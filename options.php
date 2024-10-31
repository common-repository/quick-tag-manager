<?
// This file creates the option page in WordPress

function qtm_field_text($name, $label='', $tips='', $attrs='')
{
    global $options;
    if (strpos($attrs, 'size') === false) $attrs .= 'size="30"';
    echo '<tr>';
    echo '<td align="right"><label for="options[' . $name . ']">' . $label . '</label></td>';
    echo '<td><input type="text" ' . $attrs . ' name="options[' . $name . ']" value="' . 
    htmlspecialchars($options[$name]) . '"/>';
    echo ' ' . $tips . '</td>';
    echo '</tr>';
}

function qtm_field_textarea($name, $label='', $tips='', $attrs='')
{
    global $options;

    if (strpos($attrs, 'cols') === false) $attrs .= 'cols="50"';
    if (strpos($attrs, 'rows') === false) $attrs .= 'rows="5"';

    echo '<tr>';
    echo '<td align="right"><label for="options[' . $name . ']">' . $label . '</label></td>';
    echo '<td><textarea ' . $attrs . ' name="options[' . $name . ']">' . 
    htmlspecialchars($options[$name]) . '</textarea>';
    echo ' ' . $tips . '</td>';
    echo '</tr>';
}

if (isset($_POST['update']))
{
  $options = qtm_request('options');
  update_option('qtm', $options);
}

$options = get_option('qtm');
?>

<style type="text/css">
label {
  font-weight: bold;
}
.tag {
    margin-bottom: 15px;
}
.tag h3 {
  border: 1px solid #999;
  padding: 5px;
  background-color: #E5F3FF;
}

</style>


<div class="wrap">
<h2>Quick Tag Manager</h2>
<form method="post">

<?  
// Build up the list of tags
$full_path = dirname(__FILE__) . '/tags';
$dh = opendir($full_path);
$list = array();
while (($file = readdir($dh)) !== false) 
{
    if ($file[0] == '.') continue;
    if (is_dir($full_path . '/' . $file)) 
    {
        if (file_exists($full_path . '/' . $file . '/options.php')) $list[] = $file;
    }
}
closedir($dh);

sort($list);

for($i=0; $i<count($list); $i++)
{
    echo '<div class="tag">';
    echo '<h3>' . $list[$i] . '</h3>';
    @include($full_path . '/' . $list[$i] . '/options.php');
    echo '</div>';
}

?>

<p><input type="submit" name="update" value="Save all"/></p>
</form>

<p>Send suggestion, bug reports or new ideas! Write me:  satollo@gmail.com or go to my blog <a href="http://english.satollo.com/">http://english.satollo.com</a>.</p>
</div>	
