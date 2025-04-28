<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Ingreso</title>
</head>
<body>
    <form action="//" method="post">
        
        <div class="logo">
            <img src="img/logo.png" alt="logo">
        </div>
        <h1>G2 RepairTrack</h1>
        <div class="registro">
            <div class="user">
                <label for="nombre">Usuario</label>
                <input  type="text" id="nombre" name="nombre" placeholder="Escribe tu usuario"  required>
            </div>
            
            <div class="pass">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Escribe tu contraseña" required>
            </div>

            <div class="enlaces">
                <a href="">Te olvidaste la contraseña?</a>
            </div>

            <div class="login">
                <button type="submit">Login</button>
            </div>
        </div>
        
        
    </form>
</body>
</html>