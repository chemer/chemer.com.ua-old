<?php
include("scripts/php/Page.php");
include("scripts/php/DataBase.php");

$theDataBase = new DataBase();
$theDataBase->select();
$theAnswerInfo = mysql_fetch_object($theDataBase->getPageInfo("index.php"));

class ChemerPage extends Page
{
    function additionalBodyHtml()
    {
        printf("<input type='hidden' value='%s' name='pageID' id='pageID'/>"
            , $this->getID());        
    }
}

$thePage = new ChemerPage($theAnswerInfo->id);
$thePage->setTitle(stripslashes($theAnswerInfo->title));
$thePage->setName($theAnswerInfo->name);
$thePage->setHeaderTitle($theAnswerInfo->headerTitle);
$thePage->setKeywords($theAnswerInfo->keywords);
$thePage->setContentText(stripslashes($theAnswerInfo->text));

$thePage->display();

?>