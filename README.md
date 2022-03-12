<p align="center"><a href="https://www.studeersnel.nl/nl" target="_blank"><img src="https://d20ohkaloyme4g.cloudfront.net/img/studeersnel_logo.png" width="200"></a></p>

<p align="center">
<a href="https://github.com/kadivar/flash-card-app/actions/workflows/laravel.yml"><img src="https://github.com/kadivar/flash-card-app/actions/workflows/laravel.yml/badge.svg" alt="Build Status"></a>
<a href="https://github.com/kadivar/flash-card-app/blob/main/LICENSE.md"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
<a href="https://twitter.com/mr_kadivar" title="setup-php twitter"><img alt="setup-php twitter" src="https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555"></a>
</p>

## About Flash Card App

`Flash Card App` is an interactive CLI program for Flashcard practice. For context: a flashcard is a spaced
repetition tool for memorising questions and their respective answers.
It includes following subcommands:

### Data Schema
![Data Schema](https://github.com/kadivar/flash-card-app/blob/main/data-schema.png?raw=true)

### How to use
For Initial run and get commands list use: `php artisan flashcard:interactive`
- `1 . Create a flashcard` By choosing this item you will be asked for a "Question" and its "Answer" to create a new flash card.
- `2 . List all flashcards` By choosing this item a list of all cards will be printed.
- `3 . Practice` By choosing this item you will be able to choose each card you want to practice from printed list.
- `4 . Stats` By choosing this item you can be aware of your study progress.
- `5 . Reset` By choosing this item you can reset all your study history and start again from the beginning.
- `6 . Exit` By choosing this item you exit to get some rest :)

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
