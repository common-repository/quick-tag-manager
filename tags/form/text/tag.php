<?
function qtm_tag_form_text(&$attrs, &$body, &$options)
{
    $name = &$attrs['name'];
    $size = $attrs['size'];
    if ($size == null) $size = 20;
    $buffer = '<input type="text" size="' . $size . '" name="form[' . $name . ']"/>';
    return $buffer;
}
?>
