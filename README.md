api project 
===========

World headlines (EN only) displayed in image format.

API consumed: https://newsapi.org/docs/

PHP 7.0.9
Symfony 3.3

1. git clone https://github.com/mtaylor456/news-api
2. cd news-api
3. Ensure your system meets symfony requirements: php bin/symfony_requirements
4. composer install (press return for all parameters when prompted)
5. route is http://yoursite/news-api/web/image-news

Info:

- see src/appBundle for php code
- Services are in app/config/services.yml
- for front end code, the Twig files are in app/Resources/views

Notes:

- Kept the front end simple, have not used a js package manager
- Not caching http responses or using reverse proxy (but I would usually recommend this)