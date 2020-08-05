# awesomeview
A wordpress website, with a linked external database

This is a demo WordPress web site. 
Its purpose is to connect to 2 databases at the same time: the wordpress and to an external one via PDO connection and run operations which will be synced on both databases.
The idea was from a personal project where I ahd to connect to an external database and keep tracking of purchases on both platforms (external and wp).

The code designed to work with the external database is located at <b>/wp-content/themes/envo-blog/external/</b>

Make sure to set up the PDO connection from <b>external</b> folder in connection.php 

Have fun!
