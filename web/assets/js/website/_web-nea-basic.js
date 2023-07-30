
/**
 * website function
 */
class NeaWebsiteBasic {
  sechash = null;

  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    self.ajaxSetup();
    self.getFormHash();
    self.colorCellPick();
  }

  uid() {
    return Math.random().toString(16).slice(2) + Math.random().toString(16).slice(2);
  }

  colorPicker(argSelector, argColor, argDefault, argActionName, argActionSwitch) {
    var self = this;

    var pickerId = "colorpickercontainer";
    var colorPickerClass = null;
    var lastColor = argColor;
    var defaultColor = argDefault;

    window._colorPicker = null;
    window._argColorPickerSelector = argSelector || window._argColorPickerSelector;
    window._argColorPickerColor = argColor || _argColorPickerColor;
    window._argColorPickerDefault = argDefault || window._argColorPickerDefault;
    window._argColorPickerActionName = argActionName || window._argColorPickerActionName;
    window._argColorPickerActionSwitch = argActionSwitch || window._argColorPickerActionSwitch;
    window._argColorPickerLastColor = lastColor || window._argColorPickerLastColor;

    if(window._argColorPickerColor == undefined){
      window._argColorPickerColor = "#fff";
    }

    return {

      start() {

        if($(".pickshow").length > 0){
          return false;
        }
        $(window._argColorPickerSelector).addClass("pickshow");
        var subself = this;
        try {
          /* subself.stop(); */
          var pickerContainer = "<div id='"+pickerId+"' style='position:absolute;'></div>";
          $(window._argColorPickerSelector).append(pickerContainer);

          /* $("#" + pickerId).css({ "top" : parseInt($(window._argColorPickerSelector).offset().top), "left" : parseInt($(window._argColorPickerSelector).offset().left) }); */

          $("#" + pickerId).append('<table class="vertical-middle"><tr><td class="pickleft"></td><td class="pickmiddle"></td><td class="pickright"></td></tr></table>');

          self.colorPickerClass = new iro.ColorPicker("#" + pickerId + " .pickmiddle", {
            width: 200,
            color: window._argColorPickerColor,
            display: 'block',
            borderWidth: 0,
            borderColor: "#000"
          });
          window._colorPicker = self.colorPickerClass;

          $("#" + pickerId + " .pickmiddle").append("<div class='row previewcolor'></div>");

          $("#" + pickerId + " .pickright").append("<div class='container pickbottons'></div>");
          $("#" + pickerId + " .pickbottons").append("<div class='container'></div>");
          $("#" + pickerId + " .pickbottons .container").append("<div class='row col-12'><p><button type='button' class='btn btn-secondary bttn_standard w-100'>Standard</button></p></div>");
          $("#" + pickerId + " .pickbottons .container").append("<div class='row col-12'><p><button type='button' class='btn btn-warning bttn_cancel w-100'>Abbrechen</button></p></div>");
          $("#" + pickerId + " .pickbottons .container").append("<div class='row col-12'><p><button type='button' class='btn btn-success bttn_save w-100'>Speichern</button></p></div>");
          
          $("#" + pickerId + " .pickbottons .container .bttn_cancel").on("click touch", function(){
            subself.stop();
          });

          $("#" + pickerId + " .pickbottons .container .bttn_save").on("click touch", function(){
            subself.save();
          });

          $("#" + pickerId + " .pickbottons .container .bttn_standard").on("click touch", function(){
            window._argColorPickerColor = window._argColorPickerDefault;
            subself.stop();
            subself.start();
          });

          self.colorPickerClass.on(['color:init', 'color:change'], function(color) {
            self.lastColor = color.hexString;
            window._argColorPickerLastColor = color.hexString;
            $("#" + pickerId + " .pickmiddle .previewcolor").css('background', self.lastColor).text(self.lastColor);
            $("#" + pickerId).css('background', self.lastColor);
          });

        }catch(ex){}
      },

      stop() {
        $("#" + pickerId).remove();
        $(".pickshow").removeClass("pickshow");
      },

      destroy() {
        this.stop();
      },

      remove() {
        this.stop();
      },

      getColor() {
        return self.lastColor;
      },

      setColor(color) {
      },

      updatePreviewColor() {

      },

      save(){
        var subself = this;

        var _postdata = neaWebsiteBasic_LocalLink.postData({
          "actionname" : window._argColorPickerActionName,
          "function" : window._argColorPickerActionName,
          "colorname" : window._argColorPickerActionSwitch,
          "colorvalue" : window._argColorPickerLastColor,
        });

        if(_postdata.returncode == true || _postdata.returncode >= 1){
          $(window._argColorPickerSelector).css("background", window._argColorPickerLastColor);

            var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
            notifyOptions.text = [window._argColorPickerActionSwitch, "Neue Farbe wurde gespeichert"];
            notifyOptions.icon = "success";
            window.neaWebsiteBasic_LocalLink.loadLink(document.location.pathname);
            $.toast(notifyOptions);
        }

        this.stop();
      }

    };

  }

  colorCellPick() {
    var self = this;
    $("body").off("click touch", ".color-cell-pick.pickbox").on("click touch", ".color-cell-pick.pickbox:not(pickshow)", function(){
      if($(".pickshow").length > 0){
        return false;
      }
      self.colorPicker(this, $(this).attr("data-current"), $(this).attr("data-default"), $(this).attr("data-action"), $(this).attr("data-id")).start();
    });
  }


  ajaxSetup(){
    $.ajaxSetup({
      url: document.location.pathname,
      type:'POST',
      data: {
        "NEA-REQ-SRV": document.location.host,
        "NEA-SEC-HSH": $("#neasecses").val(),
        "NEA-REQ-FRM": "NEA-GET-HSH"
      }
    });
  }


  getFormHash(){
    try {
      $.ajax({
          async:false,
          success: function(data, textStatus, request)
          {
            $.ajaxSetup({
              data: {
                "NEA-SEC-HSH": "" + request.getResponseHeader('NEA-SND-HSH'),
                "NEA-REQ-FRM": "NEA-SND-FRM"
              },
              error: function(httpObj, textStatus) {
                try{
/*                  if(httpObj.status == 401){
                    var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
                    notifyOptions.heading = "Fehler beim Senden der Daten";
                    try {
                      notifyOptions.text = ["ERROR 401"];
                      notifyOptions.icon = "error";
                      $.toast(notifyOptions);
                    }catch(ex){}
                  }*/
                }catch(ex){}
              }
            });
          }
      });
    }catch(ex){ console.warn(ex); }
  }

}

$(document).ready(function() {
  const neaWebsiteBasic = new NeaWebsiteBasic();
  window.neaWebsiteBasic = neaWebsiteBasic;
});

window.notifyOptions = {
    heading: '',
    text: '',
    position: 'top-center',
    stack: false,
    hideAfter: 3000,
    loader: true,
    loaderBg: '#ffffff',
    showHideTransition: 'slide',
    stack: true,
    stack: 3,
    icon: 'info'
};
