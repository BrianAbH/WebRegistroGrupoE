<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/Cliente.php';

class ClienteTest extends TestCase {
    private $cliente;
    private $mockDb;

    protected function setUp(): void {
        $this->mockDb = $this->createMock(mysqli::class);
    }

    public function testGuardarClienteNuevoExitoso() {
        $data = [
            'cedula' => '0959112368',
            'nombre' => 'Bryan',
            'apellido' => 'Carranza',
            'telefono' => '0980616659',
            'direccion' => 'Av. Siempre Viva',
            'id' => null
        ];
    
        // Mock de prepared statement
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        // Simula prepare y cedulaExiste
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        // Forzar que cedulaExiste devuelva falso
        $this->cliente = $this->getMockBuilder(Cliente::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $this->cliente->method('cedulaExiste')->willReturn(false);
    
        $resultado = $this->cliente->guardar($data);
    
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }
    
    public function testGuardarClienteDuplicado() {
        $data = [
            'cedula' => '1234567890',
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'telefono' => '0999999999',
            'direccion' => 'Av. Siempre Viva',
            'id' => null
        ];
    
        // Cedula duplicada
        $this->cliente = $this->getMockBuilder(Cliente::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $this->cliente->method('cedulaExiste')->willReturn(true);
    
        $_SESSION = []; // limpiar la sesión
        $this->cliente->guardar($data);
    
        $this->assertEquals('Ya existe un cliente con esa cédula', $_SESSION['error']);
    }

    public function testActualizarClienteExitoso() {
        $data = [
            'cedula' => '0980616659',
            'nombre' => 'Alex',
            'apellido' => 'Freijo',
            'telefono' => '0959112368',
            'direccion' => 'Fertiza',
            'id' => 1 // <-- con ID = actualiza
        ];
    
        // Mock del statement con execute() exitoso
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        // Simular prepare en mysqli
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        // Mock del modelo
        $clienteMock = $this->getMockBuilder(Cliente::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $clienteMock->method('cedulaExiste')->willReturn(false);
    
        $resultado = $clienteMock->guardar($data);
    
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }
    
    public function testEliminarClienteExitoso() {
        $cliente = new Cliente($this->mockDb);
    
        // ID de cliente a eliminar
        $id = 1;
    
        // Mock de prepared statement
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        // Simular prepare() que retorna el statement mock
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $resultado = $cliente->eliminar($id);
    
        $this->assertTrue($resultado);
    }
    
}


