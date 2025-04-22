<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';
$db = new Database();
$con = $db->conectar();

$token_session = $_SESSION['token'];
$orden = $_GET['orden'] ?? null;
$token = $_GET['token'] ?? null;

if ($orden == null || $token == null || $token != $token_session) {
    header("Location: compras.php");
    exit;
}

//validacion para que solo la persona que hizo la compra
//pueda visualizar el producto que compro

$sqlCompra = $con -> prepare("SELECT id, id_transaccion, fecha, total FROM compra WHERE id_transaccion = ? LIMIT 1");
$sqlCompra->execute([$orden]);
$rowCompra = $sqlCompra-> fetch(PDO::FETCH_ASSOC);
$idCompra = $rowCompra['id'];

$sqlDetalle = $con -> prepare("SELECT id,nombre,precio,cantidad FROM detalle_compra WHERE id_compra = ?");
$sqlDetalle->execute([$idCompra]);


$db = new Database();
$con = $db->conectar();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Local Closet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    
<?php include 'menu.php'; ?>

    <main >
           <div class = "container">

                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card-header">
                            <strong>Detalle de la compra</strong>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha:</strong> <?php echo $rowCompra['fecha'] ?></p>
                            <p><strong>Orden:</strong> <?php echo $rowCompra['id_transaccion'] ?></p>
                            <p><strong>Total:</strong> <?php echo MONEDA . number_format($rowCompra['total'], 2, ".", ","); ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                    while($row = $sqlDetalle->fetch(PDO::FETCH_ASSOC)){
                                        $precio = $row['precio'];
                                        $cantidad = $row['cantidad'];
                                        $subtotal = $precio * $cantidad;
                                        ?>
                                        <tr>
                                            <td> <?php echo $row['nombre']; ?></td>
                                            <td> <?php echo MONEDA . number_format($precio, 2, ".", ","); ?></td>
                                            <td> <?php echo $cantidad; ?></td>
                                            <td> <?php echo MONEDA . number_format($subtotal, 2, ".", ","); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

           </div> 

    </main>
   


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>