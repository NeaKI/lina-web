
/**
 * website function
 */
class NeaWebsiteServerStatus {

  serverstatusByIP = {};
  serverserviceByIP = {};

  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    self.getServerStatus();
  }


  initServerStatus(){
    var self = this;
    setTimeout(function(){
        self.getServerStatus();
    }, 750);
  }


  getServerStatus(){
    var self = this;

    if($(".data-serverstat").length <= 0){
      self.initServerStatus();
      return true;
    }

    var randnum = Number(Math.random()).toString(16).substr(2);
    $.ajax({
       type: "GET",
       url: document.location.pathname + "?getserver=status",
       async: true,
       data: {"randnum": randnum},
       success: function(response, randnum) { 
        self.setServerStatus(JSON.parse(response));
       },
       complete: function() {
        self.initServerStatus();          
       }
    });
  }

  setServerStatus(argData, randnum){
    var self = this;
    $.each(argData, function(serverIP, serverData){
      $.each(serverData, function(key, val){
        /*console.log(serverIP, val);*/

        try{ $("[data-serverstat-connect='"+serverIP+"']").attr("data-serverstat-connect-value", val.connect.toString()); }catch(e){};
        try{ $("[data-serverstat-cpu-percent='"+serverIP+"']").attr("data-serverstat-cpu-percent-value", val.cpu.percent).text(val.cpu.percent.toFixed(2)); }catch(e){};
        try{ $("[data-serverstat-cpu-corespeed='"+serverIP+"']").attr("data-serverstat-cpu-corespeed-value", val.cpu.corespeed).text(val.cpu.corespeed); }catch(e){};
        try{ $("[data-serverstat-system-dateformat='"+serverIP+"']").attr("data-serverstat-system-dateformat-value", val.system.dateformat).text(val.system.dateformat); }catch(e){};
        try{ $("[data-serverstat-load-1='"+serverIP+"']").attr("data-serverstat-load-1-value", val.load[1]).text(val.load[1]); }catch(e){};
        try{ $("[data-serverstat-load-5='"+serverIP+"']").attr("data-serverstat-load-5-value", val.load[5]).text(val.load[5]); }catch(e){};
        try{ $("[data-serverstat-load-15='"+serverIP+"']").attr("data-serverstat-load-15-value", val.load[15]).text(val.load[15]); }catch(e){};
        try{ $("[data-serverstat-loadpercent-1='"+serverIP+"']").attr("data-serverstat-loadpercent-1-value", val.loadpercent[1]).text(parseFloat(val.loadpercent[1]).toFixed(2)); }catch(e){};
        try{ $("[data-serverstat-loadpercent-5='"+serverIP+"']").attr("data-serverstat-loadpercent-5-value", val.loadpercent[5]).text(parseFloat(val.loadpercent[5]).toFixed(2)); }catch(e){};
        try{ $("[data-serverstat-loadpercent-15='"+serverIP+"']").attr("data-serverstat-loadpercent-15-value", val.loadpercent[15]).text(parseFloat(val.loadpercent[15]).toFixed(2)); }catch(e){};
        try{ $("[data-serverstat-memory-free='"+serverIP+"']").attr("data-serverstat-memory-free-value", val.memory.free).text(parseFloat(val.memory.free).toFixed(4)); }catch(e){};
        try{ $("[data-serverstat-memory-percentfree='"+serverIP+"']").attr("data-serverstat-memory-percentfree-value", val.memory.percentfree).text(val.memory.percentfree); }catch(e){};
        try{ $("[data-serverstat-hdd-free='"+serverIP+"']").attr("data-serverstat-hdd-free-value", val.hdd.free).text(parseFloat(val.hdd.free).toFixed(2)); }catch(e){};
        try{ $("[data-serverstat-uptime-pretty='"+serverIP+"']").attr("data-serverstat-uptime-pretty-value", val.uptime.pretty).text(val.uptime.pretty); }catch(e){};
        try{ $("[data-serverstat-uptime-since='"+serverIP+"']").attr("data-serverstat-uptime-since-value", val.uptime.since).text(val.uptime.since); }catch(e){};

        try{ $("[data-service-time-22='"+serverIP+"']").attr("data-service-time-22-value", val.service[22].time).text(parseFloat(val.service[22].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-53='"+serverIP+"']").attr("data-service-time-53-value", val.service[53].time).text(parseFloat(val.service[53].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-80='"+serverIP+"']").attr("data-service-time-80-value", val.service[80].time).text(parseFloat(val.service[80].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-90='"+serverIP+"']").attr("data-service-time-90-value", val.service[90].time).text(parseFloat(val.service[90].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-443='"+serverIP+"']").attr("data-service-time-443-value", val.service[443].time).text(parseFloat(val.service[443].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-3306='"+serverIP+"']").attr("data-service-time-3306-value", val.service[3306].time).text(parseFloat(val.service[3306].time).toFixed(4)); }catch(e){};
        try{ $("[data-service-time-8080='"+serverIP+"']").attr("data-service-time-8080-value", val.service[8080].time).text(parseFloat(val.service[8080].time).toFixed(4)); }catch(e){};

        try{ $("[data-service-count-22='"+serverIP+"']").attr("data-service-count-value", val.service[22].count).text(parseInt(val.service[22].count)); }catch(e){};
        try{ $("[data-service-count-53='"+serverIP+"']").attr("data-service-count-value", val.service[53].count).text(parseInt(val.service[53].count)); }catch(e){};
        try{ $("[data-service-count-80='"+serverIP+"']").attr("data-service-count-value", val.service[80].count).text(parseInt(val.service[80].count)); }catch(e){};
        try{ $("[data-service-count-90='"+serverIP+"']").attr("data-service-count-value", val.service[90].count).text(parseInt(val.service[90].count)); }catch(e){};
        try{ $("[data-service-count-443='"+serverIP+"']").attr("data-service-count-value", val.service[443].count).text(parseInt(val.service[443].count)); }catch(e){};
        try{ $("[data-service-count-3306='"+serverIP+"']").attr("data-service-count-value", val.service[3306].count).text(parseInt(val.service[3306].count)); }catch(e){};
        try{ $("[data-service-count-8080='"+serverIP+"']").attr("data-service-count-value", val.service[8080].count).text(parseInt(val.service[8080].count)); }catch(e){};

        try{ $("[data-service-count-webroute='"+serverIP+"']").attr("data-webroute-value", val.webroute).text(val.webroute); }catch(e){};

        /**/
        if(self.serverstatusByIP[serverIP] == undefined){
          self.serverstatusByIP[serverIP]={};
        }

        if(self.serverstatusByIP[serverIP]["cpu.percent"] == undefined){
          self.serverstatusByIP[serverIP]["cpu.percent"] = new Array(900).fill(0);
        }
          try {
            self.serverstatusByIP[serverIP]["cpu.percent"].push(val.cpu.percent);
            self.serverstatusByIP[serverIP]["cpu.percent"] = self.serverstatusByIP[serverIP]["cpu.percent"].slice(-900); /* 15min */
          }catch(ex){}

        if(self.serverstatusByIP[serverIP]["memory.free"] == undefined){
          self.serverstatusByIP[serverIP]["memory.free"] = new Array(900).fill(0);
        }
          try {
            self.serverstatusByIP[serverIP]["memory.free"].push(val.memory.free);
            self.serverstatusByIP[serverIP]["memory.free"] = self.serverstatusByIP[serverIP]["memory.free"].slice(-900); /* 15min */
          }catch(ex){}
        /**/

        if(self.serverserviceByIP[serverIP] == undefined){
          self.serverserviceByIP[serverIP] = new Array(900).fill(0);
        }
          try {
            let serverserviceByIPSum = parseFloat((val.service[22].time + val.service[53].time + val.service[80].time + val.service[90].time + val.service[3306].time + val.service[8080].time) / 6).toFixed(4);
            self.serverserviceByIP[serverIP].push(serverserviceByIPSum);
          }catch(ex){}
        



      });
    });
  }


}

const neaWebsiteServerStatus = new NeaWebsiteServerStatus();
