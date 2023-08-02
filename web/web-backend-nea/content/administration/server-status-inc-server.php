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