<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #f00;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: auto;
            }
           
            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

        </style>
    </head>
    <body>
			<div class="content">
			<h1 style="color:black">An unexpected error has occurred. Please try again later.</h1>
			<h1 style="color:black">500</h1>
			<h1 style="color:black">{{$error}}</h1>
        	</div>
</body>
</html>
