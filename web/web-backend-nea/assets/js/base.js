
/**
 * website function
 */
class NeaWebsiteAdmin {

  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    self.administration_adminuser_overview();
  }



  /* admin user button action */
  administration_adminuser_overview(){
    var self = this;
    $("body").on("click touch", ".saveadminvalues", function(ev){
      let adminId = $(this).data("admin-id");
      if(adminId <= 0){
        return;
      }
      let returnForm = neaWebsiteBasic_LocalLink.getFormData("[data-admin-id='"+adminId+"']");
      returnForm.id = adminId;
      let returnpostval = neaWebsiteBasic_LocalLink.postData(returnForm);
      var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
      notifyOptions.heading = "Admin User Änderung";
      console.log(returnpostval);
      if(returnpostval.returncode == true){
        notifyOptions.text = ["Daten wurden aktualisiert"];
        notifyOptions.icon = "success";
      }else{
        notifyOptions.text = ["Daten wurden nicht aktualisiert"];
        notifyOptions.icon = "error";
      }
      $.toast(notifyOptions);
    })
  }
}

const neaWebsiteAdmin = new NeaWebsiteAdmin();