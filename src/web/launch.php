<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db/example_postgres_database.php';

use \IMSGlobal\LTI;

print_r($_SERVER['QUERY_STRING']);
$launch = LTI\LTI_Message_Launch::new(new Example_Database())
    ->validate();
   // print_r($launch->get_launch_data());
    //print_r($launch->get_launch_data());
if ($launch->is_deep_link_launch()) {

    echo file_get_contents("https://lti.elephango.com/search/?launch_id=" .$launch->get_launch_id());
    ?>
    <!-- echo '<a href="https://lti-tool.elephango.com/configure.php?title=%20All%20About%20Solutions&id=12915&launch_id='. $launch->get_launch_id() .'">course test</a>'; -->
   
   <!-- <iframe width="100%" height="100%" src="https://dev-lti.elephango.com/search/?launch_id=<?= $launch->get_launch_id(); ?>"></iframe> -->

    <?php
    die;


//echo file_get_contents("https://dev-lti.elephango.com/activity.cfm?lcid=12701&studentID=1236&launchID=76858765876");
//echo file_get_contents("https://dev-lti.elephango.com/activity.cfm?lcid=".$launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/custom']['id']."&studentID=1236&launchID=". $launch->get_launch_id());
?>






<?php } else { 

    if (!array_key_exists('id', $launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/custom'])) {
      echo '<div style="font-family: Arial, sans-serif"><b>Elephango LTI successfully connected!</b><br> 
      You may now setup your courses with deep linking.</div>';
      die;
    }


$aud = "";
if (is_array($launch->get_launch_data()["aud"])) {
  $aud = $launch->get_launch_data()["aud"][0];
} else {
  $aud = $launch->get_launch_data()["aud"];
}


    $deepLinkUrl = "https://lti.elephango.com/activity.cfm?lcid=".$launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/custom']['id']."&studentID=".$launch->get_launch_data()['sub']."&launchID=". $launch->get_launch_id()."&deployment_id=".$launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/deployment_id']."&issuer=".$launch->get_launch_data()["iss"]."&client_id=".$aud;
    echo file_get_contents($deepLinkUrl );

    ?>
    <script>
let launch_id = '<?= $launch->get_launch_id() ?>';
let score =  34;
let time_taken = 43;
let recording_data = "test";
var submitScore = function() {
    var course_name = "<?= $launch->get_launch_data()['https://purl.imsglobal.org/spec/lti/claim/resource_link']['title']; ?>";
    //var time_taken = Math.floor(Date.now() / 1000) - start_time;
    var xhttp = new XMLHttpRequest();
   // xhttp.addEventListener("load", getScoreBoard);
    xhttp.open("POST", "https://lti-tool.elephango.com/api/score.php" , false);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("launch_id=" + launch_id + "&score=50&comment=test comment&course_name=" + course_name);
}


</script>



<?php } 

// if ($launch->has_nrps()) {
//     $members = $launch->get_nrps()->get_members(true);
//     foreach ($members as $member) {
//         print_r($member);
//     }
//     $ags = $launch->get_ags();
// }