<?php
class TipoCochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    public $id;
	public $descripcion;
    public $precioHora;
    public $precioMediaEstadia;
    public $precioEstadia;
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
	public function GetPrecioHora()
	{
		return $this->precioHora;
	}
	public function GetPrecioMediaEstadia()
	{
		return $this->precioMediaEstadia;
	}
	public function GetPrecioEstadia()
	{
		return $this->precioEstadia;
	}

//--SETTERS
	public function SetDescripcion($valor)
	{
		$this->descripcion = $valor;
	}
	public function SetPrecioHora($valor)
	{
		$this->precioHora = $valor;
	}
	public function SetPrecioMediaEstadia($valor)
	{
		$this->precioMediaEstadia = $valor;
	}
	public function SetPrecioEstadia($valor)
	{
		$this->precioEstadia = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $descripcion=NULL, $precioHora=NULL, $precioMediaEstadia=NULL, $precioEstadia=NULL)
	{
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->precioHora = $precioHora;
        $this->precioMediaEstadia = $precioMediaEstadia;
        $this->precioEstadia = $precioEstadia;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function TraerTodos()
	{
		$tipos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idTipo, 
															descripcion, 
															precioHora, 
															precioMediaEstadia, 
															precioEstadia 
													FROM tipocochera");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$tipos[] = new TipoCochera($fila['idTipo'], $fila['descripcion'], $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		}
		
		return $tipos;
	}

	public static function TraerTipoPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	idTipo, 
															descripcion, 
															precioHora, 
															precioMediaEstadia, 
															precioEstadia 
													FROM tipocochera 
													WHERE idTipo = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$tipo = new TipoCochera($fila['idTipo'], $fila['descripcion'], $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		
		return $tipo;
	}
//--------------------------------------------------------------------------------//
}