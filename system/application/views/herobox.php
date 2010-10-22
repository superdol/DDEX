<!-- herobox -->
<div id="herobox">
	<div id="heronav">		
	</div>
	<div id="slideshow">
		<img src="/images/slide1.png" width="958" height="310" alt="What is DDEX?">
		<img src="/images/slide2.png" width="958" height="310" alt="Who is using DDEX?">
		<img src="/images/slide3.png" width="958" height="310" alt="How can DDEX help?">
		<img src="/images/slide4.png" width="958" height="310" alt="Becoming a DDEX member">
		<img src="/images/slide5.png" width="958" height="310" alt="Develop using DDEX">
		<img src="/images/slide6.png" width="958" height="310" alt="Are you a U.S. publisher?">	
	</div>	
</div>

<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">
$(document).ready(function() {
   	// redefine Cycle's updateActivePagerLink function 
	$.fn.cycle.updateActivePagerLink = function(pager, currSlideIndex) { 
	    $(pager).find('li').removeClass('active') 
	        .filter('li:eq('+currSlideIndex+')').addClass('active'); 
	}; 

	$('#slideshow').cycle({ 
		fx: 'scrollHorz',
	    timeout: 10000, 
	    pager:  '#heronav',
	 	pause: 1,
	    pagerAnchorBuilder: function(idx, slide) { 
	        return '<li class="button"><a href="#">' + slide.alt + '</a></li>'; 
	    } 
	});
});
</script>