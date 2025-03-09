<?php

require 'vendor/autoload.php';

use Cursos\CLI\SearchCommand;
use Cursos\Services\BuscadorService;
use Cursos\Repositories\CursoRepository;
use Cursos\Core\Database;

if ($argc < 3 || $argv[1] !== 'search') {
    echo "Uso: php main.php search <mínimo tres caracteres>\n";
    exit(1);
}

$db = Database::getConnection();
$repositorio = new CursoRepository($db);
$buscador = new BuscadorService($repositorio);
$comando = new SearchCommand($buscador);

$comando->execute($argv);
