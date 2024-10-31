<table>
<? qtm_field_text('video_width', 'Default video witdh', '(leave empty to use the video sharing site defaults)', 'size="30"'); ?>
</table>
<p>This tag insert some code to load a video from the common video sharing services, like YouTube,
MetaCafe, Google Video. Any help to add mode services will be appreciated. The sintax is:</p>

<p><code>
[t:video url="..." width="..." height="..."]
</code></p>

<p>The tag auto detect the services from the page url used to view the video from a
browser. Height and width are optional. If only width is specified, the height value is computed
to keep the video with right proportions based on the original site settings.</p>
<p>A default width can be set here, but will be override is a width is specified in the tag.</p>
<p><strong>Important</strong>: remove the http://www. from the url of YouTube and MetaCafe.</p>
