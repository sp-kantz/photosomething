window.onload=getMyLocation;

function getMyLocation() 
{
	display();
}

var map;

function display() 
{
	var latit=document.getElementById("lat").value;
	var longit=document.getElementById("long").value;
	var googleLatAndLong=new google.maps.LatLng(latit, longit);

	var mapOptions={zoom: 6, center: googleLatAndLong, mapTypeId: google.maps.MapTypeId.ROADMAP};

	var mapDiv=document.getElementById("map");

	map=new google.maps.Map(mapDiv, mapOptions);

	addMarker(map, googleLatAndLong);
}

function addMarker(map, latlong) 
{
	var markerOptions={ position: latlong, map: map, clickable: true, draggable:false };
	var marker=new google.maps.Marker(markerOptions);

}



