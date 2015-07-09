
# Prerequisites
 - CentOS 7 x86_64
 - Apache Web Server

  ```sh
    yum install httpd
    systemctl start httpd
    systemctl enable httpd
  ```
 - MariaDB Server

  ```sh
  	yum install mariadb-server mariadb
  	systemctl start mariadb
  	systemctl enable mariadb
  	/usr/bin/mysql_secure_installation
  ```
 - PHP

  ```sh
   	yum install php php-mysql php-gd php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-snmp php-soap curl curl-devel 
	systemctl restart httpd.service 
  ```
  - Node.js
   ```sh
    yum install epel-release
    yum install nodejs
    yum install npm
   ```


# Directory Layout



# Installation 

1. Create database
 - Create database 'code_sensor_2015'
 - Add user 'codesensor' (pwd: 'nctucodesensor' ) to database 'code_sensor_2015'
 - Initialze tables for code_sensor_2015
  ```sh
  	mysql -u codesensor -p code_sensor_2015 < tools/db_schema.sql
  ```
 - Edit tools/DBLoader_nodejs/student_roster.xlsx to add user accounts for CodeSensor
 - Load user accounts to DB
  ```sh
   	cd tools/DBLoader_nodejs
   	npm -y install
   	node dbloader.js
  ```
  


install
config.php
CreateScore.php

yum install selinux-policy
yum install selinux-policy-devel

1. selinux policy

```sh
	make
	semodule -i homework.pp
```

2. HomeworkInspector/src	

	make
	cp HomeworkInspector /usr/bin/HomeworkInspector/

	ln -s build_script /usr/bin/HomeworkInspector/build_script
	ln -s init_script /usr/bin/HomeworkInspector/init_script
	ln -s skeleton_code /usr/bin/HomeworkInspector/skeleton_code

	chmod u+s /usr/bin/HomeworkInspector/HomeworkInspector
	chown root /usr/bin/HomeworkInspector/HomeworkInspector
	chcon -t homework_inspector_exec_t /usr/bin/HomeworkInspector/HomeworkInspector

	chcon -t homework_exec_t /usr/bin/valgrind.safe

3. HomeworkInspector_php

	cp * /var/www/html


4. mkdir /var/homeworks

5. mkdir /var/homeworks/queue
