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
	public static function TraerTodasLasCocheras() {
		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerCocheraPorId($id) {
		try {
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerCocheraPorNro($numero) {
		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerCocherasLibres($tipoCochera) {
		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerCocherasOcupadas(){
		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Guardar($obj) {
		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Eliminar($id) {
		if($id === NULL)
			return FALSE;
			
		$resultado = TRUE;

		try {
			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("DELETE FROM cochera WHERE idCochera = ".$id);
			$cant = $consulta->execute();
			
			if($cant < 1)
			{
				$resultado = FALSE;
			}

			return $resultado;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public function CambiarEstado(){
		$resultado = TRUE;

		try{
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Modificar($obj){
		$resultado = TRUE;
		
		try {
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerEstadisticas($fechaDesde, $fechaHasta){
		$estadisticas = array();

		try {
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerMasUsadas($fechaDesde, $fechaHasta){
		$masUsadas = array();

		try {
			$objConexion = Conexion::getConexion();
			$queryMaximo = "SELECT 
						COUNT(*) as cantidadMaxima
					FROM cochera C
					INNER JOIN operaciones O
					ON C.idCochera = O.idCochera";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$queryMaximo .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
			}

			$queryMaximo .= " GROUP BY C.idcochera
					ORDER BY cantidadMaxima DESC
					LIMIT 1";

			$consulta = $objConexion->retornarConsulta($queryMaximo);
			
			$consulta->execute();
			$resultMax = $consulta->fetch(PDO::FETCH_ASSOC);
			$max = $resultMax['cantidadMaxima'];

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
						HAVING COUNT(*) = ". $max;

			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$masUsadas[] = $fila;
			}
			
			return json_encode($masUsadas);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerMenosUsadas($fechaDesde, $fechaHasta){
		$menosUsadas = array();

		try {
			$objConexion = Conexion::getConexion();
			$queryMinimo = "SELECT 
						COUNT(*) as cantidadMinima
					FROM cochera C
					INNER JOIN operaciones O
					ON C.idCochera = O.idCochera";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$queryMinimo .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
			}

			$queryMinimo .= " GROUP BY C.idcochera
					ORDER BY cantidadMinima ASC
					LIMIT 1";

			$consulta = $objConexion->retornarConsulta($queryMinimo);
			
			$consulta->execute();
			$resultMin = $consulta->fetch(PDO::FETCH_ASSOC);
			$min = $resultMin['cantidadMinima'];


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
						HAVING COUNT(*) = ". $min;

			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$menosUsadas[] = $fila;
			}
			
			return json_encode($menosUsadas);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerNuncaUsadas($fechaDesde, $fechaHasta){
		$sinUso = array();

		try {
			$objConexion = Conexion::getConexion();
			
			$query = "SELECT 	
						C.idCochera, 
						C.numero, 
						C.piso, 
						0 as cantVehiculos 
					FROM cochera C 
					LEFT JOIN 
					(SELECT *
					FROM operaciones O";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$query .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
			}

			$query .= ") AS T1
			 ON T1.idcochera = C.idCochera
					WHERE T1.idcochera IS NULL";

			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$sinUso[] = $fila;
			}
			
			return json_encode($sinUso);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsosReservadas($fechaDesde, $fechaHasta){
		$usadas = array();

		try {
			$objConexion = Conexion::getConexion();
			
			$query = "SELECT 	
						C.idCochera, 
						C.numero, 
						C.piso, 
						COUNT(CASE WHEN T1.idCochera IS NOT NULL THEN 1 END) as cantVehiculos 
					FROM cochera C 
					LEFT JOIN 
					(SELECT O.idcochera
					FROM operaciones O";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$query .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
			}

			$query .= ") AS T1
						ON T1.idcochera = C.idCochera
						WHERE C.idTipo = 2  GROUP BY C.idCochera";

			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$usadas[] = $fila;
			}
			
			return json_encode($usadas);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsosComunes($fechaDesde, $fechaHasta){
		$usadas = array();

		try {
			$objConexion = Conexion::getConexion();
			
			$query = "SELECT 	
						C.idCochera, 
						C.numero, 
						C.piso, 
						COUNT(CASE WHEN T1.idCochera IS NOT NULL THEN 1 END) as cantVehiculos 
					FROM cochera C 
					LEFT JOIN 
					(SELECT O.idcochera
					FROM operaciones O";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$query .= " WHERE O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
			}

			$query .= ") AS T1
						ON T1.idcochera = C.idCochera
						WHERE C.idTipo = 1 GROUP BY C.idCochera";

			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$usadas[] = $fila;
			}
			
			return json_encode($usadas);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}
	
//--------------------------------------------------------------------------------//
}