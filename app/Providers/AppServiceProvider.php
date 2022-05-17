<?php

namespace App\Providers;

use App\Libraries\Integrations\SchemaDictionary;
use Illuminate\Support\ServiceProvider;
use Opis\JsonSchema\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Validator::class, function () {
            $schemaValidator = new Validator();

            // Register the external response schema pool
            foreach (SchemaDictionary::MAP as $schema) {
                $schemaValidator->resolver()->registerFile(
                    $schema['id'],
                    $schema['file']
                );
            }

            return $schemaValidator;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
