// a key map of allowed keys
var allowedKeys = {
    70: 'f',
    82: 'r',
    73: 'i',
    68: 'd',
    65: 'a',
    89: 'y'
  };
  
  // the 'official' Konami Code sequence
  var konamiCode = ['f', 'r', 'i', 'd', 'a', 'y'];
  
  // a variable to remember the 'position' the user has reached so far.
  var konamiCodePosition = 0;
  
  // add keydown event listener
  document.addEventListener('keydown', function(e) {
    // get the value of the key code from the key map
    var key = allowedKeys[e.keyCode];
    // get the value of the required key from the konami code
    var requiredKey = konamiCode[konamiCodePosition];
  
    // compare the key with the required key
    if (key == requiredKey) {
  
      // move to the next key in the konami code sequence
      konamiCodePosition++;
  
      // if the last key is reached, activate cheats
      if (konamiCodePosition == konamiCode.length) {
        activateCheats();
        konamiCodePosition = 0;
      }
    } else {
      konamiCodePosition = 0;
    }
  });
  
  function activateCheats() {
    window.location.replace("https://www.youtube.com/watch?v=kfVsfOSbJY0");
  }