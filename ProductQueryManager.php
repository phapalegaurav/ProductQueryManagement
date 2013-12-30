<?php

    include_once('Product.php');
    include_once('ProductCatalog.php');
    include_once('QueryClickStream.php');
    include_once('ArtistQueryLog.php');


    class ProductQueryManager {
        private $productCatalog;
        private $queryClickStream;
        private $artistQueryLog;

        public function __construct() {
            $this->productCatalog = ProductCatalog::Instance();
            $this->queryClickStream = QueryClickStream::Instance();
            $this->artistQueryLog = ArtistQueryLog::Instance();
        }
        
        public function addProduct($id, $name, $genre, $artist) {
            // TODO: check if id, name, genre and artist are valid (e.g. are not null, non-empty etc)
            $product = new Product($id, $name, $genre, $artist);
            $this->productCatalog->addProduct($product);
        }
        
        public function addQueryClick($query, $productId, $timestamp) {
            //TODO: check if query, productId and timestamp are valid. (e.g. if productId exists, query is non empty and timestamp is valid timestamp etc)
            
            // Add 2 records:
            // 1. in QueryClickStream
            // 2. in ArtistQueryLog
            
            // 1. Adding new record in QueryClickStream
            $this->queryClickStream->addQueryClick($query, $productId, $timestamp);
            
            // 2. Adding new record in ArtistQueryLog
            $product = $this->productCatalog->getProduct($productId);
            $artist = $product->getArtist();
            $this->artistQueryLog->addArtistQuery($artist, $query);
        }
        
        /**
         * Given a query, this retuns a list of products which were clicked.
         * @param $query Query which resulted in clicks on products
         * @return An array of products
         */
        public function getQueryProducts($query) {
            $productIds = $this->queryClickStream->getQueryClicks($query);
            $products = array();
            foreach($productIds as $productId) {
                try {
                    $products[] = $this->productCatalog->getProduct($productId);
                } catch(Exception $e) {
                    // TODO: How to handle missing product case?
                }
            }
            return $products;
        }
        
        /**
         * Given an artist, this returns the queries which resulted in clicks on products of corresponding artist.
         * @param $artist Artist of the product, which was clicked.
         * @return An array of queries which resulted in clicks.
         */
        public function getArtistQueries($artist) {
            return $this->artistQueryLog->getArtistQueries($artist);
        }
    }
?>