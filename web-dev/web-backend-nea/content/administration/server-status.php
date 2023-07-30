<?php 
require_once(__DIR__ . "/../../_inc.header.php");
global $DATABASE;
$WEBADMINS = $DATABASE->select_webadmin_getAll();
/* bof page */

/* postdata */
if(sizeof($_POST) >0 && ($_POST && $_POST["postdata"] == "postdata")){
}
/* eof postdata */
?>



<nav class="subpage-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Administration</li>
    <li class="breadcrumb-item active" aria-current="page">Admin User</li>
  </ol>
</nav>




  <div class="container mt-4">

      <div class="tabbed-nav">
      
        <ul>
          <li><a>Server Übersicht</a></li>
          <li><a>Dienst Übersicht</a></li>
          <li><a>Firewall</a></li>
        </ul>

          <div>
            <div>
                  <!-- admin list -->
                  <div class="col-md-12">
                    <h5>Server</h5>
                    <p>
                    <p>
                      <div class="container mt-4">

                        <table class="table vertical-middle dashed-right">
                          <thead>
                            <tr>
                              <!--th>#ID</th-->
                              <th>Typ</th>
                              <th>Status</th>
                              <th>Leistung</th>
                            </tr>
                          </thead>
                          <tbody>

                              <tr>
                                <td class="text-center"> 
                                  <div class="col">Firewall/ Gateway [1]</div>
                                  <div class="col">IP: <b>45.67.221.30</b></div>
                                  <img src="/image/ico/ico-server-firewall.png" height="80"> 
                                </td>
                                <td></td>
                                <td></td>
                              </tr>

                              <tr>
                                <td class="text-center"> 
                                  <div class="col">Firewall/ Gateway [2]</div>
                                  <div class="col">IP: <b>45.88.223.172</b></div>
                                  <img src="/image/ico/ico-server-firewall.png" height="80"> 
                                </td>
                                <td></td>
                                <td></td>
                              </tr>

                              <tr>
                                <td class="text-center"> 
                                  <div class="col">Datenbank/ Admin</div>
                                  <div class="col">IP: <b>185.194.216.15</b></div>
                                  <img src="/image/ico/ico-server-database.png" height="80"> 
                                </td>
                                <td></td>
                                <td></td>
                              </tr>

                              <tr>
                                <td class="text-center"> 
                                  <div class="col">Webserver [1]</div>
                                  <div class="col">IP: <b>185.239.208.38</b></div>
                                  <img src="/image/ico/ico-server-webserver.png" height="80"> 
                                </td>
                                <td></td>
                                <td></td>
                              </tr>

                              <tr>
                                <td class="text-center"> 
                                  <div class="col">Webserver [2]</div>
                                  <div class="col">IP: <b>185.239.208.39</b></div>
                                  <img src="/image/ico/ico-server-webserver.png" height="80"> 
                                </td>
                                <td></td>
                                <td></td>
                              </tr>

                          </tbody>

                        </table>

                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

            <!-- neuer admin -->
            <div>
                  <!-- admin list -->
                  <div class="col-md-12">
                    <h5>Dienste</h5>
                    <p>
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

            <!-- neuer admin -->
            <div>
                  <!-- admin list -->
                  <div class="col-md-12">
                    <h5>Firewall</h5>
                    <p>
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