## echo '0' ?: '1';

### Description

Sometimes it's not so much a quiz as a collection of things I find noteworthy.

### Get started
- Install dependencies

  ``` 
  composer install
  ``` 
- Run webpack

  ```
  npm run build
  ```
  
### Use dynamic site generator
- Point your local server to `public` folder, e.g.

  ```
  php -S localhost:80 -t public/
  ```
  
### Use static site generator
- Point your local server to the `docs` folder, e.g.

  ```
  php -S localhost:80 -t docs/
  ```
- To update the static HTML files, use

  ```
  php ./bin/createstatic.php
  ```
