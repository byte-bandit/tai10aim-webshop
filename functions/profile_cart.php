<table style="font-family:Verdana, serif; font-size:0.8em;" width="100%">
<tr>
<td>
<?php
echo("<script type='text/javascript' src='/functions/function.js'></script>");
require_once('cartview.php');
echo(cartview(5, true));
?>
</td>
</tr>
</table>