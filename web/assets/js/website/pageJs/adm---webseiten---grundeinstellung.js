
/**
 * website function
 */
function _PageJs() {

  return {

    constructor() {
      var self = this;
      self.init();
    },
    
    init() {
      var self = this;
      self.btnNavigationMainAdd();
      self.btnNSubavigationMainAdd();
      self.deleteMainNavItem();
      self.sortableMainMenuTable();
      self.sortableSubMenuTable();
      self.editNavTitle();
    },

    btnNavigationMainAdd() {
      var self = this;
      $('#btnAddMainMenu').off().on("submit", function(){
      });
    },

    btnNSubavigationMainAdd() {
      var self = this;
      $('.btnAddSubMainMenu').off().on("submit", function(){
      });
    },

    deleteMainNavItem() {
      var self = this;
      $('.deletemainnavitem').off().on("click touch", function(){
        var itemId = $(this).attr("data-nav-id");
        var itemName = $(this).attr("data-nav-name");
        
        if(itemId <= 0){
          return;
        }

        $.confirm({
            text: "Möchtest du den Menüpunkt löschen?<br><b>" + itemName + "</b>",
            confirm: function(button) {
              $(".confirmation-modal, .modal-backdrop").remove();
                var returnVal = neaWebsiteBasic_LocalLink.postData({
                  "function" : "navigation-delete-mainitem",
                  "menuitem-id" : itemId
                });
          
                var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
                notifyOptions.heading = "Menüpunkt löschen";
                try {
                  $(".confirmation-modal, .modal-backdrop").remove();
                  if(returnVal.returncode == true || returnVal.returncode >= 1){
                    neaWebsiteBasic_LocalLink.loadLink(document.location.href);
                    notifyOptions.text = ["Menüpunkt gelöscht"];
                    notifyOptions.icon = "success";
                    $.toast(notifyOptions);
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

      });
    },

    sortableMainMenuTable() {
      $("#sortableNavItemsConfig").sortable({
        items: ".sort_mainnav",
        change: function( event, ui ) {
          /**/
        },
        update: function( event, ui ) {
          var sortIdValue = [];
          $("#sortableNavItemsConfig .sort_mainnav").each(function( index ) {
            sortIdValue.push($(this).attr("data-row-id"));
            $(this).find(".mainrownumber").text(index +1);
          });

          var returnVal = neaWebsiteBasic_LocalLink.postData({
            "function" : "navigation-sortid-mainitem",
            "sortby" : sortIdValue
          });
          
        }
      });
    },

    sortableSubMenuTable() {
      $(".sortableSubNavItemsConfig").sortable({
        items: ".sort_subnav",
        change: function( event, ui ) {
          /**/
        },
        update: function( event, ui ) {
          var sortIdValue = [];

          $(event.target).find(".sort_subnav").each(function( index ) {
            sortIdValue.push($(this).attr("data-row-id"));
            $(this).find(".subrownumber").text(index +1);
          });

          var returnVal = neaWebsiteBasic_LocalLink.postData({
            "function" : "navigation-sortid-mainitem",
            "sortby" : sortIdValue
          });
          
        }
      });
    },

    editNavTitle() {
      $('.editnavtitle').off("click touch").on('click touch', function() {
        var itemName = $(this).parent().find(".editnavtitletext").text();
        var itemId = $(this).attr("data-row-id");
        $.confirm({
            text: 'Name überschreiben:<br><b>' + itemName + '</b><br><hr>' + '<div class="input-group p-has-icon"> <input type="text" id="confirmboxinput" name="title" placeholder="'+itemName+'" value="'+itemName+'" class="form-control"> <span class="p-field-cb"></span> </div>',
            confirm: function(button) {
              var newtitle = $("#confirmboxinput").val();
              $(".confirmation-modal, .modal-backdrop").remove();
                var returnVal = neaWebsiteBasic_LocalLink.postData({
                  "function" : "navigation-rename-mainitem",
                  "menuitem-id" : itemId,
                  "title" : newtitle
                });
          
                var notifyOptions = jQuery.extend(true, {}, window.notifyOptions);
                notifyOptions.heading = "Menü Name";
                try {
                  $(".confirmation-modal, .modal-backdrop").remove();
                  if(returnVal.returncode == true || returnVal.returncode >= 1){
                    neaWebsiteBasic_LocalLink.loadLink(document.location.href);
                    notifyOptions.text = newtitle;
                    notifyOptions.icon = "success";
                    $.toast(notifyOptions);
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
            confirmButton: "Speichern",
            cancelButton: "Abbrechen"
        });

      });
    }



  }
}
