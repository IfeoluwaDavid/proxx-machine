<?php

define("DB_SERVER", "localhost");
define("DB_USER", "ifedaviid");
define("DB_PASS", '*a/$YL/VP488');
define("DB_NAME", "ifedavii_students");
    
function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

function db_disconnect($connection)
{
    if(isset($connection))
    {
        mysqli_close($connection);
    }
    
    unset($_SESSION['successFeedback']);
    unset($_SESSION['errorFeedback']);
}

function db_escape($connection, $string)
{
    return mysqli_real_escape_string($connection, $string);
}

function confirm_db_connect() 
{
    if(mysqli_connect_errno())
    {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function confirm_result_set($result_set)
{
    if (!$result_set)
    {
        exit("Database query failed.");
    }
}

function url_for($script_path)
{
  // add the leading '/' if not present
  if($script_path[0] != '/')
  {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") 
{
  return urlencode($string);
}

function raw_u($string="") 
{
  return rawurlencode($string);
}

function h($string="") 
{
  return htmlspecialchars($string);
}

function error_404() 
{
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

function error_500()
{
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function request_is_get() {
	return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function request_is_same_domain()
{
	if(!isset($_SERVER['HTTP_REFERER'])) {
		// No refererer sent, so can't be same domain
		return false;
	} else {
		$referer_host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		$server_host = $_SERVER['HTTP_HOST'];

		// Uncomment for debugging
		// echo 'Request from: ' . $referer_host . "<br />";
		// echo 'Request to: ' . $server_host . "<br />";

		return ($referer_host == $server_host) ? true : false;
	}
}

function is_blank($value) 
{
    return !isset($value) || trim($value) === '';
}

function has_presence($value)
{
    return !is_blank($value);
}

?>
