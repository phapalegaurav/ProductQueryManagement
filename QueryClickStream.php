<?php 

    class QueryClickStream {
        private $queryClickStream;
        
        /**
         * Private ctr to avoid instantization.
         */
        private function __construct() { 
            
        }
        
        /**
         * Singleton instance
         * @return QueryClickStream instance
         */
        public static function Instance() {
            static $instance = null;    // Singleton instance handle
            if ($instance === null) {
                $instance = new QueryClickStream();
            }
            return $instance;
        }

        public function addQueryClick($query, $productId, $timestamp) {
            if(!isset($this->queryClickStream[$query])) {
                $this->queryClickStream[$query] = array();
            }
            
            $queryClick  = array();
            $queryClick['productId'] = $productId;
            $queryClick['timestamp'] = $timestamp;
            
            $this->queryClickStream[$query][] = $queryClick;
        }
        
        public function getQueryClicks($query) {
            if(!isset($this->queryClickStream[$query])) {
                return array();
            }
            
            $queryClicks = $this->queryClickStream[$query];
            $clickedProductIds = array();
            foreach($queryClicks as $queryClick) {
                $clickedProductIds[] = $queryClick['productId'];
            }
            
            return $clickedProductIds;
        }
    }
?>