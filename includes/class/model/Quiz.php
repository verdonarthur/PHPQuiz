<?php
/**
 *
 * @author Verdon Arthur
 */

class Quiz {
    public $id, $name, $creationDate, $description, $categories;

    public function __construct($id, $name, $creationDate, $description, $categories) {

        $this->id = $id;
        $this->name = $name;
        $this->creationDate = $creationDate;
        $this->description = $description;
        $this->categories = $categories;
    }

    public static function basicConstruct($name, $description, $categories) {
        return new self(null, $name, null, $description, $categories);
    }

    public function getAllCategoriesID() {
        $ids = array();
        foreach ($this->categories as $tmp)
            $ids[] = $tmp->id;

        return $ids;
    }

    public function getAllCategoriesName(){
        $names = array();
        foreach ($this->categories as $tmp)
            $names[] = $tmp->name;

        return $names;
    }

}