# Welcome to Fleet-management system!

This is a Laravel v9 project built using livewire for the admin dashboard, it users sanctum for api authentication and tailwind css for the ui.

# Database

![enter image description here](https://raw.githubusercontent.com/peterzaccha/fleet-management/master/public/erd.png)

## Getting Stated

You can use docker to run this project

```
docker run -p 8000:8000 peterzaccha/fleet-management
```

Then you can access the dashboard here [http://localhost:8000/login](http://localhost:8000/login)

Email : admin@admin.com
Password: P@ssw0rd

If you want to make your life harder you can follow this steps
First create a database and then run the bellow command

```
✔︎ git clone https://github.com/peterzaccha/fleet-management
✔︎ cd fleet-management
✔︎ composer install
✔︎ cp .env.example .env #don't change the db configs
✔︎ php artisan migrate --seed
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
