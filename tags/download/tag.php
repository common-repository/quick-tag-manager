<?
function qtm_tag_download(&$attrs, &$body, &$options)
{
    $file = $attrs['file'];
    $title = $attrs['title'];
    $text = $attrs['text'];
    // For compatibility
    if (!isset($text)) $text = $title;
    if (!isset($title)) $title = $text;
    $data = qtm_load('downloads');

    if ($data[$file] != null) $count = $data[$file]+1;
    else $count = 1;

    $buffer .= '<a href="' . get_option('home') . '/wp-content/plugins/quick-tag-manager/tags/download/download.php?file=' . $file . '" title="' . $title . '">' . $text . '</a> ' . '(' . $count . ')';

    return $buffer;
}
?>
