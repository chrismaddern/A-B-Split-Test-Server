<?php
// db options
define('DB_NAME', 'YOUR_DB_NAME');
define('DB_USER', 'YOUR_DB_USER');
define('DB_PASSWORD', 'YOUR_DB_PASSWORD');
define('DB_HOST', 'localhost');


mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME);

Class TestCase
{
	public $id;
	public $token;
	public $application_id;
	public $name;
	public $test_case_values;
}

Class Application
{
	public $id;
	public $token;
	public $name;
}

Class TestCaseValue
{
	public $id;
	public $test_case_id;
	public $value;
}

Class TestCaseResponse
{
	public $id;
	public $test_case_id;
	public $device_token;
	public $outcome;
	public $value;
}

function insert_test_response($application_token, $test_token, $outcome, $device_token, $test_value)
{
	$test_case_id = get_test_case_id($application_token, $test_token);
	$str_q = 'INSERT INTO test_case_responses (test_case_id, device_token, outcome, value) VALUES (' . mysql_real_escape_string($test_case_id) . ', "' . mysql_real_escape_string($device_token) . '", ' .  mysql_real_escape_string($outcome) .', "' . mysql_real_escape_string($test_value) .  '")';
	$q = mysql_query($str_q);
	$count = mysql_affected_rows();
	if($count != 1)
	{
		echo 'error adding result';
	}
	return true;
}

function get_test_case_id($application_token, $test_token)
{
	$application_id = get_application_id($application_token);
	$str_q = 'SELECT id FROM test_cases WHERE token <> "" AND token IS NOT NULL AND id <> 0 AND id IS NOT NULL AND token = "' . mysql_real_escape_string($test_token) . '" AND application_id = ' . mysql_real_escape_string($application_id);
	$q = mysql_query($str_q);
	
	$count = mysql_num_rows($q);
	if($count == 0)
	{
		return '';
	}
	else
	{
		return mysql_result($q, 0, 0);
	}
}

function get_application_id($application_token)
{
	$str_q = 'SELECT id FROM applications WHERE id <> 0 AND id IS NOT NULL and token <> "" AND token IS NOT NULL AND token = "' . $application_token . '"';
	$q = mysql_query($str_q);
	$count = mysql_num_rows($q);
	
	if($count == 0)
	{
		return '';
	}
	else
	{
		return mysql_result($q, 0, 0);
	}
}

function get_tests_for_application_with_token($application_token)
{
	$application_id = get_application_id($application_token);
	$tests = get_test_cases_for_application_with_id($application_id);
	$ret_array = array();
	$test_rep = array();
	foreach($tests as $test)
	{
		
		$test_case_values = array();
		
		foreach($test->test_case_values as $test_case_value)
		{
			array_push($test_case_values, $test_case_value->value);
		}
		$test_rep[$test->token] = $test_case_values;
	}
	return $test_rep;
}


function get_test_cases_for_application_with_id($application_id)
{
	$ret_array = array();
	$str_q = 'SELECT id, token, application_id, name FROM test_cases WHERE application_id = ' . mysql_real_escape_string($application_id);
	
	$q = mysql_query($str_q);
	$count = mysql_num_rows($q);
	
	if($count == 0)
	{
		return '';
	}
	
	for($i = 0; $i < $count; $i++)
	{
		$current_test = new TestCase();
		$current_test->id = mysql_result($q, $i, 0);
		$current_test->token = mysql_result($q, $i, 1);
		$current_test->application_id = mysql_result($q, $i, 2);
		$current_test->name = mysql_result($q, $i, 3);
		
		$current_test->test_case_values = get_test_case_values_for_test_with_id($current_test->id);
		array_push($ret_array, $current_test);
	}
	
	return $ret_array;
}

function get_test_case_values_for_test_with_id($test_case_id)
{
	$ret_array = array();
	
	$str_q = 'SELECT id, test_case_id, value FROM test_case_values WHERE test_case_id = ' . mysql_real_escape_string($test_case_id);
	
	$q = mysql_query($str_q);
	$count = mysql_num_rows($q);
	
	if($count == 0)
	{
		return '';
	}
	
	for($i = 0; $i < $count; $i++)
	{
		$current_test_case_value = new TestCaseValue();
		$current_test_case_value->id = mysql_result($q, $i, 0);
		$current_test_case_value->test_case_id = mysql_result($q, $i, 1);
		$current_test_case_value->value = mysql_result($q, $i, 2);
		array_push($ret_array, $current_test_case_value);
	}
	return $ret_array;
}

?>