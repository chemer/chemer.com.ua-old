<?php
/*
 * chemer. com. ua
 */
class Locker 
{
    function lock($aDataBase)
    { 
        session_start();
        if (isset($_GET["action"]) && strcmp($_GET["action"], "logout")==0) {
            $this->showLoginBlock();
            session_unset();
            session_destroy();
            exit;
        } else {            
            if (!isset($_SESSION['userId'])) {
                $_SESSION['userId'] = "undefined";
                $this->authenticate();
            } else {
                if (get_magic_quotes_gpc()) {
                    $_SERVER['PHP_AUTH_USER'] = stripslashes($_SERVER['PHP_AUTH_USER']);
                    $_SERVER['PHP_AUTH_PW'] = stripslashes($_SERVER['PHP_AUTH_PW']);
                } 
                $theAnswer = $aDataBase->query("SELECT id FROM `chemer_users` WHERE login='"
                        .$_SERVER['PHP_AUTH_USER']
                        ."' and password='".$_SERVER['PHP_AUTH_PW']."'");
                if (!$theAnswer || (mysql_num_rows($theAnswer)==0))
                    $this->authenticate();
                $thePageInfo = mysql_fetch_object($theAnswer);
                $_SESSION['userId'] = $thePageInfo->id;
            }
        }
    }
    
    function authenticate() 
    {
        header('WWW-Authenticate: Basic realm="Secret area"');
        header('HTTP/1.0 401 Unauthorized');
        $this->showLoginBlock();
        exit;
    }
    
    function showLoginBlock() 
    {
//        You must enter a valid login ID and password to access this resource<br/>
        print('You are not logged <a href="index.php">Go home page</a>');
    }
}
?>