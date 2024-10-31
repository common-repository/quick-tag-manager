<?
function qtm_tag_include($attrs, $body, $options)
{
	$file = &$attrs['file'];
	ob_start();
	include(ABSPATH . '/' . $file);
	$buffer = ob_get_contents();
	ob_end_clean();
	return $buffer;
}
?>
