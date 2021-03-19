<!--Gonçalo Cruz - 54959; Tiago Teodoro - 54984  ; Renato Ramires - 54974  ; Margarida Rodrigues - 55141 -  ASW  Grupo 3 -->

<?php
$dbhost = "appserver-01.alunos.di.fc.ul.pt";
$dbuser = "asw013";
$dbpass = "ventu13";
$dbname = "asw013";
// Cria a ligação à BD
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// Verifica a ligação à BD
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}

if (!mysqli_set_charset($conn, 'utf8')) {
  die('Error ao usar utf8: ' . mysqli_error($conn));
}
?>