<?php
/*
Plugin Name: Quick Tag Manager
Plugin URI: http://english.satollo.com/wordpress/quick-tag-manager/
Description: Quick Tag Manager lets developers to easly write "quick tags" without the assle of the plugins complexity. Quick tags are functionalities the blog owner can call in posts with a simple syntax, like [tagname].
Version: 1.0.4
Author: Satollo
Author URI: http://english.satollo.com/
Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
*/

/*	Copyright 2006  Satollo  (email : satollo@email.it)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

include('functions.php');

// All the options of the plugin, including the options of the tags
$qtm_options = get_option('qtm');

// Extract a request parameter (GET or POST) unescaping the single
// quotes if "magic quotes" is enabled
function qtm_request($name, $default=null) 
{
	if (!isset($_REQUEST[$name])) return $default;
	if (get_magic_quotes_gpc()) return qtm_stripslashes($_REQUEST[$name]);
	else return $_REQUEST[$name];
}

// Support for qtm_request(...)
function qtm_stripslashes($value)
{
	$value = is_array($value) ? array_map('qtm_stripslashes', $value) : stripslashes($value);
	return $value;
}

function qtm_find_tag(&$text, $start=0)
{
	$x = strpos($text, '[t:', $start);
	if ($x === false) {
    return null;
  }
	$t = array();
	$t['start'] = $x;
    
  $x += 3;
  $l = strlen($text);
  // Skip to the first space or closed square bracket where the tag name ends
  for ($y=$x; $y<$l; $y++)
  {
    if ($text[$y] == ' ' || $text[$y] == ']') break;
  }    
	$t['name'] = substr($text, $x, $y-$x);
	
	// If the tag ends here, check if there is a "real" tag closure [/t:tag-name]
  if ($text[$y] == ']') 
  {
    $e = strpos($text, '[/t:' . $t['name'] . ']', $y+1);
    if ($e === false) 
    {
      $t['end'] = $y;
      return $t;
    }
    $t['end'] = $e + strlen('[/t:' . $t['name'] . ']') - 1;
    $t['body'] = substr($text, $y+1, $e-($y+1));
    return $t;
  }
  $y++;
  
  while ($y < $l)
  {
    while ($text[$y] == ' ' && $y < $l) $y++; // skip spaces
    if ($text[$y] == ']') 
    {
      $e = strpos($text, '[/t:' . $t['name'] . ']', $y+1);
      if ($e === false) 
      {
        $t['end'] = $y;
        return $t;
      }
      $t['end'] = $e + strlen('[/t:' . $t['name'] . ']') - 1;
      $t['body'] = substr($text, $y+1, $e-($y+1));
      return $t;
    }
    $x = $y; // start of attribute name
    while ($text[$y] != '=' && $y < $l) $y++; // find the '=' of an attribute
    $attr_name = substr($text, $x, $y-$x);
    $y++; $y++; // skip the quote char
    $x = $y;
    while ($text[$y] != '"' && $y < $l) $y++; // find the '"' at the end
    $t['attrs'][$attr_name] = substr($text, $x, $y-$x);
    $y++;
  }     
}

// Send an email. Has to be modified to use the wp_mail(...) function
// of WordPress
function qtm_email($from, $name, $to, $subject, $message, $cc=null, $bcc=null)
{
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	$headers .= "X-Priority: 3\r\n";
	$headers .= "X-MSMail-Priority: Normal\r\n";
	$headers .= "X-Mailer: php\r\n";
	$headers .= 'From: "' . $name . '" <' . $from . ">\r\n";
	if ($cc != null) {
		$headers .= "Cc: " . $cc . "\r\n";
  }
	if ($bcc != null) {
		$headers .= "Bcc: " . $bcc . "\r\n";
  }
	mail($to, $subject, $message, $headers);
}

function qtm_the_content($content)
{
  global $qtm_options;
  $start = 0;
  while ( ($tag = qtm_find_tag($content, $start)) != null)
  {
    include_once('tags/' . $tag['name'] . '/tag.php');
    eval('$res = qtm_tag_' . $tag['name'] . '($tag["attrs"], $tag["body"], $qtm_options);');
		$content = substr($content, 0, $tag['start'])  . $res . substr($content, $tag['end']+1);
		$start = $tag['start'];
  }
  return $content;
}

add_filter('the_content', 'qtm_the_content');

// This is a MUST otherwise WordPress doesn't keep the double quote in ASCII format
remove_filter('the_content', 'wptexturize');


function qtm_admin_head()
{
	add_options_page('Quick Tag Manager', 'Quick Tag Manager', 'manage_options', 'quick-tag-manager/options.php');
}
add_action('activate_quick-tag-manager/plugin.php', 'qtm_activate');

function qtm_activate()
{
    mkdir(QTM_DATA_DIR, 0766);
}
add_action('admin_head', 'qtm_admin_head');
?>
