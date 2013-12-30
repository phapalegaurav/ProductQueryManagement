<?php 
    include_once('../ProductQueryManager.php');
    ini_set('memory_limit', '-1');

    class ProductQueryManagerDemo {
        
        private $productQueryManager;
        
        public function __construct() {
            $this->productQueryManager = new ProductQueryManager();
        }
        
        /**
         * Helper function for testing. It Loads queries from a JSON file.
         * @param $queryFile to read queires from.
         */
        public function loadQueries($queryFile) {
            $queries_json = file_get_contents($queryFile);
            $queries = json_decode($queries_json, true);
            
            foreach($queries as $query) {
                $querystring = $query['query'];
                $timestamp = $query['timestamp'];
                $productId = $query['productId'];
                
                $this->productQueryManager->addQueryClick($querystring, $productId, $timestamp);
            }
        }
        
        /**
         * Helper function for testing. It loads queries from a JSON file.
         * @param $productCatalogFile to read products from
         */
        public function loadProducts($productCatalogFile) {
            $products_json = file_get_contents($productCatalogFile);
            $products = json_decode($products_json, true);
            
            foreach($products as $product) {
                $id = $product['productId'];
                $name = $product['productName'];
                $genre = $product['genre'];
                $artist = $product['artist'];
                
                $this->productQueryManager->addProduct($id, $name, $genre, $artist);
            }
        }
        
        public function getQueryProducts($query) {
            return $this->productQueryManager->getQueryProducts($query);
        }
        
        public function getArtistQueries($artist) {
            return $this->productQueryManager->getArtistQueries($artist);
        }
    }
    
    //DEMO
    $demo = new ProductQueryManagerDemo();
    
    $demo->loadProducts('../data/data2.json');
    $demo->loadQueries('../data/query2.json');
    
    
    print_r($demo->getQueryProducts("Popular"));
    print_r($demo->getArtistQueries("Baby Lemonade"));

?>
