<?php
/*
 * chemer.com.ua
 */
class DataBase 
{
    var $connection = null;
    
    public function connect() 
    {
        $this->connection = mysql_connect("localhost", "chemer_chemer", "");
        if(!$this->connection) {
            echo mysql_error();
            exit;
        }
    }
    
    public function select() 
    {
        $theArgs = func_get_args();
        $theNumArgs = func_num_args();
        if(count($theArgs)<2)
            $this->connect();
        if(count($theArgs)<1)    
            $theDb = "chemer_chemer";
        mysql_select_db($theDb, $this->connection);
        mysql_query("SET NAMES utf8");
    }
    
    public function query($aQuery) 
    {
        $theResult = mysql_query($aQuery);
        if(!$theResult) {
            echo mysql_error();
            exit;
        }
        return $theResult;
    }
    
    public function getPageInfo($aFile) 
    {
        $theQuery = "SELECT * FROM `chemer_pageInfo` WHERE name='".$aFile."'";
        $theAnswer = $this->query($theQuery);
        if(mysql_num_rows($theAnswer)>=2) {
            echo "uuuupppss... More than two combination of name = ".$aFile;
            exit;
        }
        if(mysql_num_rows($theAnswer)==0) {
            echo "DB logs: There is not name = ".$aFile;
            exit;
        }
        return $theAnswer;
    }
}

?>