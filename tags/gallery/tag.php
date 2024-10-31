<?

function qtm_tag_gallery(&$attrs, &$body, &$options)
{

    $url = get_settings('home');

    if (!isset($options['gallery_js']))
    {
        echo '<script type="text/javascript" src="' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/js/prototype.js"></script>';
        echo '<script type="text/javascript" src="' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/js/scriptaculous.js?load=effects"></script>';
        echo '<script type="text/javascript">';
        echo 'var fileLoadingImage = "' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/images/loading.gif";';
        echo 'var fileBottomNavCloseImage = "' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/images/closelabel.gif";';
        echo '</script>';
        echo '<script type="text/javascript" src="' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/js/lightbox.js"></script>';
        echo '<link rel="stylesheet" href="' . $url . '/wp-content/plugins/quick-tag-manager/common/lightbox/css/lightbox.css" type="text/css" media="screen" />';
    }
    $options['gallery_js'] = 'ok';

    $buffer = '';

    $folder = $attrs['folder'];

    $height = $attrs['height'];
    if ($height == null) $height = 200;

    $full_path = ABSPATH . '/' . $folder;
    $dh = opendir($full_path);
    while (($file = readdir($dh)) !== false)
    {
        if ($file[0] == '.') continue;
        // If it is a thumb skip it
        if (strpos($file, '-tn.jpg')) continue;

        // If is a directory, skip it
        if (is_dir($full_path . '/' . $file)) continue;

        // Check if the thumbnail exists
        $thumb = str_replace('.jpg', '-' . $height . '-tn.jpg', $file);
        if (!file_exists($full_path . '/' . $thumb))
        {
            qtm_tag_gallery_thumb($full_path . '/' . $file, $full_path . '/' . $thumb, null, $height);
        }
        $buffer .= '<a rel="lightbox" target="_blank" href="' . $url . '/' . $folder .
            '/' . $file . '"><img src="' . $url . '/' . $folder . '/' . $thumb . '"/></a> ';
    }
    closedir($dh);
    return $buffer;
}

function qtm_tag_gallery_thumb($file, $thumb, $new_w, $new_h)
{
    $src_img = imagecreatefromjpeg($file);

    $old_x = imagesx($src_img);
    $old_y = imagesy($src_img);
    if ($new_w == null)
    {
        $thumb_h = $new_h;
        $thumb_w=$old_x*($new_h/$old_y);
    }
    else
    {
        if ($old_x > $old_y)
        {
            $thumb_w=$new_w;
            $thumb_h=$old_y*($new_h/$old_x);
        }
        if ($old_x < $old_y)
        {
            $thumb_w=$old_x*($new_w/$old_y);
            $thumb_h=$new_h;
        }
        if ($old_x == $old_y)
        {
            $thumb_w=$new_w;
            $thumb_h=$new_h;
        }
    }
    $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

    imagejpeg($dst_img, $thumb, 80);
    imagedestroy($dst_img);
    imagedestroy($src_img);
}
?>
