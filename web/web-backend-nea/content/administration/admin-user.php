<?php 
require_once(__DIR__ . "/../../_inc.header.php");
global $DATABASE;
$WEBADMINS = $DATABASE->select_webadmin_getAll();
/* bof page */

/* postdata */
if(sizeof($_POST) >0 && ($_POST && $_POST["postdata"] == "postdata")){
  ob_end_clean();
  $return = [];
  $return["returncode"] = false;

    switch($_POST["function"]){
      case "changeadmin":
          if($_SESSION["ADMINNAME"] == $adminVal["name"]){ 
            $_POST["active"] = 1;
          }

            $isError = false;
            if($_POST["id"] > 1){

              if(isset($_POST["password"])){
                if(strlen(trim($_POST["password"])) >= 8){
                  $password = generateHashPassword(trim($_POST["password"]));
                  $return["returncode"] = $DATABASE->change_admin_value($_POST["id"], "password", trim($password));
                }else{
                  if(strlen(trim($_POST["password"])) > 0){
                    $isError = true;
                    $return["returncode"] = "Das Passwort ist zu kurz";
                  }
                }
              }

              if(isset($_POST["active"])){
                if(!$isError && (trim($_POST["active"]) == "0" || trim($_POST["active"]) == "1")){
                  $return["returncode"] = $DATABASE->change_admin_value($_POST["id"], "active", intval(trim($_POST["active"])));
                }else{
                  $isError = true;
                  $return["returncode"] = "Aktiv hat einen falschen Wert: " . trim($_POST["active"]);
                }
              }

              if(isset($_POST["candelete"])){
                if(!$isError && (trim($_POST["candelete"]) == "0" || trim($_POST["candelete"]) == "1")){
                  $return["returncode"] = $DATABASE->change_admin_value($_POST["id"], "candelete", intval(trim($_POST["candelete"])));
                }else{
                  $isError = true;
                  $return["returncode"] = "Löschbar hat einen falschen Wert: " . trim($_POST["candelete"]);
                }
              }

              if(isset($_POST["role"])){
                if(!$isError && (trim($_POST["role"]) == "0" || trim($_POST["role"]) == "1")){
                  $return["returncode"] = $DATABASE->change_admin_value($_POST["id"], "role", intval(trim($_POST["role"])));
                }else{
                  $isError = true;
                  $return["returncode"] = "Rolle hat einen falschen Wert: " . trim($_POST["role"]);
                }
              }
            }

        break;

      case "newadmin":
        if(strlen(trim($_POST["name"])) < 1){
          $return["returncode"] = "Der Benutzername ist zu kurz";
        }else{
          if(strlen(trim($_POST["name"])) < 1 || strlen(trim($_POST["password"])) < 8){
            $return["returncode"] = "Das Passwort ist zu kurz";
          }else{
            $name = strtolower(trim($_POST["name"]));
            $fullname = trim($_POST["fullname"]);
            $email = trim($_POST["email"]);
            $password = generateHashPassword(trim($_POST["password"]));
            $active = 1;

            $return["returncode"] = $DATABASE->new_admin($name, $fullname, $email, $password, $active);
          }
        }
        break;

      case "deleteadmin":
        $delId = trim($_POST["deleteid"]);
        if($delId < 0){
          $return["returncode"] = "Fehler bei den Löschdaten";
        }

        if(trim($_POST["deleteadmin"]) != $delId || trim($_POST["deletename"]) != $delId || trim($_POST["deleteconfirm"]) != 1){
          $return["returncode"] = "Fehler bei den Löschdaten";
        }else{
          $return["returncode"] = $DATABASE->delete_admin($delId);
        }
      break;
    }


  $return["postvalues"] = $_POST;
  echo json_encode($return);
  die();
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
          <li><a>Admin Übersicht</a></li>
          <li><a>Neuen Admin anlegen</a></li>
        </ul>

          <div>
            <div>
                  <!-- admin list -->
                  <div class="col-md-12">
                    <h5>Übersicht</h5>
                    <p><b>Benutzername</b> ist der Login Name. <b>Passwort</b> <u>nur</u> eintragen, wenn dem Admin ein neues Passwort zugeordnet werden soll (Überschreiben) - ansonsten <u>leer</u> lassen. Das Passwort muss aus mindestens 8 Zeichen bestehen. <b>Aktiv</b> stellt ein, ob der Admin sich einloggen darf. Beim <b>Löschen</b> wird der Admin unwiderruflich gelöscht. Die Administrator-<b>Rolle</b> hat derzeit keine Bewandnis. <b>Löschbar</b> zeigt an, ob ein Administrator gelöscht werden kann (definiert der sysadmin).</p>
                    <p>
                      <div class="container mt-4">
                        <div method="post" class="modern-p-form" action=".">
                        <table class="table vertical-middle dashed-right">
                          <thead>
                            <tr>
                              <!--th>#ID</th-->
                              <th>Benutzername</th>
                              <th>Passwort (reset)</th>
                              <th>Aktiv</th>
                              <th>Rolle</th>
                              <th>Löschbar</th>
                              <th>Löschen</th>
                              <th>Speichern</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                              foreach ($WEBADMINS as $adminKey => $adminVal) {
                            ?>
                                  <tr class="admineditvalues">
                                    <!--td><?=$adminVal["id"]?></td-->
                                    <td><span class="<?php if(($_SESSION["ADMINNAME"] == $adminVal["name"] && $_SESSION["ADMINHASH"] == $adminVal["password"])){ echo "bold text-primary"; }if($adminVal["name"] == "sysadmin"){ echo "bold text-warning"; } ?>"><?=$adminVal["name"]?></span></td>
                                    <td>
                                      <?php if($adminVal["name"] != "sysadmin"){ ?>
                                        <!--input type="password" name="password" placeholder="***" data-admin-id="<?=$adminVal["id"]?>"-->
                                        <div class="form-group">
                                            <div class="input-group p-has-icon">
                                                <input type="password" name="password" placeholder="****" class="form-control" data-admin-id="<?=$adminVal["id"]?>">
                                                <span class="input-group-state">
                                                    <span class="p-position">
                                                        <span class="p-text">
                                                            <span class="p-valid-text"><i class="fa fa-check"></i></span>
                                                            <span class="p-error-text"><i class="fa fa-times"></i></span>
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="p-field-cb"></span>
                                                <span class="input-group-icon"><i class="fa-solid fa-lock-open"></i></span>
                                            </div>
                                        </div>
                                      <?php } ?>
                                    </td>
                                    <td>
                                      <?php if($adminVal["name"] != "sysadmin" && !($_SESSION["ADMINNAME"] == $adminVal["name"] && $_SESSION["ADMINHASH"] == $adminVal["password"])){ ?>
                                        <?php if($adminVal["candelete"] == 1 || $_SESSION["ADMINNAME"] == "sysadmin") { ?>
                                          <input type="checkbox" name="active" value="1" <?php if($adminVal["active"] == 1){ echo " checked"; } ?> data-admin-id="<?=$adminVal["id"]?>">
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                    <td>
                                        <?php if($_SESSION["ADMINNAME"] == "sysadmin" && !($_SESSION["ADMINNAME"] == $adminVal["name"] && $_SESSION["ADMINHASH"] == $adminVal["password"])) { ?>
                                                <select name="role" class="form-control" data-admin-id="<?=$adminVal["id"]?>">
                                                    <option value="0" selected>0</option>
                                                    <option value="1">1</option>
                                                </select>
                                        <?php }else{
                                          echo $adminVal["role"];
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if($_SESSION["ADMINNAME"] == "sysadmin" && !($_SESSION["ADMINNAME"] == $adminVal["name"] && $_SESSION["ADMINHASH"] == $adminVal["password"])) { ?>
                                          <input type="checkbox" name="candelete" value="1" <?php if($adminVal["candelete"] == 1){ echo " checked"; } ?> data-admin-id="<?=$adminVal["id"]?>">
                                        <?php }else{
                                          $candeleteIco = $adminVal["candelete"] == 1 ? '<i class="fa-solid fa-circle-check"></i>' : '<i class="fa-regular fa-circle-xmark text-danger"></i>';
                                          echo $candeleteIco;
                                        } ?>
                                    </td>
                                    <td>
                                      <?php if($adminVal["name"] != "sysadmin" && !($_SESSION["ADMINNAME"] == $adminVal["name"] && $_SESSION["ADMINHASH"] == $adminVal["password"])){ ?>
                                        <?php if($adminVal["candelete"] == 1 || $_SESSION["ADMINNAME"] == "sysadmin") { ?>
                                          <i class="fa-solid fa-trash-can deleteadminvalues" data-admin-id="<?=$adminVal["id"]?>" onclick="neaWebsiteBasic_LocalLink.deleteAdministrator('<?=$adminVal["id"]?>', '<?=$adminVal["name"]?>');"></i>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                    <td>
                                      <?php if($adminVal["name"] != "sysadmin"){ ?>
                                        <?php if($_SESSION["ADMINNAME"] != "sysadmin") { ?>
                                          <input type="hidden" name="function" value="changeadmin" data-admin-id="<?=$adminVal["id"]?>">
                                          <button class="saveadminvalues" value="speichern" data-admin-id="<?=$adminVal["id"]?>">speichern</button>
                                        <?php } ?>
                                      <?php } ?>
                                    </td>
                                  </tr>

                             <?php } ?>

                          </tbody>
                        </table>
                        </div>
                      </div>
                    </p>
                  </div>
                  <div class="col-md-12">
                  </div>
                  <hr>
                
            </div>

            <!-- neuer admin -->
            <div>
              <div class="col-md-12">
                <h5>Neuen Administrator anlegen</h5>
                <p>

                  <form method="post" class="modern-p-form" action=".">
                      <input type="hidden" name="function" value="newadmin">

                      <div class="col-sm-12">
                          <div class="form-group">
                              <label for="newusername">Benutzername (*)</label>
                              <div class="input-group p-has-icon">
                                  <input type="text" id="newusername" name="name" placeholder="Benutzername" class="form-control">
                                  <span class="input-group-state">
                                      <span class="p-position">
                                          <span class="p-text">
                                              <span class="p-valid-text"><i class="fa fa-check"></i></span>
                                              <span class="p-error-text"><i class="fa fa-times"></i></span>
                                          </span>
                                      </span>
                                  </span>
                                  <span class="p-field-cb"></span>
                                  <span class="input-group-icon"><i class="fa-solid fa-user"></i></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="newfullname">Vollständiger Name <sub>(optional)</sub></label>
                              <div class="input-group p-has-icon">
                                  <input type="text" id="newfullname" name="fullname" placeholder="Max Mustermann" class="form-control">
                                  <span class="input-group-state">
                                      <span class="p-position">
                                          <span class="p-text">
                                              <span class="p-valid-text"><i class="fa fa-check"></i></span>
                                              <span class="p-error-text"><i class="fa fa-times"></i></span>
                                          </span>
                                      </span>
                                  </span>
                                  <span class="p-field-cb"></span>
                                  <span class="input-group-icon"><i class="fa-solid fa-signature"></i></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="newemail">E-Mail Adresse <sub>(optional)</sub></label>
                              <div class="input-group p-has-icon">
                                  <input type="text" id="newemail" name="email" placeholder="max@mustermann.de" class="form-control">
                                  <span class="input-group-state">
                                      <span class="p-position">
                                          <span class="p-text">
                                              <span class="p-valid-text"><i class="fa fa-check"></i></span>
                                              <span class="p-error-text"><i class="fa fa-times"></i></span>
                                          </span>
                                      </span>
                                  </span>
                                  <span class="p-field-cb"></span>
                                  <span class="input-group-icon"><i class="fa-solid fa-envelope"></i></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="newpassword">Passwort (*) (mindestens 8 Zeichen)</label>
                              <div class="input-group p-has-icon">
                                  <input type="password" id="newpassword" name="password" placeholder="Passwort" class="form-control">
                                  <span class="input-group-state">
                                      <span class="p-position">
                                          <span class="p-text">
                                              <span class="p-valid-text"><i class="fa fa-check"></i></span>
                                              <span class="p-error-text"><i class="fa fa-times"></i></span>
                                          </span>
                                      </span>
                                  </span>
                                  <span class="p-field-cb"></span>
                                  <span class="input-group-icon"><i class="fa-solid fa-lock-open"></i></span>
                              </div>
                          </div>
                      </div>

                          <div class="text-right">
                              <button class="btn" type="submit">anlegen</button>
                          </div>

                  </form>

                </p>
              </div>
            </div>

        </div>

      </div>


  </div>




<?php
/* eof page */
require_once(__DIR__ . "/../../_inc.footer.php");
require_once(__DIR__ . "/../../../assets/php/phpquery.php");