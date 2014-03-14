/* ==========================================================
 * ErgoAdmin v1.2
 * index.js
 * 
 * http://www.mosaicpro.biz
 * Copyright MosaicPro
 *
 * Built exclusively for sale @Envato Marketplaces
 * ========================================================== */ 

$(function()
{

	/* nav slide */

	var cI = 2;
	var aI = 5;
	var tI = ( $( 'div.navItm' ).length +1  );
	console.log(tI);
	$('#content .widget-nav-group .chevron-right').click(function(e) {
		
		e.preventDefault();

			console.log('current index: ' + (aI+cI));
			
			if ( $('.navItm:nth-child( ' + (aI+cI) + '  )').hasClass('hidden') ) {
			
			
			console.log('click right ' + cI);
			 
			  $('.navItm:nth-child( ' + (cI) + '  )').removeClass('span2').addClass('hidden');
			  $('.navItm:nth-child( ' + (aI+cI) + '  )').removeClass('hidden').addClass('span2');
			cI++;
			 $('[data-slide="prev"]').removeClass('disabled');
			
			}
		
	});

	$('#content .widget-nav-group .chevron-left').click(function(e) {
		
		e.preventDefault();
	
			if ( $('.navItm:nth-child( ' + (cI-1) + '  )').hasClass('hidden') ) {
			
			
			console.log('click left ' + cI);
			 cI--;
			  $('.navItm:nth-child( ' + (aI+cI) + '  )').removeClass('span2').addClass('hidden');
			  $('.navItm:nth-child( ' + (cI) + '  )').removeClass('hidden').addClass('span2');
			
			 $('[data-slide="prev"]').removeClass('disabled');
			
			}
	
	});
	

	/* Notification */
	$('#content .filter-bar').after('<div id="content-notification"></div>');
	$('#content-notification').notyfy({
		text: '<h4>Welcome back Mr.Awesome!</h4><p>You have <strong>3,450</strong> unread messages. Click here to close the notification and see a dark color variation.</p>',
		type: 'default',
		layout: 'top',
		closeWith: ['click'],
		events: {
			hidden: function(){
				$('#content-notification').notyfy({
					text: '<h4>Welcome back Mr.Awesome!</h4><p>You have <strong>3,450</strong> unread messages. Click here to close the notification and see a primary color variation.</p>',
					type: 'dark',
					layout: 'top',
					closeWith: ['click'],
					events: {
						hidden: function(){
							$('#content-notification').notyfy({
								text: '<h4>Welcome back Mr.Awesome!</h4><p>You have <strong>3,450</strong> unread messages. You can click here to close me.</p>',
								type: 'primary',
								layout: 'top',
								closeWith: ['click']
							});
						}
					}
				});
			}
		}
	});
	// init map

// USA unemployment
	function initUSAUnemployment()
	{
		$.getJSON( basePath + 'theme/scripts/plugins/maps/jvectormap/data/us-unemployment.json', function(data){
			var val = 2009;
			statesValues = jvm.values.apply({}, jvm.values(data.states)),
			metroPopValues = Array.prototype.concat.apply([], jvm.values(data.metro.population)),
			metroUnemplValues = Array.prototype.concat.apply([], jvm.values(data.metro.unemployment));

			$('#usa-unemployment').vectorMap({
				map: 'us_aea_en',
				focusOn: {
 					 x: 0.25,
  					 y: 0.4,
  					 scale: 5
				},
    markers: [
      {latLng: [37.128445, -113.523721], name: 'WASHINGTON UT #861'},
      {latLng: [40.724203, -111.898175], name: 'SOUTH SALT LAKE UT #527 '},
      {latLng: [40.6589040,-111.8878890], name: 'MURRAY UT #521'},
      {latLng: [40.6118130,-111.9836970], name: 'JORDAN LANDING UT #1146'},
      {latLng: [40.7218450,-111.5388390], name: 'PARK CITY UT #1761'},
      {latLng: [40.7218450,-111.5388390], name: 'AMERICAN FORK UT #1402'},
      {latLng: [40.3844040,-111.8198600], name: 'OREM UT #773'},
      {latLng: [41.1770210,-112.0038790], name: 'RIVERDALE UT #496'},
      {latLng: [41.7404310,-111.8347360], name: 'LOGAN UT #945'},
     ],
				series: {
					markers: [{
						attribute: 'fill',
						scale: ['#dcfed9', '#13a50f'],
						values: data.metro.unemployment[val],
						min: jvm.min(metroUnemplValues),
						max: jvm.max(metroUnemplValues)
					},{
						attribute: 'r',
						scale: [5,20],
						values: data.metro.population[val],
						min: jvm.min(metroPopValues),
						max: jvm.max(metroPopValues)
					}],
					regions: [{
						scale: ['#DEEBF7', '#08519C'],
						attribute: 'fill',
						values: data.states[val],
						min: jvm.min(statesValues),
						max: jvm.max(statesValues)
					}],

				},
				onMarkerLabelShow: function(event, label, index){
					//label.text('hi');
			
				},
				onRegionLabelShow: function(event, label, code){
					//label.html(
					//		'<b>'+label.html()+'</b></br>'+
					//		'<b>Locations: </b>'+data.states[val][code]+''
					//);
				}
			});

			var mapObject = $('#usa-unemployment').vectorMap('get', 'mapObject');


		});
	}

	initUSAUnemployment();

	// initialize charts
	
		charts.initIndex();
	
		
	if (Modernizr.touch)
		return;
	
	if (!$('#guided-tour').length || $('html').is('.lt-ie9'))
		return;
	
	// gritter Guided Tour notification
	setTimeout(function()
	{
		$.gritter.add({
			title: 'Guided Tour Available',
			text: "<strong>You can start our assisted Guided Tour</strong> any time, on any page, from the top right corner, so you can't miss on any of the cool stuff!",
			time: 5000,
			class_name: 'gritter-primary'
		});
	}, 3000);


	/* slide */


 	 $('.flexslider').flexslider({
 		animation: "slide",
    		animationLoop: false,
	    	itemWidth: 210,
	 	itemMargin: 5
  });
	
});