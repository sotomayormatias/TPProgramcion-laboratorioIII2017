<?php
class Operacion
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id;
    private $cochera;
	private $vehiculo;
 	private $costo;
    private $ingreso;
    private $egreso;
    private $empleadoIngreso;
    private $empleadoEgreso;
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
	public static function TraerTodos()
	{
		$operaciones = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idOperacion, 
															idCochera, 
															idVehiculo, 
															costo, 
															ingreso, 
															egreso,
															idEmpleadoIngreso, 
															idEmpleadoEgreso
													FROM operaciones");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$operaciones[] = new Operacion($fila['idOperacion'], $fila['idCochera'], $fila['idVehiculo'], $fila['costo'], $fila['ingreso'], $fila['egreso'], $fila['idEmpleadoIngreso'], $fila['idEmpleadoEgreso']);
		}
		
		return $operaciones;
	}

	public static function TraerOperacionPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idOperacion, 
															idCochera, 
															idVehiculo, 
															costo, 
															ingreso, 
															egreso,
															idEmpleadoIngreso, 
															idEmpleadoEgreso
													FROM operaciones
													WHERE idOperacion = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$operacion = new Operacion($fila['idOperacion'], $fila['idCochera'], $fila['idVehiculo'], $fila['costo'], $fila['ingreso'], $fila['egreso'], $fila['idEmpleadoIngreso'], $fila['idEmpleadoEgreso']);
		
		return $operacion;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$id = $obj->GetId();
		$idCochera = $obj->GetCochera();
		$vehiculo = $obj->GetVehiculo();
		$costo = $obj->GetCosto();
		$ingreso = $obj->GetIngreso();
		$egreso = $obj->GetEgreso();
		$idEmpleadoIngreso = $obj->GetEmpleadoIngreso();
		$idEmpleadoEgreso = $obj->GetEmpleadoEgreso();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE operaciones SET idCochera = ".$idCochera.", idVehiculo = '".$vehiculo."', costo = ".$costo.", ingreso = ".$ingreso.", egreso = ".$egreso.", idEmpleadoIngreso = ".$idEmpeladoIngreso.", idEmpleadoEgreso = ".$idEmpleadoEgreso." WHERE idOperacion = ".$id);
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
		$consulta = $objConexion->retornarConsulta("INSERT INTO operaciones(idCochera, idVehiculo, costo, ingreso, egreso, idEmpleadoIngreso, idEmpleadoEgreso) VALUES(".$cochera->getId().", ".$idVehiculo.", ".$costo.", ".$ingreso.", ".$egreso.", ".$idEmpleadoIngreso.", ".$idEmpleadoEgreso.")");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}
	
//--------------------------------------------------------------------------------//
}