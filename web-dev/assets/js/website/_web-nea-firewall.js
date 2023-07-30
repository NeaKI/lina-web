
/**
 * website firewall
 */
class NeaWebsiteFirewall {
  constructor() {
    var self = this;
    self.init();
  }
  
  init() {
    var self = this;
    console.log("firewall js");
  }

  uid() {
    return Math.random().toString(16).slice(2) + Math.random().toString(16).slice(2);
  }
}

const neaWebsiteFirewall = new NeaWebsiteFirewall();
window.neaWebsiteFirewall = neaWebsiteFirewall;
