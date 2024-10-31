<?
function qtm_tag_email($attrs, $body, $options)
{
    $url = $attrs['url'];
    if ($_REQUEST['qtm'] == 'email')
    {
        $file = $attrs['file'];
        if ($file == null) $file = 'email';
        qtm_append($_REQUEST['email'] . "\n", $file);

        $message = str_replace("\\n", "\n", $attrs['message']);
        $message = str_replace("&gt;", ">", $message);
        $subject = str_replace("&lt;", "<", $attrs['subject']);
        qtm_email($options['email_from'], $options['email_name'], qtm_request('email'), $subject, $message);
        $buffer = '<script>alert("' . $attrs['thanks'] . '");</script>';
    }
    
    $buffer .= '<p><form method="post"><input type="hidden" name="qtm" value="email"/>' . $attrs['label'] . 
        '<input type="text" name="email" size="30"/> <input type="submit" value="' . $attrs['button']
        . '"/></form></p>';

    return $buffer;
}
?>
