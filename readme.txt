=== SpeedMetriks ===
Contributors: bookwyrm
Tags: performance, real user monitoring, anonymous data, visitor experience
Requires at least: 4.7
Tested up to: 5.1.1
Stable tag: 1.4.4
Requires PHP: 7.0
License: GPLv2 or later

A self-contained service to see how visitors experience your site.

== Description ==
Each visitor to your website will have their own unique device and network connection and will experience the site differently. Some will be fast and others will be slow, but it’s hard to know what their experience is like. Modern browsers record detailed timing information about a visitor’s experience and SpeedMetriks lets you collect that data and save it in your WordPress database so you can get an aggregate view of your visitors’ experiences.

The data is stored anonymously and there are no third party servers or services involved.

This initial release will just show `onDomReady` timing data but additional metrics will be added soon.

== Installation ==
NOTE: SpeedMetriks makes changes to your database so a backup is strongly recommended before activating this plugin.

1. BEFORE YOU BEGIN: Back up your WordPress database.
2. Upload the zip file to the `/wp-content/plugins/` directory
3. Unzip
4. Activate the plugin through the ‘Plugins’ menu in WordPress

DISCLAIMER: Under no circumstances do we release this plugin with any warranty, implied or otherwise. We cannot be held responsible for any damage that might arise from the use of this plugin.

== Frequently Asked Questions ==

= Will this plugin make my site faster? =
No, SpeedMetriks just records data from visitors on your site and helps you identify existing performance problems.

= Will this plugin make my site slower? =
No, SpeedMetriks leverages performance monitoring best practices to record performance details in an asynchronous, isolated manner that will have virtually no impact on the site performance experienced by site visitors.

= How do I see data? =
There is a "SpeedMetriks Plots" menu item in the "Tools" menu.

= Nothing is being tracked =
That’s not a question, but I understand what you mean. The tracking process uses the REST API to send performance data to the plugin for recording in the databse. There may be something interfering with the REST API in your WordPress install.

Please open a support request and we will help you get it resolved.

= How does it all work? =
Modern web browsers expose a [NavigationTiming API](https://developer.mozilla.org/en-US/docs/Web/API/Navigation_timing_API) which can be queried for information about page load performance. We are using the industry standard [Boomerang](https://developer.akamai.com/tools/boomerang/docs/index.html) library to collect this data and send it to your WordPress site where it is stored in custom tables that have been optimized for database size.

== Screenshots ==

1. Sample SpeedMetriks plot

== Changelog ==

= 1.4.4 =
Added license
Verified with WordPress 5.1.1

= 1.4.3 =
Fix REST path to work if permalinks are not enabled

= 1.4.2 =
Update boomerang

= 1.4.1 =
* Fixed asset include path

= 1.4 =
* Detect cache enabled and use longer nonce lifetime
* Add filter to ignore nonces (`speedmetriks_ignore_nonces`)

= 1.3 =
* Adds support to show bounce rate on chart
* Change chart from histogram to bar chart for better display of bounce rate
* Renamed main plugin PHP file to match slug (you may need to re-activate SpeedMetriks)

= 1.2 =
* Initial Release
