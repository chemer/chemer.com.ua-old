<?php
/**
 * @author Chemer
 */
include("scripts/php/Page.php");

class AdminPage extends Page
{
    function displayHatContent() 
    {
        print('<a href="admin/index.php?action=logout" class="logout">logout</a>');
    }
    
    function displayMenuLoop()
    {
        while(list($name, $url) = each($this->menu)) {
            if (strcmp($url, $this->name)!=0) {
                $url = str_replace(".php", "2.php", $url);
                printf("
                     <div class='menuItem'>
                        <a href='%s'>%s</a>
                     </div>", $url, $name);
             } else {
                 printf("<div class='selectedMenuItem'>%s</div>", $name);
             }
        }
    }
    
    function displaySubMenuLoop()
    {
        while(list($name, $url) = each($this->subMenu)) {
            if (strcmp($url, $this->name)!=0) {
                $url = str_replace(".php", "2.php", $url);
                 printf("
                     <div class='menuItem'>
                        <a href='%s'>%s</a>
                     </div>", $url, $name);
             } else {
                 printf("<span class='selectedMenuItem'>%s</span>", $name);
             }
        }
    }
}

?>
