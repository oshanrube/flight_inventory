flight-inventory
================


INSTALL
=======
* close the repository
* create a new database
* import the database from db.sql
* update the database credentials in app/config/parameters.yml
* create a new user and give admin role
bin/console fos:user:create {username}
bin/console fos:user:promote {username} ROLE_ADMIN

USAGE
=====
* visit the url and make the bookings
* navigate to /admin to access the admin view to manage the records

TODO
====
* add timezone validation when creating flights since destination timezone can defer
* add autocomplete like in locations to airplanes and other dropdowns
* update the error messages
* add ajax responses for the page loading
* add tests for data type test
