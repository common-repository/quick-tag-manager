<?
function qtm_tag_form_submit(&$attrs, &$body, &$options)
{
    $value = &$attrs['label'];
    $buffer = '<input type="submit" value="' . $value . '"/>';
    
    return $buffer;
}
?>
