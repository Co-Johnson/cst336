// Variables
var gameScreen;
var output;

var bullets;

var ship;
var enemies = new Array();
var blueOrb;

var gameTimer;
var currentCount = 0;

var autoFire = false;
var autoFireCount = 0;

var gameOver = false;

var score = 0;

var leftArrowDown = false;
var rightArrowDown = false;

var bg1, bg2;
const BG_SPEED = 4;

const GS_WIDTH = 800;
const GS_HEIGHT = 600;

var highScore;
if(localStorage.getItem("highScore") == null){
    highScore = 0;
}
else{
    highScore = localStorage.getItem("highScore");
}

//functions

function fire(){
	var bulletWidth = 4;
	var bulletHeight = 10;
	var bullet = document.createElement('DIV');
	bullet.className = 'gameObject';
	bullet.style.backgroundColor = 'yellow';
	bullet.style.width = bulletWidth + 'px';
	bullet.style.height = bulletHeight + 'px';
	bullet.speed = 20;
	bullet.style.top = parseInt(ship.style.top) - bulletHeight + 'px';
	var shipX = parseInt(ship.style.left) + parseInt(ship.style.width)/2;
	bullet.style.left = (shipX - bulletWidth/2) + 'px';
	bullets.appendChild(bullet);
	
}

function placeEnemyShip(e){
	e.speed = Math.floor(Math.random()*10) + 6;
	
	var maxX = GS_WIDTH - parseInt(e.style.width);
	var newX = Math.floor(Math.random() * maxX);
	e.style.left = newX + 'px';
	
	var newY = Math.floor(Math.random() * 600) - 1000;
	e.style.top = newY + 'px';
}

function placeBlueOrb(orb){
	orb.speed = Math.floor(Math.random()*10) + 6;
	
	var maxX = GS_WIDTH - parseInt(orb.style.width);
	var newX = Math.floor(Math.random() * maxX);
	orb.style.left = newX + 'px';
	
	var newY = Math.floor(Math.random() * 600) - 5000;
	orb.style.top = newY + 'px';
}



function hittest(a,b){
	var aW = parseInt(a.style.width);
	var aH = parseInt(a.style.height);
	// get center point of object a
	var aX = parseInt(a.style.left) + aW/2;
	var aY = parseInt(a.style.top) + aH/2;
	// get radius of object a (average of height and width /2)
	var aR = (aW + aH) / 4;
	
	var bW = parseInt(b.style.width);
	var bH = parseInt(b.style.height);
	// get center point of object a
	var bX = parseInt(b.style.left) + bW/2;
	var bY = parseInt(b.style.top) + bH/2;
	// get radius of object a (average of height and width /2)
	var bR = (bW + bH) / 4;
	
	var minDistance = aR + bR;
	
	var cXs = (aX - bX) * (aX - bX); // change in X squared
	var cYs = (aY - bY) * (aY - bY); // change in Y squared
	var distance = Math.sqrt(cXs + cYs);
	
	if(distance < minDistance){
		return true;
	}
	else{
		return false;
	}
	
}

function init(){
    $('body').css("background-color", "black");
    
    $('.replayBtn').hide();
    
    if(highScore > 0){
        $("#highScore").append("High score: " + highScore);
    }
    
    gameScreen = document.getElementById('gameScreen');
    
    $('#gameScreen').css("width", GS_WIDTH + 'px');
    $('#gameScreen').css("height", GS_HEIGHT + 'px');
	//gameScreen.style.width = GS_WIDTH + 'px';
	//gameScreen.style.height = GS_HEIGHT + 'px';
	
	bg1 = document.createElement('IMG');
	bg1.className = 'gameObject';
	bg1.src = 'img/bg.jpg';
	
	bg1.style.width ='800px';
	bg1.style.height = '1422px';
	bg1.style.left= '0px';
	bg1.style.top = '0px';
	
	$('#gameScreen').append(bg1);
	//gameScreen.appendChild(bg1);
	
	bg2 = document.createElement('IMG');
	bg2.className = 'gameObject';
	bg2.src = 'img/bg.jpg';
	bg2.style.width ='800px';
	bg2.style.height = '1422px';
	bg2.style.left= '0px';
	bg2.style.top = '-1422px';
	
	$('#gameScreen').append(bg2);
	//gameScreen.appendChild(bg2);
	
	bullets = document.createElement('DIV');
	bullets.className = 'gameObject';
	bullets.style.width = gameScreen.style.width;
	bullets.style.height = gameScreen.style.height;
	bullets.style.left ='0px';
	bullets.style.top = '0px';
	
	$('#gameScreen').append(bullets);
	//gameScreen.appendChild(bullets);

	output = document.getElementById('output');
	
	blueOrb = document.createElement('IMG');
	blueOrb.src = 'img/blueOrb.png';
	blueOrb.className = 'gameObject';
	blueOrb.style.width = '40px';
	blueOrb.style.height = '40px';
	placeBlueOrb(blueOrb);
	
	$('#gameScreen').append(blueOrb);
	//gameScreen.appendChild(blueOrb);
	 
	ship = document.createElement('IMG');
	ship.src = 'img/ship.gif';
	ship.className = 'gameObject';
	ship.style.width = '68px';
	ship.style.height = '68px';
	ship.style.top = '500px';
	ship.style.left = '366px';

	$('#gameScreen').append(ship);
	//gameScreen.appendChild(ship);
	
	for(var i = 0; i < 10; i ++){
		var enemy = new Image();
		enemy.className = 'gameObject';
		enemy.style.width = '64px';
		enemy.style.height = '64px';
		enemy.src = 'img/enemyShip.gif';
		$('#gameScreen').append(enemy);
		//gameScreen.appendChild(enemy);
		placeEnemyShip(enemy);
		enemies[i] = enemy;
	}

	gameTimer = setInterval(gameloop, 50);
}

function explode(obj){
	var explosion = document.createElement('IMG');
	explosion.src = 'img/explosion.gif?x='+ Date.now();
	
	explosion.className = 'gameObject';
	explosion.style.width = obj.style.width;
	explosion.style.height = obj.style.height;
	explosion.style.left = obj.style.left;
	explosion.style.top = obj.style.top;
	$('#gameScreen').append(explosion);
	//gameScreen.appendChild(explosion);
}

function gameloop(){
	currentCount += 1;
	// Autofire on blue orb collection
	if(autoFire){
		if(currentCount % 2 == 0){
			fire();
			autoFireCount += 1;
			if(autoFireCount > 125){
				autoFire = false;
				autoFireCount = 0;
			}
		}
	}
	
	// scrolling background
	var bgY = parseInt(bg1.style.top) + BG_SPEED;
	if(bgY > GS_HEIGHT){
		bg1.style.top = -1 * parseInt(bg1.style.height) + 'px';
	}
	else{
		bg1.style.top = bgY + 'px';
	}
	
	bgY = parseInt(bg2.style.top) + BG_SPEED;
	if(bgY > GS_HEIGHT){
		bg2.style.top= -1 * parseInt(bg2.style.height) + 'px';
	}
	else{
		bg2.style.top = bgY + 'px';
	}
	
    // ship movement
	if(leftArrowDown){
		var newX = parseInt(ship.style.left);
		if(newX > 0) ship.style.left = newX - 20 + 'px';
		else ship.style.left = '0px';
	}

	if(rightArrowDown){
		var newX = parseInt(ship.style.left);
		var maxX = GS_WIDTH - parseInt(ship.style.width);
		if(newX <  maxX) ship.style.left = newX + 20 + 'px';
		else ship.style.left = maxX + 'px';
	}
	
	// ship firing and bullet hit detection
	var b = bullets.children;
	for(var i = 0; i < b.length; i ++){
		var newY = parseInt(b[i].style.top) - b[i].speed;
		if(newY < 0){
			bullets.removeChild(b[i]);
		}
		else{
			b[i].style.top = newY + 'px';
			for(var j = 0; j < enemies.length; j++){
				if(hittest(b[i], enemies[j])){
					bullets.removeChild(b[i]);
					explode(enemies[j]);
					score += 10;
					placeEnemyShip(enemies[j]);
					break;
				}
			}
		}
	}
	
	// enemy movement hit detection
	for(var i = 0; i < enemies.length; i++){
		var newY = parseInt(enemies[i].style.top);
		if(newY > GS_HEIGHT){
			placeEnemyShip(enemies[i]);
		}
		else
		{
			enemies[i].style.top = newY + enemies[i].speed + 'px';
		}
		
		if( hittest(enemies[i], ship)){
			explode(ship);
			explode(enemies[i]);
			gameOver = true;
			if(score > highScore){
			    localStorage.setItem("highScore", score);
			}
			ship.style.top = '-10000px';
			placeEnemyShip(enemies[i]);
		}
		
		if(gameOver){
		    $('.replayBtn').show();
		}
	}
	
	// blue orb movement and hit detection
	var orbY = parseInt(blueOrb.style.top);
	if(orbY > GS_HEIGHT){
		placeBlueOrb(blueOrb);
	}
	else{
		blueOrb.style.top = orbY + blueOrb.speed + 'px';
	}
	
	if(hittest(blueOrb, ship)){
		autoFire = true;
		score += 100;
		placeBlueOrb(blueOrb);
	}
	
	// Score output
	$("#output").empty();
	$("#output").append("Score: " + score);
	
	// High Score output
	$("#highScore").empty();
	if(score > highScore){
	     $("#highScore").append("High Score: " + score);
	}
	else {
	     $("#highScore").append("High Score: " + highScore);
	}
	 
	
}

// listiners 
window.onload = init();  

/* replaced with jquery event handler
document.addEventListener('keypress', function(event){
	if(event.charCode==32){
		fire();	
	}
});
*/
$('body').keypress(function(event){
    	if(event.charCode==32) fire();	
});

/* replaced with jquery event handler
document.addEventListener('keydown', function(event){
	if(event.keyCode==37) leftArrowDown = true;
	if(event.keyCode==39) rightArrowDown = true;
});
*/
$('body').on("keydown", function(event){
    if(event.keyCode==37) leftArrowDown = true;
	if(event.keyCode==39) rightArrowDown = true;
	if(event.charCode==32)fire();	
});

/* replaced with jquery event handler
document.addEventListener('keyup', function(event){
	if(event.keyCode==37) leftArrowDown = false;
	if(event.keyCode==39) rightArrowDown = false;
});
*/
$('body').on("keyup", function(event){
    if(event.keyCode==37) leftArrowDown = false;
	if(event.keyCode==39) rightArrowDown = false;
});

$(".replayBtn").on("click", function() {
    location.reload();
});