<?php 
require_once(__DIR__ . "/../../_inc.header.php");
global $DATABASE;
/* bof page */


/* postdata */
if(sizeof($_POST) >0 && ($_POST && $_POST["postdata"] == "postdata")){
  ob_end_clean();
  $return = [];
  $return["returncode"] = false;

    switch($_POST["function"]){
      case "colormain":

          if(trim($_POST["colorname"]) != "" && strlen(trim($_POST["colorvalue"])) == 7){
            $return["returncode"] = $DATABASE->update_tuple("web_website_colors", "color_value", trim($_POST["colorvalue"]), "color_id", trim($_POST["colorname"]));
            if($return["returncode"] == true){
              $lessFile = __DIR__ . "/../../../assets/less/adm-config/_inc.adm.backend.var.color.less";
              try {
                $DB_GET_COLORS = $DATABASE->selectAllFromTable("web_website_colors", 0);
                $rowCount = 0;
                foreach ($DB_GET_COLORS as $colorKey => $colorVal) {
                  if($rowCount == 0){
                    file_put_contents($lessFile, "@admBackend_".$colorVal["color_id"].": ".$colorVal["color_value"].";");
                  }else{
                    file_put_contents($lessFile, PHP_EOL . "@admBackend_".$colorVal["color_id"].": ".$colorVal["color_value"].";", FILE_APPEND);
                  }
                  $rowCount++;
                }

              }catch(Exception $ex){
                $return["returncode"] = $lessFile;
              }
            }
          }

        break;

      case "navigation-new-mainitem" :
          if(trim($_POST["title"]) != "" && strlen(trim($_POST["title"])) >= 1){
            $return["returncode"] = $DATABASE->insertMultiValue("web_website_navigation", "title", trim($_POST["title"]), ["parent_id", "sort_id", "active", "link"], [0, 9999, 1, "#"]);
          }
        break;

      case "navigation-delete-mainitem" :
          if(trim($_POST["menuitem-id"]) != "" && strlen(trim($_POST["menuitem-id"])) >= 1){
            $return["returncode"] = $DATABASE->deleteQuery("web_website_navigation", "id = '".(int)trim($_POST["menuitem-id"])."' OR parent_id = '".(int)trim($_POST["menuitem-id"])."'");
          }
        break;

      case "navigation-sortid-mainitem" :
          foreach ($_POST["sortby"] as $key => $value) {
            $return["returncode"] = $DATABASE->update_tuple_by_id("web_website_navigation", $value, "sort_id", $key);
          }
        break;

      case "navigation-new-subitem" :
          if(trim($_POST["parentid"]) == "" || strlen(trim($_POST["parentid"])) <= 0){
            $return["returncode"] = "Fehlende Parent-ID";
          }
          if(trim($_POST["title"]) != "" && strlen(trim($_POST["title"])) >= 1){
            $return["returncode"] = $DATABASE->insertMultiValue("web_website_navigation", "title", trim($_POST["title"]), ["parent_id", "sort_id", "active", "link"], [(int)$_POST["parentid"], 9999, 1, "#"]);
          }
        break;

      case "navigation-rename-mainitem" :
          if(trim($_POST["menuitem-id"]) == "" || strlen(trim($_POST["menuitem-id"])) <= 0 || strlen(trim($_POST["title"])) <= 0){
            $return["returncode"] = "Fehlender Titel";
          }else{
            $return["returncode"] = $DATABASE->update_tuple_by_id("web_website_navigation", trim($_POST["menuitem-id"]), "title", trim($_POST["title"]));
          }
        break;

    }

  $return["postvalues"] = $_POST;
  echo json_encode($return);
  die();
}
/* eof postdata */



$DB_GET_COLORS = $DATABASE->selectAllFromTable("web_website_colors", 0);
$DB_GET_NAVIGATION = $DATABASE->selectQuery("web_website_navigation WHERE parent_id = '0' ORDER BY sort_id ASC");
  
?>



<nav class="subpage-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Webseite</li>
    <li class="breadcrumb-item active" aria-current="page">Grundeinstellung</li>
  </ol>
</nav>



  <div class="container mt-4">

    <div class="row">

      <div class="tabbed-nav">
      
        <ul>
          <li><a>Farbeinstellung</a></li>
          <li><a>Header-Navigation</a></li>
        </ul>

          <div>

            <!-- farbeinstellung -->
            <div>

                    <h5>Farbeinstellung</h5>
                    <p>Um die jeweilige Farbe auf der Webseite zu ändern, bitte unter der Spalte <b>Farbe</b> die Farbe anklicken. <b>Farb-ID</b> ist der in der Wert für die LESS/CSS Datei und dient zur Identifikation des Wertes. Die Spalte <b>Farbe</b> zeigt die aktuell ausgewählte Farbe an. Unter <b>Standard</b> siehst du den voreingestellten Standard-Wert, auf dem du notfalls wieder zurückstellen kannst. Die <b>Beschreibung</b> gibt als kurzen Hinweis an, wofür die Farbe verwendet wird.
                    <p>

              <div class="container mt-4">
                <div method="post" class="modern-p-form" action=".">
                <table class="table vertical-middle dashed-right">
                  <thead>
                    <tr>
                      <th>Farb-ID</th>
                      <th>Farbe</th>
                      <th>Standard</th>
                      <th>Beschreibung</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      foreach ($DB_GET_COLORS as $colorKey => $colorVal) {
                    ?>
                      <tr>
                          <td>
                              <?= $colorVal["color_id"]; ?>
                          </td>
                          <td>
                              <div class="color-cell-pick pickbox cursor pointer <?= $colorVal["color_id"]; ?>" data-id="<?= $colorVal["color_id"]; ?>" data-default="<?= $colorVal["color_default"]; ?>" data-current="<?= $colorVal["color_value"]; ?>" data-action="colormain" style="background-color: <?= $colorVal["color_value"]; ?>;">
                              </div><br>
                              <?= $colorVal["color_value"]; ?>
                          </td>
                          <td>
                              <div class="color-cell-pick" style="background-color: <?= $colorVal["color_default"]; ?>;">
                              </div><br>
                              <?= $colorVal["color_default"]; ?>
                          </td>
                          <td>
                              <?= $colorVal["beschreibung"]; ?>
                          </td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>

                <div style="min-height: 270px;">&nbsp;</div>

                </div>
              </div>
              
            </div>




            <!-- Navigation -->
            <div>
              <h4>Header-Navigation</h4>
              <p>
                <form method="post" class="modern-p-form" action="." id="btnAddMainMenu">

                    <div class="form-group">
                        <div class="input-group p-has-icon">
                            <input type="hidden" name="function" value="navigation-new-mainitem">

                            <input type="text" name="title" placeholder="Neuen Menüpunkt einfügen" class="form-control">
                            <span class="p-field-cb"></span>
                            <span class="input-group-icon"><i class="fa-solid fa-plus"></i></span>
                            <span class="input-group-btn">
                                <button type="submit" class="btn">Neuen Haupt-Menüpunkt einfügen</button>
                            </span>
                        </div>
                    </div>

                </form>
                <hr>
              </p>



              <div class="container mt-4">
                <div method="post" class="modern-p-form" action="." id="sortableNavItemsConfig" >

                    <?php
                      $count = 0;
                      foreach ($DB_GET_NAVIGATION as $mainNavKey => $mainNavVal) {
                    ?>


                        <div class="sortable mainmenu container">
                            <div class="sort_mainnav" data-row-id="<?= $mainNavVal["id"]; ?>">
                              <div class="row ">
                                  <div class="col-1">
                                    <?php if(count($DB_GET_NAVIGATION) > 1){ ?>
                                      <i class="fa-solid fa-up-down"></i>
                                    <?php } ?>
                                  </div>
                                  <div class="col">
                                      <h5>
                                        <sub>[ <span class="mainrownumber"><?=++$count?></span> ]</sub> &nbsp;&nbsp; 
                                        <b class="editnavtitletext"><?= $mainNavVal["title"]; ?></b>
                                        &nbsp;&nbsp;<i class="fa-solid fa-pen-to-square editnavtitle cursor pointer" data-row-id="<?=$mainNavVal["id"]; ?>"></i>
                                      </h5>
                                      <hr class="dashed">
                                  </div>
                                  <div class="col-1 text-end">
                                        <i class="fa-solid fa-trash-can text-danger deletemainnavitem cursor pointer" data-nav-id="<?= $mainNavVal["id"]; ?>" data-nav-name="<?= $mainNavVal["title"]; ?>"></i>
                                  </div>
                              </div>


                              <div class="row">
                                  <div class="col-1">
                                      &nbsp;
                                  </div>
                                  <div class="col-1">
                                      &nbsp;
                                  </div>
                                  <div class="col">

                                      <form method="post" class="modern-p-form form-group btnAddSubMainMenu" action=".">
                                            <input type="hidden" name="function" value="navigation-new-subitem">
                                            <input type="hidden" name="parentid" value="<?=$mainNavVal["id"]?>">
                                            <div class="input-group p-has-icon">
                                                <input type="text" name="title" placeholder="Neuen Untermenüpunkt einfügen" class="form-control">
                                                <span class="p-field-cb"></span>
                                                <span class="input-group-icon"><i class="fa-solid fa-plus"></i></span>
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn">Menüpunkt einfügen</button>
                                                </span>
                                            </div>
                                        </div>

                                      </form>
                              </div>

                              <div class="sortableSubNavItemsConfig">
                                <?php
                                  $subcount = 0;
                                  $DB_GET_SUBNAVIGATION = $DATABASE->selectQuery("web_website_navigation WHERE parent_id = '".$mainNavVal["id"]."' ORDER BY sort_id ASC");
                                  foreach ($DB_GET_SUBNAVIGATION as $mainSubNavKey => $mainSubNavVal) {
                                ?>

                                    <div class="row sort_subnav sortable" data-row-id="<?=$mainSubNavVal["id"]; ?>">
                                        <div class="col-1">
                                            &nbsp;
                                        </div>
                                        <div class="col-1">
                                            <i class="fa-solid fa-turn-up fa-rotate-90"></i>
                                        </div>
                                        <div class="col">

                                          <div class="row ">
                                              <div class="col-1">
                                                <?php if(count($DB_GET_SUBNAVIGATION) > 1){ ?>
                                                  <i class="fa-solid fa-up-down"></i>
                                                <?php } ?>
                                              </div>
                                              <div class="col">
                                                  <h6>
                                                    <sub>[ <span class="subrownumber"><?=++$subcount?></span> ]</sub> &nbsp;&nbsp; 
                                                    <b class="editnavtitletext" data-row-id="<?=$mainSubNavVal["id"]; ?>"><?= $mainSubNavVal["title"]; ?></b>
                                                    &nbsp;&nbsp;<i class="fa-solid fa-pen-to-square editnavtitle cursor pointer" data-row-id="<?=$mainSubNavVal["id"]; ?>"></i>
                                                  </h6>
                                                  <hr class="dashed">
                                              </div>
                                              <div class="col-1 text-end">
                                                    <i class="fa-solid fa-trash-can text-danger deletemainnavitem cursor pointer" data-nav-id="<?= $mainSubNavVal["id"]; ?>" data-nav-name="<?= $mainSubNavVal["title"]; ?>"></i>
                                              </div>
                                          </div>

                                        </div>
                                    </div>


                                <?php
                                  }
                                ?>
                              </div>


                            <hr>
                            </div>
                        </div>


                    <?php
                      }
                    ?>

                </div>
              </div>


            </div>

        </div>

      </div>

    </div>
</div>
    


<?php
/* eof page */
require_once(__DIR__ . "/../../_inc.footer.php");
require_once(__DIR__ . "/../../../assets/php/phpquery.php");