# Welcome to Fleet-management system!

This is a Laravel v9 project built using livewire for the admin dashboard, it users sanctum for api authentication and tailwind css for the ui.

## Database

When you run the seeds you will find

### Two Users

admin@admin.com (admin)
test@test.com (api user)
They both have the same password > P@ssword

### All Egypt Cities (Governorates)

### Two trips for testing purposes

![enter image description here](https://raw.githubusercontent.com/peterzaccha/fleet-management/master/public/erd.png)

## Getting Stated

You can use docker to run this project

```
docker run -p 8000:8000 peterzaccha/fleet-management
```

Then you can access the dashboard here [http://localhost:8000/login](http://localhost:8000/login)

Email : admin@admin.com<br>
Password: P@ssw0rd

Or you can click here
<br>
[![Try in PWD](https://raw.githubusercontent.com/play-with-docker/stacks/master/assets/images/button.png)](https://labs.play-with-docker.com/?stack=https://raw.githubusercontent.com/peterzaccha/fleet-management/master/docker-compose.yml)

Or If you want to make your life difficult you can follow this steps
First create a database and then run the bellow command

```
git clone https://github.com/peterzaccha/fleet-management
cd fleet-management
composer install
cp .env.example .env #don't forget to change the db configs
php artisan migrate --seed
```

## License

[MIT license](https://opensource.org/licenses/MIT).
