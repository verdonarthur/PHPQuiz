<?php
/**
 *
 * @author Verdon Arthur
 */

class CLogin extends Controller {
    public function login() {
        $this->getTPL()->display('login.tpl');
    }

    public function checkLogin($user, $pswd) {
        $loginOk = true;

        if (empty($user) || empty($pswd))
            $loginOk = false;

        if (!($user == "arthur" && $pswd == "arthur"))
            $loginOk = false;

        if (!$loginOk)
            $this->getTPL()->display('login.tpl');
        else {
            Session::set("username",$user);

            $this->getTPL()->assign("user", $user);
            $this->getTPL()->display('loginOk.tpl');
        }


    }

    public function logout() {
        Session::destroy();
        $this->getTPL()->display('logout.tpl');
    }


}