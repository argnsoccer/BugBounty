<html>
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">

     {{include ('bootstrap_header.php')}}
	</head>

	<body>

	{% if username and userType == "hunter" %}
  	{{ include ('header_hunter.php') }}
	{% elseif  username and userType == "marshall" %}
  	{{ include ('header_marshall.php') }}
	{% else %}
  	{{ include ('header_login.php') }}
	{% endif %}

		<h1>Uh oh, you have tried to do something our website does not allow<h1>

			<h3>Error: </h3>
			<p>{{errorMessage}}</p>

			<h3>Solution:</h3>
			<p>{{errorSolution}}</p>

		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 		<script type="text/javascript" src="/../_javascript/basic_search.js"></script>
  	<script type="text/javascript" src="/../_javascript/login.js"></script>
  	<script type="text/javascript" src="/../_javascript/logout.js"></script>
  	{{include ('bootstrap_footer.php')}} 
	</body>

</html>