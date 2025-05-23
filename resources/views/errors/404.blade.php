<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Found</title>
    <style rel="stylesheet/less" type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Roboto+Mono');

// helper
.center-xy {
  // width: inherit;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  position: absolute;
}

html, body {
  font-family: 'Roboto Mono', monospace;
  font-size: 16px;
}

html {
  box-sizing: border-box;
  user-select: none;
}

body {
  background-color: #000;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.container {
  width: 100%;
}

.copy-container {
  text-align: center;
}

p {
  color: #fff;
  font-size: 24px;
  letter-spacing: .2px;
  margin: 0;
}

.handle {
  background: #ffe500;
  width: 14px;
  height: 30px;
  top: 0;
  left: 0;
  margin-top: 1px;
  position: absolute;
}

#cb-replay {
  fill: #666;
  width: 20px;
  margin: 15px;
  right: 0;
  bottom: 0;
  position: absolute;
  overflow: inherit;
  cursor: pointer;

  &:hover {
    fill: #888;
  }
}
    </style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <div class="copy-container center-xy">
    <p>
      404, page not found.
    </p>
    <span class="handle"></span>

  </div>
</div>


<svg version="1.1" id="cb-replay" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 279.9 297.3" style="enable-background:new 0 0 279.9 297.3;" xml:space="preserve">
<g>
  <path d="M269.4,162.6c-2.7,66.5-55.6,120.1-121.8,123.9c-77,4.4-141.3-60-136.8-136.9C14.7,81.7,71,27.8,140,27.8
    c1.8,0,3.5,0,5.3,0.1c0.3,0,0.5,0.2,0.5,0.5v15c0,1.5,1.6,2.4,2.9,1.7l35.9-20.7c1.3-0.7,1.3-2.6,0-3.3L148.6,0.3
    c-1.3-0.7-2.9,0.2-2.9,1.7v15c0,0.3-0.2,0.5-0.5,0.5c-1.7-0.1-3.5-0.1-5.2-0.1C63.3,17.3,1,78.9,0,155.4
    C-1,233.8,63.4,298.3,141.9,297.3c74.6-1,135.1-60.2,138-134.3c0.1-3-2.3-5.4-5.3-5.4l0,0C271.8,157.6,269.5,159.8,269.4,162.6z"/>
</g>
</svg>
<script>
var $copyContainer = $(".copy-container"),
    $replayIcon = $('#cb-replay'),
    $copyWidth = $('.copy-container').find('p').width();

var mySplitText = new SplitText($copyContainer, {type:"words"}),
    splitTextTimeline = new TimelineMax();
var handleTL = new TimelineMax();

// WIP - need to clean up, work on initial state and handle issue with multiple lines on mobile

var tl = new TimelineMax();

tl.add(function(){
  animateCopy();
  blinkHandle();
}, 0.2)

function animateCopy() {
  mySplitText.split({type:"chars, words"}) 
  splitTextTimeline.staggerFrom(mySplitText.chars, 0.001, {autoAlpha:0, ease:Back.easeInOut.config(1.7), onComplete: function(){
    animateHandle()
  }}, 0.05);
}

function blinkHandle() {
  handleTL.fromTo('.handle', 0.4, {autoAlpha:0},{autoAlpha:1, repeat:-1, yoyo:true}, 0);
}

function animateHandle() {
  handleTL.to('.handle', 0.7, {x:$copyWidth, ease:SteppedEase.config(12)}, 0.05);
}

$('#cb-replay').on('click', function(){
  splitTextTimeline.restart()
  handleTL.restart()
})
</script>
</body>
</html>