<?php

use PHPUnit\Framework\TestCase;
use Cursos\Repositories\CursoRepository;
use Cursos\Models\ResultadoBusqueda;

class CursoRepositoryTest extends TestCase
{

    private $pdoMock;
    private $stmtMock;
    private CursoRepository $cursoRepository;

    /**
     * Configura mocks para simular la conexión a la base de datos
     * 
     * @return void
     */
    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);
        $this->stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->method('prepare')->willReturn($this->stmtMock);

        $this->cursoRepository = new CursoRepository($this->pdoMock);
    }

    /**
     * Prueba que verifica el comportamiento de una busqueda exitosa
     * 
     * Simula la busqueda y valida los datos
     * 
     * @return void
     */
    public function testBuscarRetornaResultados(): void
    {
        $resultado1 = new ResultadoBusqueda();
        $resultado1->setTabla('Clase');
        $resultado1->setNombre('Curso de PHP');
        $resultado1->setDetalles('5');

        $datosSimulados = [$resultado1];

        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetchAll')->willReturn($datosSimulados);

        $resultado = $this->cursoRepository->buscar('Curso');

        $this->assertCount(1, $resultado);
        $this->assertInstanceOf(ResultadoBusqueda::class, $resultado[0]);
        $this->assertEquals($resultado1->getTabla(), $resultado[0]->getTabla());
        $this->assertEquals($resultado1->getNombre(), $resultado[0]->getNombre());
        $this->assertEquals($resultado1->getDetalles(), $resultado[0]->getDetalles());
    }

    /**
     * Prueba que verifica el comportamiento de una busqueda sin resultados para mostrar
     * 
     * Simula la consulta sin coincidencias y verifica que no existan datos en el resultado
     * 
     * @return void
     */
    public function testBuscarRetornaVacioSiNoHayResultados(): void
    {
        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetchAll')->willReturn([]);

        $resultado = $this->cursoRepository->buscar('Inexistente');

        $this->assertEmpty($resultado);
    }

    /**
     * Prueba que verifica el comportamiento de un error en base de datos
     * 
     * Simula una falla en la ejecución de la consulta.
     * 
     * @return void
     */
    public function testBuscarLanzaExcepcionSiFallaBD(): void
    {
        $this->stmtMock->method('execute')->willThrowException(new Exception("Error en BD"));

        $this->expectException(Exception::class);
        $this->cursoRepository->buscar('PHP');
    }
}
