## Installation
### Clone the repository

### Set up your database 

In the .env file, find 
>DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

And fill in your database options.

Create new database and run migration simply by executing:

```./bin/console doctrine:database:create``` 

```./bin/console doctrine:migrations:migrate``` 


## Usage


### Make new order
Run :
```./bin/console server:run``` 
This command will start listening to port 8000 of your localhost, then go to: *localhost:8000* and enter the email.

If this is the first time you are using, we will create a new account with that email. 

Select items you want from weekly menu and don`t forget to choose side dishes!

If you already selected menu for the upcoming week, we will show you what you will receive today instead of menu.

### Admin

*localhost:8000/admin*

Will give you access to users, click on one to see his orders. You can cancel his orders by clicking on a cancel sign.



