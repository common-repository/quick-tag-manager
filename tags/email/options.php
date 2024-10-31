<table>
<? qtm_field_text("email_from", 'Sender (from) email adddress'); ?>
<? qtm_field_text("email_name", 'Sender name'); ?>
</table>

<p>The email tag lets to collect email addresses from your blog and send to these addresses an email.
Tha main use is to send a link to download a tutorial, an ebook or whatever you
can think to collect email addresses.</p>
<p><code>[t:email subject="..." message="..." label="..." button="..." file="..." thanks="..."]</code></p>
<p>In the message text you can use the "\n" sequence to force a new line in the email body. the label is
a text places befor the input field e the button is the label of the button to submit
the address. The file is the file name where to store the addresses and is placed inside the tag folder.
Please use a "strange" name, so no one can guess it and download it.</p>
<p>The thanks value will be shown as an alert when the email has ben sent and the address stored.</p>
