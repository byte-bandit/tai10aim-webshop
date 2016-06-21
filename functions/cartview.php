<?php 
require_once('productview_func.php');

function cartview($columns,$link)   //shows the content of the shoppingcart with 5 or 2 columns and de/activated product links
{
$html='	<table id="carttable" style="font-size:1.0em;" width="90%">
			<tr>';
if($columns==5)
{
$html.='		<th align="left">Nummer</th>
				<th align="left">Anzahl</th>
				';}
$html.='		<th align="left">Artikel</th>
				<th align="left">Preis</th>';
if($columns==5)
{
$html.='		<th>Sonstiges</th>
			</tr>';}
$paysum = 0;

if(!isset($_COOKIE['cart_items']) || $_COOKIE['cart_items'] == '')
{
	exit("Es befinden sich keine Artikel im Warenkorb");
}

$cart = explode("_", $_COOKIE['cart_items']); //splits the cookie which inhibits the articles and fits the values into an array
foreach($cart as &$info)
{
	$rowcount=0;
	$data=explode('x',$info);
	$row=getProductdata($data[1]);
	$paysum += $data[0]*$row->price;
	$html.='<tr id="outerrow'.$data[1].'">';
	if($columns == 5){
		$html .='
		<td class="product_id">'.$row->article_nr.'	</td>
		<td id="amount'.$data[1].'">	
			<table class="amounttable">
				<tr id="innerrow'.$data[1].'">
					<td>
						<a href onClick="decAmount(this.parentNode.parentNode.cells[1]); return false">-</a>
					</td>	
					<td id="tag'.$data[1].'">'.$data[0].'</td>
					<td id="test1">
						<a href id="link'.$data[1].'" onClick="incAmount(this.parentNode.parentNode.cells[1]); return false;" >+</a>	
					</td>
				</tr>
			</table>
		</td>'; 
		}
	
	$html.='	
	<td class="cart_items">';
	if($link)
		{$html.='<a href="index.php?action=viewProduct&id='.$data[1].'">'.$row->name.'</a>';} 
	else
		{$html.=$row->name;}
	$html.='
	</td>
	<td id="price'.$data[0].'">'.$data[0]*$row->price.'€	</td>';
	if($columns ==5)
		{
		if($row->amount< $data[0])
			{
				$html.='<td class"misc">Nicht genügend vorrätig</td>';
			}
		else{
				$html.='<td>	</td>';
			}
		}
	$html.='</tr>';	 
}								
$html.='<tr>';
if($columns ==5)
	{
	$html .='<th></th>
			<th></th>';
	}
$html.='<th><u>Endpreis:</u></th>
		<th id="paysum"><u>'.$paysum.'€ </u></th>';
		
if($columns ==5)
	{
	$html.='	<th></th>';
	}
$html.='</tr></table>';
return $html;
}
?>
