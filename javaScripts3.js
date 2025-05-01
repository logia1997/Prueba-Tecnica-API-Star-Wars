async function obtenerPersonaje(num){
    try{
        url='https://swapi.py4e.com/api/people/'+num+"/";
        const response = await fetch(url);
        if(!response.ok) throw new Error("Error con proveedor del servicio, pronto se resovlera");
        const miData=await response.json();
        return miData;
    }
    catch(error){
        console.log(error);
        return null;
    }
}

async function obtenerInfo(url){
    try{
        const response = await fetch(url);
        if(!response.ok) throw new Error("Error con proveedor del servicio, pronto se resovlera");
        const miData=await response.json();
        return miData;
    }
    catch(error){
        console.log(error);
        return null;
    }
}

function imprimirDatosPersonaje(dataPersonaje, nombrePlaneta, nombreEspecie){

    const tabla= document.getElementById("listaDatosPersonaje");
    const cuerpoTabla=document.getElementById("cuerpoTablaPersonaje");
    const nombre=document.getElementById("Nombre");

    let claves=["Nombre", "Altura", "Peso", 
                "Color de cabello", "Color de piel",
                "Color de ojos", "Fecha de cumpleaños",
                "Genero", "Planeta de origen", "Especie"];
    const valores=Object.values(dataPersonaje);
    nombre.innerHTML=valores[0];

    for(let i=1;i<8;i++){
        const nuevaFila = cuerpoTabla.insertRow(-1);
        const celdaNombre=nuevaFila.insertCell(0);
        const celdaDato=nuevaFila.insertCell(1);
        celdaNombre.innerHTML=claves[i];
        celdaDato.innerHTML=valores[i];
        if(claves[i]=="Peso")celdaDato.innerHTML=valores[i]+" Kg";
        if(claves[i]=="Altura")celdaDato.innerHTML=valores[i]+" cm";
        if(valores[i]=="n/a" || valores[i]=="none" )celdaDato.innerHTML="No tiene";
        if(valores[i]=="unknown" )celdaDato.innerHTML="Desconocido";
    }

    const nuevaFila = cuerpoTabla.insertRow(-1);
    const celdaNombre=nuevaFila.insertCell(0);
    const celdaDato=nuevaFila.insertCell(1);
    celdaNombre.innerHTML="Planeta de origen";
    celdaDato.innerHTML=nombrePlaneta;

    const nuevaFila2 = cuerpoTabla.insertRow(-1);
    const celdaNombre2=nuevaFila2.insertCell(0);
    const celdaDato2=nuevaFila2.insertCell(1);
    celdaNombre2.innerHTML="Especie";
    celdaDato2.innerHTML=nombreEspecie;
}



async function imprimirListaPeliculas(listaPeliculas) {

    const tabla= document.getElementById("tablaDatosPeliculas");
    const cuerpoTabla=document.getElementById("cuerpoTablaPeliculas");

    for (const urlPelicula of listaPeliculas) {
      const pelicula = await obtenerInfo(urlPelicula);
      const nuevaFila = cuerpoTabla.insertRow(-1);
      const celdaTitulo=nuevaFila.insertCell(0);
      const celdaDirector=nuevaFila.insertCell(1);
      const celdaFecha=nuevaFila.insertCell(2);
     celdaTitulo.innerHTML=pelicula["title"];
     celdaDirector.innerHTML=pelicula["director"];
     const Fecha=new Date(pelicula["release_date"]);   
     celdaFecha.innerHTML=Fecha.getDate()+"-"+(Fecha.getMonth()+1)+"-"+Fecha.getFullYear();
    }
}


async function imprimirListaNaves(listaNaves) {

    if(listaNaves.length===0){
        const contenedorBorrar = document.getElementById("containerNaves");
        contenedorBorrar.remove();
    }
    else{
        const tabla= document.getElementById("tablaDatosNaves");
        const cuerpoTabla=document.getElementById("cuerpoTablaNaves");
        for (const urlNave of listaNaves) {
            const nave = await obtenerInfo(urlNave);
            
            if(Object.keys(nave).length === 0){
                console.log("vacio");
            }
            const nuevaFila = cuerpoTabla.insertRow(-1);
            const celdaNombre=nuevaFila.insertCell(0);
            const celdaModelo=nuevaFila.insertCell(1);
            const celdaLogitud=nuevaFila.insertCell(2);
            celdaNombre.innerHTML=nave["name"];
            celdaModelo.innerHTML=nave["model"];
            celdaLogitud.innerHTML=nave["length"]+" m";
        }
    }
}

function completarEnlaces(planeta, especie){
    const partes = especie[0].split('/').filter(part => part !== '');
    const numero = parseInt(partes[partes.length - 1], 10);

    const partes2 = planeta.split('/').filter(part => part !== '');
    const numero2 = parseInt(partes2[partes2.length - 1], 10);

    const urlPlaneta= document.getElementById("enlacePlaneta");
    const urlEspecie= document.getElementById("enlaceEspecie");

    urlEspecie.href="index.php?page=spice&num="+numero;
    urlPlaneta.href="index.php?page=planet&num="+numero2;
}

async function cargarDataPersonaje(num){
    const data= await obtenerPersonaje(num);  

    if(data==null){
        alert("Error en la obtencion de datos");
        return;
    }
    const especie= await obtenerInfo(data["species"]);
    const planeta= await obtenerInfo(data["homeworld"]);
    await imprimirDatosPersonaje(data, planeta["name"], especie["name"]);
    await imprimirListaPeliculas(data["films"]);
    await imprimirListaNaves(data["starships"]);
    await completarEnlaces(data["homeworld"], data["species"],);
}





