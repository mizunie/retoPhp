<?php

namespace Cursos\CLI;

use Cursos\Services\BuscadorService;
use Cursos\Utils\TablaRenderer;

/**
 * Clase para centralizar las busquedas
 */
class SearchCommand
{

    private BuscadorService $buscadorService;

    /**
     * Constructor del servicio CLI
     * 
     * Se inyecta el servicio como dependencia.
     * 
     * @param BuscadorService $buscadorService servicio que se comunica con el repositorio de cursos.
     */
    public function __construct(BuscadorService $buscadorService)
    {
        $this->buscadorService = $buscadorService;
    }

    /**
     * Realiza validaciones, busca resultados y los imprime en pantalla;
     * dado caso no existan o no sea posible se muestra el inconveniente.
     * 
     * @param array $args argumentos que son adquiridos por la consola
     * @return void la salida se muestra directamente al usuario
     */
    public function execute(array $args): void
    {
        if (empty($args[2]))
        {
            echo "Uso: php main.php search <término>\n";
            return;
        }

        $termino = $args[2];
        $resultados = $this->buscadorService->buscar($termino);

        if (empty($resultados))
        {
            echo "No se encontraron resultados para: $termino\n";
        }
        else
        {
            TablaRenderer::imprimir($resultados);
        }
    }
}
