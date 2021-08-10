<?php
/**
* External Link Warning in URLs
* Website: 
* http://www.mybbcoder.info / 
* http://www.sebijk.com
* License: GPL
**/

if( !defined('IN_MYBB') )
{
	die("Hacking attempt!");
}

/** Info about External Link Warning in URLs **/
function exturlwarning_info()
{
	return array(
		"name"			=> "External Link Warning in URLs",
		"description"	=> "Add External Link Warning in MyCode Urls",
		"website"		=> "http://www.sebijk.com",
		"author"		=> "Home of the Sebijk.com",
		"authorsite"	=> "http://www.sebijk.com",
		"version"		=> "0.1",
		"guid" 			=> "",
    	"compatibility" => "18*" 
	);
}

function exturlwarning_install()
{
  global $db, $mybb, $lang;
  
	$template = '<html>
	<head>
	<title>{$mybb->settings[\'bbname\']} - {$lang->redirect_notice}</title>
	{$headerinclude}
	</head>
	<body>
	{$header}
	<center>
				<h2>{$lang->redirect_notice}</h2>
				
				<div>
					{$lang->page_trying_to} <a href="{$targetURL}" rel="noreferrer nofollow noopener">{$targetURL}</a>. <br />
					{$lang->if_not_want_visit_page}.
				</div>
			</center>
	</body>
	</html>';

	$insert_array = array(
		'title' => 'deref',
		'template' => $db->escape_string($template),
		'sid' => '-1',
		'version' => '',
		'dateline' => time()
	);
	$db->insert_query('templates', $insert_array);
}

function exturlwarning_is_installed()
{
  global $db;
    
  $query = $db->simple_select('templates','*','title="deref"');
  $installed = $db->fetch_array($query);

  if ($installed)
  {
    return true;
  } 
  else return false;
}

function exturlwarning_uninstall()
{
	global $db;
	$db->query("DELETE FROM ".TABLE_PREFIX."templates WHERE title ='deref'");
}

function exturlwarning_activate()
{
	include MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets("mycode_url", "#".preg_quote('<a href="')."#i", '<a href="deref.php?');
}

// This function runs when the plugin is deactivated.
function exturlwarning_deactivate()
{
	include MYBB_ROOT."/inc/adminfunctions_templates.php";
	find_replace_templatesets("mycode_url", "#".preg_quote('<a href="deref.php?')."#i", '<a href="');
}
?>