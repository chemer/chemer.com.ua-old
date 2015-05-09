/*
 * chemer company
 */

function Ajax() 
{
    this.request = null;
    this.init();
}

Ajax.prototype.init = function()
{
    this.createRequest();
};

Ajax.prototype.createRequest = function()
{
    try {
        this.request = new XMLHttpRequest();
    }
    catch (e) {
        try {
            this.request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            this.request = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
};



