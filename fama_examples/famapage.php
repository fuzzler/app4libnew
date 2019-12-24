<?php

session_start();

// Verifica che ci si trovi in una sessione valida
if(!isset($_SESSION['username']) && !isset($_SESSION['password']))
	header('Location: login.php');

//$page=$_SERVER['PHP_SELF'];



?>

<! DOCTYPE HTML>
<html lang="it">

<head>
	<meta charset="UTF-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> FaMaPage 1 </title>

<style type="text/css">

/* IMPORT dei font dalle API di google ( https://fonts.google.com/ ) */
@import url('https://fonts.googleapis.com/css?family=Charm:700');
@import url('https://fonts.googleapis.com/css?family=Charm');
@import url('https://fonts.googleapis.com/css?family=Shadows+Into+Light');


body {
	background-color: #FCA0D1;
	background-image: url("famaimg/heart.png");
	background-repeat: no-repeat; 
	background-size: 1100px 1000px; 
	background-position: top center; 
	color: white;
	font-family: Verdana, "Times New Roman", serif, sans-serif; 
	font-size: 27px;

	
}

th {
	color: white;
	font-family: "Charm:700", 'Charm', cursive, Verdana, arial;
	font-size: 67px;
	font-weight: bolder;
	text-shadow: 2px 2px purple;
	text-decoration: overline underline;
	clear: both;

}

h3 {
	color: yellow;
	font-family: 'Charm', cursive, arial;
	font-size: 53px;
	font-style: oblique; /* ci sono 3 attributi: normal (default), oblique e italic */
}

p {

	color: white;
	font-family: serif;
	font-size: 50px;
	font-style: oblique;
	font-weight: bolder;

}

#data {

	background-color: #F114C9;
	color: white;
	font-family: serif;
	font-size: 50px;
	font-style: oblique;
	font-weight: bolder;
	width: 550px;
	height: 70px;

}

#ap {
	color: #2D0595;
	font-family: 'Shadows Into Light', cursive;
	font-size: 59px;
	width: 850px;
	height: 79px;
	border-width: 10px; /* thick, thin, medium ... Npx */
	border-color: lightblue;
	border-style: double; /* solid, dotted, double,  */
	border-radius: 20px; /* smussatura angoli dei border */
	text-shadow: 2px 0px white;
	text-decoration: overline underline;
}

table {
	margin-top:50px;
}

img {
	width:300px;
	height:300px;

}

/* PSEUDO CLASSE -> regola lo stato di un link */

img:hover {
	color: orange;
	font-family: arial;
	font-size: 55px;
	text-decoration:none;
}

img:active {
	color: green;
	font-style: oblique;
	font-size: 55px;
	text-decoration:none;

}

	.pa {
		float: right;
		margin-top: 0px;
		clear: both;
		font-family: Arial;
		font-size:20px;
	}

</style>

</head>

<body>

<div style="width: 1200px; height: 20px;">
<p class="pa"><a href="logout.php"> Logout </a></p>
</div>

<SCRIPT TYPE="text/javascript"> 
/** FIREWORKS.js
  * You may use this code for free on any web page provided that 
  * these comment lines and the following credit remain in the code.
  * Cross Browser Fireworks from http://www.javascript-fx.com
  */
/*************************************************/
if(!window.JSFX) JSFX=new Object();
 
if(!JSFX.createLayer)
{/*** Include Library Code ***/
 
var ns4 = document.layers;
var ie4 = document.all;
JSFX.objNo=0;
 
JSFX.getObjId = function(){return "JSFX_obj" + JSFX.objNo++;};
 
JSFX.createLayer = function(theHtml)
{
   var layerId = JSFX.getObjId();
 
   document.write(ns4 ? "<LAYER  NAME='"+layerId+"'>"+theHtml+"</LAYER>" : 
              "<DIV id='"+layerId+"' style='position:absolute'>"+theHtml+"</DIV>" );
 
   var el =    document.getElementById   ? document.getElementById(layerId) :
         document.all       ? document.all[layerId] :
                       document.layers[layerId];
 
   if(ns4)
      el.style=el;
 
   return el;
}
JSFX.fxLayer = function(theHtml)
{
   if(theHtml == null) return;
   this.el = JSFX.createLayer(theHtml);
}
var proto = JSFX.fxLayer.prototype
 
proto.moveTo    = function(x,y){this.el.style.left = x;this.el.style.top=y;}
proto.setBgColor = function(color) { this.el.style.backgroundColor = color; } 
proto.clip      = function(x1,y1, x2,y2){ this.el.style.clip="rect("+y1+" "+x2+" "+y2+" "+x1+")"; }
if(ns4){
   proto.clip = function(x1,y1, x2,y2){
      this.el.style.clip.top    =y1;this.el.style.clip.left   =x1;
      this.el.style.clip.bottom=y2;this.el.style.clip.right   =x2;
   }
   proto.setBgColor=function(color) { this.el.bgColor = color; }
}
if(window.opera)
   proto.setBgColor = function(color) { this.el.style.color = color==null?'transparent':color; }
 
if(window.innerWidth)
{
   gX=function(){return innerWidth;};
   gY=function(){return innerHeight;};
}
else
{
   gX=function(){return document.body.clientWidth;};
   gY=function(){return document.body.clientHeight;};
}
 
/*** Example extend class ***/
JSFX.fxLayer2 = function(theHtml)
{
   this.superC = JSFX.fxLayer;
   this.superC(theHtml + "C");
}
JSFX.fxLayer2.prototype = new JSFX.fxLayer;
}/*** End Library Code ***/
 
/*************************************************/
/*** Firework Spark - extends fxLayer ***/
JSFX.FireworkSpark = function(x, y)
{
   this.superC = JSFX.fxLayer;
   this.superC("*");
 
   this.dx    = Math.random() * 4 - 2;
   this.dy   = Math.random() * 4 - 2;
   this.ay   = .09;
   this.x   = x;
   this.y   = y;
   this.type = 0;
}
JSFX.FireworkSpark.prototype = new JSFX.fxLayer;
/*** END Class FireworkSpark Constructor - start methods ***/
 
JSFX.FireworkSpark.prototype.fire0 = function()
{
   var a = Math.random() * 6.294;
   var s = Math.random() * 2;
   if(Math.random() >.6) s = 2;
   this.dx = s*Math.sin(a);
   this.dy = s*Math.cos(a) - 2;
}
JSFX.FireworkSpark.prototype.fire1 = function()
{
   var a = Math.random() * 6.294;
   var s = Math.random() * 2;
   this.dx = s*Math.sin(a);
   this.dy = s*Math.cos(a) - 2;
}
JSFX.FireworkSpark.prototype.fire2 = function()
{
   var a = Math.random() * 6.294;
   var s = 2;
   this.dx = s*Math.sin(a);
   this.dy = s*Math.cos(a) - 2;
}
JSFX.FireworkSpark.prototype.fire3 = function()
{
   var a = Math.random() * 6.294;
   var s = a - Math.random();
   this.dx = s*Math.sin(a);
   this.dy = s*Math.cos(a) - 2;
}
JSFX.FireworkSpark.prototype.fire4 = function()
{
   var a = Math.random() * 6.294;
   var s = (Math.random() > 0.5) ? 2 : 1;
   if(s==1)this.setBgColor("#FFFFFF");
   s -= Math.random()/4;
   this.dx = s*Math.sin(a);
   this.dy = s*Math.cos(a) - 2;
}
JSFX.FireworkSpark.prototype.fire = function(sx, sy, fw, cl)
{
   this.setBgColor(cl);
 
   if(fw == 1)
      this.fire1();
   else if(fw == 2)
      this.fire2();
   else if(fw == 3)
      this.fire3();
   else if(fw == 4)
      this.fire4();
   else
      this.fire0();
 
   this.x   = sx;
   this.y   = sy;
   this.moveTo(sx, sy);
}
JSFX.FireworkSpark.prototype.animate = function(step)
{
   this.dy += this.ay;
   this.x += this.dx;
   this.y += this.dy;
   this.moveTo(this.x, this.y);
}
/*** END Class FireworkSpark Methods***/
 
/*** Class Firework extends Object ***/
JSFX.Firework = function(numSparks)
{
   window[ this.id = JSFX.getObjId() ] = this;
 
   this.sparks = new Array();
   for(i=0 ; i<numSparks; i++)
   {
      this.sparks[i]=new JSFX.FireworkSpark(-10, -10);
      this.sparks[i].clip(0,0,3,3);
      this.sparks[i].setBgColor("#00FF00");
   }
   this.step = 0;
   this.timerId = -1;
   this.x = 0;
   this.y = 0;
   this.dx = 0;
   this.dy = 0;
   this.ay = 0.2;
   this.state = "OFF";
}
JSFX.Firework.prototype.explode = function()
{
   var fw = Math.floor(Math.random() * 5);
 
   for(i=0 ; i<this.sparks.length ; i++)
   {
      this.sparks[i].fire(this.x, this.y, fw, this.color);
      this.sparks[i].dx += this.dx;
      this.sparks[i].dy += this.dy;
   }
}
JSFX.Firework.prototype.getMaxDy = function()
{
   var ydiff = gY() - 30;
   var dy    = 1;
   var dist  = 0;
   var ay    = this.ay;
   while(dist<ydiff)
   {
      dist += dy;
      dy+=ay;
   }
   return -dy;
}
JSFX.Firework.prototype.animate = function()
{
 
   if(this.state=="OFF")
   {
      var colors = new Array("#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#FFFFFF");
      this.color = colors[Math.floor(Math.random()*colors.length)];
 
      this.step = 0;
      this.x = gX()/2;
      this.y = gY()-10;
      this.dy = this.getMaxDy();
      this.dx = Math.random()*-8 + 4;
      this.dy += Math.random()*3;
      for(i=0 ; i<this.sparks.length ; i++)
         this.sparks[i].moveTo(-10,-10);
      this.sparks[0].setBgColor(this.color);
      this.state = "TRAVEL";
   }
   else if(this.state=="TRAVEL")
   {
      this.x += this.dx;
      this.y += this.dy;
      this.dy += this.ay;
      this.sparks[0].moveTo(this.x,this.y);
      if(this.dy > 1)
      {
         this.state="EXPLODE"
         this.explode();
      }
   }
   else
   {
      if(this.step > 40)
         this.state="OFF";
 
      this.step++;
 
      for(i=0 ; i<this.sparks.length ; i++)
         this.sparks[i].animate(this.step);
   }
 
}
JSFX.Firework.prototype.start = function()
{
   if(this.timerId == -1)
   {
      this.state = "OFF";
      this.timerId = setInterval("window."+this.id+".animate()", 30);
   }
 
}
JSFX.Firework.prototype.stop = function()
{
   if(this.timerId != -1)
   {
      clearInterval(this.timerId);
      for(i=0 ; i<this.sparks.length ; i++)
         this.sparks[i].moveTo(-10,-10);
      this.timerId = -1;
      this.step = 0;
   }
}
/*** END Class Firework***/
 
JSFX.FWStart = function()
{
   if(JSFX.FWLoad)JSFX.FWLoad();
   myFW1.start();
   myFW2.start();
}
myFW1 = new JSFX.Firework(30);
myFW2 = new JSFX.Firework(30);
JSFX.FWLoad=window.onload;
window.onload=JSFX.FWStart;
 
</SCRIPT>

<center>

<div>
<table>
<th id="" colspan="2">  Specialmente...NOI   
<img style="width:130px; height:80px; margin: 0 auto;" src="famaimg/infinito.png" />
</th>
<tr>
	<td> <a href="famapage2.php"><img src="famaimg/us.jpeg" /></a> </td>
	<td> <a href="famapage2.php"><img src="famaimg/us1.jpg" /></a> </td>
</tr>

<tr>
	<td> <a href="famapage2.php"><img src="famaimg/us2.jpg" /></a> </td>
	<td> <a href="famapage2.php"><img src="famaimg/us4.jpg" /></a></td>
</tr>

</table>
</div>
</center>

</body>
</html>
