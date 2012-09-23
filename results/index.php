<?php
include("../shared/functions.php");

if($_POST)
{
	insert_test_response($_POST["application"], $_POST["testcase"], $_POST["outcome"], $_POST["user"], base64_decode($_POST["value"]));
	
}
?>