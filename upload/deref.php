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

# URL validation from https://websolutionstuff.com/post/how-to-validate-url-in-php-with-regex
$regex = "((https?|ftp)\:\/\/)?";
$regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
$regex .= "([a-z0-9-.]*)\.([a-z]{2,3})";
$regex .= "(\:[0-9]{2,5})?";
$regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
$regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?";
$regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?";

if (!preg_match("/^$regex$/i", $targetURL)) {
	$targetURL="";
 }

eval("\$template_deref = \"".$templates->get("deref", 1, 0)."\";");
echo $template_deref;
?>