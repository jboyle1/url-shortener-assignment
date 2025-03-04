# URL Shortener Assignment

This is a simple **URL Shortener** service built with **Laravel**. It allows users to shorten long URLs and retrieve the original URL using a short code. The service uses **MySQL** to store the original and shortened URLs.

## Features

- **Shorten URLs**: Enter a long URL and get a shortened version.
- **Retrieve Original URL**: Enter a short code to retrieve the original URL.
- **Database-Driven**: The service uses MySQL to store the original URLs and their corresponding short codes.
- **Basic CSRF Protection**: CSRF protection is enabled for the form submissions.

---

## **Prerequisites**

Before you can run the project, ensure you have the following installed:

- **PHP** (version 7.4 or above)
- **Composer** (for PHP dependencies)
- **MySQL** (for storing the URLs)
- **Node.js** (for compiling assets if needed)
- **TablePlus** or another database client (for inspecting the database)

---

## **Installation**

### **Step 1: Clone the Repository**

Clone the repository to your local machine:

git clone https://github.com/jboyle1/url-shortener-assignment.git

## **Step 2: Set Up the Environment**

Navigate to the project directory:

cd url-shortener-assignment

Copy the .env.example file to .env:

cp .env.example .env

Open the .env file and configure your MySQL database connection:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=short_urls
DB_USERNAME=root
DB_PASSWORD=

Make sure to update the DB_DATABASE, DB_USERNAME, and DB_PASSWORD with the correct values for your MySQL setup.

## **Step 3: Set Up the Environment**

Install PHP dependencies using Composer:

composer install

Install Node.js dependencies (for asset compilation):

npm install

## **Step 4: Run the Migrations**

Create the necessary database tables (including the short_urls table) by running the migrations:

php artisan migrate

## **Step 4: Run the Application**

php artisan serve

The application should now be running at http://127.0.0.1:8000.

---

## How the Service Works

### Shortening URLs
- On the homepage, there is an input field where you can enter a long URL.
- After submitting the form, the service will generate a short code for the URL.
- The original URL and the short code are saved to the MySQL database.
- The service will return a shortened URL (e.g., `L4Gb6f`).

### Retrieving the Original URL
- To retrieve the original URL, enter the shortened URL code (e.g., `L4Gb6f`) in the input field.
- The service will look up the short code in the database and return the corresponding original URL.
- If the short code is found, you will be redirected to the original URL.
- If the short code is invalid or does not exist in the database, the service will return a **404 error**.

## Database Schema
The database consists of a single table:

### `short_urls` Table

| Column         | Type        | Description                                    |
|----------------|-------------|------------------------------------------------|
| `id`           | `bigint`    | The unique identifier for each URL.            |
| `original_url` | `string`    | The original URL that you shortened.           |
| `short_code`   | `string`    | The generated short code for the URL.          |
| `created_at`   | `timestamp` | Timestamp of when the record was created.      |
| `updated_at`   | `timestamp` | Timestamp of the last update to the record.    |

## Testing
To test the application:

- **Shorten a URL**: Enter a long URL and click "Shorten URL." You should get a shortened URL, which can be used to access the original URL.
- **Retrieve the original URL**: Enter the short code into the "Enter Short Code to Retrieve Original URL" field. The application should return the original URL in JSON format or redirect you to the original URL if you use the shortened URL directly.



