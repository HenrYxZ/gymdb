
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
function validarEmail(valor) {
var atpos=valor.indexOf("@");
var dotpos=valor.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=valor.length){
  alert("La dirección no es valida");
  return false;
  }
  return true;}


function validar(){ 
   	//valido largo del rut de acuerdo a la base de datos varchar(11), además valida si el strig tiene guion
	

	var numrut;
	var dvrut;
	if (document.formtrainer.rut_entrenador.value.length==0 ||document.formtrainer.rut_entrenador.value.length>11 ||!tieneGuion(document.formtrainer.rut_entrenador.value)){ 
      	 alert("Tiene que escribir el rut sin puntos, con guion\n\n(Ej: 123456789-0)"); 
      	 document.formtrainer.rut_entrenador.focus(); 
      	 return 0; 
   	}
	//valido digito verificador del rut
	numrut=parseInt(document.formtrainer.rut_entrenador.value.split("-")[0]);
	dvrut=document.formtrainer.rut_entrenador.value.split("-")[1].toString();
	if(dvrut!==dv(numrut).toString()){
	alert("Ingrese un rut válido");
	document.formtrainer.rut_entrenador.focus(); 
      	 return 0;	}
	//valido email distinto de vacío
	
	if (document.formtrainer.email.value.length==0){ 
	 alert("Tiene que escribir un email") 
	 document.formtrainer.email.focus() 
	 return 0; 
   	} 
	
	//valida email
	if(!validarEmail(document.formtrainer.email.value))
	{
	document.formtrainer.email.focus()
	return 0;
	}
	//valido el nombre y apellidos
   	if (document.formtrainer.nombre.value.length==0){ 
      	 alert("Tiene que escribir su nombre") 
      	 document.formtrainer.nombre.focus() 
      	 return 0; 
   	} 
	if (document.formtrainer.ap_paterno.value.length==0){ 
      	 alert("Tiene que escribir su apellido paterno") 
      	 document.formtrainer.ap_paterno.focus() 
      	 return 0; 
   	} 
	if (document.formtrainer.ap_materno.value.length==0){ 
      	 alert("Tiene que escribir su apellido materno") 
      	 document.formtrainer.ap_materno.focus() 
      	 return 0; 
   	} 
	//validacion sexo
	var sexoElegido;
	var cnt=-1;
	for (var i=document.formtrainer.sexo.length-1; i > -1; i--) {
        if (document.formtrainer.sexo[i].checked) {cnt = i; i = -1;}
    }
    if (cnt > -1) sexoElegido=document.formtrainer.sexo[cnt].value;
    else {
	sexoElegido=null;
	alert("Debe seleccionar sexo del entrenador.") 
      	 document.formtrainer.sexo.focus() 
      	 return 0; 
	}
	
	if (document.formtrainer.tipo_entrenador.value.length==0){ 
      	 alert("Tiene que escribir descripción de tipo de entrenador") 
      	 document.formtrainer.tipo_entrenador.focus() 
      	 return 0; 
   	} 

   	//el formulario se envia 
 
	document.formtrainer.submit(); 
}
</script>

<div>
<br>
<form name=formtrainer method="post" action="cat/trainers/insertTrainers.php">
	 	 	 <p>RUT:<input type="text" name="rut_entrenador" required="required"></p>
			 <p>e-mail: <input type="email" name="email" required="required"></p>
			 <p>Nombre:<input type="text" name="nombre" required="required"></p>
			 <p>Apellido Paterno:<input type="text" name="ap_paterno" required="required"></p>
			 <p>Apelllido Materno:<input type="text" name="ap_materno required="required""></p>
			 
			<p>Sexo:
			<input type="radio" name="sexo" value="Mujer" required="required">Femenino
			<input type="radio" name="sexo" value="Hombre" required="required">Masculino</p>
			<p>Tipo: <select name="tipo_entrenador">
<option value="">- Elegir -</option>
<option value="Personal Trainer">Personal Trainer</option>
<option value="Karate">Karate</option>
<option value="Yoga">Yoga</option>
<option value="Baile">Baile</option>
<option value="Gimnasia">Gimnasia</option>
</p>
			<input type="button" value="Agregar" onclick="validar()">
</form>
					 
					 </div>
					 </html>