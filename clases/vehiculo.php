<?php
class Vehiculo
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
    public $patente;
	public $marca;
 	public $color;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
    public function GetId()
	{
		return $this->id;
	}
    public function GetPatente()
	{
		return $this->patente;
	}
	public function GetMarca()
	{
		return $this->marca;
	}
	public function GetColor()
	{
		return $this->color;
	}

//--SETTERS
	public function SetPatente($valor)
	{
		$this->patente = $valor;
	}
	public function SetMarca($valor)
	{
		$this->marca = $valor;
	}
	public function SetColor($valor)
	{
		$this->color = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $patente=NULL, $marca=NULL, $color=NULL)
	{
		$this->id = $id;
        $this->patente = $patente;
        $this->marca = $marca;
        $this->color = $color;
	}

//--------------------------------------------------------------------------------//
//--METODOS
public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		$patente = $obj->GetPatente();
		$marca = $obj->GetMarca();
		$color = $obj->GetColor();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO vehiculo(patente, marca, color) VALUES('".$patente."', '".$marca."', '".$color."')");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function TraerTodos()
	{
		$vehiculos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idVehiculo, patente, marca, color FROM vehiculo");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$vehiculos[] = new Vehiculo($fila['idVehiculo'], $fila['patente'], $fila['marca'], $fila['color']);
		}
		
		return $vehiculos;
	}

	public static function TraerVehiculoPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idVehiculo, patente, marca, color FROM vehiculo WHERE idVehiculo = '". $id ."'");
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$vehiculo = new Vehiculo($fila['idVehiculo'], $fila['patente'], $fila['marca'], $fila['color']);
		
		return $vehiculo;
	}

	public static function TraerVehiculoPorPatente($patente)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idVehiculo, patente, marca, color FROM vehiculo WHERE patente = '". $patente ."'");
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$vehiculo = new Vehiculo($fila['idVehiculo'], $fila['patente'], $fila['marca'], $fila['color']);
		
		return $vehiculo;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$patente = $obj->GetPatente();
		$marca = $obj->GetMarca();
		$color = $obj->GetColor();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE vehiculo SET marca = '".$marca."', color = '".$color."' WHERE patente = '".$patente."'");
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function Eliminar($patente)
	{
		if($patente === NULL)
			return FALSE;
			
		$resultado = TRUE;

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM vehiculo WHERE patente = '".$patente."'");
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

		$query = "SELECT 	V.patente, 
							V.marca,
							C.numero as cochera, 
							O.ingreso, 
							O.egreso, 
							O.costo 
					FROM operaciones O
					INNER JOIN vehiculo V
					ON V.idVehiculo = O.idVehiculo
					INNER JOIN cochera C
					ON C.idCochera = O.idCochera
					WHERE O.egreso IS NOT NULL";

		if($fechaDesde != NULL and $fechaHasta != NULL){
			$query .= " AND O.ingreso > '".$fechaDesde."' AND O.egreso < '".$fechaHasta."'";
		}

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