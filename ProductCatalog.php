<?php 

    class ProductCatalog {
        private $productCatalog;
        
        /**
         * Private ctr to avoid instantization.
         */
        private function __construct() {
        
        }
        
        /**
         * Singleton instance
         * @return ProductCatalog instance
         */
        public static function Instance() {
            static $instance = null;    // Singleton instance handle
            if ($instance === null) {
                $instance = new ProductCatalog();
            }
            return $instance;
        }
        
        public function addProduct($product) {
            if($product instanceof Product) {
                $productId = $product->getId();
                
                if(isset($this->productCatalog[$productId])) {
                    throw new Exception("Product with same ID already exists");
                }
                
                $this->productCatalog[$productId] = $product;
            } else {
                throw new Exception("Not a PRODUCT instance");
            }
        }
        
        public function getProduct($productId) {
            if(!isset($this->productCatalog[$productId])) {
                throw new Exception("Product with given ID does not exist");
            }
            
            return $this->productCatalog[$productId];
        }
    }
?>