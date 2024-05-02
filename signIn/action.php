<?php

require_once 'utils.php';
require_once 'database.php';

class AuthSystem{
    private $db;

    //construct
    public function __construct(){
        session_start();
        $this->db=new Database();
    }
        //handle register user
    public function registerUser($name,$email,$password,$confirm_password){
            $name=Utils::sanitize($name);
            $email=Utils::sanitize($email);
            $password=Utils::sanitize($password);
            $confirm_password=Utils::sanitize($confirm_password);
                $user=$this->db->getUserByEmail($email);
                if($user){
                    Utils::setFlash('register_error','Email do  Exists !');
                    Utils::redirect('register.php');
                }
                
                else{
                    $hashed_password= password_hash($password,PASSWORD_DEFAULT);
                    $this->db->register($name,$email,$hashed_password);
                    Utils::setFlash('register_success','You are now registered and can now login  !');
                    Utils::redirect('/');
                }               
    }
    public function registerUserByAdmin($name,$email,$password,$role){
        $name=Utils::sanitize($name);
        $email=Utils::sanitize($email);
        $password=Utils::sanitize($password);
        $role=$role;
            $user=$this->db->getUserByEmail($email);
            if($user){
                Utils::setFlash('register_error','Email do  Exists !');
                Utils::redirect('register.php');
            }
            
            else{
                $hashed_password= password_hash($password,PASSWORD_DEFAULT);
                $this->db->registerAdmin($name,$email,$hashed_password,$role);
                Utils::setFlash('register_success','You are now registered and can now login  !');
                Utils::redirect('/');
            }               
    }
        //handle login user
    public function loginUser($email,$password){
        $email=Utils::sanitize($email);
        $password=Utils::sanitize($password);
        $user= $this->db->login($email,$password);
        if($user){
            unset($user['password']);
            $_SESSION['user']= $user;
            if($user['role'] == 'admin'){
                Utils::redirect('admin_profile.php');
            }else
            Utils::redirect('profile.php');
        }else{
            Utils::setFlash('login_error','Invalid Credentials !');
            Utils::redirect('./');
        }
    }

}
$authSystem=new AuthSystem();
if(isset($_POST['registeradmin']))
    $authSystem->registerUser($_POST['name'],$_POST['email'],$_POST['password'],$_POST['role']);
if(isset($_POST['register'])){
    $authSystem->registerUser($_POST['name'],$_POST['email'],$_POST['password'],$_POST['confirm_password']);
}else if(isset($_POST['login'])){
    $authSystem->loginUser($_POST['email'],$_POST['password']);
}



?>