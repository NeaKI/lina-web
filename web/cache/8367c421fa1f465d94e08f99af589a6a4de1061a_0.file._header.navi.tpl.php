<?php
/* Smarty version 4.3.2, created on 2023-07-24 11:19:16
  from '/var/www/clients/client1/web43/web/public/template/module/_header.navi.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64be4214c06199_75570167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8367c421fa1f465d94e08f99af589a6a4de1061a' => 
    array (
      0 => '/var/www/clients/client1/web43/web/public/template/module/_header.navi.tpl',
      1 => 1690188875,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64be4214c06199_75570167 (Smarty_Internal_Template $_smarty_tpl) {
?>    <div class="preloader-container">
      <div class="lds-roller preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
    
  <div class="container-fluid">
    
    <div class="row" id="headernavi">
      <!-- 1. infoleiste (desktop) -->
      <div class="col-md-12 p-0 d-md-block" id="headernavi_top">
        <p class="text-center p-0 mb-0 d-none"> ... </p>
      </div>

      <div class="col-md-12 p-0">
        <!-- navigationsleiste -->
        <nav class="navbar navbar-expand-lg" id="headernavi_nav">
          <div class="container">
            <!--a class="navbar-brand" href="/test.php"><span class="navbar-brand-letter"><?php echo '<?'; ?>
=$oJCONFIG->global->logoletter->text<?php echo '?>'; ?>
</span></a-->
            <a class="navbar-bransd" href="/"><img src="/image/logo/logo-lina-3-50.png"></a>
              <div class="social-media order-lg-last">

                <!-- social media -->
                 <p class="mb-0 d-flex d-none d-md-none-flex d-lg-block-flex icons">
                    <a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->youtube->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-youtube"></i></a>
                    <a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->tiktok->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->instagram->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-instagram"></i></a>
                    <!--a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->instagram->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-solid fa-envelope"></i></a-->
                 </p>
                 <p class="mb-0 d-flex d-block d-sm-block d-md-block d-lg-none smarttext">
                    <a href="" class="d-flex align-items-center justify-content-center"><i class="fa-solid fa-group-arrows-rotate"></i>&nbsp;&nbsp;&nbsp;Lina's Social Media</a>
                 </p>

                <!-- suche -->
                <form action="/" method="post">
                  <p class="mb-0 d-flex search-container">
                    <input type="text" placeholder="Suche .." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                  </p>
                </form>

              </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa-solid fa-bars toggler"></i> Menü
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">

                <?php echo '<?php'; ?>
 
                  $DB_GET_NAVIGATION = $DATABASE->selectQuery("web_website_navigation WHERE parent_id = '0' ORDER BY sort_id ASC");
                  foreach ($DB_GET_NAVIGATION as $index => $value) {
                    $DB_GET_SUBNAVIGATION = $DATABASE->selectQuery("web_website_navigation WHERE parent_id = '".$value['id']."' ORDER BY sort_id ASC");
                    if(sizeof($DB_GET_SUBNAVIGATION) <=0){
                      echo '
                        <li class="nav-item">
                          <a class="nav-link" href="#" href="'.$value['url'].'">'.$value['title'].'</a>
                        </li>
                      ';
                    }else{
                      echo '
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="'.$value['url'].'">'.$value['title'].'</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              ';
                                foreach ($DB_GET_SUBNAVIGATION as $subindex => $subvalue) {
                                  echo '
                                    <li><a class="dropdown-item" href="'.$subvalue['url'].'">'.$subvalue['title'].'</a></li>
                                  ';
                                }
                              echo '
                            </ul>
                        </li>
                      ';
                    }
                  }
                <?php echo '?>'; ?>

              </ul>

            </div>
          </div>
        </nav>
      </div>

      <div class="dividingline"></div>

      <!-- 2. infoleiste (desktop) -->
      <div class="col-md-12 p-0 d-none d-sm-block" id="headernavi_bottom">
        <p class="text-center p-2 mb-0">bla bla bla info (infoleiste 2)</p>
      </div>

      <div class="dividingline"></div>

    </div>
  </div>

<div id="bodyborder" class="container-fullbody p-0"></div>
  <div id="bodypage" class="container-fullbody p-0">
    <div id="bodypage_padding" class="container-fullbody p-0">
      <?php }
}
