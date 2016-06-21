var panels = new Array('panel1', 'panel2', 'panel3', 'panel4', 'panel5', 'panel6', 'panel7');
var selectedTab = null;
steps = ['Artikelübersicht', 'Adresse', 'Bezahloptionen', ['Bestätigung', '#f88', '#800']];

function showPanel(tab, name)
	{
		if (selectedTab) 
			{
				selectedTab.style.backgroundColor = '';
				selectedTab.style.paddingTop = '';
				selectedTab.style.marginTop = '4px';
			}
		selectedTab = tab;
		selectedTab.style.backgroundColor = 'white';
		selectedTab.style.paddingTop = '6px';
		selectedTab.style.marginTop = '0px';

		for(i = 0; i < panels.length; i++)
			document.getElementById(panels[i]).style.display = (name == panels[i]) ? 'block':'none';

		return false;
	}
	
function progressBar(steps, step)
	{
		var i, width = (99 / steps.length).toFixed(2), html = '', text, back, objc;
		for (i = 0; i < steps.length; i++) 
		{
			objc = typeof steps[i] === 'object';
			if (i <= (step - 1)) 
				{
					text = '#fff'; 
					back = objc ? (steps[i][2] || '#999') : '#999';
				} 
			else 
				{
					text = '#000'; 
					back = objc ? (steps[i][1] || '#eee') : '#eee';
				}
			html +=
					'<div class="Step" style="width: ' + width + '%; color: ' + text + '; background-color: ' + back + '; z-index: ' + (steps.length - i) + ';">						<a href class="tabs" onmousedown="setStep('+(i+1)+');return event.returnValue = showPanel(this, \'panel'+(i+1)+'\');" id="tab1" onclick="return false;">' +
					(objc ? steps[i][0] : steps[i]) + (i < (steps.length - 1) ? '</a><div class="Arrow"><div class="Arrow-Head"><div style="border-color: transparent transparent transparent ' + back + ';"></div></div></div>' : '') +
					'</div>';
			}
		return '<div class="ProgressBar">' + html + '</div>';  
	}
			
function incStep()
	{
		if(step <4)
			{
				step++;
				document.all.progresscontent.innerHTML = progressBar(steps = ['Artikelübersicht', 'Adresse', 'Bezahloptionen', ['Bestätigung', '#f88', '#800']], step);
			}
	}
function setStep(number) 
	{
		step=number;
	}
function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function editArticle(id, amount)
{
var cart = document.getElementById("item_post").value.split("_");
for (i = 0; i <= cart.length;i++)
{
	if (cart[i].indexOf("x"+id)!=-1)
	{
	cart[i] = amount+"x"+id;
	}
}
document.getElementById("item_post").value=cart.join("_");

}

function incAmount(elid)
	{
		var id = 0;
		var price;
		id = parseInt(elid.parentNode.id.replace("innerrow", ""));
		var paysum=document.getElementById("paysum");
		var newpaysum= parseInt(paysum.innerHTML.substring(3,paysum.innerHTML.indexOf("€")));
		var euro= elid.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[7];
		var price_string = euro.innerHTML.slice(0,euro.innerHTML.indexOf("€"));
		price=parseInt(price_string);
		newpaysum=newpaysum - price;		
		var prev=parseInt(elid.innerHTML);
		
		price=price/prev;
		prev++;
		price=price*prev;
		
		newpaysum=newpaysum + price;
		
		paysum.innerHTML ="<u>"+newpaysum+"€</u>";
		euro.innerHTML=price+"€";
		elid.innerHTML=prev;	
		
	}	
function decAmount(elid)
	{
		var id = 0;
		var price;
		id = parseInt(elid.parentNode.id.replace("innerrow", ""));
		var paysum=document.getElementById("paysum");
		var newpaysum= parseInt(paysum.innerHTML.substring(3,paysum.innerHTML.indexOf("€")));
		var euro= elid.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[7];
		var price_string = euro.innerHTML.slice(0,euro.innerHTML.indexOf("€"));
		price=parseInt(price_string);
		var prev=parseInt(elid.innerHTML);
		newpaysum=newpaysum - price;
		
		if(prev==0)
			{
				paysum.innerHTML ="<u>"+newpaysum+"€</u>";
				elid.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.removeChild(elid.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[elid.parentNode.parentNode.parentNode.parentNode.parentNode.rowIndex]);
			}
		else{
				price=price/prev;
				prev--;
				price=price*prev;
				newpaysum=newpaysum + price;
				paysum.innerHTML ="<u>"+newpaysum+"€</u>";
				euro.innerHTML=price+"€";
				elid.innerHTML=prev;
			}
		
	}
function setCookie()
{
}
