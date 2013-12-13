<script>
 	
 	 $(function(){

      	$('#traffic-map').vectorMap({
			  map: 'us_lcc_en',
        markersSelectableOne: false,
        markersSelectable: false,
        zoomOnScroll: false,
			     markerStyle: {
          				initial: {
            				fill: 'red',
            				stroke: '#0088cc'
          				}
    			 },

           onMarkerOver: function(e, code){
            e.preventDefault();
          },
           onMarkerOut: function(e, code){
             e.preventDefault();
           },
           onMarkerClick: function(e, code){
            e.preventDefault();
          },
           onMarkerSelected: function(e, code){
            e.preventDefault();
          },
          onMarkerLabelShow: function(e, code){
            e.preventDefault();
          },
          onViewportChange: function(e, code){
            e.preventDefault();
          }

   	 });

 	 $( "#traffic-map-button-vegas" ).click(function() {

    if($( "#traffic-map-button-vegas" ).hasClass('btn-success')) {
      $( "#traffic-map-button-vegas" ).removeClass('btn-success');
      $( "#traffic-map-button-vegas" ).addClass('off');
      console.log('try');
       $('[data-index="lasvegas"]').remove();
    } else {

      if($( "#traffic-map-button-vegas" ).hasClass('btn-danger')) {
      $( "#traffic-map-button-vegas" ).removeClass('btn-danger');
      $( "#traffic-map-button-vegas" ).addClass('btn-success');
       $('[data-index="lasvegas"]').attr('fill','green');
    }

    if($( "#traffic-map-button-vegas" ).hasClass('off')) {
      $( "#traffic-map-button-vegas" ).removeClass('off');
      $( "#traffic-map-button-vegas" ).addClass('btn-danger');

      var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');
    
    mapObject.addMarker('lasvegas',{ latLng: [36.0800, -115.1522], name: 'Las Vegas' });

    }
    }


 	
	});

   $( "#traffic-map-button-nyc" ).click(function() {

    if($( "#traffic-map-button-nyc" ).hasClass('btn-success')) {
      $( "#traffic-map-button-nyc" ).removeClass('btn-success');
      $( "#traffic-map-button-nyc" ).addClass('off');
      console.log('try');
       $('[data-index="nyc"]').remove();
    } else {

      if($( "#traffic-map-button-nyc" ).hasClass('btn-danger')) {
      $( "#traffic-map-button-nyc" ).removeClass('btn-danger');
      $( "#traffic-map-button-nyc" ).addClass('btn-success');
       $('[data-index="nyc"]').attr('fill','green');
    }

    if($( "#traffic-map-button-nyc" ).hasClass('off')) {
      $( "#traffic-map-button-nyc" ).removeClass('off');
      $( "#traffic-map-button-nyc" ).addClass('btn-danger');

      var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');
    
    mapObject.addMarker('nyc',{ latLng: [40.6700, -73.9400], name: 'New York' });

    }
    }  
  });

   $( "#traffic-map-button-losangeles" ).click(function() {

    if($( "#traffic-map-button-losangeles" ).hasClass('btn-success')) {
      $( "#traffic-map-button-losangeles" ).removeClass('btn-success');
      $( "#traffic-map-button-losangeles" ).addClass('off');
      console.log('try');
       $('[data-index="losangeles"]').remove();
    } else {

      if($( "#traffic-map-button-losangeles" ).hasClass('btn-danger')) {
      $( "#traffic-map-button-losangeles" ).removeClass('btn-danger');
      $( "#traffic-map-button-losangeles" ).addClass('btn-success');
       $('[data-index="losangeles"]').attr('fill','green');
    }

    if($( "#traffic-map-button-losangeles" ).hasClass('off')) {
      $( "#traffic-map-button-losangeles" ).removeClass('off');
      $( "#traffic-map-button-losangeles" ).addClass('btn-danger');

      var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');
    
    mapObject.addMarker('losangeles',{ latLng: [34.0500, -118.2500], name: 'Los Angeles' });

    }
    }  
  });





 	 //adding marker with push
 	 var mapChannel = pusher.subscribe('trafficmap');
    mapChannel.bind('addTraffic', function(data) {
     
     	var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');

       mapObject.addMarker(data.name, { latLng: [data.lat, data.lng], name: data.name}  );
 	 //	mapObject.addMarkers([{ latLng: [data.lat, data.lng], name: data.name }], []);


    });

    mapChannel.bind('changeColor', function(data) {
       $('[data-index=' + data.name + ']').attr('fill',data.fill);

	console.log('change color of ' + data.name + ' to: ' + data.fill );

    });

     });

</script>
