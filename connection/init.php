   <?php

    use Elasticsearch\ClientBuilder;

    require 'vendor/autoload.php';

    $hosts = [
    '127.0.0.1:9200'
 
];

    $client = ClientBuilder::create()-> setHosts($hosts)->build();