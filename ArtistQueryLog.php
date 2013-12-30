<?php 

    class ArtistQueryLog {
        private $artistQueryLog;
        
        /**
         * Private ctr to avoid instantization.
         */
        private function __construct() {
        
        }
        
        /**
         * Singleton instance
         * @return ArtistQueryLog instance
         */
        public static function Instance() {
            static $instance = null;    // Singleton instance handle
            if ($instance === null) {
                $instance = new ArtistQueryLog();
            }
            return $instance;
        }
        
        public function addArtistQuery($artist, $query) {
            if(!isset($this->artistQueryLog[$artist])) {
                $this->artistQueryLog[$artist] = array();
            }
            
            $this->artistQueryLog[$artist][] = $query;
        }
        
        public function getArtistQueries($artist) {
            if(!isset($this->artistQueryLog[$artist])) {
                return array();
            }
            return $this->artistQueryLog[$artist];
        }
    }
?>