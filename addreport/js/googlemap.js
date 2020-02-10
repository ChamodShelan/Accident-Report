var map;
var geocoder;

function loadMap() {
	var nsbm = {lat: 6.821895, lng: 80.041533};
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: nsbm
    });

    //var marker = new google.maps.Marker({
      //position: nsbm,
     // map: map
    //});

    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();  
    codeAddress(cdata);

    var allData = JSON.parse(document.getElementById('allData').innerHTML);
	showAll(allData)
	

	google.maps.event.addListener(map,'click',function(event) {
		var marker = new google.maps.Marker({
		  position: event.latLng, 
		  map: map, 
		  title: event.latLng.lat()+', '+event.latLng.lng()
		});                
	});

	google.maps.event.addListener(map,'click',function(event) {                
		document.getElementById('latclicked').innerHTML = event.latLng.lat();
		document.getElementById('longclicked').innerHTML =  event.latLng.lng();
	});

	google.maps.event.addListener(map,'mousemove',function(event) {
		document.getElementById('latmoved').innerHTML = event.latLng.lat();
		document.getElementById('longmoved').innerHTML = event.latLng.lng();
	});



}

function showAll(allData) {
	var infoWind = new google.maps.InfoWindow;
	Array.prototype.forEach.call(allData, function(data){
		var content = document.createElement('div');
		var strong = document.createElement('strong');
		
		strong.textContent = data.name;
		content.appendChild(strong);

		var img = document.createElement('img');
		img.src = 'img/accident.jpg';
		img.style.width = '100px';
		content.appendChild(img);

		var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(data.lat, data.lng),
	      map: map
	    });

	    marker.addListener('mouseover', function(){
	    	infoWind.setContent(content);
	    	infoWind.open(map, marker);
	    })
	})
}

function codeAddress(cdata) {
   Array.prototype.forEach.call(cdata, function(data){
    	var address = data.name + ' ' + data.address;
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == 'OK') {
	        map.setCenter(results[0].geometry.location);
	        var points = {};
	        points.id = data.id;
	        points.lat = map.getCenter().lat();
	        points.lng = map.getCenter().lng();
	        updateCollegeWithLatLng(points);
	      } else {
	        alert('Geocode was not successful for the following reason: ' + status);
	      }
	    });
	});
}

function updateCollegeWithLatLng(points) {
	$.ajax({
		url:"action.php",
		method:"post",
		data: points,
		success: function(res) {
			console.log(res)
		}
	})
	
}