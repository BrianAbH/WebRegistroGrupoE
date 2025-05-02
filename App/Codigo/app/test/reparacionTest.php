<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/Reparacion.php';

class ReparacionTest extends TestCase {
    private $mockDb;

    protected function setUp(): void {
        $this->mockDb = $this->createMock(mysqli::class);
    }

    public function testGuardarReparacionNuevaExitoso() {
        $data = [
            'id' => null,
            'movil' => 1,
            'tecnico' => 2,
            'repuestos' => 'Pantalla, Batería',
            'total_repuestos' => 100,
            'servicio' => 'Cambio de pantalla',
            'total_servicio' => 50,
            'FechaReparacion' => '30-04-2025'
        ];

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->guardar($data);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }

    public function testGuardarReparacionActualizarExitoso() {
        $data = [
            'id' => 1,
            'movil' => 1,
            'tecnico' => 2,
            'repuestos' => 'Pantalla',
            'total_repuestos' => 80,
            'servicio' => 'Revisión general',
            'total_servicio' => 40,
            'FechaReparacion' => '29-04-2025'
        ];

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->guardar($data);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }

    public function testEliminarReparacionExitoso() {
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->eliminar(1);

        $this->assertTrue($resultado);
    }

    public function testObtenerReparaciones() {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_all')->willReturn([
            [
                'Id_Reparacion' => 1,
                'Nombre_Completo' => 'Luis Alvarez',
                'Id_Tecnico' => 2,
                'Nombre_Tecnico' => 'Carlos Mejía',
                'Id_Dispositivo' => 3,
                'Tipo' => 'Tablet',
                'Marca' => 'Apple',
                'Modelo' => 'iPad Pro',
                'Repuestos' => 'Pantalla',
                'Total_Repuestos' => 150,
                'Servicio' => 'Cambio',
                'Total_Servicio' => 60,
                'Fecha_Reparacion' => '2024-05-01'
            ]
        ]);

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->obtenerReparacion();

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertEquals('Luis Alvarez', $resultado[0]['Nombre_Completo']);
    }

    public function testObtenerDispositivosByCliente() {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_all')->willReturn([
            ['Id_Dispositivo' => 1, 'Nombre_Completo' => 'Juan Perez', 'Modelo' => 'Galaxy S21']
        ]);

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->obtenerDispositivosByCliente();

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertEquals('Juan Perez', $resultado[0]['Nombre_Completo']);
    }

    public function testObtenerTecnicoById() {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_all')->willReturn([
            ['Id_Tecnico' => 2, 'Nombre_Tecnico' => 'Carlos Mejía']
        ]);

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('get_result')->willReturn($mockResult);
        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $reparacion = new Reparacion($this->mockDb);
        $resultado = $reparacion->obtenerTecnicoById();

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertEquals('Carlos Mejía', $resultado[0]['Nombre_Tecnico']);
    }
}
