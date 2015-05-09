<?php
/**
 * @author Chemer
 */

class Loading 
{
    private $imageId    = "loading_image";
    private $messageDlgId = "loading_messageDlg";
    private $messageTextId = "loading_messageText";
    
    function init()
    {
        print('
            <script>
                var loading;
                if (!loading) 
                    loading = {};
                loading.imageId = "'.$this->imageId.'";
                loading.messageDlgId = "'.$this->messageDlgId.'";
                loading.messageTextId = "'.$this->messageTextId.'";    
            </script>
        ');
    }
    function html()
    {
        print('
            <div id="'.$this->messageDlgId.'" title="">
                <div id="'.$this->messageTextId.'"></div>
            </div>
            <div id="'.$this->imageId.'" title="">
                <img src="images/components/loader64.gif" style="margin:30px"/>
            </div>
            <script>
                $("#'.$this->imageId.'").dialog({
                    modal: true,
                    autoOpen: false,
                    raggable: false,
                    resizable: false,
                    closeOnEscape: false,
                    open: function(event, ui) { 
                            $(this).parent().children().children(\'.ui-dialog-titlebar-close\').hide();
                            $(this).parent().children(\'.ui-dialog-titlebar\').hide();
                        }
                });
                $("#'.$this->imageId.'").dialog( "option", "width", 150);
                $("#'.$this->messageDlgId.'").dialog({
                    height: 100,
                    width: 300,
                    modal: true,
                    autoOpen: false
                });
            </script>
        ');
    }
 
//******************************************************************************    
    function getImageId() {
        return $this->imageId;
    }
    function setImageId($aNewValue) {
        $this->imageId = $aNewValue;
    }
    function getMessageDlgId() {
        return $this->messageDlgId;
    }
    function setMessageDlgId($aNewValue) {
        $this->messageDlgId = $aNewValue;
    }
    function getMessageTextId() {
        return $this->messageTextId;
    }
    function setMessageTextId($aNewValue) {
        $this->messageTextId = $aNewValue;
    }
}

?>
