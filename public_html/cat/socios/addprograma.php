<script>

function dv(T){var M=0,S=1;for(;T;T=Math.floor(T/10))
S=(S+T%10*(9-M++%6))%11;return S?S-1:'k';}
function tieneGuion(rutstr){
if(rutstr.search("-")!==-1)
return true;
else
return false;
}
function validar(){ 
   	//valido largo del rut de acuerdo a la base de datos varchar(11), además valida si el strig tiene guion
	
	var numrut;
	var dvrut;
	if (document.input.rut.value.length==0 ||document.input.rut.value.length>11 ||!tieneGuion(document.input.rut.value)){ 
      	 alert("Tiene que escribir el rut sin puntos, con guion\n\n(Ej: 123456789-0)"); 
      	 document.input.rut.focus(); 
      	 return 0; 
   	}
	//valido digito verificador del rut
	numrut=parseInt(document.input.rut.value.split("-")[0]);
	dvrut=document.input.rut.value.split("-")[1].toString();
	if(dvrut!==dv(numrut).toString()){
	alert("Ingrese un rut válido");
	document.input.rut.focus(); 
      	 return 0;	}
	
	if(!validarEntero(document.input.series.value) && document.input.series.value.length!=0)
	{
		alert("Series debe ser un numero entero")
		document.input.series.focus()
		return 0;
	}
	
	if(!validarEntero(document.input.repeticiones.value) && document.input.repeticiones.value.length!=0)
	{
		alert("Repeticiones debe ser un numero entero")
		document.input.repeticiones.focus()
		return 0;
	}
	
	

   	//el formulario se envia 
 
	document.input.submit(); 
}
function validarEntero(valor){
      //intento convertir a entero.
     //si era un entero no le afecta, si no lo era lo intenta convertir
     valor = parseInt(valor)

      //Compruebo si es un valor numérico
      if (isNaN(valor)) {
            //entonces (no es numero) devuelvo el valor cadena vacia
            return ""
      }else{
            //En caso contrario (Si era un número) devuelvo el valor
            return valor
      }
} 

</script>







<h1> Agregar un nuevo programa de ejercicios</h1>
<form name="input" action="cat/socios/agregarprograma.php" method="post">
    <table border="0">
        <tr>
           <td>Rut: </td>
            <td>
            <input type="text" name="rut_socio" value="ej:1234567-8"/> <br />
            </td>
        </tr>
        <tr>
            <td>Nombre del ejercicio: </td>
            <td>
                <select name="nombre_ejercicio">
                    <option value="Abdominales">Abdominales</option>
                    <option value="Bicicleta">Bicicleta</option>
                    <option value="Eliptica">Eliptica</option>
                    <option value="Trotadora">Trotadora</option>
                    <option value="Pesa">Pesa</option>
                    <option value="Pesa para piernas">Pesa para piernas</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Series a realizar: </td>
            <td><input type="text" name="series"/> </td>
        </tr>
        <tr>
            <td>Repeticiones del ejercicio por cada serie: </td>
            <td><input type="text" name="repeticiones"/> </td>
        </tr>
        <tr>
            <td>Carga del ejercicio: </td>
            <td><input type="text" name="carga"/> </td>
        </tr>
    </table>
    
    <input type="button" value="Agregar" onclick="validar()"/> <input type="reset" />
</form>
