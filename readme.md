
## About Project

This is an articles API that create, fetch, search, delete, update and rate articles. Authentication was implemented on endpoints that requires a user to create, update or delete an article using Laravel Passport. A user is thus required to pass the bearer token to these endpoints.  

The endpoints for authentication: 

### Register a new user 
```
/api/register
Method - POST
Body - name, email, password
```
### Login an existing user
```
/api/login
Method - POST
Body -email, password
```
The endpoints for articles: 

### Create an article
```
/api/articles
Method – POST
Body – title, body
```

### Get articles
```
/api/articles
Method – GET
```
### Get an article
```
/api/articles/{id}
Method – GET
```

### Update an article
```
/api/articles/{id}
Method – PUT
Body - title, body
```
### Delete an article
```
/api/articles/{id}
Method – DELETE
```

### Rate an article
```
/api/articles/{id}/rating
Method – POST
Body - rating (must be between 1 - 5)
```

### Search for article
```
/api/articles/search/{query}
Method – GET
```
To get started: 
+ clone or download source code (unzip)
+ cd to project folder
+ Set database credentials in .env file
+ Run composer install
+ Run php artisan migrate for migrations
+ Run php artisan passport:install to set up encryption keys to generate tokens
+ Run php artisan serve to test endpoints
+ You can run php artisan db:seed to work with existing data

