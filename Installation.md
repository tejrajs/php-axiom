# Installation #

## Get Axiom ##
First, grab the latest version of Axiom Framework (current version is available here: http://code.google.com/p/php-axiom/downloads/detail?name=axiom_v1.0.3-beta.zip ) and unzip its content at the desired location on your webserver.

## Location Setup ##
Once done, you'll have to change the .htaccess directives to make it work with your deployment location:

**/.htaccess**
```
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteBase /axiom
    RewriteRule ^$ application/webroot/    [L]
    RewriteRule (.*) application/webroot/$1 [L]
</IfModule>

php_flag short_open_tag 1
```

**/application/.htaccess**
```
<IfModule mod_rewrite.c>
    RewriteEngine on
    RewriteBase /axiom
    RewriteRule ^$   webroot/   [L]
    RewriteRule (.*) webroot/$1 [L]
</IfModule>
```

**/application/.htaccess**
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /axiom
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !favicon.ico$
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>
```

As you can see, there are three "RewriteBase" directives in the .htaccess files. You have to change their values to match the location you've deployed Axiom. For instance, if the root directory of your web server is /var/www and you deployed Axiom under /var/www/my\_website/axiom/ you have to change the RewriteBase directives to /my\_website/axiom.

Ready ? Well at this point we can test Axiom is serving pages correctly.

## Configuration ##
You can find all configuration files in /application/config/bootstrap/.
Here is an overview of these configurations files:
| **Filename** | **Purpose** |
|:-------------|:------------|
| settings.php | Configures constants, PHP configuration, error reporting, missing function between version such as lcfirst (available since 5.3) and TimeZone |
| autoload.php | Configures the autoloader. Do not modify unless you want to add a custom library in Axiom (see the extending Axiom section) |
| session.php  | Configures session management (currently do nothing but start a new session) |
| locale.php   | Configures locales, availables languages and translations |
| connection.php | Configures the database connectivity (see PDO for more informations) |
| routes.php   | Configures the application routes (see the Routing section) |
| modules.php  | Configures Axiom plugins |
| views.php    | Configures the view manager |

### Database Connectivity ###
You can configure the database connection in
**/application/config/bootstrap/connection.php**
```
$db = "backoffice";
$db_type = "mysql";
$db_user = "root";
$db_password = "";
$db_host = "localhost";

Database::instance("$db_type:dbname=$db;host=$db_host", $db_user, $db_password);
```

| **Parameter**  | **Type** | **Default Value** | **Note** |
|:---------------|:---------|:------------------|:---------|
| $db            | string   | backoffice        | The database you're dealing with |
| $db\_type      | string   | mysql             | The type of RDBMS you're using |
| $db\_user      | string   | root              | The username for database connection |
| $db\_password  | string   |                   | The password for database connection |
| $db\_host      | string   | localhost         | The database host |

### Timezone Definition ###
You may set the timezone in
**/application/config/bootstrap/settings.php**
```
date_default_timezone_set("Europe/Paris");

// ...
```
Change the value "Europe/Paris" by the desired location. A list of valid location is available here: http://www.php.net/manual/en/timezones.php

### Locales ###
You can change the available langs in
**/application/config/locale.php**
```
Lang::setConfig(array(
    'locale' => 'fr',
    'locales' => array('en', 'fr'),
    'base_url' => '/axiom/',
));
```

| **Parameter** | **Type** | **Default Value** | **Note** |
|:--------------|:---------|:------------------|:---------|
| locale        | string   | fr                | Default language to be used - all language definition must have two lowercase alphabetical characters (en, fr, es...)|
| locales       | array    | { en, fr }        | Available languages on the site, see the Translation Section |
| base\_url     | string   | /axiom/           | Same behavior as "RewriteBase" in .htaccess files |