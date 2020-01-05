/*
*
*
       ********************************************           3AM          *************************************************************
*
*
*/

grid = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
win = [[0, 1, 2], [3, 4, 5], [6, 7, -1]];
delta_rows = [1, -1, 0, 0];
delta_cols = [0, 0, 1, -1];
steps = 0;
var bgsound = new Audio("tracks/music.mp3");
bgsound.play();
bgsound.loop = true;
var audio = new Audio('tracks/move.mp3');
var fire = new Audio('tracks/fireworks.mp3');
var winner = new Audio('tracks/winner.mp3');
tog=true;
count=0;
won=false;
cc=true;
as=true;
function pntArray(){
	prnt = "";
	for(i=0; i<3; i++){
		for(j=0; j<3; j++){
			prnt += grid[i][j] + " ";
		}
		prnt += "\n";
	}
	alert(prnt);
}

function Build(){
	var rand = Math.floor(Math.random()*3)+1;
	document.getElementById("sub-img").src = "images/"+(rand)+"/full.png";
	for(i=0; i<3; i++){
		for(j=0; j<3; j++){
			img_source = "images/"+(rand)+"/";
			ID = i + "_" + j;
			img_source += grid[i][j] + ".png";
			document.getElementById(ID).src = img_source;
		}
	}
}

function check_pattern(){
	for(i=0; i<3; i++)
		for(j=0; j<3; j++)
			if(grid[i][j] != win[i][j])
				return false;
	return true;
}

function new_game(){
	steps = 0;
	document.getElementById("STEP").innerHTML = steps;
	check = [0, 0, 0, 0, 0, 0, 0, 0, 0];
	for(i=0; i<3; i++)
		for(j=0; j<3; j++)
			grid[i][j] = -1;
	for(i=0; i<8; i++){
		x = Math.floor(Math.random() * 9);
		while(check[x] != 0) x = Math.floor(Math.random() * 9);
		check[x] = 1;
		grid[Math.floor(x/3)][x%3] = i;
	}
    tempoo = grid[2][2];
    grid[2][2]=grid[2][1];
    grid[2][1]=tempoo;
	if(check_pattern()) new_game();
	  Timer(count);
	  count++;
}
function Timer(T){

       seconds=0, minutes=0;
       document.getElementById('timer').innerHTML = '00' + ":" + '00';
       if(T==0)
       {
       ti = setInterval(
       function() {
       seconds++;
       if (seconds == 60) {
       minutes++;
       seconds = 0;
                    }
       document.getElementById('timer').innerHTML = (minutes < 10 ? "0" + minutes : minutes) + ":" 
       									+ (seconds < 10 ? "0" + seconds : seconds); }, 1000);
       }
                 }
    function new_win() {
    	  winner.muted = true;
    	  fire.muted=true;
          document.getElementById("wrapper").innerHTML =
          '<div id="game" class="float">'+
          '<img id="0_0" src="images/1/0.png" class="img" onClick="play(0, 0);"></img>\n'+
          '<img id="0_1" src="images/1/1.png" class="img" onClick="play(0, 1);"></img>\n'+
          '<img id="0_2" src="images/1/2.png" class="img" onClick="play(0, 2);"></img>\n'+
          '<img id="1_0" src="images/1/3.png" class="img" onClick="play(1, 0);"></img>\n'+
          '<img id="1_1" src="images/1/4.png" class="img" onClick="play(1, 1);"></img>\n'+
          '<img id="1_2" src="images/1/5.png" class="img" onClick="play(1, 2);"></img>\n'+
          '<img id="2_0" src="images/1/6.png" class="img" onClick="play(2, 0);"></img>\n'+
          '<img id="2_1" src="images/1/7.png" class="img" onClick="play(2, 1);"></img>\n'+
          '<img id="2_2" src="images/1/-1.png"class="img" onClick="play(2, 2);"></img>\n'+
          '</div>'+
          '<div class="float" id="sub-image"><img id="sub-img" src="images/1/full.png"></div>'+
  		  '</div>';
	}
function Build_new(){
	    if(won && as)
	    {
	    	bgsound.muted=false;
	    }
	    if (won) {
	    	new_win();
	    } 
		if(tog) {
		document.getElementById("btn").value = "لعبه جديدة";
		document.getElementById("btn").style.marginLeft = '8%';
		tog=false;
		}
	new_game();
	Build();
	$("#wrapper").fireworks('destroy');
	document.getElementById("STEP").value = steps;
}

function check_Move(row, col){
	return (row >= 0 && row < 3 && col >= 0 && col < 3);
}
function tracks(){
	var ele = document.getElementById("on");
	if (!bgsound.muted)
	{
        ele.className = "glyphicon glyphicon-volume-up text-info";
        audio.muted=true;
        bgsound.muted=true;
        as=false;
	}
	else 
	{
        ele.className = "glyphicon glyphicon-volume-off text-info";
		audio.muted=false;
		bgsound.muted=false;
		as=true;
	}
}

function play(row, col){
	if(grid[0][0] == grid[0][1]){
		alert("Start new game!");
		return;
	}
	valid = false;
	for(i=0; i<4; i++){
		new_row = row + delta_rows[i];
		new_col = col + delta_cols[i];
		if(check_Move(new_row, new_col) && grid[new_row][new_col] == -1){
			steps++;
			valid = true;
			from = row + "_" + col;
			to = new_row + "_" + new_col;
			tmp_src = document.getElementById(from).src;
			document.getElementById(from).src = document.getElementById(to).src;
			document.getElementById(to).src = tmp_src;
			tmp_var = grid[row][col];
			grid[row][col] = grid[new_row][new_col];
			grid[new_row][new_col] = tmp_var;
			break;
		}
	}
	document.getElementById("STEP").innerHTML = steps;
	if(check_pattern()){ // cc==true  check_pattern()   
		won=true;
		count=0;
		grid[0][0] = grid[0][1];
		bgsound.muted=true;
		fire.muted = false;
        winner.play();
        fire.play();
        fire.loop = true;
        winner.muted = false;
        clearInterval(ti);
        document.getElementById("wrapper").innerHTML =
        '<div id="winnn">'+
        '<h1 id="win-p" style="font-size:200; margin-top:23%;" class="text-center">!مبروك</h1></div>';
        $("#wrapper").fireworks();
       document.getElementById("win-p").style.opacity = "1";
	}
}