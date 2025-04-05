<?php
abstract class User
{
    //use Loggable;
    function __construct(
        private string $username,
        private string $email,
        private string $password
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    //getters
    function get_username()
    {
        return $this->username;
    }
    function get_email()
    {
        return $this->email;
    }
    function get_password()
    {
        return $this->password;
    }
    //setters
    function set_username(string $username)
    {
        $this->username = $username;
    }
    function set_email(string $email)
    {
        $this->email = $email;
    }
    function set_password(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    abstract public function get_user_role();
}

class AdminUser extends User
{
    use Loggable;
    function get_user_role()
    {
        return "admin";
    }
}

class RegularUser extends User
{
    use Loggable;
    function get_user_role()
    {
        return "regular";
    }
}

trait Loggable
{
    function logLoginAttempt()
    {
        $file = fopen("logs.txt", "a+");
        $timestamp = date("Y-m-d H:i:s");
        $log = "User " . $this->get_username() . " with role '" . $this->get_user_role() . "' attempted to log in at " . $timestamp . "\n";
        fwrite($file, $log);
        fclose($file);
    }
    function logLogout()
    {
        $file = fopen("logs.txt", "a+");
        $timestamp = date("Y-m-d H:i:s");
        $log = "User " . $this->get_username() . " with role '" . $this->get_user_role() . "' logged out at " . $timestamp . "\n";
        fwrite($file, $log);
        fclose($file);
    }
}

$reg1 = new RegularUser("Alice", "Alice@mail.com", "12345");
$adm1 = new AdminUser("AliceAdmin", "Alice@mail.com", "12345");

$reg1->logLoginAttempt();
$adm1->logLoginAttempt();

$reg1->logLogout();
$adm1->logLogout();

// $reg2 = $reg1; //передача ссылки
// $reg2->set_username("newUsername");
// echo $reg1->get_username();

$reg2 = clone $reg1; //передача копии
$reg2->set_username("newUsername");
echo $reg1->get_username();







































?>