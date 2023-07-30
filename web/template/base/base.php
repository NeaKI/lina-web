<?php
require_once(__DIR__ . '/../../assets/php/smarty/Smarty.class.php');


class TPLBASE_BASE extends Smarty {
  
  public $templateFile;
  public $smarty;
  public $templateOutput;

    function __construct(string $argTemplateFile = "") {

      if(!is_file($argTemplateFile) && is_file($argTemplateFile) . "/index.tpl"){
        $argTemplateFile .= "/index.tpl";
      }

      $this->templateFile = trim($argTemplateFile);
      if(is_file($this->templateFile)){
        header("HTTP/1.1 200 OK");
        header("Status: 200 OK");
      }

      $this->newSmarty();

      $this->basicTemplateVars();
      $this->fetchTemplateFile();
      $this->outputTemplateFile();
    }

    function basicTemplateVars() {
      $this->smarty->assign('_templatefile', $this->templateFile);
      $this->smarty->assign('_REQUEST', $_REQUEST);
      $this->smarty->assign('_POST', $_POST);
      $this->smarty->assign('_GET', $_GET);
      $this->smarty->assign('_SESSION', $_SESSION);

      $this->smarty->setCacheLifetime(0);
    }

    function newSmarty() {
      $this->smarty = new Smarty();
      $this->smarty->security        = true;
      $this->smarty->secure_dir      = __DIR__ . "/../../template/view";
      $this->smarty->compile_dir     = __DIR__ . "/../../cache";
      $this->smarty->left_delimiter  = '{{* ';
      $this->smarty->right_delimiter = ' *}}';
      $this->smarty->debugging       = false;
    }

    function fetchTemplateFile() {
      global $DATABASE;
      global $oJCONFIG;

      ob_start();
      #$this->smarty->display($this->templateFile);
      $tpl = $this->smarty->fetch($this->templateFile);
        eval("?> $tpl <?php ");
        $out = ob_get_contents();
      $this->templateOutput = $out;
      ob_end_clean();
    }

    function outputTemplateFile() {
      echo $this->templateOutput;
    }
}

