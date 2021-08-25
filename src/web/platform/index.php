<?php
require_once __DIR__ . '/../../db/example_postgres_database.php';
?>

        <button type="button" class="sub" onclick="document.getElementById('frame').src='<?php echo TOOL_HOST; ?>/login.php?iss=https%3A%2F%2Flti-tool.elephango.com&login_hint=12345&target_link_uri=https%3A%2F%lti-tool.elephango.com%2Fgame.php&lti_message_hint=subreview'">Login</button>
        <div class="frame-wrapper"><iframe id="frame" style="border:none;" ></div>

</iframe>
<style>
ul {
    position:absolute;
    left:0px;
    top:0px;
    width:200px;
    bottom:0;
    background-color:darkslategray;
    color: white;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 28px;
    font-weight: bold;
    margin:0;
    list-style-type: none;
}
li {
    padding-top: 26px;

}
li.sub {
    padding-left:26px;
    font-size: 24px;
}
iframe {
    position: absolute;
    left:0px;
    right:0px;
    top:0px;
    bottom:0px;
    width:100%;
    height:100%;
}
.frame-wrapper {
    position: absolute;
    left: 240px;
    right:0px;
    top:0px;
    bottom:0px;
}
</style>

