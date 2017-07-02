<?php
include_once "estadoCochera.php";
include_once "tipoCochera.php";
class Cochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
    public $numero;
	public $estado;
 	public $piso;
    public $idTipo;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
    public function GetId()
	{
		return $this->id;
	}
    public function GetNumero()
	{
		return $this->numero;
	}
	public function GetEstado()
	{
		return $this->estado;
	}
	public function GetPiso()
	{
		return $this->piso;
	}
	public function GetTipo()
	{
		return $this->idTipo;
	}

//--SETTERS
	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}
	public function SetPiso($valor)
	{
		$this->piso = $valor;
	}
	public function SetTipo($valor)
	{
		$this->idTipo = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $numero=NULL, $estado=NULL, $piso=NULL, $tipo=NULL)
	{
		$this->id = $id;
        $this->numero = $numero;
        $this->estado = $estado;
        $this->piso = $piso;
        $this->idTipo = $tipo;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	// public static function TraerTodos()
	// {
	// 	$cocheras = array();

	// 	$objConexion = Conexion::getConexion();
	// 	$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
	// 														numero, 
	// 														idEstado,  
	// 														idTipo, 
	// 														piso
	// 												FROM cochera");
		
	// 	$consulta->execute();
	// 	while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
	// 	{
	// 		$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
	// 		$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
	// 		$cocheras[] = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
	// 	}
		
	// 	return $cocheras;
	// }

	public static function TraerTodasLasCocheras()
	{
		$cocheras = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
															numero, 
															idEstado,  
															idTipo, 
															piso
													FROM cochera");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
			$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
			$cocheras[] = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
		}
		
		return $cocheras;
	}

	public static function TraerCocheraPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
															numero, 
															idEstado,  
															idTipo, 
															piso
													FROM cochera
													WHERE idCochera = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
		$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
		$cochera = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
		
		return $cochera;
	}

	public static function TraerCocheraPorNro($numero)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
															numero, 
															idEstado,  
															idTipo, 
															piso
													FROM cochera
													WHERE numero = ". $numero);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
		$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
		$cochera = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
		
		return $cochera;
	}

	public static function TraerCocherasLibres($tipoCochera){
		$cocheras = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
															numero, 
															idEstado,  
															idTipo, 
															piso
													FROM cochera
													WHERE idTipo = ". $tipoCochera .
													" AND idEstado = 1");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
			$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
			$cocheras[] = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
		}
		
		return $cocheras;
	}

	public static function TraerCocherasOcupadas(){
		$cocheras = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idCochera, 
															numero, 
															idEstado,  
															idTipo, 
															piso
													FROM cochera
													WHERE idEstado = 2");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estado = EstadoCochera::TraerEstadoPorId($fila['idEstado']);
			$tipo = TipoCochera::TraerTipoPorId($fila['idTipo']);
			$cocheras[] = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo);
		}
		
		return $cocheras;
	}

	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		$numero = $obj->GetNumero();
		$estado = $obj->GetEstado();
		$piso = $obj->GetPiso();
		$tipo = $obj->GetTipo();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO cochera(numero, idEstado, idTipo, piso) VALUES(".$numero.", ".$estado.", ".$tipo.", ".$piso.")");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function Eliminar($id)
	{
		if($id === NULL)
			return FALSE;
			
		$resultado = TRUE;

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM cochera WHERE idCochera = ".$id);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}

	public function CambiarEstado()
	{
		$resultado = TRUE;

		$objConexion = Conexion::getConexion();
		if($this->GetEstado()->GetId() == 1){
			$consulta = $objConexion->retornarConsulta("UPDATE cochera SET idEstado = 2 WHERE idCochera = " .$this->GetId());
		}
		else {
			$consulta = $objConexion->retornarConsulta("UPDATE cochera SET idEstado = 1 WHERE idCochera = " .$this->GetId());
		}
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$id = $obj->GetId();
		$numero = $obj->GetNumero();
		$idEstado = $obj->GetEstado()->GetId();
		$piso = $obj->GetPiso();
		$idTipo = $obj->GetTipo()->GetId();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE cochera SET numero = ".$numero.", idEstado = ".$idEstado.", idTipo = ".$idTipo.", piso = ".$piso." WHERE idCochera = ".$id);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function TraerEstadisticas($fechaDesde, $fechaHasta){
		$estadisticas = array();

		$objConexion = Conexion::getConexion();
		$query = "SELECT 	
					C.idCochera, 
					C.numero, 
					C.piso, 
					COUNT(*) as cantVehiculos
				FROM cochera C
				INNER JOIN operaciones O
				ON C.idCochera = O.idCochera";
		
		if($fechaDesde != NULL and $fechaHasta != NULL){
			$query .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
		}

		$query .= " GROUP BY C.idcochera
				ORDER BY cantVehiculos DESC";

		$consulta = $objConexion->retornarConsulta($query);
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estadisticas[] = $fila;
		}
		
		return json_encode($estadisticas);
	}
	
//--------------------------------------------------------------------------------//
}