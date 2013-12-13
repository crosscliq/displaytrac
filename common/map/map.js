<script>
 	
 	 $(function(){
      	$('#traffic-map').vectorMap({
			  map: 'us_lcc_en',
			  
			  
			});

      	
   	 });

 	 $( "#traffic-map-button" ).click(function() {

 	 	var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');

      mapObject.addMarker('name',{ latLng: [42.940893, -71.444068], name: 'Test' });
 	 //	mapObject.addMarkers([{ latLng: [42.940893, -71.444068], name: 'Test' }], []);

	});

 	 //adding marker with push
 	 var mapChannel = pusher.subscribe('trafficmap');
    mapChannel.bind('addTraffic', function(data) {
     
     	var mapObject = $('#traffic-map').vectorMap('get', 'mapObject');

       mapObject.addMarker(data.name, { latLng: [data.lat, data.lng], name: data.name, style: {fill: data.fill}}  );
 	 //	mapObject.addMarkers([{ latLng: [data.lat, data.lng], name: data.name }], []);


    });





 
 	 </script>