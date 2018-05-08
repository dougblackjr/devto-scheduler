# DEV.TO CONTEST: The Scheduler

## Installation
1. `composer install`
2. `npm install`
3. `npm run dev`
4. `git submodule update --recursive --remote`
5. `cp .env.example .env`
6. `cp laradock.env laradock/.env`
7. `cd laradock`
8. `docker-compose up --force-rebuild percona nginx redis`
9. In new window, `docker-compose exec php-fpm bash`
10. Register a user.
11. Schedule an appointment!

##