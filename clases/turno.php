<?php
class Turno
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    private $id;
	private $descripcion;
    private $horarioIngreso;
    private $HorarioSalida;
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
    public function GetHorarioIngreso()
	{
		return $this->horarioIngreso;
	}
	public function GetHorarioSalida()
	{
		return $this->horarioSalida;
	}

//--SETTERS
	public function SetDescripcion($valor)
	{
		$this->descripcion = $valor;
	}
	public function SetHorarioIngreso($valor)
	{
		$this->horarioIngreso = $valor;
	}
	public function SetHorarioSalida($valor)
	{
		$this->horarioSalida = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($id=NULL, $descripcion=NULL, $horaIngreso=NULL, $horaSalida=NULL)
	{
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->horarioIngreso = $horaIngreso;
        $this->horarioSalida = $horaSalida;
	}

//--------------------------------------------------------------------------------//
//--METODOS
	public static function TraerTodos()
	{
		$turnos = array();

		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idTurno, descripcion, ingreso, egreso FROM turno where idTurno <> 4");
		
		$consulta->execute();
		while($fila = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$turnos[] = new Turno($fila['idTurno'], $fila['descripcion'], $fila['ingreso'], $fila['egreso']);
		}
		
		return $turnos;
	}

	public static function TraerTurnoPorId($id)
	{
		$objConexion = Conexion::getConexion();
		$consulta = $objConexion->retornarConsulta("SELECT idRol, descripcion, ingreso, egreso FROM turno WHERE idTurno = ". $id);
		$consulta->execute();
		$fila = $consulta->fetch(PDO::FETCH_ASSOC);

		$turno = new Turno($fila['idTurno'], $fila['descripcion'], $fila['ingreso'], $fila['egreso']);
		
		return $turno;
	}
//--------------------------------------------------------------------------------//
}