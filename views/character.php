<?php

session_start();

if(!isset($_SESSION["user"])){
    $_SESSION["user"]=1;
}

if(isset($_GET["next"])){
    $_SESSION["user"]-=$_GET["next"];
    if($_SESSION["user"]==0){
        $_SESSION["user"]=1;
    }
    else if($_SESSION["user"]>87){
        $_SESSION["user"]=87;
    }
}


$numUrl= $_SESSION["user"];
?>




<div class="container-granTitulo">
    <p class="granTitulo">Fichas  de personajes de star wars</p>
    <p class="texto">Para que los fans y no tan fans de la franquisia aprendan todos los detalles de sus personajes favoritos</p>
</div>

<div class="container-button">
    <a href="index.php?next=1">
      <button class="button-next"> Anterior</button>
    </a>
    <a href="index.php?next=-1">
        <button class="button-next">Siguiente</button>
    </a>
</div>

<div class="container">

    <p id="Nombre" ></p>
    
    <div class="containerTable">
    <table id="tablaDatosPersonaje"  class="tablaDatos">
    <caption id="tituloTablePersonaje" class="tituloTable" >Información descriptiva</caption>
        <thead>

        </thead>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
          
        </tbody>
    </table>
    </div>
</div>

<div class="container">
    <div class="containerTable">
    <table id="tablaDatosPeliculas" class="tablaDatos">
    <caption id="tituloTablePeliculas" class="tituloTable">Lista de peliculas donde salio</caption>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Director</td>
                <td>fecha de Lanzamiento</td>
            </tr>
        </thead>
        <tbody id="cuerpoTablaPeliculas" class="cuerpoTabla">

        </tbody>
    </table>
</div>

</div>

<div class="container" id="containerNaves">
    <div class="containerTable">
        <table id="tablaDatosNaves" class="tablaDatos">
        <caption id="tituloTableNaves" class="tituloTable">Lista de naves espaciales que condujo</caption>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Modelo</td>
                    <td>Longitud</td>
                </tr>
            </thead>
            <tbody id="cuerpoTablaNaves" class="cuerpoTabla">
            </tbody>
        </table>
    </div>
</div>
    
    

    



<div class="contenedorEnlaces">
    <a class="button-enlace" href="" id="enlaceEspecie">
         Ver  Informacion sobre la especie
    </a>
    <a href="" class="button-enlace" id="enlacePlaneta">
         Ver  Informacion sobre el planeta natal
    </a>
</div> 


<script src="javaScripts3.js"></script>    
<script>
    cargarDataPersonaje(<?php echo $numUrl?> );
</script>    
</body>
</html>