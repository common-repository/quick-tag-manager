=== Quick Tag Manager ===
Tags: post, quick tags
Requires at least: 2.1
Tested up to: 2.3.2
Stable tag: 1.0.4

Quick Tag Manager lets developers to easly write "quick tags" without the assle of the plugins complexity. Quick tags
are functionalities the blog owner can call in posts with a simple syntax, like [tagname].

== Description ==

Quick Tag Manager is a revolutionary plugin that adds a number of quick tags to WordPress. 
Quick tags can be easly used in posts and pages, for example, to add a video, a gallery, 
to include external php scripts.

But not only that! Quick Tag Manager is intended to be a framework too, dedicated to 
those developers who want to write a quick tag without the assle to build a complete plugin. 
A dynamic tag parser is already included: the developer has only
to write the core tag functionality and all is done.

In the base Quick Tag Manager installation some quick tags are included: 

* include - include en external file (php too) to "import" functionalities (it use it for a guest book) 
* gallery - display images placed in a folder, creating thumbnails and showin them with lightbox
* email - ask the user for an email address (stored) to sen him a mail (used to send emails with download link for tutorial or programs)
* video - embed a video from youtube, google, metacafe, it's very light, no javascript used
* download - create a link to a file tracking the number of downloads

A tag is inserted as [t:tagname attr1="value1" attr2="value2"]. The "t:" namespace prefix 
is needed to quickly identify the tags in a post or page.

The latest information and a manual for users and developers can be found in the plugin home page.

FEEL FREE to ASK for NEW QUICK TAGS!

== Installation ==

1. Put the folder "quick-tag-manager" into [wordpress_dir]/wp-content/plugins/
2. Go into the WordPress admin interface and activate the plugin
3. Optional: go to the options page and configure the plugins

== Frequently Asked Questions ==

= How can I tell if it's working? =

1. Write a new post and add this tag: [t:video type="youtube" id="vjYMIGUr84o"]
2. Look at the post online, it has to show a video (if not removed from YouTube)

= Why a "qtm" directory has appeared in "wp-content" =

Some tags collect information and the qtm directory is used to store them by some
functions of the plugin. I prefere to not store "tags generated content" in the plugin
directory (rule of thumb: keep code and data separated.. :-)

== History ==

2007-01-18 (1.0.4) security (grave) issue with download tag and a better options page
2007-01-17 (1.0.3) added the download tag and resolved some bugs


