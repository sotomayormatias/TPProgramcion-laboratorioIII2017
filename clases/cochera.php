<?php
class Cochera
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
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
	public function __construct($numero=NULL, $estado=NULL, $piso=NULL, $tipo=NULL, $precioHora=NULL, $precioMediaEstadia=NULL, $precioEstadia=NULL)
	{
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
// public static function Guardar($obj)
// 	{
// 		$resultado = FALSE;
		
// 		$nombre = $obj->GetNombre();
// 		$correo = $obj->GetCorreo();
// 		$password = $obj->GetPassword();
// 		$rol = $obj->GetRol();
// 		$turno = $obj->GetTurno();

// 		$objConexion = Conexion::getConexion();
// 		$consulta = $objConexion->retornarConsulta("INSERT INTO producto(codigo_barra, nombre, path_foto) VALUES(".$codBarra.", '".$nombre."', '".$pathFoto."')");
// 		$cant = $consulta->execute();
		
// 		if($cant > 0)
// 		{
// 			$resultado = TRUE;			
// 		}
		
// 		return $resultado;
// 	}

	public static function TraerTodos()
	{
		$usuarios = array();

		$objConexion = Conexion::getConexion();
        //TODO: hacer la consulta con los join para traer todos los datos
		$consulta = $objConexion->retornarConsulta("SELECT nroCochera, nombre, correo, password, idRol, idTurno FROM usuario");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $fila['idRol'], $fila['idTurno']);
		}
		
		return $usuarios;
	}

	public static function TraerCocheraPorNro($numero)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idUsuario, nombre, correo, password, idRol, idTurno FROM usuario WHERE idUsuario = ".$id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$usuario = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $fila['idRol'], $fila['idTurno']);
		
		return $usuario;
	}

	public static function Modificar($obj)
	{
		$resultado = TRUE;
		
		$id = $obj->GetId();
		$nombre = $obj->GetNombre();
		$correo = $obj->GetCorreo();
		$password = $obj->GetPassword();
		$rol = $obj->GetRol();
		$turno = $obj->GetTurno();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE usuario SET nombre = '".$nombre."', correo = '".$correo."', password = '".$password."', idRol = '".$rol."', idTurno = '".$turno."' WHERE idUsuario = ".$id);
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