<?php
class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    private $id;
	private $nombre;
 	private $correo;
    private $password;
    private $rol;
    private $turno;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS
    public function GetId()
	{
		return $this->id;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetCorreo()
	{
		return $this->correo;
	}
	public function GetPassword()
	{
		return $this->password;
	}
	public function GetRol()
	{
		return $this->rol;
	}
	public function GetTurno()
	{
		return $this->turno;
	}

//--SETTERS
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetCorreo($valor)
	{
		$this->correo = $valor;
	}
	public function SetPassword($valor)
	{
		$this->password = $valor;
	}
	public function SetRol($valor)
	{
		$this->rol = $valor;
	}
	public function SetTurno($valor)
	{
		$this->turno = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $nombre=NULL, $correo=NULL, $password=NULL, $rol=NULL, $turno=NULL)
	{
		$this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->rol = $rol;
        $this->turno = $turno;
	}

//--------------------------------------------------------------------------------//
//--METODOS
public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		$nombre = $obj->GetNombre();
		$correo = $obj->GetCorreo();
		$password = $obj->GetPassword();
		$rol = $obj->GetRol();
		$turno = $obj->GetTurno();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO usuario(nombre, correo, password, rol, turno) VALUES('".$nombre."', '".$correo."', '".$password."', ".$rol.", ".$turno.")");
		$cant = $consulta->execute();
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		return $resultado;
	}

	public static function TraerTodos()
	{
		$usuarios = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idUsuario, nombre, correo, password, idRol, idTurno FROM usuario");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $fila['idRol'], $fila['idTurno']);
		}
		
		return $usuarios;
	}

	public static function TraerUsuarioPorId($id)
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
		$consulta = $objConexion->retornarConsulta("UPDATE usuario SET nombre = '".$nombre."', correo = '".$correo."', password = '".$password."', idRol = ".$rol.", idTurno = ".$turno." WHERE idUsuario = ".$id);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function Eliminar($id)
	{
		if($id === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM usuario WHERE idUsuario = ".$id);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}
//--------------------------------------------------------------------------------//
}