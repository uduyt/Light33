
    window.onload=function onloadd(){
	var l=document.getElementById("sidebar")
	var k=document.getElementById("content")
	var b=document.getElementsByTagName("body")[0]
	l.style.height=k.offsetHeight+310+"px"
	b.style.height=l.offsetHeight+80+"px"
	}
function mouseoverdt( x,t)
{

   // cerrar todos umenus
	for (i=1;i<20;i++)
	{
		// dt back
		l=document.getElementById("menu"+i)
		if (l) 
		{
			l.style.width = "170px"
			l.style.backgroundColor = "#339a99"
		} 
		
		// cerrar umenus	
		h = document.getElementById("umenu"+i )
		
		if (h) 
		{	 
			h.style.opacity = "0";   
			h.style.marginLeft="300px";
			h.style.zIndex="1"
		}

		// arr disappear	
		k = document.getElementById("arr"+i )			
		if (k) 
		{		
			k.style.opacity="0";
		}
	}	
	k=document.getElementById( "arr"+t )
	t = document.getElementById( "umenu" +t )
	if (t)
	{
        // abrir umenu
        t.style.opacity = "1";   
		t.style.marginLeft="236px";
		t.style.zIndex="100"
	}
	
	if (x)
	{
		// dt forward
		x.style.width = "220px"
		x.style.backgroundColor = "#1f6060"
		// arr appear
		if (k)
		{
			k.style.opacity="1"
		}
	}
	
	
	
	

}

function mouseoutdt( i)
{
   
}



function mouseoutdts( x)
{
 
         x.style.width = "170px";
         x.style.backgroundColor = "#339a99";
   
}


function mouseclicdt( x, t )
	{

		h = document.getElementById( "umenu"+t )
		k= document.getElementById( "arr"+t )
		// si umenu cerrado
		if ( x.style.width != "220px" )
		{
			if ( h )
			{
				// abre umenu
				h.style.zIndex="100"
				h.style.opacity = "1";
				h.style.marginLeft="236px";
				
			}
			// dt forward
			x.style.width = "220px";
			x.style.backgroundColor = "#1f6060"
			// arr appear
			if (k)
			{
				k.style.opacity="1"
			}
		}

		// si umenu abierto
		else
		{
			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
		}
}

// li forward
function mouseoverli( x )
{
   x.style.width = "192px"
   x.style.backgroundColor = "#16825a"
}

// li back
function mouseoutli( x )
{
   x.style.width = "160px"
   x.style.backgroundColor = "#339a99"
}

//  ---------------------------------------


//menu2
$(document).ready(function(){
  $("#menu2").mouseleave(function(){
  
	if (event.relatedTarget.tagName != "UL" && event.relatedTarget.tagName != "LI" ){
	
	h = document.getElementById( "umenu2" )
	k= document.getElementById( "arr2" )
	x= document.getElementById( "menu2" )

			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
	}
  });
});


//menu3
$(document).ready(function(){
  $("#menu3").mouseleave(function(){
		if (event.relatedTarget.tagName != "UL" && event.relatedTarget.tagName != "LI" ){
	
	h = document.getElementById( "umenu3" )
	k= document.getElementById( "arr3" )
	x= document.getElementById( "menu3" )

			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
	}
  });
});

//menu4
$(document).ready(function(){
  $("#menu4").mouseleave(function(){
		if (event.relatedTarget.tagName != "UL" && event.relatedTarget.tagName != "LI" ){
	
	h = document.getElementById( "umenu4" )
	k= document.getElementById( "arr4" )
	x= document.getElementById( "menu4" )

			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
	}
  });
});

//menu2
$(document).ready(function(){
  $("#menu5").mouseleave(function(){
		if (event.relatedTarget.tagName != "UL" && event.relatedTarget.tagName != "LI" ){
	
	h = document.getElementById( "umenu5" )
	k= document.getElementById( "arr5" )
	x= document.getElementById( "menu5" )

			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
	}
  });
});




//menu6
$(document).ready(function(){
  $("#menu6").mouseleave(function(){
		if (event.relatedTarget.tagName != "UL" && event.relatedTarget.tagName != "LI" ){

	h = document.getElementById( "umenu6" )
	k= document.getElementById( "arr6" )
	x= document.getElementById( "menu6" )
			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
	}
  });
});






//umenu2
$(document).ready(function(){
  
  $("#umenu2").mouseleave(function(){
	h = document.getElementById( "umenu2" )
	k= document.getElementById( "arr2" )
	x= document.getElementById( "menu2" )
	if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
  });
});

//umenu3
$(document).ready(function(){
  
  $("#umenu3").mouseleave(function(){
	h = document.getElementById( "umenu3" )
	k= document.getElementById( "arr3" )
	x= document.getElementById( "menu3" )
	if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
  });
});

//umenu4
$(document).ready(function(){
  
  $("#umenu4").mouseleave(function(){
	h = document.getElementById( "umenu4" )
	k= document.getElementById( "arr4" )
	x= document.getElementById( "menu4" )
	if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
  });
});

//umenu5
$(document).ready(function(){
  
  $("#umenu5").mouseleave(function(){
	h = document.getElementById( "umenu5" )
	k= document.getElementById( "arr5" )
	x= document.getElementById( "menu5" )
			if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
  });
});
//umenu6
$(document).ready(function(){
  
  $("#umenu6").mouseleave(function(){
	h = document.getElementById( "umenu6" )
	k= document.getElementById( "arr6" )
	x= document.getElementById( "menu6" )
	if ( h )
			{
				// cierra umenu
				h.style.opacity = "0";
				h.style.marginLeft = "300px";
				h.style.zIndex="1"
			}
			// dt back
			x.style.width = "170px"
			x.style.backgroundColor = "#339a99"
			//arr disappear
			if (k) 
			{		
				k.style.opacity="0";
			}
  });
});


