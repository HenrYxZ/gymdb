<script>
    function validar()
    {
    
        //validar que el cobro sea un valor entero
        if(!validarEntero(document.input.cobro.value) && document.input.cobro.value.length!=0)
	{
		alert("Cobro debe ser un numero entero")
		document.input.cobro.focus()
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



<h1> Agregar cobro de servicio de personal trainer a un socio</h1>

<form name="input" action="index.php?cat=socios&action=agregarcobro" method="post">
   
      
    <h2>Monto a cobrar al socio de rut= "<?php if(isset ($_GET['socioId'])) echo $_GET['socioId']?>" </h2>
            <br />
                <input type="text" name="cobro" />
                <input type="hidden" name="rut_socio" 
                       value="<?php if(isset ($_GET['socioId'])) echo $_GET['socioId']?>">
                <input type="button" value="Agregar" onclick="validar()"  /><input type="reset"/> 
</form>
