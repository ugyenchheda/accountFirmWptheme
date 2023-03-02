=== Bootstrap Widget Styling ===
Contributors: ryankienstra
Donate link: http://jdrf.org/get-involved/ways-to-donate/
Tags: Bootstrap, widgets, mobile, responsive, default widgets
Requires at least: 3.9
Tested up to: 4.1
Stable tag: 1.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Make widgets mobile. A bigger click area and cleaner look for 9 default widgets.

== Description ==

* Gives Bootstrap styles to widgets: "Categories," "Archives," "Pages," "Search," "Recent Posts," "Recent Comments," "Custom Menu," "Meta," and "Tag Cloud."
* Fast: must have Bootstrap 3 because it only sends one small file to the browser.
* Disable plugin for certain widgets, using "Settings" page.
* Works with all widgets in Bootstrap themes "evolve," and "Unite." Mostly works on "DevDmBootstrap3" (except for "Search"). Doesn't work at all on "The Bootstrap," "Radiant," "Customizr," and "Inkzine."
* Doesn't work if you have more than one of each kind of widget on a page. For example, two "Categories" widgets.
* No setup needed, unless you want to disable it for certain widgets.

== Installation ==

1. Upload the bootstrap-widget-styling directory to your /wp-content/plugins directory.
1. In the "Plugins" menu, find "Bootstrap Widget Styling," and click "Activate."
1. If you would like to disable the plugin for certain widgets, click "Settings."

== Frequently Asked Questions ==

= What does this require? =
Twitter Bootstrap 3.

= Will this change the rest of my page's styles? =
No, this doesn't output any stylesheets. It only formats widgets so they can use Bootstrap styles.

== Screenshots ==

1. Wide click area for mobile devices.
2. View from a tablet.
3. Click anywhere in the row.
4. Bootstrap styling, with post counts and dates.
5. The "Tag Cloud" widget.
 
== Changelog ==

= 1.0.3 =
* Added "Custom Menu" widget Bootstrap styling. The widget looks better when it has only one level of navigation.

= 1.0.2 =
* Fixed bug where warning appeared in strict mode.
* Integration with the plugin "Adapter Widget Rows."
* Translation-ready, but no translations included.

= 1.0.1 =
* Tag cloud widget support added. Improved support for the customizer: widgets will be styled as they're added.

= 1.0.0 =
* First version

== Upgrade Notice ==

= 1.0.3 =
"Custom Menu" widget support added. The widget looks better when it has only one level of navigation.

= 1.0.2 =
Small bug fix.
Now works well with the plugin "Adapter Widget Rows."

= 1.0.1 =
Supports tag cloud widgets, but old version still works with WordPress 4.0.
