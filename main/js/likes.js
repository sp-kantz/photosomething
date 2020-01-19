var webServiceUrl = '../php/lower/like_action.php';

function like(input)
{
	var photo = document.getElementById( 'photo' ).value;
	callWebService(1, photo);
}

function dislike(input)
{
	var photo = document.getElementById( 'photo' ).value;
	callWebService(0, photo);
}

function callWebService(input, photo)
{
	var requestUrl = webServiceUrl + "?action=" + input + "&id=" + photo;	
	try
	{
		var asyncRequest = new XMLHttpRequest(); 

		asyncRequest.onreadystatechange = function() { result( asyncRequest, input ); };

		asyncRequest.open( 'GET', requestUrl, true );
		asyncRequest.send(); 
	} 
	catch ( exception )
	{
		alert ( 'Request Failed' );
	} 
}

function result( asyncRequest, input )
{
	if ( asyncRequest.readyState == 4 )
	{
		var ok = asyncRequest.responseXML.getElementsByTagName("ok");
		if( ok.item(0).firstChild.nodeValue == 1 )
		{
			if( input == 1 )
			{
				var button = document.getElementById("like");
				button.disabled = true;
				var button = document.getElementById("dislike");
				button.disabled = false;
			}
			else
			{
				var button = document.getElementById("dislike");
				button.disabled = true;
				var button = document.getElementById("like");
				button.disabled = false;
			}
		}
	} 
} 
