function text_swapper() {
  /* settings */
  var showDuration = 4000;
  var container = $('home-slideshow');
  if (container == null) {
	return;
  }
  var images = container.getElements('p');
  var currentIndex = 0;
  var interval;
  /* opacity and fade */
  images.each(function(img,i){ 
    if(i > 0) {
      img.set('opacity',0);
    }
  });
  /* worker */
  var show = function() {
    images[currentIndex].fade('out');
    images[currentIndex = currentIndex < images.length - 1 ? currentIndex+1 : 0].fade('in');
  };
  /* start once the page is finished loading */
  window.addEvent('load',function(){
    interval = show.periodical(showDuration);
  });
};

window.addEvent('domready', text_swapper);