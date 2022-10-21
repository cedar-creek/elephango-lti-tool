<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db/example_postgres_database.php';

use \IMSGlobal\LTI;

$database = new Example_Database();
LTI\JWKS_Endpoint::new($database->get_keys_in_set($_GET['id']))->output_jwks();

?>