<?php
class Vehiculo
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    private $patente;
	private $marca;
 	private $color;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
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
	public function __construct($patente=NULL, $marca=NULL, $color=NULL)
	{
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
		$consulta = $objConexion->retornarConsulta("INSERT INTO producto(codigo_barra, nombre, path_foto) VALUES(".$codBarra.", '".$nombre."', '".$pathFoto."')");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function TraerTodos()
	{
		$cocheras = array();

		$objConexion = Conexion::getConexion();
        //TODO: hacer la consulta con los join para traer todos los datos
		$consulta = $objConexion->retornarConsulta("SELECT c.nroCochera, c.idEstado, c.idTipo, c.piso, tc.precioHora, tc.precioMediaEstadia, tc.precioEstadia 
													FROM cochera c
													INNER JOIN tipocochera tc
													ON tc.idTipo = c.idTipo");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$cocheras[] = new Cochera($fila['nroCochera'], $fila['idEstado'], $fila['idTipo'],$fila['piso'], $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		}
		
		return $cocheras;
	}

	public static function TraerCocheraPorNro($numero)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT c.nroCochera, c.idEstado, c.idTipo, c.piso, tc.precioHora, tc.precioMediaEstadia, tc.precioEstadia 
													FROM cochera c
													INNER JOIN tipocochera tc
													ON tc.idTipo = c.idTipo
													WHERE c.nroCochera = ". $numero);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$cochera = new Cochera($fila['nroCochera'], $fila['idEstado'], $fila['idTipo'],$fila['piso'], $fila['precioHora'], $fila['precioMediaEstadia'], $fila['precioEstadia']);
		
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
		$consulta = $objConexion->retornarConsulta("UPDATE cochera SET idEstado = ".$idEstado.", idTipo = ".$idTipo.", piso = ".$piso.", precioHora = ".$precioHora.", precioMediaEstadia = ".$precioMediaEstadia.", precioEstadia = ".$precioEstadia." WHERE nroCochera = ".$numero);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	// public static function Eliminar($id)
	// {
	// 	if($id === NULL)
	// 		return FALSE;
			
	// 	$resultado = TRUE;
		
	// 	$usuario = Usuario::TraerUsuarioPorId($id);

	// 	$objConexion = Conexion::getConexion();
	// 	$consulta = $objConexion->retornarConsulta("DELETE FROM usuario WHERE idUsuario = ".$id);
	// 	$cant = $consulta->execute();
		
	// 	if($cant < 1)
	// 	{
	// 		$resultado = FALSE;
	// 	}

	// 	return $resultado;
	// }
//--------------------------------------------------------------------------------//
}