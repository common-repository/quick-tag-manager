<?
// The type attribute is obsolete! Kept only for compatibility... I don't want
// to destroy my blog...
function qtm_tag_video($attrs, $body, $options)
{
    $url = trim($attrs['url']);
    $type = &$attrs['type'];

    $width = $attrs['width'];
    if ($width == null) $width = $options['video_width'];
    $height = $attrs['height'];
    if ($width == null) $width = $options['video_height'];

    $buffer = '<div style="clear: both"></div>';

    // Oldish...
    if ($type != '')
    {
        if ($type == 'youtube')
        {
            if ($width == '') $width = 425;
            if ($height == '') $height = 350/425*$width;
            $id = &$attrs['id'];
            $url = 'http://www.youtube.com/v/' . $id;
            $buffer .= '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="' .
                $url . '"></param><param name="wmode" value="transparent"></param><embed src="' . $url .
                '" type="application/x-shockwave-flash" wmode="transparent" width="' . $width . '" height="' .
                $height . '"></embed></object>';
        }
        else if ($type == 'google')
        {
            if ($width == '') $width = 400;
            if ($height == '') $height = 326/400*$width;
            $url = 'http://video.google.com/googleplayer.swf?docId=' . $id;
            $buffer .= '<embed style="width:' . $width . 'px; height:' . $height .
                'px;" id="VideoPlayback" type="application/x-shockwave-flash" src="' .
                $url . '" flashvars=""></embed>';
        }
    }
    else
    {
        if (strpos($url, 'metacafe.com') !== false)
        {
            if ($width == '') $width = 400;
            if ($height == '') $height = 345/400*$width;

            $x = strpos($url, '/watch/');
            $url = 'http://www.metacafe.com/fplayer/' . substr($url, $x+7, -1) . '.swf';

            $buffer .= '<embed src="' . $url . '" width="' . $width . '" height="' . $height .
                '" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" ' .
                'type="application/x-shockwave-flash"></embed>';
        }
        else if (strpos($url, 'youtube.com') !== false)
        {
            if ($width == '') $width = 425;
            if ($height == '') $height = 350/425*$width;

            $x = strpos($url, 'watch?v=');
            $url = 'http://www.youtube.com/v/' . substr($url, $x+8);

            $buffer .= '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="' .
                $url . '"></param><param name="wmode" value="transparent"></param><embed src="' . $url .
                '" type="application/x-shockwave-flash" wmode="transparent" width="' . $width . '" height="' .
                $height . '"></embed></object>';
        }
        else if (strpos($url, 'google.com') !== false)
        {
            if ($width == '') $width = 400;
            if ($height == '') $height = 326/400*$width;

            $x = strpos($url, 'docid=');
            $url = 'http://video.google.com/googleplayer.swf?docId=' . substr($url, $x+6);

            $buffer .= '<embed style="width:' . $width . 'px; height:' . $height .
            'px;" id="VideoPlayback" type="application/x-shockwave-flash" src="' .
            $url . '" flashvars=""></embed>';
        }
    }

    return $buffer . '<div style="clear: both"></div>';
}
?>
