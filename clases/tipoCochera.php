<?php
class TipoCochera
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
		$tipos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idTipo, descripcion FROM tipocochera");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$tipos[] = new TipoCochera($fila['idTipo'], $fila['descripcion']);
		}
		
		return $tipos;
	}

	public static function TraerTipoPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idTipo, descripcion FROM tipocochera WHERE idTipo = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$tipo = new TipoCochera($fila['idTipo'], $fila['descripcion']);
		
		return $tipo;
	}
//--------------------------------------------------------------------------------//
}