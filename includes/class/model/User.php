<?php
/**
 *
 * @author Verdon Arthur
 */

class User {
    public static function isUserExist($username){
        $db = new DB();
        return !empty($db->query("select * from user where username='$username'")->execute()->fetch_obj());
    }

    public static function getUserPasswordHash($username){
        $db = new DB();
        $result = $db->query("select * from user where username='$username'")->execute()->fetch_obj();
        if(!empty($result)){
            return $result[0]->password;

        }else{return "";}
    }

    public static function getUserId($username){
        $db = new DB();
        $result = $db->query("select * from user where username='$username'")->execute()->fetch_obj();
        if(!empty($result)){
            return (int)$result[0]->id;

        }else{return "";}
    }
}