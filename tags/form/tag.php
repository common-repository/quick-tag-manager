<?
function qtm_tag_form(&$attrs, &$body, &$options)
{
  if ($_REQUEST['qtm'] == 'form')
  {
        $message = '';
        $form = $_POST['form'];
        foreach($form as $key=>$value)
        {
            $message .= $key . ': ' . $value . "\n";
        }
        qtm_email($options['form_email'], '', $attrs['to'], $attrs['subject'], $message);
        $buffer = '<script>alert("' . $attrs['thanks'] . '");</script>';
    }
    $buffer .= '<form method="post"><input type="hidden" name="qtm" value="form"/>' . $body . '</form>';

    return $buffer;
}
?>
