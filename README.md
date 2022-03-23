<h1>apis for add order, show menu to users</h1>
<p>Using this api, you can get menu from available, unexpired foods and order food</p>
<h2>Requirement</h2>
<p>To use this api, you must already have php and mysql installed on your system</p>
<h2>Installation</h2>
<p>First clone the code or download it.Then you need to do the following steps.</p>
<ul>
  <li>Open the .env file and enter your database settings.(you can copy from env.example)
    <span>These settings are as follows.
      DB_CONNECTION = mysql
      DB_HOST = 127.0.0.1
      DB_PORT = 3306
      DB_DATABASE = snapp_food
      DB_USERNAME = root
      DB_PASSWORD =
    </span>
  </li>
  <li>Then you need to install dependencies with <b>composer install && composer dump-autoload</b></li>
  <li>Then you need to create project tables with the <b>php artisan migrate</b> command in your database</li>
  <li>then you should install passport on laravel <b>php artisan passport:install</b>
  <li>Then you need to fill data to your tables with <b>php artisan db:seed</b></li>
  <li>after db:seed, 51 users will created, one of them is root user with following information
    <ol>
      <li>email: root@root.com</li>
      <li>name: root</li>
      <li>password: r00t@Root</li>
    </ol>
    for using apis you should enter Bearer token for Authorization, so you can use login route to login with this user and get token or you can use register route and create new user and use returned token.
  </li>
  <li>Then you can run the project with the <b>php artisan serve command.</b></li>
  <li>You can also get the list of api urls with the <b>php artisan route:list</b> command</li>
  <li>You can see test files in path: <b>tests/Features</b></li>
  <li>You can run test with this command: <b>tests/Features</b></li>
</ul>
