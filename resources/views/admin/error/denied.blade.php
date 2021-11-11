<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Forbidden Access</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

	<!-- Custom stlylesheet -->
	{{-- <link type="text/css" rel="stylesheet" href="css/style.css" /> --}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        * {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

body {
  padding: 0;
  margin: 0;
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 520px;
  width: 100%;
  text-align: center;
  line-height: 1.4;
}

.notfound .notfound-404 {
  height: 190px;
}

.notfound .notfound-404 h1 {
  font-family: 'Montserrat', sans-serif;
  font-size: 146px;
  font-weight: 700;
  margin: 0px;
  /* color: #232323; */
  color: #ff2a2a;
}

.notfound .notfound-404 h1>span {
  display: inline-block;
  width: 120px;
  height: 120px;
  /* background-image: url('../img/emoji.png'); */
  /* background-image: url('uploads/admin/error/emoji.png'); */
  background-size: cover;
  -webkit-transform: scale(1.4);
      -ms-transform: scale(1.4);
          transform: scale(1.4);
  z-index: -1;
}

.notfound h2 {
  font-family: 'Montserrat', sans-serif;
  font-size: 22px;
  font-weight: 700;
  margin: 0;
  text-transform: uppercase;
  /* color: #232323; */
  color: #ff0000;
}

.notfound p {
  /* font-family: 'Montserrat', sans-serif;
  color: #787878;
  font-weight: 300; */
  font-family: 'Montserrat', sans-serif;
    color: #f90f0f;
    font-weight: 300;
    font-size: 23px;
    font-variant: petite-caps;
    font-weight: bold;
}

.notfound a {
  font-family: 'Montserrat', sans-serif;
  display: inline-block;
  padding: 12px 30px;
  font-weight: 700;
  /* background-color: #f99827; */
  background-color: #37d005;
  color: #fff;
  border-radius: 40px;
  text-decoration: none;
  -webkit-transition: 0.2s all;
  transition: 0.2s all;
}

.notfound a:hover {
  opacity: 0.8;
}

@media only screen and (max-width: 767px) {
  .notfound .notfound-404 {
    height: 115px;
  }
  .notfound .notfound-404 h1 {
    font-size: 86px;
  }
  .notfound .notfound-404 h1>span {
    width: 86px;
    height: 86px;
  }
}

    </style>

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>4<span><img src="{{ asset('uploads/admin/error/emoji.png') }}" style="height: 100px;
                    width: 100px;
                    margin-bottom: 15px;" alt="emoji"></span>3</h1>
			</div>
			<h2>Oops!</h2>
			<p>Sorry.. You are not authorized to access</p>
			{{-- <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a> --}}
			<a href="{{ route('admin.dashboard') }}">Go to dashboard</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
