## $4YT-API

This is an API developed with the purpose of provide functionality for the building-u event: A dollar for your thoughts ($4YT).

## API Documentation

This API documentation is provided [here]()

## Local environment

In order to set up locally is needed to execute:

<ol>
    <li>Clone repository</li>
    <li><code>cd localpath/s4yt-api/</code></li>
    <li><code>composer install</code></li>
    <li><code>cp .env.example .env</code></li>
    <li>Create a local MySQL database</li>
    <li>Set env variables <code>DB_PASSWORD, DB_USERNAME</code> and <code>DB_DATABASE</code></li>
    <li><code>php artisan key:generate</code></li>
    <li><code>npm install</code></li>
    <li><code>npm run dev</code></li>
    <li><code>php artisan migrate --seed</code></li>
</ol>

For updates please refer to the commit instructions.
