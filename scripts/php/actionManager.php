<?php
/*
 * che m er.com.ua
 */
include("DataBase.php");
include("Converter.php");

$theDataBase = new DataBase();
$theDataBase->select();

$theAction = null;
if(isset($_POST["action"])) 
    $theAction = $_POST["action"];

switch ($theAction) {
    case 'UPDATE_TEXT' : 
        $theDialogTitle = "Update text";
        if(isset($_POST["text"]) && isset($_POST["title"]) && isset($_POST["pageID"])) {
            $theTable = isset($_POST["table"]) ? $_POST["table"] : "chemer_pageInfo";
            $theArticleTitle = addslashes(Converter::stringToHtml($_POST["title"]));
            $theArticleText = addslashes(Converter::stringToHtml($_POST["text"]));
            if (isset($_POST["description"])) {
                $theDescription = ", description='".addslashes(Converter::stringToHtml($_POST["description"]))."' ";
            } else {
                $theDescription = "";
            }
            $theResult = $theDataBase->query("UPDATE ".$theTable." SET text='"
                    .$theArticleText."', title='".$theArticleTitle
                    ."'".$theDescription." WHERE id='".$_POST["pageID"]."'");
            if ($theResult) {
                $theDialogText = "Text was updated successful.";
            } else {
                $theDialogText = mysql_error();
            }    
        } else {
            $theDialogText = "Not all data were entred.<br> Please go back and complete the data.";
        }
        dialogXml($theDialogTitle, $theDialogText);
        break;
};

function dialogXml($aDialogTitle, $aDialogText)
{
    header('Content-Type: text/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="utf-8"?><root>';
    echo '<title>'.$aDialogTitle.'</title>';
    echo '<text>'.$aDialogText.'</text>';
    echo '</root>';
}
?>