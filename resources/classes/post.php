<?php

    /*
     *  Classe:         Post
     *  Descrizione:    Informazioni su un post WordPress
     *
     */
    class Post {
        
        //titolo del post
        protected $title;
        
        //contenuto testuale del post. (contiene pure la formattazione html)
        protected $content;
        
        //url dell'immagine thumbnail del post
        protected $image;
        
        //url al post
        protected $url;
        
        
        //costruttore
        public function __construct( $title, $content, $image = "#", $url = "#" ) {
            $this->title = $title;
            $this->content = $content;
            $this->image = $image;
            $this->url = $url;
        }
        
        // -----
        
        
        //metodi GETTER - SETTER
        
        public function getTitle() {
            return $this->title;
        }
        
        public function setTitle( $title ) {
            $this->title = $title;   
        }
        
        public function getContent() {
            return $this->content;
        }
        
        public function setContent( $content ) {
            $this->content = $content;
        }
        
        public function getImage() {
            return $this->image;
        }
        
        public function setImage( $image ) {
            $this->image = $image;
        }
        
        public function getUrl() {
            return $this->url;
        }
        
        public function setUrl( $url ) {
            $this->url = $url;
        }
    }

?>