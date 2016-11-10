# News Portal
Simple News Portal designed using PHP Codeigniter Framework

1. Database Initialization
	- Import db.sql file in your MySQL database
	- If you are using PhpMyAdmin,Click on home button,then click on import button(top bar),then Click on Choose File button and choose db.sql file and click on Go button at the bottom
	- The sql file will create a database named news_portal and load all the tables in it
	- If table or database already exist this will truncate existing database and table and insert them again
	
2. Virtual host
	- This project is deployed on a virtual host,for this project to work properly virtual host must be created
	- newsportal.dev is virtual host address
	- If you are using XAMPP on windows follow the instructions below
	- Open file <Your XAMPP directory>\apache\conf\extra\httpd-vhosts.conf
	- Add the following code at the end of file replacing your XAMPP directory
		<VirtualHost *:80>
		DocumentRoot "<Your XAMPP directory>/htdocs/news_portal"
		ServerName newsportal.dev
		</VirtualHost>
	- Now we need to edit windows host files
	- Open C:\Windows\System32\drivers\etc\hosts
	- Add the following lines at the end of document
	127.0.0.1       localhost 
	127.0.0.1       newsportal.dev
	
3. PHP mailer configuration
	- Open application\config\php_mailer.php
	- Set your email and password and choose mail host (Default is Gmail)
	- You will also need to allow acces to less secure apps in Gmail (https://www.google.com/settings/security/lesssecureapps)
