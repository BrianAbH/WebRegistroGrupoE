<?php

define("CLIENT_ID", "AYsciX0VyM-SwOSKjfMd1JZKxFtik6Ejl4WUw4wVeFKldFa7YIdWDfF9cZZ5K2ajJUFtftYsbdCeRSfA");
define("CURRENCY", "USD");
define("KEY_TOKEN", "AS8aac8.asd*");
define("MONEDA", "$");

session_start();

$num_cart =0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>