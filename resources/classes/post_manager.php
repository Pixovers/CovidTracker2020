<?php

    include "post.php";


    /*
     *  Classe:         PostManager
     *  Descrizione:    Classe per importare i post da WordPress
     *
     *
     */
    class PostManager {
        
        //connessione al db wordpress
        protected $connection;
        
        //array dei post attualmente caricati
        protected $posts;
        
        //numero di post presenti nel database
        protected $posts_total_count;
        
        
        /* __ Costruttore __
         *
         * Parametri:
         *      $connection -> Connessioni Mysqli di un database wordpress
         *
         */
        public function __construct( $connection ) {
            $this->connection = $connection;
            
            //inizializza posts ad array()
            $this->posts = array();
            
            //conta il numero totale dei post nel database
            $this->posts_total_count = $this->connection->query('SELECT COUNT(*) FROM wpyy_posts WHERE ping_status = "Open" AND post_status = "publish"' )->fetch_assoc()['COUNT(*)'];
        }
        
        
        //recupera $max post dal database in ordine casuale.
        //Se $max e' maggiore del numero reale dei post del database, verranno recuperati meno post.
        public function randomPosts( $max = 1 ) {
            
            $this->query_exec( 'SELECT post_title, post_content, meta_image.meta_value, guid FROM wpyy_posts posts ' .
                               'INNER JOIN wpyy_postmeta hold ON posts.ID = hold.post_id AND hold.meta_key = "_thumbnail_id" ' . 
                               'INNER JOIN wpyy_postmeta meta_image ON hold.meta_value = meta_image.post_id AND meta_image.meta_key = "_wp_attached_file" ' .
                               'WHERE ping_status = "Open" AND post_status = "publish" ORDER BY rand()  LIMIT ' . $max );
                               
            return $this->posts;
        }
        
        //recupera $max post dal database dal più vecchio al più nuovo.
        //Se $max e' maggiore del numero reale dei post del database, verranno recuperati meno post.
        public function lastPosts( $max = 1 ) {
            
            $this->query_exec( 'SELECT post_title, post_content, meta_image.meta_value, guid FROM wpyy_posts posts ' .
                               'INNER JOIN wpyy_postmeta hold ON posts.ID = hold.post_id AND hold.meta_key = "_thumbnail_id" ' . 
                               'INNER JOIN wpyy_postmeta meta_image ON hold.meta_value = meta_image.post_id AND meta_image.meta_key = "_wp_attached_file" ' .
                               'WHERE ping_status = "Open" AND post_status = "publish" ORDER BY post_date DESC  LIMIT ' . $max );
                               
            return $this->posts;
        }
        
        //recupera $max post dal database dal più nuovo al più vecchio
        //Se $max e' maggiore del numero reale dei post del database, verranno recuperati meno post.
        public function firstPosts( $max = 1 ) {
            
            $this->query_exec( 'SELECT post_title, post_content, meta_image.meta_value, guid FROM wpyy_posts posts ' .
                               'INNER JOIN wpyy_postmeta hold ON posts.ID = hold.post_id AND hold.meta_key = "_thumbnail_id" ' . 
                               'INNER JOIN wpyy_postmeta meta_image ON hold.meta_value = meta_image.post_id AND meta_image.meta_key = "_wp_attached_file" ' .
                               'WHERE ping_status = "Open" AND post_status = "publish" ORDER BY post_date ASC  LIMIT ' . $max );
                               
            return $this->posts;
        }
        
        //recupera tutti i post dal database
        public function allPosts() {
                        
            $this->query_exec( 'SELECT post_title, post_content, meta_image.meta_value, guid FROM wpyy_posts posts ' .
                               'INNER JOIN wpyy_postmeta hold ON posts.ID = hold.post_id AND hold.meta_key = "_thumbnail_id" ' . 
                               'INNER JOIN wpyy_postmeta meta_image ON hold.meta_value = meta_image.post_id AND meta_image.meta_key = "_wp_attached_file" ' .
                               'WHERE ping_status = "Open" AND post_status = "publish"' );
                               
            return $this->posts;
        }
        
        //esegue le query per recuperare post dal database
        protected function query_exec( $query ) {
            $this->posts = array();
            
            $result = $this->connection->query( $query );
            while( $row = $result->fetch_assoc() ) {
                $title = $row['post_title'];
                $content = $row['post_content'];
                $image = "https://www.covidtracker2020.live/pages/blog/wp-content/uploads/".$row['meta_value'];
                $url = $row['guid'];

                $post = new Post( $title, $content, $image, $url );
                
                $this->posts[] = $post;
                
                
            }
        }
        
        //metodi GETTER - SETTER
        public function getConnection() {
            return $this->connection;
        }
        
        public function setConnection( $connection ) {
            $this->connection = $connection;
        }
        
        public function getPosts() {
            return $this->posts;
        }
        
        public function getPostsTotalCount() {
            return $this->posts_total_count;
        }
    }

?>