<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../db/example_postgres_database.php';

use \IMSGlobal\LTI;
$launch = LTI\LTI_Message_Launch::from_cache($_REQUEST['launch_id'], new Example_Database());
if (!$launch->has_ags()) {
    throw new Exception("Don't have grades!");
}
$grades = $launch->get_ags();

// file_get_contents('https://webhook.site/0264d283-4d5d-4824-adff-e7aa8c3e0d05?req=' . $_REQUEST['launch_id']);

$score = LTI\LTI_Grade::new()
    ->set_score_given($_REQUEST['score'])
    ->set_score_maximum(100)
    ->set_timestamp(date(DateTime::ISO8601))
    ->set_activity_progress('Completed')
    ->set_grading_progress('FullyGraded')
    ->set_comment($_REQUEST['comment'])
    ->set_user_id($launch->get_launch_data()['sub']);
$score_lineitem = LTI\LTI_Lineitem::new()
    ->set_tag('course')
    ->set_score_maximum(100)
    ->set_label($launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/resource_link']['title'])
    ->set_resource_id($launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/resource_link']['id']);
//  print_r($launch->get_launch_data());
$da = $grades->put_grade($score, $score_lineitem);
// print_r($da);


// $time = LTI\LTI_Grade::new()
//     ->set_score_given($_REQUEST['time'])
//     ->set_score_maximum(999)
//     ->set_timestamp(date(DateTime::ISO8601))
//     ->set_activity_progress('Completed')
//     ->set_grading_progress('FullyGraded')
//     ->set_user_id($launch->get_launch_data()['sub']);
// $time_lineitem = LTI\LTI_Lineitem::new()
//     ->set_tag('time')
//     ->set_score_maximum(999)
//     ->set_label('Time Taken')
//     ->set_resource_id('time'.$launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/resource_link']['id']);
// $grades->put_grade($time, $time_lineitem);
echo '{"success" : true}';
?>