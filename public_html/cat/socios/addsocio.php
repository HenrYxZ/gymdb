<!--AgregarSocio-->
<html>

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
	
	if (document.input.email.value.length==0){ 
      	 alert("Tiene que escribir un email");
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
	
	if (document.input.dia.value.length==0 || document.input.dia.value > 31){ 
      	 alert("Tiene que escribir dia de nacimiento valido") 
      	 document.input.dia.focus() 
      	 return 0; 
   	}
	
	if (document.input.mes.value.length==0 || document.input.mes.value > 12){ 
      	 alert("Tiene que escribir mes de nacimiento valido") 
      	 document.input.mes.focus() 
      	 return 0; 
   	}
	
	if (document.input.anio.value.length==0 || document.input.anio.value < 1800){ 
      	 alert("Tiene que escribir año de nacimiento valido") 
      	 document.input.anio.focus() 
      	 return 0; 
   	}

   	//el formulario se envia 
 
	document.input.submit(); 
}
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
	<input type="text" name="dia" size="2" maxlength="2" value="DD">/<input type="text" name="mes" size="2" maxlength="2" value="MM">/
	<input type="text" name="anio" size="4" maxlength="4" value="AAAA">
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
</html>