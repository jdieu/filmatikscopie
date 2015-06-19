/* début barre de progression */
var maxprogress = 100;   // total à atteindre
var actualprogress = 0;  // valeur courante
var itv = 0;  // id pour setinterval
function prog()
{
  if(actualprogress >= maxprogress) 
  {
	clearInterval(itv);   	
	return;
  }	
  var progressnum = document.getElementById("progressnum_create");
  var indicator = document.getElementById("indicator_create");
  actualprogress += 3;	
  indicator.style.width=actualprogress + "%";
  if(actualprogress == maxprogress) clearInterval(itv);   
}
/* fin barre de progression */



