<?php
/* Smarty version 4.3.2, created on 2023-07-24 11:19:16
  from '/var/www/clients/client1/web43/web/public/template/module/_footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64be4214c0bc39_29481415',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '304e4e80a5f059075ba7c5ab6bbc2e1fe36e696c' => 
    array (
      0 => '/var/www/clients/client1/web43/web/public/template/module/_footer.tpl',
      1 => 1690186894,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64be4214c0bc39_29481415 (Smarty_Internal_Template $_smarty_tpl) {
?>

      </div>
    </div>  <!-- end of bodypage -->

    <footer class="footer fixed-bottom">
      <div class="container-fluid">
        <div class="row">

          <div class="dividingline"></div>

          <!-- social media -->
          <div class="row justify-content-center socialmedia">
            <div class="col-lg-6">
              <ul class="nav justify-content-center">
                <li class="nav-item col-4">
                  <a href="<?php echo '<?php'; ?>
 echo $oJCONFIG->socialmedia->youtube->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-youtube"></i><span class="socialtext"><?php echo '<?'; ?>
=$oJCONFIG->socialmedia->youtube->text<?php echo '?>'; ?>
</span></a>
                </li>
                <li class="nav-item col-4">
                  <a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->tiktok->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-tiktok"></i><span class="socialtext"><?php echo '<?'; ?>
=$oJCONFIG->socialmedia->tiktok->text<?php echo '?>'; ?>
</span></a>
                </li>
                <li class="nav-item col-4">
                  <a href="<?php echo '<?'; ?>
=$oJCONFIG->socialmedia->instagram->url<?php echo '?>'; ?>
" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-instagram"></i><span class="socialtext"><?php echo '<?'; ?>
=$oJCONFIG->socialmedia->instagram->text<?php echo '?>'; ?>
</span></a>
                </li>
              </ul>
            </div>
          </div>
          
          <div class="dividingline"></div>

          <div class="col-12 p-0 copyright">
              <section class="d-flex justify-content-center justify-content-lg-between text-center text-md-end">
                <div class="me-5 d-none d-sm-block">
                  &copy; <?php echo '<?'; ?>
=date("Y")<?php echo '?>'; ?>
 Copyright: <b><?php echo '<?'; ?>
=$oJCONFIG->global->copyright->text<?php echo '?>'; ?>
</b>
                </div>
                <div>
                  <a class="copyright-nav-item" href="<?php echo '<?'; ?>
=$oJCONFIG->globalpages->impressum->url<?php echo '?>'; ?>
"><?php echo '<?'; ?>
=$oJCONFIG->globalpages->impressum->name<?php echo '?>'; ?>
</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?php echo '<?'; ?>
=$oJCONFIG->globalpages->datenschutz->url<?php echo '?>'; ?>
"><?php echo '<?'; ?>
=$oJCONFIG->globalpages->datenschutz->name<?php echo '?>'; ?>
</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?php echo '<?'; ?>
=$oJCONFIG->globalpages->haftungsausschluss->url<?php echo '?>'; ?>
"><?php echo '<?'; ?>
=$oJCONFIG->globalpages->haftungsausschluss->name<?php echo '?>'; ?>
</a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?php echo '<?'; ?>
=$oJCONFIG->globalpages->startseite->url<?php echo '?>'; ?>
"><?php echo '<?'; ?>
=$oJCONFIG->globalpages->startseite->name<?php echo '?>'; ?>
</a>
                </div>
              </section>
          </div>

        </div>
      </div>
    </footer>

    
    <?php echo '<script'; ?>
 src="/assets/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/assets/js/compress.squeeze.js"><?php echo '</script'; ?>
>

  </body>
</html><?php }
}
