<?php

namespace Stephenjude\Wallet\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use Stephenjude\Wallet\WalletServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'Stephenjude\\Wallet\\Tests\\Database\\Factories\\'.class_basename(
                    $modelName
                ).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            WalletServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', 'base64:EWcFBKBT8lKlGK8nQhTHY+wg19QlfmbhtO9Qnn3NfcA=');

        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/database/migrations/create_users_tables.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/add_wallet_balance_column_to_model_table.php.stub';
        $migration->up();
    }
}
