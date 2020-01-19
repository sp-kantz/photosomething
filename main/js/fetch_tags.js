var webServiceUrl = '../php/lower/fetch_tags.php';
var checked;

function check0()
{
	checked=0;
}

function check1()
{
	checked=1;
}

function searcha(input)
{
	if ( checked == 1 )
	{
		var listBox = document.getElementById( 'names' );
		listBox.innerHTML = ''; 
	
		if ( input !== "" ) 
		{
			callWebService(input);
		} 
	}
	else
	{
		var listBox = document.getElementById( 'names' );
		listBox.innerHTML = ''; 
	}
}

function callWebService(input)
{
	var requestUrl = webServiceUrl + "?tags=" + input;	
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

function result( asyncRequest, par1 )
{
	if ( asyncRequest.readyState == 4 )
	{
		var _suggel = document.getElementById("names");
		_suggel.style.top = par1.offsetTop + 20 + "px"; 
		_suggel.style.left = par1.offsetLeft + "px";
		_suggel.innerHTML="";
		var namelist = asyncRequest.responseXML.getElementsByTagName("tag");
		for(i=0; i<namelist.length; i++)
		{
			_suggel.innerHTML = _suggel.innerHTML + "<a href=\"search.php?where=tags&search="+ namelist.item(i).firstChild.nodeValue +"\">" + namelist.item(i).firstChild.nodeValue + "</a>" + "</br>";
		}
		_suggel.style.display='block';
	} 
} 
