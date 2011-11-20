<!--AgregarSocio-->


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
	//valido email distinto de vacío
	
	
var x=document.input.email.value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("No es e-mail válido");
  document.input.email.focus(); 
  return 0;
  
  }
   	 
	//valido el nombre y apellidos
   	if (document.input.nombre.value.length==0){ 
      	 alert("Tiene que escribir su nombre") 
      	 document.input.nombre.focus() 
      	 return 0; 
   	} 
	if (document.input.apellido_paterno.value.length==0){ 
      	 alert("Tiene que escribir su apellido paterno") 
      	 document.input.apellido_paterno.focus() 
      	 return 0; 
   	} 
	if (document.input.apellido_materno.value.length==0){ 
      	 alert("Tiene que escribir su apellido materno") 
      	 document.input.apellido_materno.focus() 
      	 return 0; 
   	} 
	//validacion sexo
	var sexoElegido;
	var cnt=-1;
	for (var i=document.input.sexo.length-1; i > -1; i--) {
        if (document.input.sexo[i].checked) {cnt = i; i = -1;}
    }
    if (cnt > -1) sexoElegido=document.input.sexo[cnt].value;
    else {
	sexoElegido=null;
	alert("Debe seleccionar sexo del entrenador.") 
      	 document.input.sexo.focus() 
      	 return 0; 
	}
	
	if (document.input.comuna.value.length==0){ 
      	 alert("Tiene que escribir comuna") 
      	 document.input.comuna.focus() 
      	 return 0; 
   	} 
	
	if (document.input.direccion.value.length==0){ 
      	 alert("Tiene que escribir direccion") 
      	 document.input.direccion.focus() 
      	 return 0; 
   	} 

   	//el formulario se envia 
 
	document.input.submit(); 
}



$(function() {

var $now = new Date();
$.datepicker.setDefaults( $.datepicker.regional[ "" ] );

		$( "#fecha_nacimiento" ).datepicker
		($.extend(
			{
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd',
				maxDate: $now
			
			
			}
		,$.datepicker.regional[ "es" ] )
		);
		
	});
	
	

</script>

<h1> Agregar un nuevo Socio</h1>
<form name="input" action="cat/socios/agregarsocio.php" method="post">
<table border="0">
<tr>
	<td>Rut: </td>
	<td>
	<input type="text" name="rut" value="ej:1234567-8"/> <br />
	</td>
</tr>	
<tr>	
    <td>Email: </td>
	<td>
	<input type="text" name="email" /> <br/>
	</td>
</tr>
<tr>	
    <td>Nombre: </td> <td><input type="text" name="nombre" /> <br/> </td>
</tr>
<tr>	
    <td>Apellido Paterno: </td>
	<td><input type="text" name="apellido_paterno"/><br /></td> 
	</tr>
	<tr>
    <td>Apellido Materno: </td>
	<td><input type="text" name="apellido_materno"/><br /></td>
	</tr>
	<tr>
	<td>
    Sexo: <br /></td>
	</tr>
	<tr>
	<td>
	<input type="radio" name="sexo" value="Hombre" /> Hombre<br />
	</td>
	</tr>
	<tr><td>
	<input type="radio" name="sexo" value="Mujer" /> Mujer<br />
	</td></tr>
	<tr>
    <td>Comuna: </td>
	<td><input type="text" name="comuna" /> <br/></td>
	</tr>
	<tr>
    <td>Dirección: </td>
	<td><input type="text" name="direccion" /> <br/> </td>
	</tr>
	<tr>
    <td>Fecha de Nacimiento: </td>
	<td>
	<input type="text" name="fecha_nacimiento" id="fecha_nacimiento" />
	</td>
	</tr>
	<tr>
    <td>Telefono 1: </td>
	<td><input type="text" name="telefono1" /> <br/></td>
	
    <td>Telefono 2: </td>
	<td><input type="text" name="telefono2" /> <br/></td>
	</tr>
</table></br>
<input type="button" value="Agregar" onclick="validar()"/> <input type="reset" />
</form>
