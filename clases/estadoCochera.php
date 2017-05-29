<?php
class EstadoCochera
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
		$estados = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idEstado, descripcion FROM estadocochera");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estados[] = new EstadoCochera($fila['idEstado'], $fila['descripcion']);
		}
		
		return $estados;
	}

	public static function TraerEstadoPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idEstado, descripcion FROM estadocochera WHERE idEstado = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$estado = new EstadoCochera($fila['idEstado'], $fila['descripcion']);
		
		return $estado;
	}
//--------------------------------------------------------------------------------//
}