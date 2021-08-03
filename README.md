# Webhook-machine

A project that implements sending and receiving of Webhooks between 2 laravel apps (Server &amp; Client).

## What does the application do?

The server (api) schedules a job and sends data to the client app (client) through a webhook. When the webhook is received on the client-side app, it processes the request using a job.The job then sends a notification to the user and broadcasts an event using Pusher channels. Finally, the event is captured by Laravel Echo which then provides the necessary data to be updated on the Vue JS frontend in real-time.

You can read more into detail on what the packages do here:

- [Spatie's Laravel Webhook Server](https://github.com/spatie/laravel-webhook-server)
- [Spatie's Laravel Webhook Client](https://github.com/spatie/laravel-webhook-client)

## Project setup

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

```
* node 15.5.1 or latest
* npm 7.6.0 or latest
* composer 2.1.5 or latest
```

### Setting up the project locally

A step by step series on how to get a development env running.

Open Terminal / Command Prompt and type:

```
git clone https://github.com/vamuigua/webhook-machine.git
```

Then change your directory to the project you have cloned

```
cd webhook-machine
```

### Server App (api) & Client App (client)

The project includes two laravel applications: a server-side & client-side app.
In both apps, follow the steps below to get the project up and running:

```
cd <api/client>
```

#### Install project Dependencies

```
composer install
```

#### Install npm packages

```
npm install
```

#### Compile assets for development

```
npm run dev
```

#### Create .env file

```
touch .env
```

#### Copy .env Laravel Configuration

```
php -r "file_exists('.env') || copy('.env.example', '.env');"
```

#### Generate Application Key

```
php artisan key:generate
```

#### Run Database migrations and seed

```
php artisan migrate --seed
```

#### Start the app

```
php artisan serve
```

Your done...The app should now be running on your browser 👍

<p align="center">
  <img src="https://media.giphy.com/media/3o7abKhOpu0NwenH3O/source.gif">
</p>

## Built With

- Laravel, for processing [Scheduling Jobs](https://laravel.com/docs/8.x/scheduling#scheduling-queued-jobs) and [Broadcasting Notifications](https://laravel.com/docs/8.x/notifications#broadcast-notifications)
- Vue JS, for Reactive UI [Components](https://vuejs.org/v2/guide/components.html) on the client app
- [Pusher](https://pusher.com/), for broadcasting events
- Laravel Echo, for subscribing to channels and listening for events
- [Spatie's Laravel Webhook Server](https://github.com/spatie/laravel-webhook-server), for sending webhooks
- [Spatie's Laravel Webhook Client](https://github.com/spatie/laravel-webhook-client), for receiving webhooks

## Authors

- **Victor Allen** - [vamuigua](https://github.com/vamuigua) :v:

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
