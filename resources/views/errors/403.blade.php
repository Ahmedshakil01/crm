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
                <div class="title" style="margin-top:100px">
                	<h2><?php echo $exception->getStatusCode(); ?></h2>
                   <?php echo $exception->getMessage(); ?>
                </div>
        	</div>
</body>
</html>
