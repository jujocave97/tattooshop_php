<?php
require_once "./models/Tatuador.php";
class Cita implements JsonSerializable
{
    private $id;
    private $descripcion;
    private $fechaCita;
    private $cliente;
    private $tatuadorID;

    public function __construct($id = null, $descripcion = null, $fechaCita = null, $cliente = null, $tatuadorID = null){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fechaCita = $fechaCita;
        $this->cliente = $cliente;
        $this->tatuadorID = $tatuadorID;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getFechaCita()
    {
        return $this->fechaCita;
    }

    /**
     * @param mixed $fechaCita
     */
    public function setFechaCita($fechaCita)
    {
        $this->fechaCita = $fechaCita;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getTatuador()
    {
        return $this->tatuador;
    }

    /**
     * @param mixed $tatuador
     */
    public function setTatuador($tatuador)
    {
        $this->tatuador = $tatuador;
    }

    public function jsonSerialize(): array
    {
        return[
            'descripcion'=>$this->descripcion,
            'fechaCita'=>$this->fechaCita,
            'cliente'=>$this->cliente,
            'tatuador'=>$this->tatuadorID
        ];
    }
}