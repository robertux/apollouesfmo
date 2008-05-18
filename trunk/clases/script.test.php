<htm><head></head><body>
<?php
require_once("cusuario.php");
echo "Comienza el scrip de prueba...<br>";
$u = new cUsuario();
$u->nombre = "nono";
$u->clave = "nono";
$u->Insert();
echo "Acabo de insertar a Nono en la BD, y todo salio bien<br>";
echo "Ahora voy  a obtener la info de nono:<br>";
$u->Get("nono","nono");
echo "Nombre del usuario: " .$u->nombre ."<br>";
echo "Clave del usuario: " .$u->clave ."<br>";
echo "Id : Este es PRIVADISISMO<br>";
echo "<br>Ahorita voy a borrar a este nono...";
$u->Delete();
echo "listo, ya lo borre! :D"
?>
</body></html>