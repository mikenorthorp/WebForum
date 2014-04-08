README
======

README and code base best viewed on [Github](https://github.com/mikenorthorp/WebForum)

This is an assignment for my Server Side Scripting class INFX2670 Assignment 5

It is a simple web forum using restful practices and Larvel for a PHP framework. It uses database migrations and seeding to set up initial users and settings. It also uses bootstrap for some simple design. It follows REST metholdies to create, post, and delete things, as well as access replies and forums. The blade template is used for the views. This project also follows MVC practices. Enjoy!

Requirements
------------

This program requires `php` and `apache` to be installed on the server you are running this on. As well as settings below.

Installation
------------
* Note - Could not get working on Dal Web Server because I couldnt change settings that I could locally... steps listed below *
1. Put all of the project in a folder
2. Make sure app/storage is writable (755 I believe)
3. Set up the config/database.php file to use the correct host, database and password. (currently uses dev settings)
4. Ensure modrewrite is enabled
5. Run `php artisan migrate` to set up database tables
6. Run `php artisan db:seed` to set up database default values
7. Login with default user/pass `admin/admin`

Making the Website Do Things
----------------------------

1. Login with above user/pass
2. Navigate through
3. Register more users
4. Delete and create posts and users and forums
5. Play around with it


Citations
=========
Used many stack overflow posts, and bit of help from classmate Salman for ideas on how to delete which is cited in the code.

And the links below 


[http://laravelbook.com/laravel-user-authentication/](http://laravelbook.com/laravel-user-authentication/)
[http://wiki.laravel.io/Laravel_4_Auth_pitfalls](http://wiki.laravel.io/Laravel_4_Auth_pitfalls)
[http://laravel.com/docs/security](http://laravel.com/docs/security)
[http://scotch.io/tutorials/simple-and-easy-laravel-routing](http://scotch.io/tutorials/simple-and-easy-laravel-routing)
[http://stackoverflow.com/questions/17799148/how-to-check-if-a-user-email-already-exist](http://stackoverflow.com/questions/17799148/how-to-check-if-a-user-email-already-exist)
