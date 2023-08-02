<?php 
require_once(__DIR__ . "/../../_inc.header.php");
global $DATABASE;
$WEBADMINS = $DATABASE->select_webadmin_getAll();
/* bof page */

$_SERVER = [];
$_SERVER["45.67.221.30"] = ["Firewall/ Gateway [1]", "ico-server-firewall.png", "firewall"];
$_SERVER["45.88.223.172"] = ["Firewall/ Gateway [2]", "ico-server-firewall.png", "firewall"];
$_SERVER["185.239.208.38"] = ["Webserver [1]", "ico-server-webserver.png", "webserver"];
$_SERVER["185.239.208.39"] = ["Webserver [2]", "ico-server-webserver.png", "webserver"];
$_SERVER["185.194.216.15"] = ["Datenbank & Administration", "ico-server-database.png", "database"];

$_PORTSERVICE[22] = "SSH RemoteConsole";
$_PORTSERVICE[53] = "DNS NameServer";
$_PORTSERVICE[80] = "HTTP Webserver";
$_PORTSERVICE[90] = "SystemServer Daemon";
$_PORTSERVICE[443] = "HTTPS (SSL) Webserver";
$_PORTSERVICE[3306] = "SQL Datenbank";
/*$_PORTSERVICE[8080] = "ISPconfig";*/
$_PORTSERVICE["webroute"] = "Webserver Routing";

/* postdata */
if(sizeof($_POST) >0 && ($_POST && $_POST["postdata"] == "postdata")){
}
/* eof postdata */
?>



<nav class="subpage-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Administration</li>
    <li class="breadcrumb-item active" aria-current="page">Server & Dienste</li>
  </ol>
</nav>




  <div class="container mt-4 data-serverstat">

      <div class="tabbed-nav">
      
        <ul>
          <li><a>Server Übersicht</a></li>
          <li><a>Dienst Übersicht</a></li>
          <li><a>Webserver Routing</a></li>
          <li><a>Firewall</a></li>
          <li><a>SSL Check</a></li>
        </ul>

        <div>
            <div class="without-padding-tab">
                  <!-- Server Übersicht -->
                  <?php require_once(__DIR__ . "/server-status-inc-server.php"); ?>
            </div>

            <div class="without-padding-tab">
                  <!-- Dienst Übersicht -->
                  <?php require_once(__DIR__ . "/server-status-inc-dienste.php"); ?>
            </div>

            <div class="without-padding-tab">
                  <!-- Webserver Routing -->
                  <?php require_once(__DIR__ . "/server-status-inc-routing.php"); ?>
            </div>

            <div>
                  <!-- Firewall -->
                  <?php require_once(__DIR__ . "/server-status-inc-firewall.php"); ?>
            </div>

            <div>
                  <!-- SSL check -->
                  <?php require_once(__DIR__ . "/server-status-inc-sslcheck.php"); ?>
            </div>

        </div>

      </div>


  </div>




<?php
/* eof page */
require_once(__DIR__ . "/../../_inc.footer.php");
require_once(__DIR__ . "/../../../assets/php/phpquery.php");