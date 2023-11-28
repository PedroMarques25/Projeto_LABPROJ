
# This is my City - Tourist Routes Website

This is a Laravel-based web application designed to offer and sell tourist routes, attractions, and activities within different cities.

## Features

- **User Authentication**: Allows users to sign up, log in, and manage their accounts.
- **Browse Routes**: View available routes, attractions, and activities within each city.
- **Purchase Routes**: Users can purchase and book routes they're interested in.
- **Admin Dashboard**: Administrators have access to manage routes, attractions, and user data.
- **Testing**: Extensive testing using Laravel's testing framework ensures application reliability.

## Installation

### Prerequisites

- PHP 7.4+
- Composer
- MySQL

### Steps

1. Clone the repository:

   ```bash
   git clone https://github.com/PedroMarques25/Projeto_LABPROJ
   ```

2. Navigate to the project directory:

   ```bash
   cd this-is-my-city
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Create a `.env` file:

   ```bash
   cp .env.example .env
   ```

5. Configure your `.env` file with your database credentials and other necessary configurations.

6. Generate application key:

   ```bash
   php artisan key:generate
   ```

7. Run migrations:

   ```bash
   php artisan migrate
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

## Testing

Run the tests using:

```bash
php artisan test
```

## Contributing

Contributions are welcome! Please fork the repository and create a pull request for any enhancements or bug fixes.

## License

This project is licensed under the [MIT]() License.

---

