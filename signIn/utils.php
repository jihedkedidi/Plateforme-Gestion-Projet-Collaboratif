<?php

require_once 'config.php';

class Utils{
    //For security to prevent sql injections 
    public static function sanitize($input){
        $input= trim($input);
        $input= htmlspecialchars($input);
        //PHP function used to remove backslashes (\) from a string
        $input= stripslashes($input);
        return $input;
    }
    //redirection method 
    public static function redirect($page){
        header('location: ' . BASE_URL . '/' . $page);
    }
    // method to set a flash message
    public static function setFlash($name,$message){
        if(!empty($_SESSION[$name])){
            unset($_SESSION[$name]);
        }
        $_SESSION[$name]=$message;
    }

    //method to display a flash message 
    public static function displayFlash($name,$type){
        if (isset($_SESSION[$name])) {
            echo '<div class="alert alert-'.$type.'">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
        }
    }
    //function To Check if USER isLogged
        public static function isLogged(){
            if(isset($_SESSION['user'])){
                return true;   
            } else {
                return false;
            }
        }  
} 

?>