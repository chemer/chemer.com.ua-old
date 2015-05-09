<?php
include("scripts/php/AdminPage.php");
include("scripts/php/DataBase.php");
include("scripts/php/Locker.php");

$theDataBase = new DataBase();
$theDataBase->select();
$theLocker = new Locker();
$theLocker->lock($theDataBase);

$theAnswerInfo = mysql_fetch_object($theDataBase->getPageInfo("portfolio.php"));

class IndexPage extends AdminPage
{
    function additionalBodyHtml()
    {
        printf("<input type='hidden' value='%s' name='pageID' id='pageID'/>"
            , $this->getID());        
    }
}

$thePage = new IndexPage($theAnswerInfo->id);
$thePage->setTitle(stripslashes($theAnswerInfo->title));
$thePage->setName($theAnswerInfo->name);
$thePage->isShowTitle = false;

$thePage->setContentText("
        <div contentEditable id='title' rows='1' cols='80'>".stripslashes($theAnswerInfo->title)."</div>
        <br/>
        <div contentEditable id='updatedText' rows='6' cols='80'>".stripslashes($theAnswerInfo->text)."</div>
        <br/><input type='button' value='Update text' onclick='requestManager.updateText();'/>
");

$thePage->display();

?>