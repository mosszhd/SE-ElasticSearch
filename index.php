<!DOCTYPE html>
<html>
<head>
	<title>welcome to SE</title>

<meta charset="UTF-8">
  <meta name="description" content="Search the web and images">
  <meta name="keywords" content="Search engine, SE, websites,images">
  <meta name="author" content="Mustafa Kamal, azmee">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">


</head>
<body>



	<div class="wrapper indexPage">
		
		<div class ="mainSection">
		
			<div class=  "logoContainer">
				<img  src="assets/images/logo.png" >

			
			</div>

				<div class="searchContainer">
					<form action="search.php" method="GET ">

				<input class= "searchBox" type="text" name="term" id="search">
				<input class= "searchButton" type="submit" value="search">
				<div id="suggestion-box"></div>

					</form>


			</div>

		</div>

	</div>


 
</html>
</body>