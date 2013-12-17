<script>
 	
 	 $(function(){

      	$('#traffic-map').vectorMap({
			  map: 'us_lcc_en',
        markersSelectableOne: false,
        markersSelectable: false,
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
    
    mapObject.addMarker('lasvegas',{ latLng: [32.7150, -117.1625], name: 'San Diego' });

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
    
    mapObject.addMarker('nyc',{ latLng: [32.7758, -96.7967], name: 'Dallas' });

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
    
    mapObject.addMarker('losangeles',{ latLng: [41.8819, -87.6278], name: 'Chicago' });

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
