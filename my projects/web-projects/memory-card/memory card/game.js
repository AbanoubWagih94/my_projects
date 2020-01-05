function box(img, id) {
  this.img = img;
  this.id = id;
  this.exposed = false;
  this.string = '<div class="box" id="' + id + '"" onclick="game.check(this)"><div class="content center-block">' +
    '<img class="img-responsive center-block" src="' + img + '"></img></div>' +
    '<div class="covers"><img src="images/cover.png" class="img-responsive center-block"></div></div>';
  this.draw = function() {
    return this.string;
  };
}

var click = new Audio('sounds/click.mp3');
var fire = new Audio('sounds/Fireworks.mp3');
var win = new Audio('sounds/winner.mp3');
var game = {
  images: ['images/1.png', 'images/2.png',
    'images/3.png', 'images/4.png',
    'images/5.png', 'images/6.png',
    'images/7.png', 'images/8.png'
  ],
  toggleMute : function(x){
    var m = document.getElementById("audio");
     if(m.muted){
      x.className = "glyphicon glyphicon-volume-off text-info";
      m.muted = false;
     }else{
      x.className = "glyphicon glyphicon-volume-up text-info";
      m.muted = true;
    }
  },
  start: function() {
    this.s = 0;
    this.m = 0;
    this.exposed = false;
    this.exposedId = null;
    this.gameBoard = [];
    this.originalBoard = [];
    this.success = 0;
    this.timer = null;
    this.tries = 0;
    document.getElementById("timer").innerHTML = "0:0";
    document.getElementById("tries").innerHTML = "0";
    document.getElementById("audio").volume = 0.2;
    document.getElementById("audio").muted = false;
    fire.muted = true;
    win.muted = true;
    fire.loop = false;
    this.timer = setInterval(function() {
      game.s++;
      if (game.s == 60) {
        game.m++;
        game.s = 0;
      }
      document.getElementById('timer').innerHTML = game.m + ":" + game.s;
    }, 1000);

    for (var i = 0, j = this.images.length; i < this.images.length; i++, j++) {

      this.gameBoard[i] = new box(this.images[i], i);
      this.gameBoard[j] = new box(this.images[i], j);
      this.originalBoard[i] = new box(this.images[i], i);
      this.originalBoard[j] = new box(this.images[i], j);

    }

    for (var i = 0; i < this.gameBoard.length; i++) {

      var temp = Math.floor(Math.random() * this.gameBoard.length);
      var temp1 = Math.floor(Math.random() * this.gameBoard.length);
      var temp3 = this.gameBoard[temp];
      this.gameBoard[temp] = this.gameBoard[temp1];
      this.gameBoard[temp1] = temp3;

    }

    this.render();
    setTimeout(function() {
      var items = document.getElementsByClassName("covers");
      var len = items.length;
      for (var i = 0; i < len; i++) {
        items[i].setAttribute("class", "covers cover");
      }
    }, 1500);
  },

  render: function() {
 
    var ret = "";

    for (var i = 0; i < this.gameBoard.length; i++) {
      ret += this.gameBoard[i].draw();
    }
    ret += '<div id="win"></div>';

    document.getElementById('wrapper').innerHTML = ret;
  },
  check: function(self) {
   $("#wrapper").fireworks('destroy');
    if (!this.originalBoard[self.id].exposed) {

      click.play();
      self.lastElementChild.style.height = 0;
      if (!this.exposed) {

        this.exposed = true;
        this.exposedId = self.id;
        this.originalBoard[self.id].exposed = true;

      } else {

        if (this.originalBoard[self.id].img != this.originalBoard[this.exposedId].img) {
          this.tries++;
          document.getElementById('tries').innerHTML = this.tries;

          setTimeout(function() {
            document.getElementById(game.exposedId).lastElementChild.style.height = "100%";
            self.lastElementChild.style.height = "100%";
            this.exposedId = null;
          }, 400);

          this.originalBoard[self.id].exposed = this.originalBoard[this.exposedId].exposed = false;

        } else {

          this.originalBoard[self.id].exposed = this.originalBoard[this.exposedId].exposed = true;
          this.success++;

        }
        this.exposed = false;

      }
    }
    if (this.success == this.originalBoard.length / 2) {
      document.getElementById("audio").muted = true;
      fire.muted = false;
      win.play();
      fire.play();
      fire.loop = true;
      win.muted = false;
      clearInterval(this.timer);
      document.getElementById("wrapper").innerHTML = '<div id="win">'+
      '<p id="win-p" class="text-center">!مبروك</p></div>'+
      '<input type="button" onclick="game.start();" style="padding:20px; font-size:75;" value="لعبه جديده" class="btn btn-success center-block">';
      $("#wrapper").fireworks();
      document.getElementById("win-p").style.opacity = "1";
    }
  },

};

function start() {
  game.start();
}
window.addEventListener('load', start, false);