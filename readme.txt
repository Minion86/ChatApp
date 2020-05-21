Steps to set environment

1. Download and install xampp
2. Copy files inside xampp installation/htdocs
3. Create a mysql database and run the script \ChatApp\bdd\bck_chatapp.sql
4. Open file xampp\htdocs\ChatApp\protected\config\main.php
and set your database credentials:

     'class' => 'CDbConnection',
            'connectionString' => 'mysql:host=localhost;dbname=chatapp',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'kt_',

5. Create a .htaccess file with the following code:

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /index.php/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>

6. In order the routes to work a virtual host has to be configures, open file
\xampp\apache\conf\extra\httpd-vhosts.conf

and add the following configuration

<VirtualHost *>
    DocumentRoot "E:\Projects\Servers\xampp\htdocs\ChatApp"
    ServerName chat.test.com
    <Directory "E:\Projects\Servers\xampp\htdocs\ChatApp">
    Order allow,deny
    Allow from all
    </Directory>
</VirtualHost>

<VirtualHost *>
    DocumentRoot "E:\Projects\Servers\xampp\htdocs"
    ServerName localhost
</VirtualHost>


The Document root has to be your server path

7. With that configuration you have to modify C:\Windows\System32\drivers\etc\hosts
with administrator privileges, and add the following 

127.0.0.1		    chat.test.com

8. Test the application, and if it doesn't work I have uploaded to a hosting of mine

user: admin@hotmail.com	
pass:123456

chatapp.neldevsys.com