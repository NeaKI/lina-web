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
                