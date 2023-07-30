

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
                  <a href="<?php echo $oJCONFIG->socialmedia->youtube->url?>" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-youtube"></i><span class="socialtext"><?=$oJCONFIG->socialmedia->youtube->text?></span></a>
                </li>
                <li class="nav-item col-4">
                  <a href="<?=$oJCONFIG->socialmedia->tiktok->url?>" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-tiktok"></i><span class="socialtext"><?=$oJCONFIG->socialmedia->tiktok->text?></span></a>
                </li>
                <li class="nav-item col-4">
                  <a href="<?=$oJCONFIG->socialmedia->instagram->url?>" class="d-flex align-items-center justify-content-center"><i class="fa-brands fa-instagram"></i><span class="socialtext"><?=$oJCONFIG->socialmedia->instagram->text?></span></a>
                </li>
              </ul>
            </div>
          </div>
          
          <div class="dividingline"></div>

          <div class="col-12 p-0 copyright">
              <section class="d-flex justify-content-center justify-content-lg-between text-center text-md-end">
                <div class="me-5 d-none d-sm-block">
                  &copy; <?=date("Y")?> Copyright: <b><?=$oJCONFIG->global->copyright->text?></b>
                </div>
                <div>
                  <a class="copyright-nav-item" href="<?=$oJCONFIG->globalpages->impressum->url?>"><?=$oJCONFIG->globalpages->impressum->name?></a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?=$oJCONFIG->globalpages->datenschutz->url?>"><?=$oJCONFIG->globalpages->datenschutz->name?></a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?=$oJCONFIG->globalpages->haftungsausschluss->url?>"><?=$oJCONFIG->globalpages->haftungsausschluss->name?></a>&nbsp;&nbsp;&middot;&nbsp;&nbsp;
                  <a class="copyright-nav-item" href="<?=$oJCONFIG->globalpages->startseite->url?>"><?=$oJCONFIG->globalpages->startseite->name?></a>
                </div>
              </section>
          </div>

        </div>
      </div>
    </footer>

    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/compress.squeeze.js"></script>

  </body>
</html>