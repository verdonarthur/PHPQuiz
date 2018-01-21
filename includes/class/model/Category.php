<?php
/**
 *
 * @author Verdon Arthur
 */

class Category {
    public $id, $name;

    public function __construct($id, $name) {

        $this->id = $id;
        $this->name = $name;
    }

    public static function basicConstruct($name){
        return new self(null,$name);
    }
}