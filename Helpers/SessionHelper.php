<?php
    namespace Helpers;
    use Models\Administrator as Administrator;

    class SessionHelper {

        public function sessionRestart() {
            session_destroy();
            session_start();
        }

        public function isAdmin() {
            $isAdmin = false;
            if($_SESSION["currentUser"] instanceof Administrator) {
                $isAdmin = true;
            }
            return $isAdmin;
        }

        public function setCurrentUser($loginUser) {
            $_SESSION['currentUser'] = $loginUser;
        }

        public function getCurrentUser(){
            return $_SESSION['currentUser'];
        }
    }
?>