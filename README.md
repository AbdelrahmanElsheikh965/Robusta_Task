## Hi, this is Robusta Task (bus-booking system)

 
 
### User can register through the following  
Link : domain.com/api/register  
Parameters : name - email - password - password_confirmation  
Method     : POST   

### User can login through the following  
Link : domain.com/api/login  
Parameters : email - password  
Method     : POST   


### If user forgot the password, he can reset it using the following link
 
Link : domain.com/api/reset-password  
Parameters : email  
Method     : POST   
then an email with a pin code will be sent to user inbox if email is already registered.

### User can create the new password through the following link  
Link : domain.com/api/create-new-password  
Parameters : email - pin_code - password - password_confirmation  
Method     : POST 


### The bus-booking system has 2 Apis :
   NOTE: A user must be logged in so he can provide api_token in the URL.
#### 1) First one is for letting user list available seats on a specific trip  
    
   URL : domain.com/api/list-available-seats?api_token=  
   Method : POST                                      
   Parameters : start_station_id - end_station_id

   Returned Result : if there are available seats he can choose any seat name
   and provide it as a parameter in the next request to book that seat.


#### 2) Second one is for book a specific seat on a specific trip  
    
   URL: domain.com/api/book-a-seat?api_token=  
   Method : POST                                      
   Parameters : start_station_id - end_station_id, seatName   
   Returned Result : 'Updated' if so.

### Installation

import database file provided in phpMyAdmin through 'import' section.

### Email
adjust email credentials in .env file
```python
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=yourmail@gmail.com
MAIL_PASSWORD=yourPassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="yourmail@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Configure Database
after creating database in localhost phpMyAdmin                    
provide its name, username & password in .env file
```python
DB_DATABASE=DataBaseName
DB_USERNAME=username
DB_PASSWORD=password
```

### Run Migrations

```python
php artisan migrate
```

### Run localserver

```python
php artisan serve
```
You can download potman collection from the attached files.  
 
That's it :)

## License

[MIT](https://choosealicense.com/licenses/mit/)
