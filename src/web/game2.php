<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db/example_postgres_database.php';

use \IMSGlobal\LTI;
$launch = LTI\LTI_Message_Launch::new(new Example_Database())
    ->validate();

?>


<iframe width="100%" height="100%" src="https://dev.elephango.com/ltisample.cfm?fromBLC=1&sid=4222270&lcid=12701&lsec=8FC81FD7630F52ACA6381FF6DF0F6CEC"></iframe>
