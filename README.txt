README
Dominic Fairman
Basic CRUD application
6/5/2021

This is the basic web application I created for the assessment. It uses HTML, CSS, JavaScript, PHP, and MySQL.
The HTML and PHP are in the main.php file, the CSS is the the style.css file, and the JavaScript is in the script.js file.
the inc.db.php file is used to connect the application to the database. I exported the database to the assessment1.sql file. 
I used PHPMyAdmin to create and test the web application and I tested to make sure the database imports correctly and continues to work.

Some small notes about the website:
-The user can click on the buttons on the bottom of the tables, and this displays forms that can be filled out to manipulate the table.
-The category names on each table can be clicked and it will sort the table. 
-The delete button on the worker table does not actually delete the worker, but change a boolean on them to be not currently employed.
-The delete button the the complaints does actually delete the desired complain though.
-Complaints will automatically change tables between the current workers and archived tab based on if the worker is currently employed or not.