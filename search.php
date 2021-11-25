<?php 
require_once 'connection/init.php';


	if($_GET["term"]){
		$term = $_GET["term"];

		$params = [
    'index' => 'searchengine',
    'body'  => [
        'query' => [
            'multi_match' => [
                "query" => $term,
                "fields" => ["description","title","url"]
            ]
        ]
    ]
];



				$results = $client->search($params);

			/*	echo '<pre>', print_r($results), '<pre>';
				print_r($results);*/

				if($results['hits']['total'] >=1){
					$res = $results['hits']['hits'];
				}

	}
	else{
		 exit("You must enter a search Term");
	}

	//$type = isset($_GET["type"]) ? $_GET["type"] : "sites";

?>
	

<!DOCTYPE html>
<html>
<head>
	<title>welcome to Doodle</title>

	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>



	<div class="wrapper">
		<div class="header">
		
			<div class="headerContent">
			
					<div class=  "logoContainer">
				<a href="index.php">
					<img  src="assets/images/logo.png" >	
				</a>
				
					</div>

		<div class= "searchContainer">
			<form action="search.php" method="GET">
					
				<div class="searchBarContainer">
						
						<input class="searchBox" type="text" name="term" autocomplete="on">
						<button class="searchButton">
							<img  src="assets/images/sear.png">
						</button>

					</div>
				</form>
			</div>
		</div>
		</div>
		</div>

		<div class = "mainResultsSection">
		<?php
		if(isset($res)){
			foreach ($res as $r) {
				$url = $r['_source'] ['url'];
				$title= $r['_source'] ['title'];
				$description = $r['_source'] ['description'];
				$keywords = $r['_source'] ['keywords'];

				?>
				
				<div class='resultContainer'>

								<h3 class='title'>
									<a class='result' href='<?php echo $url ?>'>
										<?php echo $title ?>
									</a>
								</h3>
								<span class='url'><?php echo $url ?></span>
								<span class='description'><?php echo $description ?></span>

							</div>
							</div>
				<?php
			}
		}
	?>
		

		
	


	

</html>
</body>