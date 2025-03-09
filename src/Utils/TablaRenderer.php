<?php

namespace Cursos\Utils;

use Cursos\Core\Constants;
use Cursos\Models\ResultadoBusqueda;

class TablaRenderer
{
    
    /**
     * Imprime en pantalla los datos de los cursos y examenes en una tabla.
     * 
     * El ancho de las columnas es calculado de forma dinámica
     *
     * @param ResultadoBusqueda[] $datos Lista de ResultadoBusqueda a imprimir en pantalla
     */
    public static function imprimir(array $datos)
    {
        $anchos = [
            'Tipo' => 8, // Mínimo 8 caracteres
            'Nombre' => 20, // Mínimo 20 caracteres
            'Detalles' => 9 // Mínimo 8 caracteres
        ];

        foreach ($datos as $fila)
        {
            $anchos['Tipo'] = max($anchos['Tipo'], strlen($fila->getTabla()));
            $anchos['Nombre'] = max($anchos['Nombre'], strlen($fila->getNombre()));
            $anchos['Detalles'] = max($anchos['Detalles'], strlen((string) $fila->getDetalles()));
        }

        echo str_repeat('-', array_sum($anchos) + count($anchos) * 3) . PHP_EOL;
        printf("| %-" . $anchos['Tipo'] . "s | %-" . $anchos['Nombre'] . "s | %-" . $anchos['Detalles'] . "s |\n", 'Tipo', 'Nombre', 'Detalles');
        echo str_repeat('-', array_sum($anchos) + count($anchos) * 3) . PHP_EOL;

        foreach ($datos as $fila)
        {
            $detalles = $fila->getTabla() === 'Clase' ? $fila->getDetalles() . '/5' : Constants::TIPOS_EXAMEN[$fila->getDetalles()];
            printf("| %-" . $anchos['Tipo'] . "s | %-" . $anchos['Nombre'] . "s | %-" . $anchos['Detalles'] . "s |\n",
                    $fila->getTabla(), $fila->getNombre(), $detalles);
        }

        echo str_repeat('-', array_sum($anchos) + count($anchos) * 3) . PHP_EOL;
    }
}
