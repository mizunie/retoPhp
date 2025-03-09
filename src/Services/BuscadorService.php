<?php

namespace Cursos\Services;

use Cursos\Repositories\CursoRepository;

/**
 * Servicio de búsqueda que interactúa con el repositorio de cursos.
 */
class BuscadorService
{

    private CursoRepository $cursoRepository;

    /**
     * Constructor del servicio.
     * 
     * Se inyecta el repositorio de cursos como dependencia.
     * 
     * @param CursoRepository $cursoRepository Repositorio encargado de la búsqueda de cursos.
     */
    public function __construct(CursoRepository $cursoRepository)
    {
        $this->cursoRepository = $cursoRepository;
    }

    /**
     * Realiza una búsqueda en el repositorio según el término proporcionado.
     *
     * @param string $termino Término a buscar (mínimo 3 caracteres).
     * @return ResultadoBusqueda[] Lista de resultados encontrados. Puede estar vacío si no hay coincidencias.
     */
    public function buscar(string $termino): array
    {
        return $this->cursoRepository->buscar($termino);
    }
}
