# API v2

## Current flow
index.php -> controllers/* -> models/*

 - apache redirects any request to `index.php?q=<URL>`
 - initial request to index.php
 - look through our `$routes` table to 