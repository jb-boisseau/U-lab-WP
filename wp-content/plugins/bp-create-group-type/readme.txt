=== BuddyPress Create Group Type ===
Contributors: wbcomdesigns, vapvarun
Tags: buddypress,group-type, group type, create group, BuddyPress group, Group Filter
Donate link: https://wbcomdesigns.com/donate/
Requires at least: 4.6
Tested up to: 4.9.5
Stable tag: 4.6
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a Group Type search and filter at BuddyPress Group Directory. It also allows displaying group types as Tabs for Group Directory.

== Description ==
BuddyPress 2.6 introduced the concept of group types. It will help to create group type. This plugin adds a new feature to BuddyPress, group types that allow site admin to add group types.

If you have to display any number of group type as Tabs at group directory page which will list only a specific type of groups which belong to specific group type.

[youtube https://www.youtube.com/watch?v=ozOQz-z19cg]

= Links =

*	[Plugin url](https://wbcomdesigns.com/downloads/buddypress-create-group-type/ "BuddyPress Create Group Type" )
*	[Demo]( https://demos.wbcomdesigns.com/wbcomplugins/ "BuddyPress Create Group Type")
*	[Support](https://wbcomdesigns.com/helpdesk/article-categories/buddypress-group-reviews/)
*	[Github Development Repo](https://github.com/wbcomdesigns/buddypress-create-group-type)

If you need additional help you can contact us at [Wbcom Designs](https://wbcomdesigns.com/contact/).


Note: For Multisite please activate itat which site BuddyPress is activated. Like if BuddyPress is network activated so also network activate this plugin. and use define('BP_ENABLE_MULTIBLOG', true ); in config.php file for separate blog. if BuddyPress is activated separate domain so please activate this plugin to separate blog.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/buddypress-create-group-type` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the \'Plugins\' screen in WordPress
3. Use the Groups-> Group type screen to add group types


== Frequently Asked Questions ==
= What plugin does this plugin require? =
As the name of the plugin justifies, this plugin helps create Group Types for BuddyPress Groups, this plugin requires BuddyPress plugin to be installed and active.

= How does Pre-select Group Types setting work provided in general setting section? =
This setting will pre-select all the created group type while creating a new group.

= How does Enable Group Type Search setting work provided in general setting section? =
This setting provides filter at domain.com/groups page for searching groups by created group types.

= How to a create group type? =
A new group type can be created with help of interface provided at plugin settings page under Group Types tab section.

= How to go for any custom development? =
If you need additional help you can contact us for <a href="https://wbcomdesigns.com/contact/" target="_blank" title="Custom Development by Wbcom Designs">Custom Development</a>.

== Screenshots ==
1. screenshot-1 - shows the general settings in the plugin.
2. screenshot-2 - shows the group types management panel in admin.
3. screenshot-3 - shows the group type search settings (if enabled).
4. screenshot-4 - shows the options to enable Group Type Tabs
5. screenshot-5 - shows the group types filter and tab with default WordPress theme.
6. screenshot-6 - shows the group types filter and tab with Boss theme.
7. screenshot-7 - shows the group types filter and tab with Kleo theme.

== Changelog ==

= 1.1.0 =
* Multisite Fixes

= 1.0.5 =
* Enhancement - WPCS fixes
* Enhancement - Added support for Boss and Kleo theme for search option.
* Enhancement - Added support for Group Tabs
* Enhancement - Update Group Listing with Ajax Query search
* Fix - Layout fixes for group results

= 1.0.4 =
* Fix - All Types search issue
* Fix - Updated support section
* Fix- Added translation files

= 1.0.3 =
* Fix - Settings added to whether or not have all the group types pre checked during group creation.

= 1.0.2 =
* Fix - Plugin multisite support added

= 1.0.1 =
* Fix -  Option updates and JS fixes

= 1.0.0 =
* Fix - Initial Release
