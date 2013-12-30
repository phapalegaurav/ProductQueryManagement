<?php

    class Product {
        private $id;
        private $name;
        private $genre;
        private $artist;
        
        function __construct($id, $name, $genre, $artist) {
            $this->id = $id;
            $this->name = $name;
            $this->genre = $genre;
            $this->artist = $artist; 
        }
        
        function getId() {
            return $this->id;
        }
        
        function getArtist() {
            return $this->artist;
        }
    }

?>