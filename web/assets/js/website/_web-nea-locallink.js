
/**
 * local links
 * smart loader
 */
class NeaWebsiteBasic_LocalLink {
  smartClass = "hrefsmartlink";
  loadElement = "#bodypage";
  zozoActiveTab = 1;

  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;

    window.neaWebsitePageFunction = new NeaWebsitePageFunction();
    window.neaWebsitePageFunction.load();

    self.getClientIpToSession();
    self.getLinks();
    self.onClick();
    self.formSubmit();
    self.zozoTabs();
    self.disableDragableImages();
  }

  getClientIpToSession() {
    try {
      $.ajax({
         type: "POST",
         url: "https://sys.lina-narzisse.de/cdata.php",
         async: true,
         data: {},
         success: function(response) { 

          $.ajax({
             type: "POST",
             url: document.location.pathname + "?cdata=true",
             async: true,
             data: {"cdata": response},
             success: function(response) { 
              console.log(response);
             }
          });

         }
      });
    }catch(e){}
  }

  getLinks() {
    var self = this;
    $('a').not(".externallink").each(function(index, value){
      try {
        if($(this).attr("href").substr(0,5) != "http:"){
          self.addClass(this);
        }
      }catch(ex){}
    });
  }

  addClass(argElement) {
    var self = this;
    if(!$(argElement).hasClass(self.smartClass)){
      $(argElement).addClass(self.smartClass);
    }
  }

  onClick() {
    var self = this;
    $("a." + self.smartClass).off("click touch").on("click touch", function(elem) {
      if($(this).hasClass(self.smartClass)){
        let url = $(this).attr("href");
        if(url != "#"){
          elem.stopPropagation();
          elem.preventDefault();
          if(url.substr(0,1) == "#"){
            url = "/" + url;
          }
          self.zozoActiveTab = 1;
          self.loadLink(url);
          self.afterOnClick();
          return false;
        }
      }
    });
  }

  afterOnClick() {
    var self = this;
    $(".dropdown-menu.show").removeClass("show");
  }

  loadLink(argUrl) {
    var self = this;

    let emptyError = false;
    let maxError = 1000;
    do{
      if($(self.loadElement).length >= 1){
        try {
          $(self.loadElement).html('');
          emptyError = false;
        }catch(e){
          emptyError = true;
        }
      }
    }while(emptyError && --maxError >= 0);

    let newUrl = argUrl + "?" + self.smartClass + "=true";
    $(".preloader-container").stop().show(0);
    history.replaceState({}, argUrl, argUrl);
    history.pushState({page:argUrl}, '', argUrl);
    $(self.loadElement).load(newUrl, function(data) {
      self.loadAfter();
    });
  }

  getFormData(argSelector) {
    var self = this;
    var formValues = jQuery(argSelector).serializeArray();
    formValues = formValues.concat(
      jQuery(argSelector + " [type='checkbox']:not(:checked),"+argSelector + "[type='checkbox']:not(:checked)").map(
        function() {
            return {"name": this.name, "value": 0}
        }
      ).get()
    );
    var returnFormValues = {};
    $.each(formValues, function(index, value) {
      returnFormValues[value.name] = value.value;
    }); 

    return returnFormValues;
  }

  formSubmit() {
    var self = this;
    $("body").off("submit", "form:not('.external')").on("submit", "form:not('.external')", function(elem) {
      self.zozoActiveTab = 1;
      elem.stopPropagation();
      elem.preventDefault();

        let uid = neaWebsiteBasic.uid();
        $(this).attr("data-form-id", uid);
        let formData = self.getFormData("[data-form-id='"+uid+"']");
      
      let postData = self.postData(formData);

      if($(this).hasClass("formlogin")){
        try {
          var notifyOptionsLog = jQuery.extend(true, {}, window.notifyOptions);
          notifyOptionsLog.heading = "LogIn";
          if(postData.login){
            notifyOptionsLog.text = ["Login erfolgreich"];
            notifyOptionsLog.icon = "success";
            $.toast(notifyOptionsLog);
            location.reload();
          }else{
            notifyOptionsLog.text = ["Login fehlgeschlafen"];
            notifyOptionsLog.icon = "error";
            $.toast(notifyOptionsLog);
          }
        }catch(ex){}
        return true;
      }else{
      
        var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
        var activeTab = 0;
        notifyOptions.heading = "Formular";
        try {
          if(postData.returncode == true || postData.returncode >= 1){
            notifyOptions.text = ["Daten gespeichert"];
            notifyOptions.icon = "success";
            if($(".tabbed-nav .z-tab").length > 0){
              self.zozoActiveTab = $(".tabbed-nav .z-tab.z-active").index() +1;
            }

            self.loadLink(document.location.pathname);
          }else{
            notifyOptions.text = ["Fehler", postData.returncode];
            notifyOptions.icon = "error";
          }
        }catch(ex){}

        $.toast(notifyOptions);

      }

      return postData;
      
    });
  }

  postData(argData) {
    var self = this;
      $(".preloader-container").stop().show(0);
      argData.postdata = "postdata";
      let returnVal = {};
      self.zozoActiveTab = 1;

        $.ajax({
           type: "POST",
           url: document.location.pathname + "?" + self.smartClass + "=true",
           async: false,
           data: argData,
           success: function(response) { returnVal = JSON.parse(response); }
        });

      if($(".tabbed-nav .z-tab").length > 0){
        self.zozoActiveTab = $(".tabbed-nav .z-tab.z-active").index() +1;
      }
      console.info(returnVal);

      return returnVal;
  }

  disableDragableImages(){
    $('img').attr('draggable', false);
    $('img').off('dragstart').on('dragstart', function () {
        return false;
    });
  }

  loadAfter() {
    var self = this;

    window.neaWebsitePageFunction = new NeaWebsitePageFunction();
    window.neaWebsitePageFunction.load();
    self.getLinks();
    self.onClick();
    self.formSubmit();
    self.zozoTabs();
    self.disableDragableImages();
    $(".preloader-container").stop().hide(0);
  }

  deleteAdministrator(argId, argName){
    var self = this;
    $.confirm({
        text: "Möchtest du den Administrator unwiderruflich löschen?<br><b>" + argName + "</b>",
        confirm: function(button) {
          $(".confirmation-modal, .modal-backdrop").remove();
            var returnVal = self.postData({
              "function" : "deleteadmin",
              "deleteid" : argId,
              "deleteadmin" : argId,
              "deletename" : argId,
              "deleteconfirm" : 1
            });
      
            var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
            notifyOptions.heading = "Administrator löschen";
            try {
              $(".confirmation-modal, .modal-backdrop").remove();
              if(returnVal.returncode == true || returnVal.returncode >= 1){
                self.loadLink(document.location.pathname);
              }else{
                notifyOptions.text = ["Fehler", returnVal.returncode];
                notifyOptions.icon = "error";
                $.toast(notifyOptions);
              }
            }catch(ex){}

            console.log(returnVal);
        },
        cancel: function(button) {
          $(".confirmation-modal, .modal-backdrop").remove();
        },
        confirmButton: "Ja",
        cancelButton: "Nein"
    });
  }

  zozoTabs() {
    var self = this;

    $(".tabbed-nav").zozoTabs({
      theme: "silver",
      orientation: "horizontal",
      position: "top-left",
      size: "medium",
      animation: {
        easing: "easeInOutExpo",
        duration: 400,
        effects: "slideH",
      },
      defaultTab: "tab" + self.zozoActiveTab
    });
  }
}

$(document).ready(function() {
  const neaWebsiteBasic_LocalLink = new NeaWebsiteBasic_LocalLink();
  window.neaWebsiteBasic_LocalLink = neaWebsiteBasic_LocalLink;
});

/* loader animation */