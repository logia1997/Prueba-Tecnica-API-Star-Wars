
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars Info</title>
    <link rel="stylesheet" href="style5.css">
 
</head>
<body>



<?php
$page=isset($_GET["page"])?$_GET["page"]:$page="character";


include_once "views/".$page.".php";
?>

