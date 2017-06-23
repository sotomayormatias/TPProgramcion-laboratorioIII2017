<?php
include_once "rol.php";
include_once "turno.php";

class Usuario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    public $id;
	public $nombre;
 	public $correo;
    public $password;
    public $rol;
    public $turno;
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
		$consulta = $objConexion->retornarConsulta("INSERT INTO usuario(nombre, correo, password, idRol, idTurno) VALUES('".$nombre."', '".$correo."', '".$password."', ".$rol.", ".$turno.")");
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
		$consulta = $objConexion->retornarConsulta("SELECT idUsuario, 
															nombre, 
															correo, 
															password, 
															idRol, 
															idTurno
													FROM usuario");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$rol = Rol::TraerRolPorId($fila['idRol']);
			$turno = Turno::TraerTurnoPorId($fila['idTurno']);
			$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno);
		}
		
		return $usuarios;
	}

	public static function TraerUsuarioPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT U.idUsuario, 
															U.nombre, 
															U.correo, 
															U.password, 
															U.idRol, 
															R.descripcion as descRol,
															U.idTurno,
															T.descripcion as descTurno
													FROM usuario U
													INNER JOIN rol R
													ON U.idRol = R.idRol
													INNER JOIN turno T
													ON U.idTurno = T.IdTurno 
													WHERE U.idUsuario = ".$id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$rol = new Rol($fila['idRol'], $fila['descRol']);
		$turno = new Turno($fila['idTurno'], $fila['descTurno']);
		$usuario = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno);
		
		return $usuario;
	}

	public static function TraerUsuarioPorCorreo($correo)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idUsuario, nombre, correo, password, idRol, idTurno FROM usuario WHERE correo = '".$correo."'");
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$usuario = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $fila['idRol'], $fila['idTurno']);
		
		return $usuario;
	}

	public static function TraerUsuariosPorRol($rol)
	{
		$usuarios = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT U.idUsuario, 
															U.nombre, 
															U.correo, 
															U.password, 
															U.idRol, 
															R.descripcion as descRol,
															U.idTurno,
															T.descripcion as descTurno
													FROM usuario U
													INNER JOIN rol R
													ON U.idRol = R.idRol
													INNER JOIN turno T
													ON U.idTurno = T.IdTurno 
													WHERE U.idRol = ".$rol);
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$rol = new Rol($fila['idRol'], $fila['descRol']);
			$turno = new Turno($fila['idTurno'], $fila['descTurno']);
			$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno);
		}
		
		return $usuarios;
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

	public function FicharIngreso(){
        date_default_timezone_set('America/Argentina/Buenos_Aires');
		$idUsuario = $this->GetId();
		$entrada = date("Y-m-d H:i:s");

		$resultado = TRUE;
		
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("INSERT INTO fichaje(idUsuario, fechaLogin) VALUES(" .$idUsuario. ", '" .$entrada. "')");
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}
//--------------------------------------------------------------------------------//
}