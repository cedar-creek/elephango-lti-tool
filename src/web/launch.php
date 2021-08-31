<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../db/example_postgres_database.php';

use \IMSGlobal\LTI;
$launch = LTI\LTI_Message_Launch::new(new Example_Database())
    ->validate();

if ($launch->is_deep_link_launch()) {
    ?>
    <div class="dl-config" style="padding:24px">
        <h1>Pick a Difficulty</h1>
        <ul>
            <li><a href="<?= TOOL_HOST ?>/configure.php?diff=easy&launch_id=<?= $launch->get_launch_id(); ?>">Easy</a></li>
            <li><a href="<?= TOOL_HOST ?>/configure.php?diff=normal&launch_id=<?= $launch->get_launch_id(); ?>">Normal</a></li>
            <li><a href="<?= TOOL_HOST ?>/configure.php?diff=hard&launch_id=<?= $launch->get_launch_id(); ?>">Hard</a></li>
        </ul>
    </div>
    <?php
    die;
}
?>


<iframe width="100%" height="100%" src="https://dev.elephango.com/ltisample.cfm?fromBLC=1&sid=4222270&lcid=12701&lsec=8FC81FD7630F52ACA6381FF6DF0F6CEC"></iframe>


<script>
let launch_id = '<?= $launch->get_launch_id() ?>';
let score =  34;
let time_taken = 43;
let recording_data = "test";
var submitScore = function() {
    //var time_taken = Math.floor(Date.now() / 1000) - start_time;
    var xhttp = new XMLHttpRequest();
   // xhttp.addEventListener("load", getScoreBoard);
    xhttp.open("POST", "api/score.php" , false);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("launch_id=" + launch_id + "&score=" + score + "&time=" + time_taken + "&comment=" + recording_data);
}

submitScore();

</script>
