<?php
    $api_url= "https://swapi.py4e.com/api/planets/".$_GET["num"]."/";

    $context = stream_context_create([
        'http' => ['ignore_errors' => true] 
    ]);
    $result =file_get_contents($api_url, false, $context);
    $data=json_decode($result, true);

    if($data==null){
        header("Location: index.php?page=error");
    }
   
    $listPersonajes=[];
    foreach($data["residents"] as $residentUrl){
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
    <p class="granTitulo">Ficha  de planeta de star wars</p>
</div>



<div class="container">
    <p class="nombre-info" >Planeta  <?= $data["name"] ?></p>
    <div class="containerTable">
    <table id="tablaDatosPlaneta"  class="tablaDatos">
    <caption id="tituloTablePlaneta" class="tituloTable" >Caracteristicas</caption>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
          <tr>
                <td>Clima</td>
                <td><?= $data["climate"] ?></td>
          </tr>
        
          <tr>
                <td>Tipos de Terreno</td>
                <td><?= $data["terrain"] ?></td>
          </tr>
        
          <tr>
                <td>Gravedad</td>
                <td><?= $data["gravity"] ?></td>
          </tr>
        
        </tbody>
    </table>

    <table id="tablaDatosPlaneta"  class="tablaDatos">
    <caption id="tituloTablePlaneta" class="tituloTable" >Estadisticas</caption>
        <tbody id="cuerpoTablaPersonaje" class="cuerpoTabla">
          <tr>
                <td>Poblacion</td>
                <td><?= $data["population"]." de personas" ?></td>
          </tr>
          <tr>
                <td>Diametro total</td>
                <td><?= $data["diameter"]." km"?></td>
          </tr>
        
          <tr>
                <td>Periodo de rotacion</td>
                <td><?= $data["rotation_period"]." Dias"?></td>
          </tr>
        
          <tr>
                <td>Periodo de orbita</td>
                <td><?= $data["orbital_period"]." Dias"?></td>
          </tr>    
        </tbody>
    </table>
    </div>
</div>

<?php if(!empty($listPersonajes)): ?>
<div class="container">
    <div class="containerTable">
    <table id="tablaDatosPlaneta"  class="tablaDatos">
        <caption id="tituloTablePlaneta" class="tituloTable" >Lista de personajes nativos</caption>
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
    <caption id="tituloTablePlaneta" class="tituloTable" >Peliculas con <?=$data["name"]?> como escenario</caption>
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