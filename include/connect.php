<?php
$dbh = new mysqli("localhost", "dbUser", "malik", "webbshop");

if(!$dbh){
  echo "ingen kontakt med databasen";
  exit;
}
?>
