                  <div class="col-md-12">
                    <p>
                      <div class="container mt-4" data-arrow-rootelement="arrows-routing">


                        <table class="table vertical-middle dashed-right">
                          <thead>
                            <tr>
                              <!--th>#ID</th-->
                              <th class="text-center">Besucher / Nameserver</th>
                              <th class="text-center">Firewall / Gateway</th>
                              <th class="text-center">Routing <span class="small">(Echtzeit)</span> <span class="small"><sub>{ &#8960; 1-5 Sekunden }</sub></span></th>
                              <th class="text-center"> </th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php 
                              foreach ($_SERVER as $serverKey => $serverVal) {
                                if($serverVal[2] != "firewall"){
                                  continue;
                                }

                                $currentSrvIP = $serverKey;
                            ?>

                              <tr data-arrow-rootelement="<?=$currentSrvIP?>">

                                <td class="col-4">
                                  
                                  <div class="row text-center">
                                    <div class="col-6">
                                      <div class="col-12">Besucher</div>
                                      <img src="/image/ico/ico-server-user.png" height="80" data-arrow-from="1" data-arrow-to="1"> 
                                      <div class="col-12">&nbsp;</div>
                                    </div>
                                    <div class="col-6">
                                      <div class="col-12">Nameserver</div>
                                      <img src="/image/ico/ico-server-dns.png" height="80" data-arrow-from="2" data-arrow-to="2"> 
                                      <div class="col-12">&nbsp;</div>
                                    </div>
                                  </div>

                                </td>

                                <td class="text-center col-4"> 

                                  <div class="row text-center">
                                    <div class="col-1" data-serverstat-connect="<?=$currentSrvIP?>">
                                      &nbsp;
                                    </div>
                                    <div class="col">
                                      <div class="col-12"><?=$_SERVER[$currentSrvIP][0]?></div>
                                      <div class="col-12">IP: <b><?=$currentSrvIP?></b></div>
                                      <img src="/image/ico/<?=$_SERVER[$currentSrvIP][1]?>" height="80" data-arrow-from="3" data-arrow-to="3" data-arrow-ip="<?=$currentSrvIP?>"> 
                                      <div class="col-12 small d-none">Route: <span  data-service-count-webroute="<?=$currentSrvIP?>" data-arrow-ip="<?=$currentSrvIP?>"></span></div>
                                      <div class="col-12 small">Antwortzeit: <span data-service-time-22="<?=$currentSrvIP?>"></span> s</div>

                                      <div class="col-12 small">
                                        <table class="col-12">
                                          <tbody> </tbody>
                                          <tbody>
                                            <tr>
                                              <td class="text-center small"><b>1 Min</b> (<span data-serverstat-loadpercent-1="<?=$currentSrvIP?>"></span><span> %</span>)</td>
                                              <td class="text-center small"><b>5 Min</b> (<span data-serverstat-loadpercent-5="<?=$currentSrvIP?>"></span><span> %</span>)</td>
                                              <td class="text-center small"><b>15 Min</b> (<span data-serverstat-loadpercent-15="<?=$currentSrvIP?>"></span><span> %</span>)</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>

                                    </div>
                                  </div>

                                </td>

                                <td class="col-4">

                                  <?php 
                                    foreach ($_SERVER as $serverWKey => $serverWVal) {
                                      if($serverWVal[2] != "webserver"){
                                        continue;
                                      }
                                  ?>
                                  
                                    <div class="row text-center">
                                      <div class="col-1" data-serverstat-connect="<?=$serverWKey?>">
                                        &nbsp;
                                      </div>
                                      <div class="col">
                                        <div class="col-12"><?=$_SERVER[$serverWKey][0]?></div>
                                        <div class="col-12">IP: <b><?=$serverWKey?></b></div>
                                        <img src="/image/ico/<?=$_SERVER[$serverWKey][1]?>" height="80" data-arrow-from="4" data-arrow-to="4" data-arrow-ip="<?=$serverWKey?>"> 
                                        <div class="col-12 small">Antwortzeit: <span data-service-time-443="<?=$serverWKey?>"></span> ms</div>

                                        <div class="col-12 small">
                                          <table class="col-12">
                                            <tbody> </tbody>
                                            <tbody>
                                              <tr>
                                                <td class="text-center small"><b>1 Min</b> (<span data-serverstat-loadpercent-1="<?=$serverWKey?>"></span><span> %</span>)</td>
                                                <td class="text-center small"><b>5 Min</b> (<span data-serverstat-loadpercent-5="<?=$serverWKey?>"></span><span> %</span>)</td>
                                                <td class="text-center small"><b>15 Min</b> (<span data-serverstat-loadpercent-15="<?=$serverWKey?>"></span><span> %</span>)</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>

                                      </div>
                                    </div>
                                    <hr class="p-0 m-0">

                                  <?php } ?>

                                </td>

                              </tr>


                              <tr>
                                <td colspan="3">
                                  <hr>
                                </td>
                              </tr>

                            <?php } ?>

                          </tbody>

                        </table>

                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                

                <script type="text/javascript">

                    var serviceRoutingRootElement = ["45.67.221.30", "45.88.223.172"];
                    var rootSelector = '#bodypage [data-arrow-rootelement="arrows-routing"]';

                    function arrowRoutingConnectUserDns(){
                      try {
                        let arrowPosTop = $(rootSelector).offset().top;
                        let arrowPosLeft = $(rootSelector).offset().left;

                        serviceRoutingRootElement.forEach(function (rootElement) {
                          let arrowId = (rootElement.replaceAll(".", "-") + '-user-dns');
                          let rootElem = '[data-arrow-rootelement="'+rootElement+'"]';
                          $("#" + arrowId).remove();

                          $().arrows({
                            from: rootElem + ' [data-arrow-from="1"]', 
                            to: rootElem + ' [data-arrow-to="2"]', 
                            name: '',
                            id: arrowId, 
                            class: 'svg arrow user-dns',
                            within: rootSelector,
                          });

                          $("#" + arrowId).css({
                            top : "-" + arrowPosTop + "px",
                            left : "-" + arrowPosLeft + "px"
                          });

                          $("#" + arrowId + "-triangle")
                            .attr("refX", 0)
                            .attr("markerWidth", 4)
                            .attr("viewBox", "0 0 20 10");

                        });
                      }catch(ex){}
                    };

                    function arrowRoutingConnectDnsFirewall(){
                      try {
                        let arrowPosTop = $(rootSelector).offset().top;
                        let arrowPosLeft = $(rootSelector).offset().left;

                        serviceRoutingRootElement.forEach(function (rootElement) {
                          let arrowId = (rootElement.replaceAll(".", "-") + '-dns-firewall');
                          let rootElem = '[data-arrow-rootelement="'+rootElement+'"]';
                          $("#" + arrowId).remove();

                          $().arrows({
                            from: rootElem + ' [data-arrow-from="2"]', 
                            to: rootElem + ' [data-arrow-to="3"]', 
                            name: '',
                            id: arrowId, 
                            class: 'svg arrow dns-firewall',
                            within: rootSelector,
                          });

                          $("#" + arrowId).css({
                            top : "-" + arrowPosTop + "px",
                            left : "-" + arrowPosLeft + "px"
                          });

                          $("#" + arrowId + "-triangle")
                            .attr("refX", 0)
                            .attr("markerWidth", 4)
                            .attr("viewBox", "0 0 20 10");

                        });
                      }catch(ex){}
                    };

                    function arrowRoutingConnectFirewallWeb(){
                      try {
                        let arrowPosTop = $(rootSelector).offset().top;
                        let arrowPosLeft = $(rootSelector).offset().left;

                        serviceRoutingRootElement.forEach(function (rootElement) {
                          let arrowId = (rootElement.replaceAll(".", "-") + '-firewall-web');
                          let rootElem = '[data-arrow-rootelement="'+rootElement+'"]';
                          let currentRouteIP = $(rootElem + ' [data-service-count-webroute]').attr("data-webroute-value");

                          $("#" + arrowId).remove();

                          $().arrows({
                            from: rootElem + ' [data-arrow-from="3"]', 
                            to: rootElem + ' [data-arrow-to="4"][data-arrow-ip="'+currentRouteIP+'"]', 
                            name: '',
                            id: arrowId, 
                            class: 'svg arrow firewall-web',
                            within: rootSelector,
                          });

                          $("#" + arrowId).css({
                            top : "-" + arrowPosTop + "px",
                            left : "-" + arrowPosLeft + "px"
                          });

                          $("#" + arrowId + "-triangle")
                            .attr("refX", 0)
                            .attr("markerWidth", 4)
                            .attr("viewBox", "0 0 20 10");

                        });
                      }catch(ex){}
                    };



                    function updateArrowRouting(){
                      if($(rootSelector).length <= 0){
                        return true;
                      }

                      setTimeout(function(){
                        arrowRoutingConnectFirewallWeb();
                        arrowRoutingConnectUserDns();
                        arrowRoutingConnectDnsFirewall();

                        updateArrowRouting();
                      }, 1000);
                    }

                  $(document).ready(function(){
                    updateArrowRouting();
                  });
                </script>