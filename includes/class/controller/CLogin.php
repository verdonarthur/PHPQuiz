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

        if (!(User::isUserExist($user) && password_verify($pswd, User::getUserPasswordHash($user))))
            $loginOk = false;

        if (!$loginOk)
            $this->getTPL()->display('login.tpl');
        else {
            Session::set("username", $user);

            $this->getTPL()->assign("user", $user);
            $this->getTPL()->display('loginOk.tpl');
        }


    }

    public function logout() {
        Session::destroy();
        $this->getTPL()->display('logout.tpl');
    }

    public function signup() {
        $this->getTPL()->display('registration.tpl');
    }

    public function checkAndSaveRegistration($user, $pswd) {
        $db = new DB();
        try {
            $db->pdo->beginTransaction();
            $q = $db->pdo->prepare("INSERT INTO user (username, password) VALUES (:username,:password)");
            $q->bindParam(":username", $user, PDO::PARAM_STR, 50);
            $q->bindParam(":password", password_hash($pswd, PASSWORD_DEFAULT), PDO::PARAM_STR, 255);
            $q->execute();


            $db->pdo->commit();
            $this->checkLogin($user, $pswd);
        } catch (Exception $e) {
            $db->pdo->rollBack();
            $this->getTPL()->assign("error", $e->getMessage());
            $this->getTPL()->display("error.tpl");
        }
    }

}