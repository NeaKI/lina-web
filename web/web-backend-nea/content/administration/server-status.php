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
          <li><a>Firewall</a></li>
          <li><a>SSL Check</a></li>
        </ul>

          <div>
            <div class="without-padding-tab">
                  <!-- Server Übersicht -->
                  <div class="col-md-12">
                    <!--h5>Server</h5-->
                    <p>
                      <div class="container mt-4">

                        <table class="table vertical-middle dashed-right">
                          <thead>
                            <tr>
                              <!--th>#ID</th-->
                              <th>Typ</th>
                              <th>Hardware Status <span class="small">(Echtzeit)</span> <span class="small"><sub>{ &#8960; 1-5 Sekunden }</sub></span></th>
                              <th>Auslastung</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php 
                              $count=0;
                              foreach($_SERVER as $serverIP => $serverVal) {
                            ?>

                                  <tr>
                                    <td class="text-center col-3"> 
                                      <div class="row">
                                        <div class="col-1" data-serverstat-connect="<?=$serverIP?>">
                                          &nbsp;
                                        </div>
                                        <div class="col">
                                          <div class="col-12"><?=$serverVal[0]?></div>
                                          <div class="col-12">IP: <b><?=$serverIP?></b></div>
                                          <img src="/image/ico/<?=$serverVal[1]?>" height="80"> 
                                        </div>
                                      </div>
                                    </td>
                                    <td class="col-6">
                                      
                                      <table class="col-12">
                                        <tbody>
                                          <tr>
                                            <td class="small"><span class="small">CPU Auslastung</span></td>
                                            <td class="small">
                                              <span id="data-serverstat-cpu-percent-left<?=$count?>" data-serverstat-cpu-percent="<?=$serverIP?>"></span> % 
                                              &nbsp;&nbsp;&nbsp;&nbsp;
                                              <span class="small">(<span data-serverstat-cpu-corespeed="<?=$serverIP?>"></span>)</span>
                                              &nbsp;&nbsp;&nbsp;&nbsp;
                                              <span class="small">[ System Zeit: <span data-serverstat-system-dateformat="<?=$serverIP?>"></span> ]</span>
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="small"><span class="small">Prozess-Load</span></td>
                                            <td class="small">
                                              <hr class="p-0 m-0">
                                              <table class="col-12">
                                                <tbody>
                                                  <tbody>
                                                    <tr>
                                                      <td class="text-center small"><b>1 Min</b> (<span data-serverstat-loadpercent-1="<?=$serverIP?>"></span><span> %</span>)</td>
                                                      <td class="text-center small"><b>5 Min</b> (<span data-serverstat-loadpercent-5="<?=$serverIP?>"></span><span> %</span>)</td>
                                                      <td class="text-center small"><b>15 Min</b> (<span data-serverstat-loadpercent-15="<?=$serverIP?>"></span><span> %</span>)</td>
                                                    </tr>
                                                    <tr>
                                                      <td class="text-center small" data-serverstat-load-1="<?=$serverIP?>"></td>
                                                      <td class="text-center small" data-serverstat-load-5="<?=$serverIP?>"></td>
                                                      <td class="text-center small" data-serverstat-load-15="<?=$serverIP?>"></td>
                                                    </tr>
                                                  </tbody>
                                                </tbody>
                                              </table>
                                              <hr class="p-0 m-0">
                                            </td>
                                          </tr>

                                          <tr>
                                            <td class="small"><span class="small">Freie Ressourcen</span></td>
                                            <td class="small">
                                                <table class="col-12">
                                                  <tbody>
                                                    <tr>
                                                      <td class="text-center col-6 small">Freier Arbeitsspeicher</td>
                                                      <td class="text-center col-6 small">Freie Festplatte</td>
                                                    </tr>
                                                    <tr>
                                                      <td class="text-center col-6 small"><span data-serverstat-memory-free="<?=$serverIP?>"></span> GB (<span data-serverstat-memory-percentfree="<?=$serverIP?>"></span> %)</td>
                                                      <td class="text-center col-6 small"><span data-serverstat-hdd-free="<?=$serverIP?>"></span> GB</td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                            </td>
                                          </tr>

                                        </tbody>
                                      </table>

                                    </td>
                                    <td class="col-3" style="vertical-align: top;">
                                        <div><sup data-serverstat-uptime-pretty="<?=$serverIP?>" class="bold"></sup></div>
                                        <div><sup data-serverstat-uptime-since="<?=$serverIP?>"></sup></div>
                                        <hr class="dashed p-0 m-0">
                                        <sub>CPU Auslastung: <span id="data-serverstat-cpu-percent<?=$count?>" class="small"></span> % [max: <span id="data-serverstat-cpu-percent<?=$count?>-max" class="small"></span>] / 5 Min.</sub>
                                        <div id="sparkchart<?=$count?>">
                                        </div>
                                        <script>
                                          $(document).ready(function(){
                                            function serverstatusChart<?=$count?>(){
                                              setTimeout(function(){
                                                  try {
                                                    $('#sparkchart<?=$count?>').sparkline(neaWebsiteServerStatus.serverstatusByIP["<?=$serverIP?>"]["cpu.percent"].slice(-300), { 
                                                      type: 'line',
                                                      normalRangeMin: 0,
                                                      /*normalRangeMax: 100,*/
                                                      width: "100%",
                                                      height: 70,
                                                      enableTagOptions: false,
                                                      disableInteraction: true
                                                    });
                                                    $("#data-serverstat-cpu-percent<?=$count?>").text(parseFloat($("#data-serverstat-cpu-percent-left<?=$count?>").attr("data-serverstat-cpu-percent-value")).toFixed(3));
                                                    try{
                                                      $("#data-serverstat-cpu-percent<?=$count?>-max").text(parseFloat(Math.max.apply(null, neaWebsiteServerStatus.serverstatusByIP["<?=$serverIP?>"]["cpu.percent"].slice(-300))).toFixed(3) + " %");
                                                    }catch(ex){}
                                                  }catch(ex){}

                                                if($(".data-serverstat").length > 0){
                                                  serverstatusChart<?=$count?>();
                                                }
                                              }, 1000);
                                            };
                                            serverstatusChart<?=$count?>();
                                          });
                                        </script>
                                    </td>
                                  </tr>

                                <?php 
                                  $count++; } 
                                ?>

                          </tbody>

                        </table>

                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

            <!-- Dienst Übersicht -->
            <div class="without-padding-tab">
                  <div class="col-md-12">
                    <p>
                      <div class="container mt-4">


                        <table class="table vertical-middle dashed-right">
                          <thead>
                            <tr>
                              <!--th>#ID</th-->
                              <th>Typ</th>
                              <th>Service Status <span class="small">(Echtzeit)</span> <span class="small"><sub>{ &#8960; 1-5 Sekunden }</sub></span></th>
                              <th>Auslastung</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php 
                              $count=0;
                              foreach($_SERVER as $serverIP => $serverVal) {
                            ?>

                                  <tr>
                                    <td class="text-center col-3"> 
                                      <div class="row">
                                        <div class="col-1" data-serverstat-connect="<?=$serverIP?>">
                                          &nbsp;
                                        </div>
                                        <div class="col">
                                          <div class="col-12"><?=$serverVal[0]?></div>
                                          <div class="col-12">IP: <b><?=$serverIP?></b></div>
                                          <img src="/image/ico/<?=$serverVal[1]?>" height="80"> 
                                        </div>
                                      </div>
                                    </td>
                                    <td class="col-6">
                                      
                                      <table class="col-12">

                                        <thead>
                                          <tr>
                                            <th class="text-center small">Port</th>
                                            <th class="text-center small">Prozesse</th>
                                            <th class="text-center small">Antwort (Sek.)</th>
                                            <th class="text-center small">Service/ Dienst</th>
                                          </tr>
                                        </thead>

                                        <tbody>

                                          <?php 
                                            foreach($_PORTSERVICE as $portKey => $portVal) {
                                              if($serverVal[2] == "firewall" && ($portKey == 80 || $portKey == 443 || $portKey == 3306)){ continue; }
                                              if($serverVal[2] == "webserver" && ($portKey == 53 || $portKey == 3306 || $portKey == "webroute")){ continue; }
                                              if($serverVal[2] == "database" && ($portKey == 53 || $portKey == "webroute")){ continue; }
                                          ?>

                                              <tr>
                                                <td class="small col-2 text-center"><span class="small"><?=$portKey?></span></td>
                                                <td class="small col-2 text-center" data-service-count-<?=$portKey?>="<?=$serverIP?>">&nbsp;</td>
                                                <td class="small col-3 text-center"><span class="small"><span data-service-time-<?=$portKey?>="<?=$serverIP?>">-</span> s</span></td>
                                                <td class="small col-5"><span class="small"><?=$portVal?></span></td>
                                              </tr>

                                          <?php } ?>


                                        </tbody>
                                      </table>

                                    </td>
                                    <td class="col-3" style="vertical-align: top;">
                                        <div><sup data-serverstat-uptime-pretty="<?=$serverIP?>" class="bold"></sup></div>
                                        <div><sup data-serverstat-uptime-since="<?=$serverIP?>"></sup></div>
                                        <hr class="dashed p-0 m-0">
                                        <sub>&#8960; Timing: <span id="data-serverstat-service-percent<?=$count?>" class="small"></span> Sek. [max: <span id="data-serverstat-service-percent<?=$count?>-max" class="small"></span> Sek.] / 5 Min.</sub>
                                        <div id="sparkservicechart<?=$count?>">
                                        </div>
                                        <script>
                                          $(document).ready(function(){
                                            function serverserviceChart<?=$count?>(){
                                              setTimeout(function(){
                                                  try {
                                                    $('#sparkservicechart<?=$count?>').sparkline(neaWebsiteServerStatus.serverserviceByIP["<?=$serverIP?>"].slice(-300), { 
                                                      type: 'line',
                                                      normalRangeMin: 0,
                                                      /*normalRangeMax: 100,*/
                                                      width: "100%",
                                                      height: 70,
                                                      enableTagOptions: false,
                                                      disableInteraction: true
                                                    });
                                                    $("#data-serverstat-service-percent<?=$count?>").text(parseFloat(neaWebsiteServerStatus.serverserviceByIP["<?=$serverIP?>"].slice(-1)).toFixed(4));
                                                    try{
                                                      $("#data-serverstat-service-percent<?=$count?>-max").text(parseFloat(Math.max.apply(null, neaWebsiteServerStatus.serverserviceByIP["<?=$serverIP?>"].slice(-300))).toFixed(4));
                                                    }catch(ex){}
                                                  }catch(ex){}

                                                if($(".data-serverstat").length > 0){
                                                  serverserviceChart<?=$count?>();
                                                }
                                              }, 1000);
                                            };
                                            serverserviceChart<?=$count?>();
                                          });
                                        </script>
                                    </td>
                                  </tr>

                                <?php 
                                  $count++; } 
                                ?>

                          </tbody>

                        </table>

                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

            <!-- Firewall -->
            <div>
                  <div class="col-md-12">
                    <p>
                      <div class="container mt-4">
                        /**/
                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

            <!-- SSL check -->
            <div>
                  <div class="col-md-12">
                    <p>
                      <div class="container mt-4">
                        /**/
                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

        </div>

      </div>


  </div>




<?php
/* eof page */
require_once(__DIR__ . "/../../_inc.footer.php");
require_once(__DIR__ . "/../../../assets/php/phpquery.php");