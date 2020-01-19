window.onload=getMyLocation;

function getMyLocation() 
{
	display();
}

var map;

function display() 
{
	var div=document.forms[0]; 
	
	var latit=div.elements["lat"].value; 
	var longit=div.elements["long"].value;
	var googleLatAndLong=new google.maps.LatLng(latit, longit);

	var mapOptions={zoom: 2, center: googleLatAndLong, mapTypeId: google.maps.MapTypeId.ROADMAP};

	var mapDiv=document.getElementById("map");

	map=new google.maps.Map(mapDiv, mapOptions);

	addMarker(map, googleLatAndLong);
}

function addMarker(map, latlong) 
{
	var markerOptions={ position: latlong, map: map, clickable: true, draggable:true };
	var marker=new google.maps.Marker(markerOptions);
	
	google.maps.event.addListener(marker, 'dragend', function(a) {
		var div=document.forms[0]; 
		div.elements["lat"].value=a.latLng.Xa; 
		div.elements["long"].value=a.latLng.Ya; 
	});

}
