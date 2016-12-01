Playtox Test Task
============================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

Clone this repository

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar install
~~~

Now you should configure db connection in `config/db.php`


Next step is to import schemas structure from `models/db/dump.sql` to your MySQL db. You may just use your favorite GUI or run

~~~
mysql -uUSERNAME -pUSERPASSWORD < /path/to/project/models/db/dump.sql
~~~


Please make sure that directories `runtime` and `web/assets` are writable for web process

Now you should be able to access the application through the following URL, assuming `playtox` is the directory
directly under the Web root.

~~~
http://localhost/playtox/web/
~~~

Please note! New user's email confirmation is disabled for this project!

Admin's credentials are `admin/adminpassword`