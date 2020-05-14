=== Was it you? Account login notifications ===
Contributors: gripgrip, bogdand
Tags: login, security, access, account protect, login notification, woocommerce, woocommerce subscriptions, protect, protection, secure, login secure, access prevention
Requires at least: 4.3
Tested up to: 5.4.1
Requires PHP: 7.0
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

Send an email notification to users each time someone logs in from a new IP.
This helps users figure out if someone accessed their accounts without their knowledge.

== Description ==
This plugin solves an increasing problem nowadays: account security.
The plugin notifies by email a user whenever there is a new sign-in to their account from a new IP.
This helps you and your users get in control of their account access.

== Installation ==
Just install, configure and enjoy. It also works with default settings.
Available settings:
* Number of IPs to save in user's login history log.

== Frequently Asked Questions ==
= Do I have to do any settings? =
Yes but the plugin works just fine with the default settings.
For simplicity we'll showcase and explain the available options:
**Number of IPs to save**

* 0 is the default setting.
* By default the plugin stores all login IPs in user history.
* Any number larger than 0 determines the number of login IPs to save in user history.

= Does the plugin store any data? =
The plugin tracks the last IP's used to login for each account and stores them in a custom table for performance reasons.

= Is this plugin GDPR compliant? =
This version is not GDPR compliant. The IP's are stored in plain, un-anonymized. We planed for a GDPR compliance feature soon.

== Changelog ==
= v.1.0.1 / 2020.05.14 =
* [feature] - Added options page.
* [feature] - Added option to select how many IPs to save in user history.
* [improvement] - Restructured the logic for scalability.
* [improvement] - Update IP storage to use limit option.

= v.1.0.0 / 2020.05.12 =
* [feature] - Notify user by email with IP on sign-in.
