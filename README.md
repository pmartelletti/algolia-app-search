# Algolia Technical Test

Algilia Technical Test by Pablo Martelletti.

### Running the App

Install package vendors via composer:

```bash
composer install
```

Copy .env.example to .env and define the Algolia parameters:

```
ALGOLIA_APP_ID='EXAMPLE-ID'
ALGOLIA_API_KEY='EXAMPLE-KEY'
ALGOLIA_SEARCH_KEY='EXAMPLE-SEARCH-KEY'
ALGOLIA_APPS_INDEX='APPS-INDEX'
```

Finally, use the PHP built-in server to run the application:

```bash
php -S localhost:8080 -t public/
```

**Note**: In order to the instantsearch.js faceting to work, the 'category' attribute must be set in the 
Algolia index as an "Attributes for faceting".

### Running the Tests

The MVC framework includes some unit testing so that we can be sure that the essential framework classes behave as expected.

To run them, just use phpunit:

```bash
php vendor/bin/phpunit
```

