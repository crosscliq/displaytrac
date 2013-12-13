<script>
 	
 	 $(function(){
      	$('#traffic-map').vectorMap({
			  map: 'us_lcc_en',
			  markersSelectableOne: false,
			  markersSelectable: false,
			     markerStyle: {
      				initial: {
        				fill: 'red',
        				stroke: '#0088cc'
      				},
				 hover: {
				}
    			    }
			  
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

       mapObject.addMarker(data.name, { latLng: [data.lat, data.lng], name: data.name}  );
 	 //	mapObject.addMarkers([{ latLng: [data.lat, data.lng], name: data.name }], []);


    });

    mapChannel.bind('changeColor', function(data) {
       $('[data-index=' + data.name + ']').attr('fill',data.fill);

	console.log('change color of ' + data.name + ' to: ' + data.fill );

    });





 
 	 </script>
