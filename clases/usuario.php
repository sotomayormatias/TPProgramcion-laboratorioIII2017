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
    public $estado;
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
	public function GetEstado()
	{
		return $this->estado;
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
	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $nombre=NULL, $correo=NULL, $password=NULL, $rol=NULL, $turno=NULL, $estado=NULL)
	{
		$this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->password = $password;
        $this->rol = $rol;
        $this->turno = $turno;
        $this->estado = $estado;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function Guardar($obj)
	{
		try {
			$resultado = FALSE;
			
			$nombre = $obj->GetNombre();
			$correo = $obj->GetCorreo();
			$password = $obj->GetPassword();
			$rol = $obj->GetRol();
			$turno = $obj->GetTurno();

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("INSERT INTO usuario(nombre, correo, password, idRol, idTurno, estado) VALUES('".$nombre."', '".$correo."', '".$password."', ".$rol.", ".$turno.", 1)");
			$cant = $consulta->execute();
			
			if($cant > 0)
			{
				$resultado = TRUE;			
			}
			
			return $resultado;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerTodosLosUsuarios()
	{
		try {
			$usuarios = array();

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("SELECT idUsuario, 
																nombre, 
																correo, 
																password, 
																idRol, 
																idTurno,
																estado
														FROM usuario");
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$rol = Rol::TraerRolPorId($fila['idRol']);
				$turno = Turno::TraerTurnoPorId($fila['idTurno']);
				$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno, $fila['estado']);
			}
			
			return $usuarios;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsuarioPorId($id)
	{
		try {
			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("SELECT U.idUsuario, 
																U.nombre, 
																U.correo, 
																U.password, 
																U.idRol, 
																R.descripcion as descRol,
																U.idTurno,
																T.descripcion as descTurno,
																U.estado
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
			$usuario = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno, $fila['estado']);
			
			return $usuario;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsuarioPorCorreo($correo)
	{
		try {
			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("SELECT 	idUsuario, 
																nombre, 
																correo, 
																password, 
																idRol, 
																idTurno,
																estado 
																FROM usuario 
																WHERE correo = '".$correo."'");
			$consulta->execute();
			$fila = $consulta->fetch(PDO::FETCH_ASSOC);

			$usuario = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $fila['idRol'], $fila['idTurno'], $fila['estado']);
			
			return $usuario;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsuariosPorRol($rol)
	{
		try {
			$usuarios = array();

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("SELECT U.idUsuario, 
																U.nombre, 
																U.correo, 
																U.password, 
																U.idRol, 
																R.descripcion as descRol,
																U.idTurno,
																T.descripcion as descTurno,
																U.estado
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
				$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno, $fila['estado']);
			}
			
			return $usuarios;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function TraerUsuariosPorEstado($estado)
	{
		try {
			$usuarios = array();

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("SELECT U.idUsuario, 
																U.nombre, 
																U.correo, 
																U.password, 
																U.idRol, 
																R.descripcion as descRol,
																U.idTurno,
																T.descripcion as descTurno,
																U.estado
														FROM usuario U
														INNER JOIN rol R
														ON U.idRol = R.idRol
														INNER JOIN turno T
														ON U.idTurno = T.IdTurno 
														WHERE U.estado = ".$estado);
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$rol = new Rol($fila['idRol'], $fila['descRol']);
				$turno = new Turno($fila['idTurno'], $fila['descTurno']);
				$usuarios[] = new Usuario($fila['idUsuario'], $fila['nombre'], $fila['correo'],$fila['password'], $rol, $turno, $fila['estado']);
			}
			
			return $usuarios;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Modificar($obj)
	{
		try {
			$resultado = TRUE;
			
			$id = $obj->GetId();
			$nombre = $obj->GetNombre();
			$correo = $obj->GetCorreo();
			$password = $obj->GetPassword();
			$rol = $obj->GetRol();
			$turno = $obj->GetTurno();
			$estado = $obj->GetEstado();

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta("UPDATE usuario SET nombre = '".$nombre."', correo = '".$correo."', password = '".$password."', idRol = ".$rol.", idTurno = ".$turno.", estado = ".$estado." WHERE idUsuario = ".$id);
			$cant = $consulta->execute();
				
			if($cant < 1)
			{
				$resultado = FALSE;
			}
			
			return $resultado;
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Eliminar($id)
	{
		try {
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Suspender($id)
	{
		try {
			if($id === NULL)
				return FALSE;
				
			$resultado = TRUE;

			$usuario = Usuario::TraerUsuarioPorId($id);
			$usuario->SetRol($usuario->GetRol()->getId());
			$usuario->SetTurno($usuario->GetTurno()->getId());
			$usuario->SetEstado(2);
			
			return Usuario::Modificar($usuario);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function Activar($id)
	{
		try {
			if($id === NULL)
				return FALSE;
				
			$resultado = TRUE;

			$usuario = Usuario::TraerUsuarioPorId($id);
			$usuario->SetRol($usuario->GetRol()->getId());
			$usuario->SetTurno($usuario->GetTurno()->getId());
			$usuario->SetEstado(1);
			
			return Usuario::Modificar($usuario);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public function FicharIngreso(){
		try {
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
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function traerFichajes($fechaDesde, $fechaHasta){
		try {
			$fichajes = array();

			$query = "SELECT 	U.nombre,
								T.descripcion as turno,
								F.fechaLogin
						FROM usuario U
						INNER JOIN fichaje F
						ON U.idUsuario = F.idUsuario
						INNER JOIN turno T
						ON U.idTurno = T.idTurno
						WHERE U.idRol = 2";
			
			if($fechaDesde != NULL and $fechaHasta != NULL){
				$query .= " AND fechaLogin BETWEEN '".$fechaDesde."' AND '".$fechaHasta."'";
			}

			$objConexion = Conexion::getConexion();
			$consulta = $objConexion->retornarConsulta($query);
			
			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$fichajes[] = $fila;
			}
			
			return json_encode($fichajes);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}

	public static function traerTransacciones($fechaDesde, $fechaHasta){
		try {
			$transacciones = array();

			$objConexion = Conexion::getConexion();

			$query = "SELECT 	T1.nombre, 
								SUM(T1.transacciones) AS transacciones 
						FROM ( 
							SELECT 	idempleadoingreso AS idEmpleado, 
									U.nombre, 
									COUNT(*) AS transacciones 
							FROM operaciones O 
							INNER JOIN usuario U 
								ON O.idEmpleadoIngreso = U.idUsuario";

			if($fechaDesde != NULL){
				$query .= " WHERE ingreso > '".$fechaDesde."' ";
			}

			$query .= " GROUP BY idempleadoingreso, nombre 
					UNION 
					SELECT idempleadoEgreso AS idEmpleado, 
					U.nombre, 
					COUNT(*) AS transacciones 
					FROM operaciones O 
					INNER JOIN usuario U 
					ON O.idEmpleadoEgreso = U.idUsuario";

			if($fechaHasta != NULL){
				$query .= " WHERE egreso < '".$fechaHasta."' ";
			}

			$query .= " GROUP BY idempleadoEgreso, nombre ) AS T1 
					GROUP BY T1.idEmpleado";
			
			$consulta = $objConexion->retornarConsulta($query);

			$consulta->execute();
			while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$transacciones[] = $fila;
			}
			
			return json_encode($transacciones);
		}
		catch(Exception  $e){
			return json_encode($e->getMessage());
		}
	}
//--------------------------------------------------------------------------------//
}