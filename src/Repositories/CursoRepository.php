<?php

namespace Cursos\Repositories;

use PDO;
use Cursos\Models\ResultadoBusqueda;

class CursoRepository
{

    private PDO $db;

    /**
     * Crea un repositorio para interactuar con la base de datos
     * como parametro se inyecta la conexión usando PDO
     * 
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Busca en la base de datos coincidencias con el término suministrado.
     * El proceso finaliza si no cumple con los caracteres mínimos de busqueda.
     *
     * @param string $termino Término a buscar (mínimo 3 caracteres).
     * @return ResultadoBusqueda[] Lista de resultados encontrados. Puede estar vacío si no hay coincidencias.
     */
    public function buscar(string $termino): array
    {
        if (strlen($termino) < 3)
        {
            echo "Debe ingresar un mínimo de tres caracteres en la busqueda\n";
            exit(1);
        }
        
        $termino = trim($termino) . '*';

        $sql = "SELECT nombre, ponderacion AS detalles, 'Clase' AS tabla FROM clases 
                WHERE MATCH(nombre) AGAINST(:termino IN BOOLEAN MODE)
                UNION 
                SELECT nombre, tipo AS detalles, 'Examen' AS tabla FROM examenes 
                WHERE MATCH(nombre) AGAINST(:termino IN BOOLEAN MODE)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['termino' => $termino]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, ResultadoBusqueda::class);
    }
}
