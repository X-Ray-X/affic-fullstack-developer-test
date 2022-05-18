# Affic Fullstack Developer Test

## Prerequisites:
* [Docker](https://docs.docker.com/get-docker/)

## How to:

### Add the following entry to your /etc/hosts file:

> 127.0.0.1 pgsql

Please note the project is configured under the default 'localhost' domain.

### Run the command from project's root catalog:

> // first installation with some additional steps: \
> make first-run \
> \
> // later use: \
> make up \
> make down

### Testing:

> make test

For more please check the contents of Makefile.

### Manual testing via Postman:

Feel free to import the Postman collection included in the root of the repository:

> affic-fullstack-developer-test.postman_collection.json

### Database access:

Use the following credentials in a database client of your choice:

> DB_HOST: pgsql \
> DB_PORT:5432 \
> DB_DATABASE: affic_fullstack_developer_test \
> DB_USERNAME:sail \
> DB_PASSWORD: password

### Laravel IDE Helper usage:

Hinting for models:
> php artisan ide-helper:models \
> php artisan ide-helper:models --reset 

Use --reset option to replace whole phpdoc block in models. 
Code hinting for facades methods:
> php artisan ide-helper:generate

Code hinting for classes called through containers: 
> php artisan ide-helper:meta

## Extending the request normalisation interface:

- Create a new JSON Schema file in **_App\Libraries\Integrations\Schemas_** 
- Add a new entry to the schema dictionary class in **_App\Libraries\Integrations\SchemaDictionary.php_**
  - (this will be automatically loaded to the schema validator class)
- Create a Transformer class in order to map external request properties to the common database schema - **_App\Libraries\Integrations\Transformers_**
- Provide a new match between the transformer and a schema vendor in **_App\Libraries\Integrations\RequestTransformerFactory.php_**
- **Enjoy.**
