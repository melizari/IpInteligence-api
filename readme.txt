=== IpInteligence API ===
Contributors: Me
Tags: wp-admin,xmlrpc,ip,reputation,protection,risk,score
Requires at least: 3.5.2
Tested up to: 5.5
Requires PHP: 5.4
Stable tag: 1.0.3

== Description == 
This plugin protects WordPress Sites from unwanted malicious access attempts.

== External Service == 
This plugin allows administrators to protect their WordPress Sites from unwanted access attempts by leveraging IP reputation data provided by the getipintel IP reputation service. This plugin invokes a restAPI call to the IPIntelligence API, consumes the response and acts based on configuration options in the plugin. This allows ip reputation data to be placed in front of pages (wp-admin and custom pages for example) - without interrupting normal access.
To communicate with the restAPI an API KEY is required from getipintel.

== Privacy Policy ==
The privacy policy for the api services is viewable here [privacy policy](https://getipintel.net/privacy)
 
== Plugin Features ==
* Detects activity and IP reputation from the following sources:
* Proxy
* VPN
* API Documentation is available here: [documentation](https://getipintel.net/free-proxy-vpn-tor-detection-api/)
 
== Special Features ==
* Provide risk based decisions through configuration to allow an administrator the correct flow for their site.

== Configuration Items ==
* API Key - An API key is required to access the IP reputation service.
* Country Blacklist - 2 Character ISO country code csv format. Country codes in this list will cause IP addresses from those countries to issue a redirection. Allows you to block access from countries
* Country Whitelist - 2 Character ISO country code csv format. Country codes in this list will cause only IP addressed from these countries to be allowed. All others will be redirected. Allow all from UK for example.
* Country Blacklist is evaluated first - it makes little sense to have both blacklists and whitelists set although it is a supported option due to demand.
* Redirection URL - The web page you wish traffic to be redirected to.
* Reject IP Risk >= - Redirect IP risk scores marked as Consider or High. Allow low risk only if consider is selected.
* Pages to protect - a comma separated list of custom pages that you want to use the IP reputation service
* Disable XMLRPC endpoint by adding entry to .htaccess
 
== Localization ==
* English
 
== Installation ==
 
1. Download plugin from WordPress! or manually upload the entire 'IpIntelligence-api' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The IPIntelligence-Api settings menu will appear
4. Fill in the API Key, Country Blacklist and/or Country Whitelist, Redirect URL and Risk level, Tor Exit Node check, Anonymous VPN check and pages to protect (Admin login is enabled by default).
5. Save the settings
6. Save the page
 
== Frequently Asked Questions ==
 
= Does this plugin work with newest WP versions and also older versions? =
Yes, this plugin works with 3.5.2 and above.
We tested on versions 3.5.2, 4.9.5 up to 5.5. As the plugin is simply a way of calling the api and consuming the response the plugin should function in most versions, although we tested mainly on the two versions listed.
  
= Can I access the API documentation? =
Yes, please use the following link to the IPIntelligence API documentation: [documentation](https://getipintel.net/free-proxy-vpn-tor-detection-api/)