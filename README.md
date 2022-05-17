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
