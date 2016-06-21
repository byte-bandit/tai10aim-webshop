function incAmount(elid)
	{
		var prev=parseInt(elid.innerHTML);
		prev++;
		elid.innerHTML=prev;
	}	
function decAmount(elid)
	{
		var prev=parseInt(elid.innerHTML);
		if(prev==0)
		{
		elid.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(elid.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[elid.parentNode.parentNode.parentNode.parentNode.parentNode.rowIndex]);
		}
		else{
		prev--;
		elid.innerHTML=prev;
		}
	}