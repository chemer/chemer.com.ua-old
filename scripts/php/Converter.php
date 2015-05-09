<?php
/**
 * @author Chemer
 */

class Converter 
{
    static public function stringToHtml($aString)
    {
        return str_replace("\n", "<br/>", $aString);
    }
};

?>
