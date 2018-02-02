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

    public static function getAllCategory(){
        $db = new DB();

        $result = $db->query("select * from category")->execute()->fetch_obj();
        $listCategories = array();

        for ($i = 0; $i < count($result); $i++) {
            $listCategories[] = new Category($result[$i]->id, $result[$i]->name);
        }

        return $listCategories;
    }
}