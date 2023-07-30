<?php 
$IS_INDEX_OR_LOGIN_PAGE = "indexlogin";

?>
<nav class="subpage-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Login</li>
  </ol>
</nav>

<script>
  $(document).ready(function(){
    $("button.signup").on("click touch", function(event){
      if($("#login_username").val().trim().length > 0 && $("#login_password").val().trim().length > 0){
        $("form.formlogin").submit(function(subevt){});
      }else{
        event.preventDefault();
        return false;
      }
    });
  });
</script>

<div class="form-bg">
    <div class="container">
        <div class="row">
            <div class="formorientation col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                <div class="form-container">
                    <h3 class="title"><i class="far fa-caret-square-right"></i> Login</h3>
                    <form class="formlogin Xexternal form-horizontal" method="post" action="<?=$BASELINK?>/">
                        <div class="form-group">
                            <label for="">Benutzername</label>
                            <input type="text" name="username" id="login_username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Passwort</label>
                            <input type="password" name="password" id="login_password" class="form-control">
                        </div>
                        <input type="hidden" name="loginform" value="<?=session_id()?>">
                        
                        <button class="btn signup">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
