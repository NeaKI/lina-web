
/**
 * website function
 * damit die webseite, insbesondere admin backend, nicht erkannt werden, wird der path mit sha256 verschlüsselt und im switch übergeben
 */
class NeaWebsitePageFunction {
  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    self.setAjaxHeader();
  }

  setAjaxHeader(){
    var self = this;
    $.ajaxSetup({
      data: {
        "NEA-FRM-PAG": "" + self.encodePath(self.pageName())
      }
    });
  }

  encodePath(argPath){
    var _return = argPath;
    try {
      _return = Sha256.hash(argPath);
    }catch(ex){}

    return _return;
  }

  pageName() {
    return document.location.pathname;
  }

  uid() {
    return Math.random().toString(16).slice(2) + Math.random().toString(16).slice(2);
  }

  importPageJs(argFile) {
    var pageJsPath = "/assets/js/website/pageJs/";
    window.PageJs = null;
    $.getScript(pageJsPath + argFile, function()
    {
      window.PageJs = new _PageJs();
      window.PageJs.constructor();
    });
  }


  /* website funktionen */
  load(){
    var self = this;
    var pageHash = self.encodePath(self.pageName());
    console.info("ph", pageHash);

    switch(pageHash){
 
       /* /web-backend-nea/content/administration/admin-user.php  */
      case "ca9d029baf8cc282dc6081f04fd2b160c44436366e41fec1cfa565883ae31c85" :
          self.importPageJs("adm---administration---admin-user.js");
        break;

      /* /web-backend-nea/content/administration/admin-user.php  */
      case "87546ff83abdc9aa917f585184be282db0d90f01a708c6984e616b644f32088c" :
          self.importPageJs("adm---webseiten---grundeinstellung.js");
        break;
        
    }
  }

}
