<?php
include "estadoCochera.php";
include "tipoCochera.php";
class Cochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $id;
    private $numero;
	private $estado;
 	private $piso;
    private $idTipo;
    private $precioHora;
    private $precioMediaEstadia;
    private $precioEstadia;
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
	public function __construct($id=NULL, $numero=NULL, $estado=NULL, $piso=NULL, $tipo=NULL, $precioHora=NULL, $precioMediaEstadia=NULL, $precioEstadia=NULL)
	{
		$this->id = $id;
        $this->numero = $numero;
        $this->estado = $estado;
        $this->piso = $piso;
        $this->idTipo = $tipo;
        $this->precioHora = $precioHora;
        $this->precioMediaEstadia = $precioMediaEstadia;
        $this->precioEstadia = $precioEstadia;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function TraerTodos()
	{
		$cocheras = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT 	c.idCochera, 
															c.numero, 
															c.idEstado, 
															ec.descripcion as descEstado, 
															c.idTipo, 
															tc.descripcion as descTipo,
															c.piso, 
															tc.precioHora, 
															tc.precioMediaEstadia, 
															tc.precioEstadia 
													FROM cochera c
													INNER JOIN tipocochera tc
													ON tc.idTipo = c.idTipo
													INNER JOIN estadocochera ec
													ON ec.idEstado = c.idEstado");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$estado = new EstadoCochera($fila['idEstado'], $fila['descEstado']);
			$tipo = new TipoCochera($fila['idTipo'], $fila['descTipo']);
			$cocheras[] = new Cochera($fila['idCochera'], $fila['numero'], $estado, $fila['piso'], $tipo, $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		}
		
		return $cocheras;
	}

	public static function TraerCocheraPorNro($numero)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT c.idCochera, c.numero, c.idEstado, c.idTipo, c.piso, tc.precioHora, tc.precioMediaEstadia, tc.precioEstadia 
													FROM cochera c
													INNER JOIN tipocochera tc
													ON tc.idTipo = c.idTipo
													WHERE c.numero = ". $numero);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$cochera = new Cochera($fila['idCochera'], $fila['numero'], $fila['idEstado'], $fila['idTipo'],$fila['piso'], $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		
		return $cochera;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$numero = $obj->GetNumero();
		$idEstado = $obj->GetEstado();
		$piso = $obj->GetPiso();
		$idTipo = $obj->GetTipo();
		$precioHora = $obj->GetPrecioHora();
		$precioMediaEstadia = $obj->GetPrecioMediaEstadia();
		$precioEstadia = $obj->GetPrecioEstadia();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE cochera SET idEstado = ".$idEstado.", idTipo = ".$idTipo.", piso = ".$piso.", precioHora = ".$precioHora.", precioMediaEstadia = ".$precioMediaEstadia.", precioEstadia = ".$precioEstadia." WHERE numero = ".$numero);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}
	
//--------------------------------------------------------------------------------//
}