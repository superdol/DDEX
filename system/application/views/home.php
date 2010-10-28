<!-- herobox -->

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

<div id="content">
	<div id="latest-news">
		<h1>Latest News</h1>
		<div class="news-item first">
			<h2><a href="336d95">Open Implementation Meeting on 5th November in Los Angeles, CA.</a></h2>
			<p class="news-date">Posted on <span class="date-item">11th August 2010</span></p>
			<p><strong>DDEX will be hosting an Open Implementation Meeting on 5th November in Los Angeles.</strong></p>
			<p>The meeting will be beginning with an update on DDEX's standards (including those just published). This will be followed by a series of "mentoring sessions" during which representatives from companies that have carried out implementation of one or more of the DDEX standards will work with small groups explaining how they approached implementations, what problems they encountered, how these were solved, what benefits have been derived from implementation.</p>
			<p>For details, <a href="http://example.com/">please read on here</a>.</p>
		</div>
		<div class="news-item">
			<h2><a href="336d95">New Membership Structure and Fees</a></h2>
			<p class="news-date">Posted on <span class="date-item">4th August 2010</span></p>
			<p>From 1st January 2010 DDEX has introduced a new membership structure, which is aimed at accommodating further membership growth following recent increases in membership and in particular the addition of three new Charter Members. Microgen Aptitude Limited, Phonographic Performance Limited and Société Civile des Producteurs Phonographiques (SCPP) have all recently accepted invitations from the DDEX Board to become Charter Members and take seats on the DDEX Board.</p>
			<p>Details of the new membership structure and fees <a href="http://example.com/">are available here</a>.</p>
		</div>
		<div class="news-item">
			<h2><a href="336d95">DDEX Publishes White Paper</a></h2>
			<p class="news-date">Posted on <span class="date-item">13th January 2010</span></p>
			<p>On 13th January DDEX published a white paper entitled "Standardisation for an Automated Transaction Processing Environment in the Digital Media Supply Chain" (click on the following links for a <a href="http://example.com/">HTML</a> and <a href="http://example.com/">PDF</a> version).</p>
			<p>The white paper sets out six components that DDEX believes require standardisation if an automated transaction processing environment for digital media is to be achieved. <a href="http://example.com/">Read more</a>.</p>
		</div>
	</div>
	<div id="standards-documents">
		<h1>Standards <span class="subtler">&amp;</span> Documents</h1>
		<p class="notes">NB: You must be a member and <a href="http://example.com/">logged in</a> to download files. <a href="http://example.com/">Become a member</a></p>
		<div class="document-item first">
			<h2><a href="http://example.com/" class="pdf-link">ERN Choreography</a></h2>
			<p><a href="http://example.com/" class="button download">DOWNLOAD NOW</a>11th August 2010<br />3.4mb</p>
		</div>
		<div class="document-item">
			<h2><a href="http://example.com/" class="pdf-link">ERN Choreography</a></h2>
			<p><a href="http://example.com/" class="button download">DOWNLOAD NOW</a>11th August 2010<br />3.4mb</p>
		</div>
		<div class="document-item">
			<h2><a href="http://example.com/" class="pdf-link">ERN Choreography</a></h2>
			<p><a href="http://example.com/" class="button download">DOWNLOAD NOW</a>11th August 2010<br />3.4mb</p>
		</div>
		<div class="document-item">
			<h2><a href="http://example.com/" class="pdf-link">ERN Choreography</a></h2>
			<p><a href="http://example.com/" class="button download">DOWNLOAD NOW</a>11th August 2010<br />3.4mb</p>
		</div>
	</div>
</div>