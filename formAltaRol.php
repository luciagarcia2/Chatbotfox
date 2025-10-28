<form name="formAltaRol" action="./Controller/rol.controller.php" method="POST" >
    <input type="hidden" name="operacion" value="guardar" /> //este input es invisible sirve para mandar la operacion que queremos al controllet
    <label for="">Nombre: </label>
    <input type="text" name="nombre"/>
    <input type="submit" value="Aceptar" />
</form>