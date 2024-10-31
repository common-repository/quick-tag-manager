<p>The "download" tag let the user to download a file from your blog, tracking the number of
downloads. The tracking data is store in thje wp-content/qtm directory, not in the database.</p>

<p>The files have to be place in tghe "downloads" directory under the "wp-content" directory, and uploaded via
FTP by now.</p>

<p><code>[t:download file="tutorial.pdf" text="Link text" title="Link title"]</code></p>

<? 
$downloads = qtm_load('downloads'); 
if ($downloads == null)
{
    echo '<p>No downloads...</p>';
}
else 
{
    echo '<table>';
    echo '<tr><th>File</th><th>Downloads</th></tr>';
    foreach ($downloads as $key=>$value)
    {
        echo '<tr><td>' . $key . '</td><td align="right">' . $value . '</td></tr>';
    }
    echo '</table>';
}
?>

