<?php
class Rol
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    private $id;
	private $descripcion;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
    public function GetId()
	{
		return $this->id;
	}
	public function GetDescripcion()
	{
		return $this->descripcion;
	}

//--SETTERS
	public function SetDescripcion($valor)
	{
		$this->descripcion = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $descripcion=NULL)
	{
        $this->id = $id;
        $this->descripcion = $descripcion;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function TraerTodos()
	{
		$roles = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idRol, descripcion FROM rol");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$roles[] = new Rol($fila['idRol'], $fila['descripcion']);
		}
		
		return $roles;
	}

	public static function TraerRolPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idRol, descripcion FROM rol WHERE idRol = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$rol = new Rol($fila['idRol'], $fila['descripcion']);
		
		return $rol;
	}
//--------------------------------------------------------------------------------//
}