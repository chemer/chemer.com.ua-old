/* 
chemer@ua.fm
 */

var requestManager;
if(!requestManager)
    requestManager = {};

requestManager.requestResult = function() 
{
    switch(this.readyState) {
        case 1:
            if (loading.imageId) {
                $("#"+loading.imageId).dialog("open");
                return;
            } else {
                throw new Error("Loading image was not initialized.");
            }   
//        case 3:
//            requestManager.openMessageDlg("", "Server isn't finished with response.<br/> Wait or reload page.");
//            break;
        case 4:
            if (this.status == 200) {
                if (this.responseXML == null) {
                    requestManager.openMessageDlg("Error", "Request error.<br/> Reload page.");
                    requestManager.loadingImageClose();
                    if (this.response) {
                        throw new Error(this.response);
                    }
                    throw new Error("Response is null");
                } else {
                    this.callback();
                }
            break;
        } 
        default:return;
    }
    requestManager.loadingImageClose();
};

requestManager.loadingImageClose = function() 
{
    if (loading.imageId) {
        $("#"+loading.imageId).dialog("close");
    } else {
        throw new Error("Loading image was not initialized.");
    }
}

requestManager.initMessageDialog = function() 
{
    var theResponse = this.responseXML;
    var theTitle = theResponse.getElementsByTagName("title")[0].firstChild.nodeValue;
    var theText = theResponse.getElementsByTagName("text")[0].firstChild.nodeValue;
    requestManager.openMessageDlg(theTitle, theText);
}

requestManager.openMessageDlg = function(aTitle, aText)
{
    document.getElementById(loading.messageTextId).innerHTML = aText;
    $("#"+loading.messageDlgId).dialog("option", "title", aTitle);
    $("#"+loading.messageDlgId).dialog("open");
}

requestManager.updateText = function(aTable)
{
    var theTable = aTable || "chemer_pageInfo";
    var theAjax = new Ajax();
 	if(theAjax.request == null) {
		return;
	}
	var url = "scripts/php/actionManager.php";
    theAjax.request.callback = requestManager.initMessageDialog;
	theAjax.request.onreadystatechange = requestManager.requestResult;
	theAjax.request.open("POST", url, true);
    theAjax.request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var theTitle = encodeURIComponent(document.getElementById("title").innerHTML);
    var theText = encodeURIComponent(document.getElementById("updatedText").innerHTML);
    var thePageId = document.getElementById("pageID").value;
    var theParams = "pageID="+thePageId+"&action=UPDATE_TEXT&title="+theTitle+"&text="+theText+
        "&table="+theTable;
	theAjax.request.send(theParams);   
}