var webServiceUrl = 'lower/fetch_locations.php';

window.onload = getMyLocation;

function getMyLocation() 
{
	displayDefault();
	if (navigator.geolocation) 
	{
		navigator.geolocation.getCurrentPosition(displayLocation);
		return ;
	} 		
}

function displayLocation(position) 
{
	var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;

	showMap(position.coords);
}

var map;

function displayDefault() 
{
	var googleLatAndLong = new google.maps.LatLng("37.983174833513395", "23.7249755859375");

	var mapOptions = {zoom: 8, center: googleLatAndLong, mapTypeId: google.maps.MapTypeId.ROADMAP};

	var mapDiv = document.getElementById("map_index");

	map = new google.maps.Map(mapDiv, mapOptions);

	callWebService();
}

function showMap(coords) 
{
	var googleLatAndLong = new google.maps.LatLng(coords.latitude, coords.longitude);

	var mapOptions = {zoom: 8, center: googleLatAndLong, mapTypeId: google.maps.MapTypeId.ROADMAP};

	var mapDiv = document.getElementById("map_index");

	map = new google.maps.Map(mapDiv, mapOptions);

	callWebService();
}


function callWebService()
{
	try
	{
		var asyncRequest = new XMLHttpRequest(); 

		asyncRequest.onreadystatechange = function() { result( asyncRequest ); };

		asyncRequest.open( 'GET', webServiceUrl, true );
		asyncRequest.send(); 
	} 
	catch ( exception )
	{
		alert ( 'Request Failed' );
	} 
}

function result( asyncRequest)
{
	if ( asyncRequest.readyState == 4 )
	{
		var namelist = asyncRequest.responseXML.getElementsByTagName("mark");
		
		for(i=0; i<namelist.length; i++)
		{
			var id = namelist[i].getAttribute("id");

			var point = new google.maps.LatLng(
				parseFloat(namelist[i].getAttribute("lat")),
				parseFloat(namelist[i].getAttribute("long")));
			var html = "<a href=\"view_photo.php?id=" + id + "\"><img src=\"lower/scale_image.php?image=/var/www/thumbnails/"+ id +"\"/></a>";
			var markerOptions = { position: point, map: map, clickable: true, draggable:false };
			var marker = new google.maps.Marker(markerOptions);
			var infoWindow = new google.maps.InfoWindow;
			bindInfoWindow(marker, map, infoWindow, html);

		} 
	}	
} 

function bindInfoWindow(marker, map, infoWindow, html) 
{
	google.maps.event.addListener(marker, 'click', function(){
		infoWindow.setContent(html);
		infoWindow.open(map, marker);
	});
}

