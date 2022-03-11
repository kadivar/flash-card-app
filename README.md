<p align="center"><a href="https://www.studeersnel.nl/nl" target="_blank"><img src="https://d20ohkaloyme4g.cloudfront.net/img/studeersnel_logo.png" width="200"></a></p>

<p align="center">
<a href="#"><img src="https://github.com/kadivar/flash-card-app/actions/workflows/laravel.yml/badge.svg" alt="Build Status"></a>
<a href="#"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<a href="https://twitter.com/mr_kadivar" title="setup-php twitter"><img alt="setup-php twitter" src="https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555"></a>
</p>

## About Flash Card App

`Flash Card App` is an interactive CLI program for Flashcard practice. For context: a flashcard is a spaced
repetition tool for memorising questions and their respective answers.
It includes following subcommands:

- Initial run and get help: `php artisan flashcard:interactive`
- Create a Card: `php artisan flashcard:create`
- List all cards: `php artisan flashcard:list`
- Practice cards: `php artisan flashcard:practice`
- Get statistics of flash cards study: `php artisan flashcard:stats`
- Reset all personal saved study records: `php artisan flashcard:stats`
- Exit to normal shell: `php artisan flashcard:exit`

## How to initial setup
For quick of running project it's recommended to use `laravel sail`. 
For this reason you have to navigate to project path in terminal and then run:

`./vendor/bin/sail up -d`

Then run you considered command after:

`./vendor/bin/sail php artisan [Your expected command]`

For example, for getting list of flash cards you have to run:

`./vendor/bin/sail php artisan flashcard:list`

If need to stop all running services, it's enough to run:

`./vendor/bin/sail down`

## Running on a Production server:
  
For this case after primary infrastructure setup you need to run following commands to get application ready to use:

- `cp .env.example .env` (Just don't forget to fill values.)

- `composer install --prefer-dist --optimize-autoloader`

- `php artisan config:clear`

- `php artisan migrate`

## To do

The feature that are planned:
- [ ] Ability to login as a non admin user in terminal for working with flash cards.
- [ ] Ability to export cards as `csv` and `xlsx` file.
- [ ] Ability to import bulk cards using  `csv` and `xlsx` file.
- [ ] Add Leitner algorithm for organizing cards studying order.
- [ ] Sending reminder for daily study.
- [ ] Developing Restful API for CRUM actions.
- [ ] Simple VueJS web app.


## Security Vulnerabilities

If you discover a security vulnerability within project, please send an e-mail to `Mohammadreza Kadivar` via [me.kadivar@gmail.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Flash Card App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
