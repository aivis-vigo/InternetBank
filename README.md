# Internet Bank

Welcome to the Internet Bank project! This project is built using the Laravel framework and provides a secure and
convenient platform for users to manage their finances. It includes features such as user registration, login, logout,
2FA (Two-Factor Authentication), money transfers, personal bank card management, and investment account functionality
with cryptocurrency support.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

1. **User Authentication:** The Internet Bank provides a secure authentication system with user registration, login, and
   logout functionality.
2. **Security:** Fortify, a Laravel package, is integrated to enhance security. Users have the option to enable or
   disable Two-Factor Authentication (2FA) to further protect their accounts.
3. **Money Transfers:** Users can easily transfer money from their account to different accounts within the Internet
   Bank.
4. **Personal Bank Card Management:** Users can add and manage their personal bank cards within the Internet Bank.
5. **Investment Accounts:** Users with investment accounts can transfer funds from their regular account to their
   investment account. They can also buy and sell cryptocurrencies.
6. **Currency Selection:** Users with investment accounts can select the currency in which they want their account to be
   denominated.

## Requirements

To run the Internet Bank project, you need to have the following installed on your system:

- PHP (version 7.4 or higher)
- Composer
- MySQL or another compatible database
- Web server (such as Apache or Nginx)

## Installation

1. Clone the project repository:

   ```bash
   git clone https://github.com/your-username/internet-bank.git

2. Install the dependencies using Composer:

   ```bash
   cd internet-bank
   composer install

3. Configure your environment variables by renaming the .env.example file to .env:

   ```bash
   cp .env.example .env

4. Generate a unique application key:

   ```bash
   php artisan key:generate

5. Configure your database connection settings in the .env file:

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

6. Migrate the database:

   ```bash
   php artisan migrate

7. Start the local development server:

   ```bash
   php artisan serve

7. You can now access the Internet Bank application in your browser at

   ```bash
   http://localhost:8000

## Configuration

The Internet Bank project can be customized by modifying the corresponding configuration files in the `config` directory. Some important files to note are:

- `config/fortify.php`: Contains the configuration for Fortify's security features, such as enabling or disabling 2FA.
- `config/currencies.php`: Defines the available currency options for investment accounts.

Please refer to the Laravel documentation for more information on how to configure these files.

## Usage

Once the Internet Bank application is set up, users can perform various actions:

- Visit the registration page to create an account.
- Log in using their credentials.
- Enable or disable 2FA in the account settings.
- Manage personal bank cards in the corresponding section.
- Perform money transfers to different accounts within the Internet Bank.
- For users with investment accounts, transfer funds to their investment account and buy or sell cryptocurrencies.
- Select the preferred currency for their investment account.

Please refer to the documentation or comments within the code for more detailed instructions on how to use specific features.

## Contributing

Contributions to the Internet Bank project are welcome! If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them.
4. Push your changes to your fork.
5. Submit a pull request to the main repository.

Please ensure your code adheres to the project's coding standards and includes appropriate tests and documentation.

## License

The Internet Bank project is open-source software licensed under the MIT License. Feel free to use, modify, and distribute it as per the terms of the license.
