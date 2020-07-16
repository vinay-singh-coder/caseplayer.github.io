<!DOCTYPE html>	
<html>
<head>
	<title>Human Patients</title>
	<script src="https://kit.fontawesome.com/1a594a0608.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="myscript.js"></script>
 
</head>

<body>
	<div class="container">

		<div class="header">
			<div  id="header1">
			<h3>Interactive Drink Training</h3>
			</div>
			
			<div id="header2">
			<span id="r">Course Progress</span>
			
			<div id="progress">	
			<ul class="progressbar">
        	<li class="active"></li>
        	<li class="active"></li>
        	<li></li>
        	<li></li>
        	<li></li>
      		</ul>
      		</div>
      		
      		<span>20% completed</span>
			</div>
		
		</div>



		<div class="body">
			
			<iframe src="https://www.i-human.com/case-player/" width="100%" height="100%"></iframe>
	
		</div>

		

		<div class="footer">
			<i class="fas fa-align-justify" id="i"></i>
			<i class="far fa-question-circle" id="i"></i>
			
			<div id="box" >
				<audio id="music" src="motivational.mp3" autoplay="autoplay">
					 Your browser does not support the audio format.
				</audio> 
				<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>			
			</div>

			<div>
			<button id='btnPlayPause'  class="bi" title='play' accesskey="P" onclick='playPauseAudio();'>
				<i class="fas fa-play-circle"></i>
			</button>
			<button id='btnStop'   class="bi" title='stop' accesskey="X" onclick='stopAudio();'><i class="fas fa-redo"></i></button>
     		<input type="range" id="volume-bar" title="volume" min="0" max="10" step="1" value="10">
			<button id='btnMute' class="bi" title='mute' onclick='muteVolume();'><i class="fas fa-volume-up"></i>
			</button>
			</div>


			<i class="fas fa-arrow-circle-left" id="i"></i>
			<button id="page_no"><1 of 5></button>
			<i class="fas fa-arrow-circle-right" id="i"></i>
			


		</div>


    </div>
    <script type="text/javascript">
var player = document.getElementById('music'); // id for audio element
var duration; // Duration of audio clip
btnPlayPause = document.getElementById('btnPlayPause');
btnMute      = document.getElementById('btnMute');
progressBar  = document.getElementById('progress-bar');
volumeBar    = document.getElementById('volume-bar');
source       = document.getElementById('audioSource');
  
// Update the video volume
volumeBar.addEventListener("change", function(evt) {function displayMessage(message, canPlay) {
    var element = document.querySelector('#message');
    element.innerHTML = message;
    element.className = canPlay ? 'info' : 'error';
}
  player.volume = parseInt(evt.target.value) / 10;
});

// Add a listener for the timeupdate event so we can update the progress bar
player.addEventListener('timeupdate', updateProgressBar, false);
	
// Add a listener for the play and pause events so the buttons state can be updated
player.addEventListener('play', function() {
  // Change the button to be a pause button
  changeButtonType(btnPlayPause, '<i class="fas fa-pause-circle"></i>');
}, false);
  
player.addEventListener('pause', function() {
  // Change the button to be a play button
  changeButtonType(btnPlayPause, '<i class="fas fa-play-circle"></i>');
}, false);

player.addEventListener('volumechange', function(e) { 
  // Update the button to be mute/unmute
  if (player.muted) changeButtonType(btnMute, '<i class="fas fa-volume-mute"></i>');
  else changeButtonType(btnMute, '<i class="fas fa-volume-up"></i>');
}, false);	

player.addEventListener('ended', function() { this.pause(); }, false);	

progressBar.addEventListener("click", seek);

function seek(e) {
  if (player.src) {
    var percent = e.offsetX / this.offsetWidth;
    player.currentTime = percent * player.duration;
    e.target.value = Math.floor(percent / 100);
    e.target.innerHTML = progressBar.value + '% played';
  }
}

function playPauseAudio() {
  if (player.src) {
    if (player.paused || player.ended) {
      // Change the button to a pause button
      changeButtonType(btnPlayPause, 'pause');
      player.play();
    }
    else {
      // Change the button to a play button
      changeButtonType(btnPlayPause, 'play');
      player.pause();
    }
  }
}

// Stop the current media from playing, and return it to the start position
function stopAudio() {
  if (player.src) {
    player.pause();
    if (player.currentTime) player.currentTime = 0;
  }
}

// Toggles the media player's mute and unmute status
function muteVolume() {
  if (player.src) {
    if (player.muted) {
      // Change the button to a mute button
      changeButtonType(btnMute, 'mute');
      player.muted = false;
    }
    else {
      // Change the button to an unmute button
      changeButtonType(btnMute, 'unmute');
      player.muted = true;
    }
  }
}

// Replays the media currently loaded in the player
function replayAudio() {
  if (player.src) {
    resetPlayer();
    player.play();
  }
}

// Update the progress bar
function updateProgressBar() {
  // Work out how much of the media has played via the duration and currentTime parameters
  var percentage = Math.floor((100 / player.duration) * player.currentTime);
  // Update the progress bar's value
  progressBar.value = percentage;
  // Update the progress bar's text (for browsers that don't support the progress element)
  progressBar.innerHTML = progressBar.title = percentage + '% played';
}

// Updates a button's title, innerHTML and CSS class
function changeButtonType(btn, value) {
  btn.title     = value;
  btn.innerHTML = value;
  btn.className = value;
}

function resetPlayer() {
  progressBar.value = 0;
  //clear the current song
  player.src = '';
  // Move the media back to the start
  player.currentTime = 0;
  // Set the play/pause button to 'play'
  changeButtonType(btnPlayPause, 'play');
}  

function displayMessage(message, canPlay) {
    var element = document.querySelector('#message');
    element.innerHTML = message;
    element.className = canPlay ? 'info' : 'error';
}

function playSelectedFile(event) {
    var file = this.files[0],
        type = file.type,
        canPlay = player.canPlayType(type),
        message = 'Can play type "' + type 
                + '": ' + (canPlay ? canPlay : 'no');
    displayMessage(message, canPlay);
    
    if (canPlay) player.src = URL.createObjectURL(file);
    else         resetPlayer();
  }

var inputNode = document.querySelector('input');
  inputNode.addEventListener('change', playSelectedFile, false);

    </script>
    
</body>
</html>