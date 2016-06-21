<?PHP
?>

<html>
<head>
<script type="text/javascript">
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
</script>
</head>
<body>
<form onSubmit="editArticle(56, 3)">
<input type="text" id="item_post" value="1x56_2x34">zeug</input>
<a href="" onClick="editArticle(56, 3);return false"><geiler scheiß</a>
</form>
</body>
</html>