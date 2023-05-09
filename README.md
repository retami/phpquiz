## `echo '0' ?: '1'` - PHP quiz

### Description

Sometimes it's not so much a quiz as a collection of things I find noteworthy in PHP.

Visit [retami.github.io/phpquiz][1]


### Get started
- Install dependencies

  ``` 
  composer install
  ``` 
- Run webpack

  ```
  npm run build
  ```
  
### Use dynamic site
- Point your local server to `public` folder, e.g.

  ```
  php -S localhost:80 -t public/
  ```
  
### Use static site generator
- Point your local server to the `docs` folder, e.g.

  ```
  php -S localhost:80 -t docs/
  ```
- To update the static HTML files in the `docs` folder, use

  ```
  php ./bin/createstatic.php
  ```

[1]: https://retami.github.io/phpquiz
