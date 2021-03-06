# Awesome View
A website created by me using wordpress and php, also linked with an external database.

This is a demo WordPress web site. 
Its purpose is to connect to sync the changes between 2 databases at the same time: the wordpress database and the external one via PDO connection and run operations which will be applied on both databases at the same time.
The idea is from a personal project where I had to connect to an external database and keep tracking of purchases on both platforms (external and wp).

The code designed to work with the external database is located [here](./wp-content/themes/envo-blog/external).

## Databases

Make sure to set up the PDO connection in [connection.php](./wp-content/themes/envo-blog/external/connection.php) file.

The databases are located in dbs folder. <b>awesome</b> is wordpress database, whereas <b>awesome_external</b> is supposed to be the external database.

## Usage

You can check the [live version](https://awesome-view.000webhostapp.com/).
Due to JawsDB restrictions, the external database could not be available for everyone. 
<br>In this case, there is a workaround, by using external db in your local mysql server:

1. Import the external database by creating a new database and running the SQL code from [awesome_external](./dbs/awesome_external.sql) file.
2. Set up the PDO connection from [connection.php](./wp-content/themes/envo-blog/external/connection.php), and put the credentials of your mysql server:

``` php
$host = 'localhost'; 
$db   = 'your database name';
$user = 'mysql username';
$pass = 'mysql password';
```

Have fun!
