<?php

function get_mysql_connection(){
  $server = "localhost";
  $user = "root";
  $pass = "";
  $db = "custodia_activos";
  $mysqli = new mysqli($server, $user, $pass, $db);
  return $mysqli;
}
