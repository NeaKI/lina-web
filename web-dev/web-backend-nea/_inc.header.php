<?php
  require_once(__DIR__ . "/../_inc.pagebase.php");
  require_once(__DIR__ . "/_inc.pagebase.php");

  if($_REQUEST["getserver"] == "status"){
    require_once(__DIR__ . "/_inc.getserverstatus.php");
    exit;
  }

  ob_start("sanitize_output");
?>
<!doctype html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <meta name="theme-color" content="#e6155e">

  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  <META NAME="Copyright" CONTENT="">
  <META NAME="Author" CONTENT="">
  <META NAME="Subject" CONTENT="">
  <META NAME="Language" CONTENT="DE">
  <META NAME="Robots" CONTENT="index,follow">

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/assets/css/plugins/fontawesome-free-6.4.0/css/all.min.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/plugins/simple-line-icons/css/simple-line-icons.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/_combine1.css" rel="preload">
  <link rel="stylesheet" href="/assets/css/less.css" rel="preload">
  <link rel="stylesheet" href="<?=$BASELINK?>/assets/css/loginform.css" rel="preload">
  <link rel="stylesheet" href="<?=$BASELINK?>/assets/css/style.css" rel="preload">

  <link rel="apple-touch-icon" sizes="180x180" href="/image/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest.json" crossorigin="use-credentials">
  
  <script src="/assets/js/plugins/jquery-3.6.1.min.js"></script>

  <meta property="og:title" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <link rel="canonical" href="<?=$_PATH_DOMAIN_PROTOCOL?><?=array_shift(explode('?',$_SERVER["REQUEST_URI"]))?>">

  <title>Lina Narzisse</title>

  <script>
    window.onerrorX = function (msg, url, line) {
       console.warn(msg, url, line);
       return true;
    };
    try{
      document.addEventListener('touchstart', (event) => {}, {passive: true});
      document.addEventListener('touchmove', (event) => {}, {passive: true});
    }catch(ex){};
    try{
      document.addEventListener('wheel', (event) => {}, {passive: true});
    }catch(ex){};
    try{
      document.addEventListener('scroll', (event) => {}, {passive: true});
    }catch(ex){};

  </script>
</head>

<body class="webadmin">
  
<div class="container maincontainer p-0">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-0 bg-dark naviside">
            <div class="d-flex flex-column align-items-center align-items-sm-start pt-0 text-white min-vh-100">
            <?php if(ADM_LOGIN == true){ ?>
              <hr>
                <div class="col-12 text-center">
                  <a href="<?=$BASELINK?>/" class="align-items-center mb-md-0 me-md-auto text-white text-decoration-none">
                      <span class="fs-5 d-none d-sm-inline">Web Admin</span>
                  </a>
                </div>
                

                <div class="container-fluid mt-0">
                  <div class="accordion" id="accordionMenu">

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Dashboard
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionMenu">
                        <div class="accordion-body">
                          <ul class="list-group">
                            <li class="list-group-item"><a href="<?=$BASELINK?>/content/dashboard/dashboard.php">Übersicht</a></li>
                            <li class="list-group-item"><a href="<?=$BASELINK?>/content/dashboard/besucher.php">Besucher</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Webseite
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionMenu">
                        <div class="accordion-body">
                          <ul class="list-group">
                            <li class="list-group-item"><a href="<?=$BASELINK?>/content/webseiten/grundeinstellung.php">Grundeinstellung</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Administration
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionMenu">
                        <div class="accordion-body">
                          <ul class="list-group">
                            <li class="list-group-item"><a href="<?=$BASELINK?>/content/administration/admin-user.php">Admin User</a></li>
                            <li class="list-group-item"><a href="<?=$BASELINK?>/content/administration/server-status.php">Server & Dienste</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <hr>
                        <div class="text-center">
                          <?=$_SESSION["ADMINNAME"]?>
                        </div>
                      <hr>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading0">
                        <button class="accordion-button collapsed logoutbutton" type="button">
                          <a href="<?=$BASELINK?>/?logout=true" class="externallink logoutcollapse">Logout</a>
                        </button>
                      </h2>
                    </div>

                  </div>
                </div>

                <hr>

            <?php } ?>
            </div>
        </div>


        <div class="col contentarea p-0 m-0" id="bodypage">
            
        
