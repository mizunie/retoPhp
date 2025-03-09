<?php

namespace Cursos\Models;

class ResultadoBusqueda
{

    private string $nombre;
    private string $detalles;
    private string $tabla;

    public function __construct()
    {
        
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDetalles(string $detalles): void
    {
        $this->detalles = $detalles;
    }

    public function setTabla(string $tabla): void
    {
        $this->tabla = $tabla;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDetalles(): string
    {
        return $this->detalles;
    }

    public function getTabla(): string
    {
        return $this->tabla;
    }
}
