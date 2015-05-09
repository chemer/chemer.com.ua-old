<?php
include("scripts/php/Page.php");
include("scripts/php/DataBase.php");

$theDataBase = new DataBase();
$theDataBase->select();
$theAnswerInfo = mysql_fetch_object($theDataBase->getPageInfo("portfolio.php"));

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

$thePortfolio = '
    <div class="portfolioItem">
        <a href="http://djiling.com.ua" title="djiling.com.ua" target="_blank"><img src="images/djiling.png"/></a>
    </div>
    <div class="portfolioItem">
        <a href="http://denin.com.ua" title="denin.com.ua" target="_blank"><img src="images/denin.png"/></a>
    </div>
    <div class="portfolioItem">
        <a href="http://imegela.com.ua" title="imegela.com.ua" target="_blank"><img src="images/imegela.png"/></a>
    </div>

    <div class="portfolioItem">
        <a href="http://profenglish.com.ua" title="profenglish.com.ua" target="_blank"><img src="images/profenglish.png"/></a>
    </div>
    <div class="portfolioItem">
        <a href="http://dentexpres.com" title="dentexpres.com" target="_blank"><img src="images/dentexpres.png"/></a>
    </div>
    <div class="portfolioItem">
        <a href="http://mramorservice.com.ua" title="mramorservice.com.ua" target="_blank"><img src="images/mramorservice.png"/></a>
    </div>
';

//$thePage->setContentText(stripslashes($theAnswerInfo->text));
$thePage->setContentText($thePortfolio);

$thePage->display();

?>