<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../models/Tecnico.php';

class tecnicoTest extends TestCase {
    private $tecnincoMock;
    private $mockDb;

    protected function setUp(): void {
        $this->mockDb = $this->createMock(mysqli::class);
    }

    public function testGuardarTecnicoNuevoExitoso() {
        $data = [
            'cedula' => '1305048884',
            'nombre' => 'Luis',
            'apellido' => 'Diaz',
            'telefono' => '0959112368',
            'especialidad' => 'En teléfono Android',
            'id' => null
        ];
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $tecnicoMock = $this->getMockBuilder(Tecnico::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $tecnicoMock->method('cedulaExiste')->willReturn(false);
    
        $resultado = $tecnicoMock->guardar($data);
    
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }
    
    public function testGuardarTecnicoDuplicado() {
        $data = [
            'cedula' => '1305048884',
            'nombre' => 'Luis',
            'apellido' => 'Diaz',
            'telefono' => '0959112368',
            'especialidad' => 'En teléfono Android',
            'id' => null
        ];
    
        $tecnicoMock = $this->getMockBuilder(Tecnico::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $tecnicoMock->method('cedulaExiste')->willReturn(true);
    
        $_SESSION = [];
        $tecnicoMock->guardar($data);
    
        $this->assertEquals('Ya existe un tecnico con esa cédula', $_SESSION['error']);
    }

    public function testActualizarTecnicoExitoso() {
        $data = [
            'cedula' => '0980616659',
            'nombre' => 'Doug',
            'apellido' => 'Alvarez',
            'telefono' => '0959358565',
            'especialidad' => 'En teléfono Xiaomi',
            'id' => 1
        ];
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $tecnicoMock = $this->getMockBuilder(Tecnico::class)
            ->setConstructorArgs([$this->mockDb])
            ->onlyMethods(['cedulaExiste'])
            ->getMock();
    
        $tecnicoMock->method('cedulaExiste')->willReturn(false);
    
        $resultado = $tecnicoMock->guardar($data);
    
        $this->assertArrayHasKey('success', $resultado);
        $this->assertTrue($resultado['success']);
    }

    public function testEliminarTecnicoExitoso() {
        $tecnico = new Tecnico($this->mockDb);
    
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
    
        $this->mockDb->method('prepare')->willReturn($mockStmt);
    
        $resultado = $tecnico->eliminar(100);
    
        $this->assertTrue($resultado);
    }
    
    
}


