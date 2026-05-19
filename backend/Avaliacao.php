<?php

class Avaliacao {
    private $id;
    private $anime_id;
    private $anime_name;
    private $user_email;
    private $stars;
    private $comment;
    private $created_at;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }
}
