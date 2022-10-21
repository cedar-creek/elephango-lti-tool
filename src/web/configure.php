<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db/example_postgres_database.php';

use \IMSGlobal\LTI;
$launch = LTI\LTI_Message_Launch::from_cache($_REQUEST['launch_id'], new Example_Database());
if (!$launch->is_deep_link_launch()) {
    throw new Exception("Must be a deep link!");
}

$resource = LTI\LTI_Deep_Link_Resource::new()
    ->set_url(TOOL_HOST . "/launch.php")
    ->set_custom_params(['id' => $_REQUEST['id']])
    ->set_title($_REQUEST['title']);
#print_r($launch->get_deep_link());
$launch->get_deep_link()
    ->output_response_form([$resource]);
?>