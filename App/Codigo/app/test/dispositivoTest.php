<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/Dispositivo.php';

class DispositivoTest extends TestCase {

    private $mockDb;

    protected function setUp(): void {
        $this->mockDb = $this->createMock(mysqli::class);
    }

    public function testGuardarDispositivoNuevoExitoso() {
        $data = [
            'id' => null,
            'cliente' => 1,
            'tipo' => 'Smartphone',
            'marca' => 'Samsung',
            'modelo' => 'Galaxy S21',
            'anio' => 2021
        ];
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('bind_param')->willReturn(true); // ✅ Agregado
        $mockStmt->method('execute')->willReturn(true);
    
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $dispositivo = new Dispositivo($this->mockDb);
        $resultado = $dispositivo->guardar($data);
    
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }
    

    public function testGuardarDispositivoActualizarExitoso() {
        $data = [
            'id' => 1,
            'cliente' => 1,
            'tipo' => 'Smartphone',
            'marca' => 'IPhone',
            'modelo' => 'Xr',
            'anio' => 2023
        ];
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('bind_param')->willReturn(true); // ⚠️ esta línea es crítica
        $mockStmt->method('execute')->willReturn(true);

        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $dispositivo = new Dispositivo($this->mockDb);
        $resultado = $dispositivo->guardar($data);

        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }

    public function testEliminarDispositivoExitoso() {
        $dispositivo = new Dispositivo($this->mockDb);
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $resultado = $dispositivo->eliminar(1);
    
        $this->assertTrue($resultado);
    }

    public function testObtenerDispositivos() {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_all')->willReturn([
            [
                'Id_Dispositivo' => 1,
                'Id_Cliente' => 1,
                'Nombre_Completo' => 'Juan Perez',
                'Apellidos' => 'Perez',
                'Tipo' => 'Smartphone',
                'Marca' => 'Samsung',
                'Modelo' => 'Galaxy S21',
                'Año' => 2021,
                'Activo' => 1
            ]
        ]);

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('get_result')->willReturn($mockResult);

        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $dispositivo = new Dispositivo($this->mockDb);
        $dispositivos = $dispositivo->obtenerDispositivos();
    
        $this->assertIsArray($dispositivos);
        $this->assertCount(1, $dispositivos);
        $this->assertEquals('Juan Perez', $dispositivos[0]['Nombre_Completo']);
    }

    public function testObtenerByCliente() {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_all')->willReturn([
            [
                'Id_Cliente' => 1,
                'Nombre_Completo' => 'Juan Perez'
            ]
        ]);

        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('get_result')->willReturn($mockResult);

        $this->mockDb->method('prepare')->willReturn($mockStmt);

        $dispositivo = new Dispositivo($this->mockDb);
        $clientes = $dispositivo->obtenerByCliente();
    
        $this->assertIsArray($clientes);
        $this->assertCount(1, $clientes);
        $this->assertEquals('Juan Perez', $clientes[0]['Nombre_Completo']);
    }
}
