<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    dev.to Scheduler
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">tl;dr</div>
                        <div class="card-body">
                            <p>This scheduler allows you to create appointments to be scheduled in different rooms. You can create rooms, create appointments to be added directly to the scheduler, move appointments between rooms and time slots on the scheduler, schedule appointments without a time to be added later (drag and drop them on).</p>
                            <p>The scheduler uses sockets to communicate with others on the schedule, so that appointments time slots lock out when you are scheduling there, or when you are editing an appointment.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">How to Get Started</div>
                        <div class="card-body">
                            <ol>
                                <li>Register as a user, or use <em>fake@gmail.com</em> with password <em>nutella</em>.</li>
                                <li>Create a room, or create an appointment!</li>
                            </ol>
                            <p>Note: For demo purposes, the database will reset every hour and your data will disappear.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Tech Stack</div>
                        <div class="card-body">
                            <a href="https://laravel.com/" rel="nofollow" target="_blank">
                                <img src="./images/laravel.png" class="img-thumbnail" />
                            </a>
                            <a href="https://vuejs.org/" rel="nofollow" target="_blank">
                                <img src="./images/vue.png" class="img-thumbnail" />
                            </a>
                            <a href="https://pusher.com/" rel="nofollow" target="_blank">
                                <img src="./images/pusher.png" class="img-thumbnail" />
                            </a>
                            <p>
                                <a href="https://fullcalendar.io/" rel="nofollow" target="_blank">
                                    fullcalendar
                                </a>
                            </p>
                            <p>
                                <a href="https://fullcalendar.io/scheduler" rel="nofollow" target="_blank">
                                    fullcalendar Scheduler
                                </a>
                            </p>
                            <p>
                                <a href="https://github.com/CodeSeven/toastr" rel="nofollow" target="_blank">
                                    toastr
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
