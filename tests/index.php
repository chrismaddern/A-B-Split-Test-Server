<?php
include("../shared/functions.php");

$application_token = $_GET["application"];
$tests = get_tests_for_application_with_token($application_token);

echo json_encode($tests);

//Test code
//echo '{"next_button_text":["Next Button Text v1","Next Button Text v2"],"next_button_color":["#000000","#FFFFFF"]}';
?>