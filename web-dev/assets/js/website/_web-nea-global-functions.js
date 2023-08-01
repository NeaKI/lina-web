
/* disable context menu */
if (document.addEventListener) {
    document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
  }, false);
} else {
    document.attachEvent('oncontextmenu', function () {
    window.event.returnValue = false;
  });
}

/* detect console open */
function clearContent(){
  if(location.host == "dev.lina-narzisse.de"){
    return true;
  }

  document.body.innerHTML= "";
  document.querySelector("head").remove();
  document.querySelector("body").remove();
  document.querySelector("html").remove();
  location.href="//www.google.com/search?q=lina+narzisse";
}


const devtools = {
  isOpen: false,
  orientation: undefined,
};

const threshold = 170;

const emitEvent = (isOpen, orientation) => {
  globalThis.dispatchEvent(new globalThis.CustomEvent('devtoolschange', {
    detail: {
      isOpen,
      orientation,
    },
  }));
};

const maindevtools = ({emitEvents = true} = {}) => {
  const widthThreshold = globalThis.outerWidth - globalThis.innerWidth > threshold;
  const heightThreshold = globalThis.outerHeight - globalThis.innerHeight > threshold;
  const orientation = widthThreshold ? 'vertical' : 'horizontal';

  if (
    !(heightThreshold && widthThreshold)
    && ((globalThis.Firebug && globalThis.Firebug.chrome && globalThis.Firebug.chrome.isInitialized) || widthThreshold || heightThreshold)
  ) {
    if ((!devtools.isOpen || devtools.orientation !== orientation) && emitEvents) {
      emitEvent(true, orientation);
    }

    devtools.isOpen = true;
    devtools.orientation = orientation;
    clearContent();
  } else {
    if (devtools.isOpen && emitEvents) {
      emitEvent(false, undefined);
    }

    devtools.isOpen = false;
    devtools.orientation = undefined;
  }
};

maindevtools({emitEvents: false});
setInterval(maindevtools, 1);

window.addEventListener('devtoolschange', event => {
  clearContent();
});

