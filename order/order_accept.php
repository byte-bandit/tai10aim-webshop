<?php
  require_once('../../confidential/_GLOBALS.php');
  require_once('../class/classloader.php'); 
  require_once('../authgate.php');

$db =new database();
$db->connect();
$bill_number=time();
$bill_number.=$_SESSION['user_id'];
$sql="
	INSERT INTO
		purchases
			(
				id,
				user_id,
				bill_number,
				purch_date,
				pay_date,
				status,
				archive
			)
			VALUES
			(
				NULL,
				{$_SESSION['user_id']},
				{$bill_number},
				CURRENT_TIMESTAMP,
				NULL,
				1,
				0
			)
";
$db->query($sql);

$sql="
	INSERT INTO
		addresses
			(
				id,
				user_id,
				street,
				number,
				zipcode,
				location,
				country,
				state,
				misc,
				type
			)
			VALUES
			(
				NULL,
				{$_SESSION['user_id']},
				{$_POST['street']},
				{$_POST['number']},
				{$_POST['zipcode']},
				{$_POST['location']},
				'GERMANY',
				'',
				'',
				1
			)
";

$db->query($sql);
writeArticles($db->getLastId(), explode('_',$_COOKIE['cart_items']));

$db->disconnect();

?>
<html>
	<head>
		<meta http-equiv="refresh" content="5; URL=../index.php">
		<title>Profil</title>
	</head>
	<body>
		<?php
			
			echo($return);
		?>
		<br>
		<br>
		Sie werden in 1 Sekunden weitergeleitet!
	</body>
</html>

<?

function writeArticles($orderID, $cartString)
{

	$db = new database();
	$db->connect();
	
	foreach($cartString as $substring)
			{
				$myID = substr($substring, strpos($substring, 'x') + 1);
				$myAmount = intval(substr($substring, 0, strpos($substring, 'x')));
				
						$sql="
		INSERT INTO
			article_per_order
				(
					id,
					order_id,
					article_id,
					amount,
				)
				VALUES
				(
					NULL,
					{$orderID}
					{$nr},
					{$amount}
				)
		";
		
		$db->query($sql);
			}

	
	$db->disconnect();

}

?>