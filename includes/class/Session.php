<?php
/**
 * Help to manage the $_SESSION global php var
 *
 * @author Arthur Verdon
 */
class Session {
    /**
     * Check if a session is already start. This function is used for not have
     * to session start on a page
     * @return boolean
     */
    private static function check_is_session_start(){
        $is_session_start = false;

        if(session_status() == PHP_SESSION_ACTIVE){
            $is_session_start = true;
        }
        return $is_session_start;
    }
    /**
     * execute session_start if necessary
     */
    public static function start_session(){
        if(!self::check_is_session_start()){
            session_start();
        }
    }
    /**
     * set a session var
     * ex:
     * <code>
     * //set $_SESSION['username'] = 'admin';
     * session::set('username','admin');
     * </code>
     * @param string $name
     * @param string/array/int/bool $value
     */
    public static function set($name,$value){
        self::start_session();
        $_SESSION[$name] = $value;
    }
    /**
     * return the value of a session var. If this var is not set the function will
     * return false
     * ex:
     * <code>
     * //return $_SESSION['admin'];
     * session::get('admin');
     * </code>
     * @param string $name
     * @return bool/string/array/int
     */
    public static function get($name){
        self::start_session();
        $value = false;
        if(isset($_SESSION[$name])){
            $value = $_SESSION[$name];
        }

        return $value;
    }
    /**
     * destroy and clear the $_SESSION superglobal
     */
    public static function destroy (){
        self::start_session();
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}