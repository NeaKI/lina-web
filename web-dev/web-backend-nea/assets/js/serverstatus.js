
/**
 * website function
 */
class NeaWebsiteServerStatus {

  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    self.getServerStatus();
    self.initServerStatus();
  }


  initServerStatus(){
    var self = this;
    setTimeout(function(){
        self.getServerStatus();
        self.initServerStatus();
    }, 3000);
  }


  getServerStatus(){
    var self = this;
    console.log("server status");

    $.ajax({
       type: "GET",
       url: document.location.pathname + "?getserver=status",
       async: false,
       data: {},
       success: function(response) { 
        var returnVal = JSON.parse(response); 
        console.log(returnVal);
      }
    });
  }


}

const neaWebsiteServerStatus = new NeaWebsiteServerStatus();