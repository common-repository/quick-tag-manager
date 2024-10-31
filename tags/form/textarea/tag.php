<?
function qtm_tag_form_textarea(&$attrs, &$body, $options)
{
	$name = &$attrs['name'];
	$cols = $attrs['cols'];
	$rows = $attrs['rows'];
    if ($cols == null) $cols = 50; 
    if ($rows == null) $rows = 5; 
    $buffer = '<textarea cols="' . $cols . '" rows="' . $rows . '" name="form[' . $name . ']"></textarea>';
        
	return $buffer;
}
?>
