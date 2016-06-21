<table class="products" width="100%">
<tr>
<td>
<?php
	switch($_GET['action'])
	{
		case 'viewProduct':
			require_once('functions/productview.php');
			break;

		case 'profile':
			require_once('functions/profile.php');
			break;
			
		default:
			require_once("functions/product_links.php");
			break;
	}
?>
</td>
</tr>
</table>
