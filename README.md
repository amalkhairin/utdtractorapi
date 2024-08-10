# Simple REST API using Laravel 9 with JWT Authentication

postman documentaion: [postman documentation](https://documenter.getpostman.com/view/14513514/2sA3s3HBbv)

## how to run
run seeder
```
php artisan db:seed
```

<br>
run server

```
php artisan serve
```

## API Endpoints

base url
```
http://127.0.0.1:8000
```

## Auth

- `POST /api/auth/register` - Register a new user
- `POST /api/auth/login` - Log in with user credentials

## Category Products

- `GET /api/category-products` - Retrieve all product categories
- `POST /api/category-products` - Add a new product category
- `GET /api/category-products/{id}` - Retrieve a product category by ID
- `PUT /api/category-products/{id}` - Update a product category by ID
- `DELETE /api/category-products/{id}` - Delete a product category by ID

## Products

- `GET /api/products` - Retrieve all products
- `POST /api/products` - Add a new product
- `GET /api/products/{id}` - Retrieve a product by ID
- `PUT /api/products/{id}` - Update a product by ID
- `DELETE /api/products/{id}` - Delete a product by ID
