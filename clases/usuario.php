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
		// $consulta = $objConexion->retornarConsulta("INSERT INTO producto(codigo_barra, nombre, path_foto) VALUES(".$codBarra.", '".$nombre."', '".$pathFoto."')");
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
		$consulta = $objConexion->retornarConsulta("SELECT codigo_barra, nombre, path_foto FROM producto");
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$usuarios[] = new Usuario($fila['codigo_barra'], $fila['nombre'], $fila['path_foto']);
		}
		
		return $usuarios;
	}

	public static function TraerProductoDeBDPorCodigo($codBarra)
	{
		$ListaDeProductosLeidos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT codigo_barra, nombre, path_foto FROM producto WHERE codigo_barra = ".$codBarra);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$producto = new Producto($fila['codigo_barra'], $fila['nombre'], $fila['path_foto']);
		
		return $producto;
	}

	public static function ModificarEnBD($obj)
	{
		$resultado = TRUE;
		
		$codBarra = $obj->GetCodBarra();
		$nombre = $obj->GetNombre();
		$pathFoto = $obj->GetPathFoto();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("UPDATE producto SET nombre = '".$nombre."', path_foto = '".$pathFoto."' WHERE codigo_barra = ".$codBarra);
		$cant = $consulta->execute();
			
		if($cant < 1)
		{
			$resultado = FALSE;
		}
		
		return $resultado;
	}

	public static function EliminarDeBD($codBarra)
	{
		if($codBarra === NULL)
			return FALSE;
			
		$resultado = TRUE;
		
		$producto = Producto::TraerProductoDeBDPorCodigo($codBarra);
		unlink("archivos/".$producto->GetPathFoto());

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("DELETE FROM producto WHERE codigo_barra = ".$codBarra);
		$cant = $consulta->execute();
		
		if($cant < 1)
		{
			$resultado = FALSE;
		}

		return $resultado;
	}
//--------------------------------------------------------------------------------//
}