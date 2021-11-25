<?php

require_once 'connection/init.php';
include("classes/DomDocumentParser.php");


$alreadyCrawled = array(); // already crawled links
$crawling = array();


function insertLink($url, $title, $description, $keywords){

	global $client;

	$params = [
    'index' => 'searchengine',
    // 'id'    => 'my_id',
    'body'  => [
    			'url' => $url,
    			'title' => $title ,
				'description' => $description,
				'keywords' => $keywords]
	];

	$response = $client->index($params);
				print_r($response);

				echo "URL: $url, Title : $title Description: $description, keywords: $keywords<br> ";
}



function createLink($src,$url) {


	$scheme = parse_url($url)["scheme"]; //http it will return an array saying access the scheme part of the url
	$host = parse_url($url)["host"]; //www.website.com

		if(substr($src,0,2) == "//") {
					$src = $scheme . ":" . $src; 


		}

		else if(substr($src,0, 1) == "/"){
			$src = $scheme . "://" . $host . $src;

				
		}
		elseif (substr($src,0, 2) == "./") {
			$src = $scheme . "://" . $host . dirname(parse_url($url)["path"]) . substr($src, 1); //./about/aboutUS.php


		}
		elseif (substr($src,0, 3) == "../") {
			$src = $scheme . "://" . $host . "/" . $src; //../about/aboutUS.php
		}
		else if (substr($src,0, 5) != "https" && substr($src,0, 5) != "http") {
			$src = $scheme . "://" . $host . "/" . $src; //about/about.php
		}


		return $src;
		

}


	function getDetails($url){


		$parser = new DomDocumentParser($url);

		$titleArray = $parser->getTitletags();

		if(sizeof($titleArray) == 0 || $titleArray->item(0) == NULL){
			return;
		}



		$title = $titleArray->item(0)->nodeValue;

		$title = str_replace("\n", "", $title);

		if($title == ""){
			return;
		}

		$description = "";
		$keywords = "";

		$metasArray = $parser->getMetatags();

		foreach ($metasArray  as $meta) {

			if($meta->getAttribute("name") == "description"){
				$description = $meta->getAttribute("content");
			}

			if($meta->getAttribute("name") == "keywords"){
				$keywords = $meta->getAttribute("content");
			}
		}

		$description = str_replace("\n", "", $description);
		$keywords = str_replace("\n", "", $keywords);

		insertLink($url, $title, $description,$keywords);

		



		//echo "URL: $url, Description: $description, keywords: $keywords<br> ";
}

		function followLinks($url){

			global $alreadyCrawled;
			global $crawling;

			$parser = new DomDocumentParser($url);

			$linkList = $parser->getLinks();	

			foreach ($linkList as $link) {
						$href = $link->getAttribute("href");

						if(strpos($href, "#") !== false){
							continue;
						}

					else if(substr($href, 0 , 11) == "javascript:"){
						continue;
					}

			$href = createLink($href, $url);

			if(!in_array($href, $alreadyCrawled)){  

					$alreadyCrawled[] = $href;
					$crawling[] = $href;

					getDetails($href);

			  }

			
						echo $href . "<br>";
			}		

			array_shift($crawling); //knock it off the array after visiting

			foreach ($crawling as $site) {
				followLinks($site);
			}
		}



$startUrl= "https://www.quora.com"; //this is where we start to crawl website
	followLinks($startUrl);
 ?>