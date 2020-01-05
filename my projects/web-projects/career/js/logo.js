  var logo = {
    flipped:false,
    foreFace:document.getElementById('fore-logo'),
    backFace:document.getElementById('back-logo'),
    flipp : function() {
      if( logo.flipped){
         logo.foreFace.style.transform = "rotateY(180deg)";
         logo.backFace.style.transform = "rotateY(0deg)";
      }else{
         logo.foreFace.style.transform = "rotateY(0deg)";
         logo.backFace.style.transform = "rotateY(180deg)";
      }
       logo.flipped = !logo.flipped;
    }
  }


  setInterval(logo.flipp,2000);