<?php
/**
 * Auto Generated by GWFv3.02-2011.Nov.12 *
 * It is good to have a backup at a second physical location *
 * Because of the GWF_SECRET_SALT *
 */
#######################
### Error reporting ###
#######################
ini_set('display_errors', 1);
error_reporting(0xffffffff);

############
### Main ###
############
define('GWF_DOMAIN', 'lfi.warchall.net'); # Example: 'www.foobar.com'.
define('GWF_SITENAME', 'Live-FI'); # Your Site`s name. htmlspecialchars() it yourself.
define('GWF_WEB_ROOT_NO_LANG', '/'); # Add trailing and leading slash. Example: '/' or '/mywebdir/'.
define('GWF_DEFAULT_DOCTYPE', 'html5'); # Set the default html-doctype for gwf. Modules can change it.
define('GWF_LOG_BITS', 0x7fffffff);
#################
### 3rd Party ###
#################
define('GWF_SMARTY_PATH', '/opt/php/gwf3/core/inc/3p/smarty/Smarty.class.php'); # Path to Smarty.class.php. Smarty replaced the GWF template engine and has to be available.
define('GWF_JPGRAPH_PATH', '/opt/php/jpgraph/jpgraph.php'); # Path to jpgraph.php. JPGraph is a library to draw graphs with php. It is available under the GPL.
define('GWF_GESHI_PATH', '/opt/php/geshi/geshi.php'); # Path to geshi.php. GeSHi is a GPL licensed Syntax highlighter.

##############
### Smarty ###
##############
define('GWF_SMARTY_DIRS', '/opt/php/gwf3/extra/temp/smarty/'); # Path to smarty template directory.
define('GWF_ERRORS_TO_SMARTY', false); # Group all Error and display them in one Box?
define('GWF_MESSAGES_TO_SMARTY', false); # Same as above with success-messages

################
### Defaults ###
################
define('GWF_DEFAULT_URL', 'about'); # 1st visit URL. Example: 'home'.
define('GWF_DEFAULT_LANG', 'en'); # Fallback language. Should be 'en'.
define('GWF_DEFAULT_MODULE', 'GWF'); # 1st visit module. Example: 'MyModule'.
define('GWF_DEFAULT_METHOD', 'About'); # 1st visit method. Example: 'Home'.
define('GWF_DEFAULT_DESIGN', 'default'); # Default design. Example: 'default'.
define('GWF_ICON_SET', 'default'); # Default Icon-Set. Example: 'default'.
//define('GWF_DOWN_REASON', 'Converting the database atm. should be back within 45 minutes.'); # The Message if maintainance-mode is enabled.

################
### Language ###
################
define('GWF_LANG_ADMIN', 'en'); # Admins language. Should be 'en'.
define('GWF_SUPPORTED_LANGS', 'en;de;fr;it;pl;hu;es;bs;et;fi;ur;tr;sq;nl;ru;cs;sr;lv'); # Separate 2 char ISO codes by semicolon. Currently (partially) Supported: en;de;fr;it;pl;hu;es;bs;et;fi;ur;tr;sq;nl;ru;cs;sr

###############
### Various ###
###############
define('GWF_ONLINE_TIMEOUT', 60); # A request will mark you online for N seconds.
define('GWF_CRONJOB_BY_WEB', 0); # Chance in permille to trigger cronjob by www clients (0-1000)
define('GWF_CAPTCHA_COLOR_BG', 'FFFFFF'); # Captcha background color. 6 hex digits. Example: ffffff
define('GWF_USER_STACKTRACE', true); # Show stacktrace to the user on error? Example: true.

################
### Database ###
################
define('GWF_SECRET_SALT', 'schnism_schnism'); # May not be changed after install!
define('GWF_CHMOD', 0700); # CHMOD mask for file creation. 0700 for mpm-itk env. 0777 in worst case.
define('GWF_DB_HOST', 'localhost'); # Database host. Usually localhost.
define('GWF_DB_USER', 'LFI'); # Database username. Example: 'some_sql_username'.
define('GWF_DB_PASSWORD', 'LFI'); # Database password.
define('GWF_DB_DATABASE', 'LFI'); # Database db-name.
define('GWF_DB_TYPE', 'mysql'); # Database type. Currently only 'mysql' is supported.
define('GWF_DB_ENGINE', 'myIsam'); # Default database table type. Either 'innoDB' or 'myIsam'.
define('GWF_TABLE_PREFIX', 'lfi_'); # Database table prefix. Example: 'gwf3_'.

###############
### Session ###
###############
define('GWF_SESS_NAME', 'LFI'); # Cookie Prefix. Example: 'GWF'.
define('GWF_SESS_LIFETIME', 14400); # Session lifetime in seconds.
define('GWF_SESS_PER_USER', 1); # Number of allowed simultanous sessions per user. Example: 1

##########
### IP ###
##########
define('GWF_IP_QUICK', 'hash_32_1'); # Hashed IP Duplicates. See core/inc/util/GWF_IP6.php
define('GWF_IP_EXACT', 'bin_32_128'); # Complete IP storage. See core/inc/util/GWF_IP6.php

#############
### EMail ###
#############
define('GWF_DEBUG_EMAIL', 0); # Send Mail on errors? 0=NONE, 1=DB ERRORS, 2=PHP_ERRORS, 4=404, 8=403, 16=MailToScreen)
define('GWF_BOT_EMAIL', 'robot@warchall.net'); # Robot sender email. Example: robot@www.site.com.
define('GWF_ADMIN_EMAIL', 'gizmore@wechall.net'); # Hardcoded admin mail. Example: admin@www.site.com.
define('GWF_SUPPORT_EMAIL', 'support@wechall.net'); # Support email. Example: support@www.site.com.
define('GWF_STAFF_EMAILS', ''); # CC staff emails seperated by comma. Example: 'staff@foo.bar,staff2@blub.org'.
?>
