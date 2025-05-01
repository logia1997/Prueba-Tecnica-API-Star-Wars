

<?php
    $api_url= "https://swapi.py4e.com/api/species/".$_GET["num"]."/";
    $context = stream_context_create([
        'http' => ['ignore_errors' => true] 
    ]);
    $result =file_get_contents($api_url, false, $context);
    $data=json_decode($result, true);

    if($data==null){header("Location: index.php?page=error");}
   
    $result =file_get_contents($data["homeworld"], false, $context);
    $planetaDeOrigen=json_decode($result, true);

    $listPersonajes=[];
    foreach($data["people"] as $residentUrl){
        $result =file_get_contents($residentUrl, false, $context);
        $resident=json_decode($result, true);
        $listPersonajes[]=[$resident["name"],$resident["gender"], $resident["birth_year"] ];
    }
  
    $listPeliculas=[];
    foreach($data["films"] as $peliculaUrl){
        $result =file_get_contents($peliculaUrl, false, $context);
        $pelicula=json_decode($result, true);
        $listPeliculas[]=[$pelicula["title"],$pelicula["director"], $pelicula["release_date"] ];
    }

?>


<div class="contenedorEnlaceRetorno">   
     <a class="enlace-retorno" href="index.php">Regresar a la pagina principal</a>
</div>


<div class="container-Titulo">
    <p class="granTitulo">Ficha  de Especie de Star Wars</p>
</div>

<div class="container ">

    <p class="nombre-info" >Especie  <?= $data["name"] ?></p>

    <div class="containerTable">
    <table id="tablaDatosPlaneta"  class="tablaDatos">
    <caption id="tituloTablePlaneta" class="tituloTable" >Informacion</caption>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
          <tr>
                <td>Clasificacion</td>
                <td><?= $data["classification"] ?></td>
          </tr>
        
          <tr>
                <td>Designacion</td>
                <td><?= $data["designation"] ?></td>
          </tr>
    
          <tr>
                <td>Planeta de origen</td>
                <td><?= $planetaDeOrigen["name"] ?></td>
          </tr>
    
          <tr>
                <td>Lenguaje</td>
                <td><?= $data["language"] ?></td>
          </tr>
        
        </tbody>

    </table>
 
    <table id="tablaDatosPlaneta"  class="tablaDatos">
    <caption id="tituloTablePlaneta" class="tituloTable" >Caracteristicas fisicas</caption>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
          <tr>
                <td>Altura Promedio</td>
                <td><?= $data["average_height"]." cm" ?></td>
          </tr>
          <tr>
                <td>Colores de piel</td>
                <td><?= $data["skin_colors"]?></td>
          </tr>
        
          <tr>
                <td>Colores de Pelo</td>
                <td><?= $data["hair_colors"]?></td>
          </tr>
        
          <tr>
                <td>Esperanza de vida (Años)</td>
                <td><?= $data["average_lifespan"]?></td>
          </tr>
        </tbody>
    </table>
    </div>
</div> 



<?php if(!empty($listPersonajes)): ?>
<div class="container">
    <div class="containerTable">
    <table id="tablaDatosPlaneta"  class="tablaDatos">
        <caption id="tituloTablePlaneta" class="tituloTable" >Lista de personajes pertenecientes a esta especie</caption>
        <thead>
            <tr>
                    <td>Nombre</td>
                    <td>Genero</td>
                    <td>Año de Nacimiento</td> 
            </tr>         
        </thead>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
        <?php foreach($listPersonajes as $personaje): ?>
                <tr>
                    <td><?=$personaje[0]?></td>
                    <td><?=$personaje[1]?></td>
                    <td><?=$personaje[2]?></td>
                </tr>
        <?php endforeach;?>
        </tbody>
   
    </table>
</div>
</div>
<?php endif;?>


<?php if(!empty($listPeliculas)): ?>
<div class="container">
    <div class="containerTable">
    <table id="tablaDatosPlaneta"  class="tablaDatos">
    <caption id="tituloTablePlaneta" class="tituloTable" >
        Peliculas con personajes de la especie <?=$data["name"]?>  
    </caption>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Director</td>
                <td>fecha de Lanzamiento</td>
            </tr>
        </thead>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
        <?php foreach($listPeliculas as $pelicula): ?>
                <tr>
                    <td><?=$pelicula[0]?></td>
                    <td><?=$pelicula[1]?></td>
                    <td><?=$pelicula[2]?></td>
                </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<?php endif;?>



</body>
</html>