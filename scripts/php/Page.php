<?php
header('Content-Type: text/html;charset=UTF-8');
include("scripts/php/components/Loading.php");

class Page
{
    private     $ID = null;
	private     $headerTitle = '';
	private     $title = '';
    protected   $name = '';
    private     $keywords = '';
    private     $contentText = '';
    var         $isShowTitle = true;
    protected   $loading = null;

    protected $subMenu = null;
    protected $menu = array(
            'О Компании'   => 'index.php',
            'Портфолио'    => 'portfolio.php',
            'Контакты'     => 'contacts.php'        
        );
//******************************************************************************

    function __construct()
    {
        $theArgs = func_get_args();
        $theNumArgs = func_num_args();
        if (method_exists($this, $theFunc='__construct'.$theNumArgs)) {
            call_user_func_array(array($this, $theFunc),$theArgs);
        }
        
        $this->loading = new Loading();
    }
   
    function __construct1($anId)
    {
        $this->ID = $anId;
    } 
    
//************************************************************************************************************
    
    function display()
    {
        echo '<!doctype html><HTML>';
        $this->displayHead();
        $this->displayBody();
        echo '</HTML>';
    }
    
    function displayHead()
    {
        echo '<HEAD>';
        $this->metaTags();
        $this->includes();
        $this->additionalIncludes();
        $this->displayTitle();
        echo '</HEAD>';
    }

    function displayBody()
    {
        echo '<body leftmargin="0" cellpadding="0" cellspacing="0" border="0">';
        $this->displayHat();
        $this->displayMenu();
        $this->displaySubMenu();
        $this->displayContent();
        $this->displayFooter();
        echo '</BODY>';
    }
	
//************************************************************************************************************

   function metaTags()
   {
      echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>';
      printf("<meta name='Keywords' content='%s'/>", $this->keywords);
   }
   function includes()
   {
      echo '<LINK  REL="stylesheet"  type="text/css"  href="css/chemer.all.css">';
      echo '<link rel="stylesheet" href="css/jquery/base/jquery.ui.all.css">';
      echo '<script type="text/javascript" src="scripts/js/default.js"></script>';
      echo '<script type="text/javascript" src="scripts/js/library/general.js"></script>';
      echo '<script type="text/javascript" src="scripts/js/library/BrowserDetect.js"></script>';
      echo '<script type="text/javascript" src="scripts/js/library/ajax.js"></script>';
      print('
            <script src="scripts/js/jquery/jquery-1.7.1.js"></script>
            <script src="scripts/js/jquery/external/jquery.bgiframe-2.1.2.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.core.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.widget.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.mouse.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.draggable.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.position.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.resizable.js"></script>
            <script src="scripts/js/jquery/ui/jquery.ui.dialog.js"></script>
            <script src="scripts/js/requestManager.js"></script>
      ');
      $this->loading->init();
   }
   function additionalIncludes(){}

   function displayTitle()
   {
		printf("<TITLE>Chemer - %s</TITLE>", $this->headerTitle);
//       print("<TITLE>Chemer</TITLE>");
   }
   
//************************************************************************************************************
    function displayHat()
    {
        print('
            <div id="container">
                <div id="hatID">');
        $this->displayHatContent();
        print('
                </div>
        ');
    }
    function displayHatContent() {}
    
    function displayMenu()
    {
        print('
            <div id="menuID">            
        '); 
        $this->displayMenuLoop();        
        print('</div>');
    }
    
    function displayMenuLoop()
    {
        while(list($name, $url) = each($this->menu)) {
            if (strcmp($url, $this->name)!=0) {
                 printf("
                     <div class='menuItem'>
                        <a href='%s'>%s</a>
                     </div>", $url, $name);
             } else {
                 printf("<div class='selectedMenuItem'>%s</div>", $name);
             }
        }
    }
    
    function displaySubMenu()
    {
        echo "<div id='subMenuID'>";
        if (!$this->subMenu) {
            echo '</div>';
            return;
        }
        $this->displaySubMenuLoop();
        echo '</div>';   
    }

    function displaySubMenuLoop()
    {
        while(list($name, $url) = each($this->subMenu)) {
            if (strcmp($url, $this->name)!=0) {
                 printf("
                     <div class='menuItem'>
                        <a href='%s'>%s</a>
                     </div>", $url, $name);
             } else {
                 printf("<span class='selectedMenuItem'>%s</span>", $name);
             }
        }
    }
    
    function displayContent()
    {
        print('
        	<div id="contentID">
                <div class="content">
        '); 
        if($this->isShowTitle)
            printf("<h1>%s</h1>", $this->getTitle());
        printf("
                %s"
                , $this->getContentText()
        );
        $this->additionalContent();
        print('
            </div></div>
        ');
    }
    function additionalContent(){}

    function displayFooter()
    {
        print('
            </div>
            <div id="footerID">
                &copy; copyright 2012
             </div>  
        ');
        $this->additionalBodyHtml();
        $this->loading->html();
     }
     
     function additionalBodyHtml(){}

//************************************************************************************************************

    function setID($aNewValue) {
        $this->ID = $aNewValue;
    }
    function getID() {
        return $this->ID;
    }
    function setTitle($aNewValue) {
        $this->title = $aNewValue;
    }
    function getTitle() {
        return $this->title;
    }
    function setName($aNewValue) {
        $this->name = $aNewValue;
    }
    function getName() {
        return $this->name;
    } 
    function setMenu($aNewValue) {
        $this->menu = $aNewValue;
    }
    function getMenu() {
        return $this->menu;
    }
    function setSubMenu($aNewValue) {
        $this->subMenu = $aNewValue;
    }
    function getSubMenu() {
        return $this->submenu;
    }
    function setKeywords($aNewValue) {
        $this->keywords = $aNewValue;
    }
    function getKeywords() {
        return $this->keywords;
    }
    function getContentText() {
        return $this->contentText;
    }
    function setContentText($aNewValue) {
        $this->contentText = $aNewValue;
    }
    function getLoading() {
        return $this->loading;
    }
    function setLoading($aNewValue) {
        $this->loading = $aNewValue;
    }
	function setHeaderTitle($aNewValue) {
        $this->headerTitle = $aNewValue;
    }
    function getHeaderTitle() {
        return $this->headerTitle;
    }
}
?>