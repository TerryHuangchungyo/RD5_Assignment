<?php
class Route {
    private $url;
    private $pointer;

    public function __construct() {
        if( isset($_GET["url"])){
            $this->url = explode("/",trim( $_GET["url"], "/"));
        } else {
            $this->url = [];
            $this->pointer = -1;
        }
        $this->pointer = 0;
    }

    public function hasNextPath() {
        if( $this->pointer >= 0&& $this->pointer < count($this->url) ) {
            return true;
        }
        return false;
    }

    public function getNextPath() {
        if( $this->hasNextPath() ) {
            return $this->url[$this->pointer++];
        }
        return null;
    }

    public function getPrevPath() {
        if( $this->pointer > 0 ) {
            return $this->url[--$this->pointer];
        }
        return null;
    }

    public function rewind() {
        if( $this->pointer > 0 ) {
            $this->pointer = 0;
        }
    }

    public function getFirstPath() {
        if( count($this->url) != 0 ) {
            return $this->url[0];
        }
        return null;
    }

    public function getLastPath() {
        if( count($this->url) != 0 ) {
            return $this->url[count($this->url)-1];
        }
        return null;
    }

    public function getParam() {
        if( $this->hasNextPath() ) {
            return array_slice($this->url, $this->pointer);
        } else {
            return [];
        }
    }
}