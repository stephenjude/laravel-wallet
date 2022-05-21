# Laravel Wallet

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stephenjude/laravel-wallet.svg?style=flat-square)](https://packagist.org/packages/stephenjude/laravel-wallet)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/stephenjude/laravel-wallet/run-tests?label=tests)](https://github.com/stephenjude/laravel-wallet/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/stephenjude/laravel-wallet/Check%20&%20fix%20styling?label=code%20style)](https://github.com/stephenjude/laravel-wallet/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/stephenjude/laravel-wallet.svg?style=flat-square)](https://packagist.org/packages/stephenjude/laravel-wallet)

A simple wallet implementation for Laravel.

## Installation

You can install the package via composer:

```bash
composer require stephenjude/laravel-wallet
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="wallet-migrations"
php artisan migrate
```

[//]: # ()

[//]: # (```bash)

[//]: # (php artisan vendor:publish --tag="wallet-config")

[//]: # (```)

## Usage

### Prepare User Model

```php

use Stephenjude\Wallet\Interfaces\Wallet;
use Stephenjude\Wallet\Traits\HasWallet;

class User extends Authenticatable implements Wallet
{
    use HasWallet;
}
```

### Deposit

```php
$user = User::first();

$user->deposit(200.22); // returns the wallet balance: 200.22

$user->deposit(200); // returns the wallet balance: 400.22
```

### Withdraw
```php
$user->withdraw(200); // returns the wallet balance: 200.22

$user->withdraw(0.22); // returns the wallet balance: 200
```

### Balance

```php
$user->balance

$user->wallet_balance
```

### Exceptions
#### InvalidAmountException
The `InvalidAmountException` is thrown whenever the deposit or withdrawal amount is a negative numeric value or zero.

#### InsufficientFundException
The `InsufficientFundException` is thrown whenever the withdrawal amount is less than the user's wallet balance.

### Alternative Package
If you are looking for somthing much bigger and elaborate checkout [Bavix Laravel Wallet](https://bavix.github.io/laravel-wallet/#/).

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [stephenjude](https://github.com/stephenjude)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
