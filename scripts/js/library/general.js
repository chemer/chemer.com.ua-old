/*
 * chemer company
 */

function isThereId(anId)
{
    var theElement = documumet.getElementById(anId);
    if(theElement) {
        alert("Here is the element with id "+anId+".");
        return true;
    }
    return false;
}

function switchTagVisibility(anId)
{
    document.getElementById(anId).style.display=='none' 
        ? document.getElementById(anId).style.display='block'
        : document.getElementById(anId).style.display='none';
}