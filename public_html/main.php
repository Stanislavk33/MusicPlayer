<?php
include "C:\\xampp\\htdocs\\PhpAudioDb\\MusicPlayer\\resources\\config.php"

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Audio DataBase</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet"  href="css/main.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Player/BufferLoader.js"></script>
    <script src="js/Player/SongController.js"></script>
    
  
</head>
<body>
<div id=main role=>
<nav class="navbar navbar-inverse navbar-fixed-top" id="navbar" role="navigation">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" 
         data-target="#menu">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="MusicPlayer.php">Music Player</a>
   </div>
   <div class="collapse navbar-collapse" id="menu">
      <ul class="nav navbar-nav">
         <li><a href="ManageAudio.php">Manage Songs</a></li>
      </ul>
   </div>
</nav>
</div>
<input id="volume" type="range" min="0" max="1" step="0.01" value="0.5"/>
<button type="submit" id="Play">Play </>
<button type="submit" id="Load">Load</>
<button type="submit" id="Stop">Stop ME </> 
<script type="text/javascript">
       window.onload = init;
var context;
var bufferLoader;

function init() {
  // Fix up prefixing
  window.AudioContext = window.AudioContext || window.webkitAudioContext;
  context = new AudioContext();
  bufferLoader = new BufferLoader(context,["uploads\\Oliver_Heldens_-_Melody_Official_Music_Video[www.MP3Fiber.com].mp3"],finishedLoading);
  bufferLoader.load();
}
        var url="uploads\\Oliver_Heldens_-_Melody_Official_Music_Video[www.MP3Fiber.com].mp3";
        document.getElementById("Load").addEventListener("click",function(){bufferLoader = new BufferLoader(context,["uploads\\Oliver_Heldens_-_Melody_Official_Music_Video[www.MP3Fiber.com].mp3"],finishedLoading);});
      //  document.getElementById("PlayMe").addEventListener("click",function(){finishedLoading(bufferList);});





function finishedLoading(bufferList) {
  // Create two sources and play them both together.
  var source1 = context.createBufferSource();

  source1.buffer = bufferList[0];

  var biquadFilter = context.createBiquadFilter();
  var gainNode=context.createGain();
  biquadFilter.type = (typeof biquadFilter.type==='string')? 'lowpass' : 0;
  biquadFilter.frequency = 5000;
  source1.connect(biquadFilter);
  biquadFilter.connect(gainNode);
  gainNode.connect(context.destination);
 
  //source1.start(0);
  //this.source1=Mysource;
   // this.biquadFilter=myFilter;
    document.getElementById('volume').addEventListener('change',function(){gainNode.gain.value=this.value;});
    document.getElementById('Play').addEventListener('click',function(){bufferLoader.load();
      source1.start(0);});
    document.getElementById('Stop').addEventListener('click',function(){
      if ( this.source1 ) {
        this.source1.stop(0);
        this.source1 = null;
        this.position = this.context.currentTime - this.startTime;
        this.playing = false;
      }
    
    })
};



</script>


</body>
</html>