      
            </div>
        </div>
    </div>

    
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/compress.squeeze.js"></script>
    <script src="<?=$BASELINK?>/assets/js/base.js"></script>

    <?php if(ADM_LOGIN && $_SESSION["ADMINNAME"] != ""){ ?>
      <script src="<?=$BASELINK?>/assets/js/serverstatus.js"></script>
    <?php } ?>

  </body>
</html>