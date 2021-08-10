<?php
define("IN_MYBB", 1);
define('THIS_SCRIPT', 'deref.php');
require_once "./global.php";

$templatelist = "deref";

$lang->load("deref");
/**
 * deref code
 */
$url = $_SERVER['REQUEST_URI'];
$sepPos = strpos($url, '?');
if($sepPos !== false)
{
	$targetURL = substr($url, $sepPos+1);
}

eval("\$template_deref = \"".$templates->get("deref", 1, 0)."\";");
echo $template_deref;
?>