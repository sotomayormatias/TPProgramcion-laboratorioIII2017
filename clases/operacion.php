<?php
class Operacion
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	public $id;
    public $cochera;
	public $vehiculo;
 	public $costo;
    public $ingreso;
    public $egreso;
    public $empleadoIngreso;
    public $empleadoEgreso;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
    public function GetId()
	{
		return $this->id;
	}
    public function GetCochera()
	{
		return $this->cochera;
	}
	public function GetVehiculo()
	{
		return $this->vehiculo;
	}
	public function GetCosto()
	{
		return $this->costo;
	}
	public function GetIngreso()
	{
		return $this->ingreso;
	}
	public function GetEgreso()
	{
		return $this->egreso;
	}
	public function GetEmpleadoIngreso()
	{
		return $this->empleadoIngreso;
	}
	public function GetEmpleadoEgreso()
	{
		return $this->empleadoEgreso;
	}

//--SETTERS
	public function SetCochera($valor)
	{
		$this->cochera = $valor;
	}
	public function SetVehiculo($valor)
	{
		$this->vehiculo = $valor;
	}
	public function SetCosto($valor)
	{
		$this->costo = $valor;
	}
	public function SetIngreso($valor)
	{
		$this->ingreso = $valor;
	}
	public function SetEgreso($valor)
	{
		$this->egreso = $valor;
	}
	public function SetEmpleadoIngreso($valor)
	{
		$this->empleadoIngreso = $valor;
	}
	public function SetEmpleadoEgreso($valor)
	{
		$this->empleadoEgreso = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $cochera=NULL, $vehiculo=NULL, $costo=NULL, $ingreso=NULL, $egreso=NULL, $empleadoIngreso=NULL, $empleadoEgreso=NULL)
	{
		$this->id = $id;
        $this->cochera = $cochera;
        $this->vehiculo = $vehiculo;
        $this->costo = $costo;
        $this->ingreso = $ingreso;
        $this->egreso = $egreso;
        $this->empleadoIngreso = $empleadoIngreso;
        $this->empleadoEgreso = $empleadoEgreso;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function TraerTodasLasOperaciones()
	{
		$operaciones = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	O.idOperacion, 
															O.idCochera, 
															O.idVehiculo, 
															O.costo, 
															O.ingreso, 
															O.egreso,
															O.idEmpleadoIngreso, 
															O.idEmpleadoEgreso
													FROM operaciones O
													WHERE O.egreso is NULL");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$cochera = Cochera::TraerCocheraPorId($fila['idCochera']);
			$vehiculo = Vehiculo::TraerVehiculoPorId($fila['idVehiculo']);
			$operaciones[] = new Operacion($fila['idOperacion'], $cochera, $vehiculo, $fila['costo'], $fila['ingreso'], $fila['egreso'], $fila['idEmpleadoIngreso'], $fila['idEmpleadoEgreso']);
		}
		
		return $operaciones;
	}

	public static function TraerOperacionPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	O.idOperacion, 
															O.idCochera, 
															O.idVehiculo,
															O.costo, 
															O.ingreso, 
															O.egreso,
															O.idEmpleadoIngreso, 
															O.idEmpleadoEgreso
													FROM operaciones O
													WHERE idOperacion = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$cochera = Cochera::TraerCocheraPorId($fila['idCochera']);
		$vehiculo = Vehiculo::TraerVehiculoPorId($fila['idVehiculo']);
		$operacion = new Operacion($fila['idOperacion'], $cochera, $vehiculo, $fila['costo'], $fila['ingreso'], $fila['egreso'], $fila['idEmpleadoIngreso'], $fila['idEmpleadoEgreso']);
		
		return $operacion;
	}


	public static function TraerOperacionPorPatente($patente)
	{
		$operaciones = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	O.idOperacion, 
															O.idCochera, 
															O.idVehiculo,
															O.costo, 
															O.ingreso, 
															O.egreso,
															O.idEmpleadoIngreso, 
															O.idEmpleadoEgreso
													FROM operaciones O
													INNER JOIN vehiculo V
													ON V.idvehiculo = O.idVehiculo
													WHERE V.patente = '". $patente.
														"' OR '" .$patente. "' = '' AND O.egreso is NULL");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$cochera = Cochera::TraerCocheraPorId($fila['idCochera']);
			$vehiculo = Vehiculo::TraerVehiculoPorId($fila['idVehiculo']);
			$operaciones[] = new Operacion($fila['idOperacion'], $cochera, $vehiculo, $fila['costo'], $fila['ingreso'], $fila['egreso'], $fila['idEmpleadoIngreso'], $fila['idEmpleadoEgreso']);
		}
		
		return $operaciones;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$id = $obj->GetId();
		$cochera = $obj->GetCochera();
		$vehiculo = $obj->GetVehiculo();
		$costo = $obj->GetCosto();
		$ingreso = $obj->GetIngreso();
		$egreso = $obj->GetEgreso();
		$idEmpleadoIngreso = $obj->GetEmpleadoIngreso();
		$idEmpleadoEgreso = $obj->GetEmpleadoEgreso();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE operaciones 
													SET idCochera = ".$cochera->GetId().
														", idVehiculo = ".$vehiculo->GetId().
														", costo = ".$costo.
														", ingreso = '".$ingreso.
														"', egreso = '".$egreso.
														"', idEmpleadoIngreso = ".$idEmpleadoIngreso.
														", idEmpleadoEgreso = ".$idEmpleadoEgreso.
														" WHERE idOperacion = ".$id);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		$cochera = $obj->GetCochera();
		$vehiculo = $obj->GetVehiculo();
		$costo = $obj->GetCosto();
		$ingreso = "'" .$obj->GetIngreso(). "'";
		$egreso = $obj->GetEgreso() != null ? "'" .$obj->GetEgreso(). "'" : "null";
		$idEmpleadoIngreso = $obj->GetEmpleadoIngreso();
		$idEmpleadoEgreso = $obj->GetEmpleadoEgreso() != null ? $obj->GetEmpleadoEgreso() : "null";

		$objConexion = Conexion::getConexion();
		//Agrego el vehiculo
		Vehiculo::Guardar($vehiculo);
		$idVehiculo = Vehiculo::TraerVehiculoPorPatente($vehiculo->GetPatente())->GetId();

		//Cambio el estado de la cochera
		$cochera->CambiarEstado();

		//Agrego la operacion
		$consulta = $objConexion->retornarConsulta("INSERT INTO operaciones(idCochera, idVehiculo, costo, ingreso, egreso, idEmpleadoIngreso, idEmpleadoEgreso) 
													VALUES(".$cochera->getId().", ".$idVehiculo.", ".$costo.", ".$ingreso.", ".$egreso.", ".$idEmpleadoIngreso.", ".$idEmpleadoEgreso.")");
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
		$consulta = $objConexion->retornarConsulta("DELETE FROM operaciones WHERE idOperacion = ".$id);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}

	public static function calcularCosto($id){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
		
		$operacion = Operacion::TraerOperacionPorId($id);
		$cochera = $operacion->getCochera();
		$costo = 0;
		$fechaIngreso = $operacion->GetIngreso();
		$hoy = date("Y-m-d H:i:s");
		$tiempo = (strtotime($hoy) - strtotime($fechaIngreso)) / 3600;

		if($tiempo <= 1){
			$costo = $cochera->GetTipo()->getPrecioHora();
		}
		else if($tiempo > 1 && $tiempo <= 12){
			$costo = $cochera->GetTipo()->getPrecioMediaEstadia();
		}
		else{
			$cantDias = $tiempo / 24;
			if($cantDias - round($cantDias) > 0){
				$costo = ($cochera->GetTipo()->getPrecioEstadia() * floor($cantDias)) + $cochera->GetTipo()->getPrecioMediaEstadia();
			}
			else{
				$costo = $cochera->GetTipo()->getPrecioEstadia() * ceil($cantDias);
			}
		}
		return $costo;
	}

	public static function traerTransacciones($fechaDesde, $fechaHasta){
		$operaciones = array();
		$objConexion = Conexion::getConexion();

		$query = "SELECT 	idOperacion, costo
					FROM operaciones";

		if($fechaDesde != NULL && $fechaHasta != NULL){
			$query .= " WHERE ingreso between '".$fechaDesde."' AND '".$fechaHasta."'";
		};
						
		$query .= " UNION 
					SELECT idOperacion, costo
						FROM operaciones";
		
		if($fechaDesde != NULL && $fechaHasta != NULL){
			$query .= " WHERE egreso between '".$fechaDesde."' AND '".$fechaHasta."'";
		};

		$consulta = $objConexion->retornarConsulta($query);

		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$operaciones[] = new Operacion($fila['idOperacion'], NULL, NULL, $fila['costo'], NULL, NULL, NULL, NULL);
		}
		
		return $operaciones;
	}
	
//--------------------------------------------------------------------------------//
}