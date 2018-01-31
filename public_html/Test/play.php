<!DOCTYPE html>
<html>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <meta charset="utf-8">
  <title>JS Bin</title>
  <style>* {
  box-sizing: border-box;
}

.player {
  margin: 0 auto;
  width: 300px;
}

.message {
  height: 20px;
  text-align: center;
  font-family: Helvetica, Arial, sans-serif;
}

.controls {
  background: #333;
  padding: 8px;
}

.button {
  color: white;
  width: 20px;
  margin: 3px 0 0 0;
  font-size: 16px;
  text-align: center;
  display: inline-block;
  cursor: pointer;
  background: transparent;
  border: none;
  outline: none;
}



</style>
</head>
<body>
  <div class="player">
    <p class="message"></p>
    <div class="controls">
      <button class="button fa fa-play"></button>
      <div class="track">
        <div class="scrubber"></div>
      <a type="submit" id="Song">Play </>
      </div>
    </div>
    <input type="range" min="0" max="1" step="0.01" value="1" oninput="biquadFilter.changeFrequency(this.biquadFilter);"></>
  </div>
</body>
</html>


<script>

  playerElement = document.querySelector('.player');

function Player ( url, el ) {
  this.ac = new ( window.AudioContext || webkitAudioContext )();
  this.url = url;
  this.el = el;
  this.button = el.querySelector('.button');
  this.track = el.querySelector('.track');
  this.progress = el.querySelector('.progress');
  this.message = el.querySelector('.message');
  this.message.innerHTML = 'Loading';
  this.bindEvents();
  this.fetch();
  var biquadFilter = {FREQ_MUL: 7000, QUAL_MUL: 30,playing: false };

}

Player.prototype.bindEvents = function() {
  this.button.addEventListener('click', this.toggle.bind(this));

};


Player.prototype.fetch = function() { // 1 
  var xhr = new XMLHttpRequest();
  xhr.open('GET', this.url, true);XMLHttpRequest
  xhr.responseType = 'arraybuffer';
  xhr.onload = function() {
    this.decode(xhr.response);
  }.bind(this);
  xhr.send();
  
};

Player.prototype.decode = function( arrayBuffer ) {    // 2 
  this.ac.decodeAudioData(arrayBuffer, function( audioBuffer ) {
    this.message.innerHTML = '';
    this.buffer = audioBuffer;
    this.draw();
    this.play();
  }.bind(this));
};
var biquadFilter = {FREQ_MUL: 7000, QUAL_MUL: 30,playing: false };
this.biquadFilter.changeFrequency = function(element) {
  var minValue = 40;
  var SampleRate=this.ac.sampleRate=48000;
  var maxValue = this.ac.sampleRate / 2;
  var numberOfOctaves = Math.log(maxValue / minValue) / Math.LN2;
  var multiplier = Math.pow(2, numberOfOctaves * (element.value - 1.0));
  this.filter.frequency.value = maxValue * multiplier;
};


Player.prototype.connect = function() { //5 
  if ( this.playing ) {
    this.pause();
  }
  this.source = this.ac.createBufferSource();
  this.source.buffer = this.buffer;
  var biquadFilter = this.ac.createBiquadFilter();
  var gainNode=this.ac.createGain();
  biquadFilter.type = (typeof biquadFilter.type==='string')? 'lowpass' : 0;
  biquadFilter.frequency = 5000;
  this.source.connect(biquadFilter);
  biquadFilter.connect(gainNode);
  gainNode.connect(this.ac.destination);
};

Player.prototype.draw = function() {   //3 
  if ( this.playing ) {
    this.button.classList.add('fa-pause');
    this.button.classList.remove('fa-play');
  } else {
    this.button.classList.add('fa-play');
    this.button.classList.remove('fa-pause');
  }

};

Player.prototype.play = function( position ) {  //4
  this.connect();
  this.position = typeof position === 'number' ? position : this.position || 0;
  this.startTime = this.ac.currentTime - ( this.position || 0 );
  this.source.start(this.ac.currentTime, this.position);
  this.playing = true;
};

Player.prototype.pause = function(){
  if ( this.source ) {
    this.source.stop(0);
    this.source = null;
    this.position = this.ac.currentTime - this.startTime;
    this.playing = false;
  }
};



Player.prototype.toggle = function() {
  if ( !this.playing ) {
    this.play();
  }
  else {
    this.pause();
  }
};



 var tmp;

    document.getElementById('Song').addEventListener('click',function(){
      var Myurl="http://localhost:8080/PhpAudioDb/MusicPlayer/public_html/uploads/trancebeat.mp3";
      if(tmp!=Myurl)
      {
        window.player = new Player(Myurl, playerElement);
        tmp=Myurl;
      }
    })



</script>