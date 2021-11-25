<?php 

class domDocumentParser {



	private $doc; //this doc contains the website we have visited

	public function __construct($url){

		$options = array (
			'http'=>array('method'=> "GET", 'header'=> "User-Agent: searchEngine/0.1\n")
					); //this option is gonna be used when we will request a webpage.. Go to the url request the whole document.. the option we are specifying are the method we are gonna retrieve the website with which will be get because we are gonna retrieve the data  .. the we have to specify header and user agent.. user agent is how website knows who visited..

		$context = stream_context_create($options); // which is we are gonna be used when we are gonna make the request

		$this->doc = new domDocument(); //domdocument allows you to perform actions on web pages


		@$this->doc->loadHTML(file_get_contents($url,false,$context)); //we are gonna be passing parameter(file). and the file is gonna be the actual webpage itself.. the false is for wheather we wanna use the include path for php.. a configuration url..

		
		}

		public function getLinks(){
			return $this->doc->getElementsByTagName("a");
			}

			public function getTitletags(){
			return $this->doc->getElementsByTagName("title");  
			}

			public function getMetaTags(){
			return $this->doc->getElementsByTagName("meta");
			}


  }

  ?>