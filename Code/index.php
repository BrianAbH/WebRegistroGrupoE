<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con -> prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql -> execute();
$resultado = $sql-> fetchAll(PDO::FETCH_ASSOC);

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

    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach($resultado as $row){ ?>
            
            <div class="col">
                <div class="card shadow-sm" >
                    <?php
                        $id = $row['id'];
                        $imagen = "img/productos/" . $id . "/principal.jpg" ;
                        if(!file_exists($imagen)){
                            $imagen = "img/no-photo.jpg";
                        }

                    ?>
                    <img src="<?php echo $imagen;?>">
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nombre'];?></h5>
                    <p class="card-text"><?php echo number_format($row['precio'],2,'.',',');?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="details.php?id=<?php echo $row['id'];?>&token=<?php echo hash_hmac('sha1',$row['id'], KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                        </div>
                        <button class="btn btn-outline-success" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1',$row['id'], KEY_TOKEN);?>')">Agregar al carrito</button>
                    </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </main>

   <div class="Container-fluid">
        <div class="row p-5 pb-2 bg-dark text-white">
            <div class="col-x5-12 col-nd-6 col-lg-3">
                <p class="h5">Digital Local</p>
                <p class="text-secondary">Guayaquil - Ecuador</p>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-3">Integrantes</p>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">CARRANZA FREIJO BRYAN ALEXANDER</a>
                </div>

                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">CARRION LOAIZA MARC ANTHONY</a>
                </div>

                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">CHIRIGUAYA VASQUEZ HECTOR JEREMIAS</a>
                </div>

                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">HIDALGO MORAN RONNY ALEXANDER</a>
                </div>

                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">MORALES ESPINALES TERRY ALEJANDRO</a>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-3">QA</p>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Terms & Conditions</a>
                </div>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Privacy Policy</a>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-3">Contacto</p>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Facebook</a>
                </div>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Instagram</a>
                </div>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Twitter</a>
                </div>
                <div class="mb-2">
                    <a class="text-secondary text-decoration-none" href="">Youtube</a>
                </div>
            </div>

            <div class="col-xs-12 pb-4">
            <p class="text-white text-center">
                Copyright - All rights reserved @ 2023
            </p>
        </div>
        </div>
        
   </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    function addProducto(id,token){
        let url = 'clases/carrito.php'
        let formData= new FormData()
        formData.append('id',id)
        formData.append('token',token)

        fetch(url,{
            method: "POST",
            body:formData,
            mode: 'cors'
        }).then(response => response.json())
        .then(data=>{
            if(data.ok){
                let elemento = document.getElementById("num_cart")
                elemento.innerHTML = data.numero
            }
        })
    }
</script>
<script src="https://kit.fontawesome.com/ba77e33b2d.js" crossorigin="anonymous"></script>
</body>
</html>