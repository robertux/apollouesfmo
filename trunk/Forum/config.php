<?php
define("RUTAINC", realpath("../"));
$foo = RUTAINC."/clases/cconexion.php";
require_once($foo);
$con = new cConexion();
#echo "<h1>".$foo."</h1>";
#echo "<h1> configuracion : ".$con->Db()."</h1>";
#return 0;

$db_type = 'mysqli';
#$db_host = 'localhost';
#$db_name = 'apollo';
#$db_username = 'apollouser';
#$db_password = 'apollopwd';
$db_host = $con->Host();
$db_name = $con->Db();
$db_username = $con->User();
$db_password = $con->Pass();
$db_prefix = 'foro_';
$p_connect = false;

$cookie_name = 'foro_postgrados_cookie';
$cookie_domain = '';
$cookie_path = '/';
$cookie_secure = 0;
$cookie_seed = '435e2fe5de57c942';

define('PUN', 1);