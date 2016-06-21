<?php
	require_once('../../confidential/_GLOBALS.php');
	require_once('../class/classloader.php');
	require_once('authgate.php');
  
	 if(!isset($_POST['input_name']) or strlen($_POST['input_name']) < 1)
	 {
		exit('ERROR: PLEASE_SPECIFY_A_CORRECT_NAME');
	 }
  
	 if(!isset($_POST['input_desc']) or strlen($_POST['input_desc']) < 1)
	 {
		 exit('ERROR: PLEASE_SPECIFY_A_CORRECT_DESCRIPTION');
	 }
	
	$ext = pathinfo($_FILES['input_picture']['name'], PATHINFO_EXTENSION);
	
	
	if(!file_exists('../images/products/'.$_POST['input_article_nr']))
	{
		mkdir('../images/products/'.$_POST['input_article_nr']);
	}
  
	$target_path = 'images/products/'.$_POST['input_article_nr'].'/'.date('YmdHi').'.'.$ext;
	
	/*echo('target: '.$target_path.'<br>');
	echo('TmpName: '.$_FILES['input_picture']['tmp_name'].'<br>');
	echo('Name: '.$_FILES['input_picture']['name'].'<br>');
	echo('Type: '.$_FILES['input_picture']['type'].'<br>');
	echo('Size: '.$_FILES['input_picture']['size'].'<br>');
	echo('Error: '.$_FILES['input_picture']['error']);
	*/
	
	if(!move_uploaded_file($_FILES['input_picture']['tmp_name'], '../'.$target_path))
	{
		exit('There was an error uploading your picture! Please make sure its not too big!');
	}
	
	//directory for comment data
	/* NOT LONGER INCLUDED
			if(!file_exists('../data/products/'.$_POST['input_article_nr']))
	{
		mkdir('../data/products/'.$_POST['input_article_nr']);
	}*/
	
	
	$db = new database();
	$db->connect();
	
	
	$sql = "INSERT INTO
				`products`
			(
				`id`, 
				`category_id`, 
				`name`, 
				`desc`, 
				`rating`, 
				`price`, 
				`size`, 
				`amount`, 
				`article_nr`, 
				`picture_url`, 
				`location`
			)
			VALUES
			(
				NULL, 
				'{$_POST['input_kategorie']}', 
				'{$_POST['input_name']}', 
				'{$_POST['input_desc']}', 
				'0', 
				'{$_POST['input_price']}', 
				'{$_POST['input_size']}', 
				'{$_POST['input_amount']}', 
				'{$_POST['input_article_nr']}', 
				'{$target_path}',
				'{$_POST['input_location']}'
			);";
	
	/*
	$sql = "INSERT INTO
				products
			(
				id,
				category_id,
				name,
				desc,
				rating,
				price,
				size,
				amount,
				article_nr,
				picture_url,
				location
			)
			VALUES
			(
				NULL,
				".$_POST['input_kategorie'].",
				'".$_POST['input_name']."',
				'".$_POST['input_desc']."',
				0,
				".$_POST['input_price'].",
				".$_POST['input_size'].",
				".$_POST['input_amount'].",
				'".$_POST['input_article_nr']."',
				'".$target_path."',
				'".$_POST['input_location']."'
		)
	";
	*/
	
	
	if(!$result = $db->query($sql))
	{
		echo($result.'<br>');
		echo($db->getError());
		echo('There was an error uploading the product to the database.');
	}
	
	$db->disconnect();
?>

<html>
	<head>
		<? //<meta http-equiv="refresh" content="1; URL=index.php?pid=admin_conf"> ?>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>Administration</title>
	</head>
	<body>
	<center>
		Ihr Produkt wurde eingestellt!<br><br>
		<table id="admin">
      <tr class="alt">
        <td width="200px">
          Name:
        </td>
        <td colspan="3">
          <? echo($_POST['input_name']); ?>
        </td>
      </tr>
      <tr>
        <td>
          Beschreibung:
        </td>
        <td colspan="3">
          <? echo(nl2br($_POST['input_desc'])); ?>
        </td>
      </tr>
      <tr class="alt">
        <td>
          Kategorie:
        </td>
        <td colspan="3">
			<? echo($_POST['input_kategorie']); ?>
        </select>
        </td>
      </tr>
      <tr>
            <td>
          Größe:
        </td>
        <td>
          <? echo($_POST['input_size']); ?>
        </td>
            <td width="200px">
          Lagerbestand:
        </td>
        <td>
          <? echo($_POST['input_amount']); ?>
        </td>
          </tr>
      <tr class="alt">
        <td>
          Preis:
        </td>
        <td align="right" style="padding-right:25px;">
          <? echo($_POST['input_price']); ?> €
        </td>
        <td>
          Artikelnummer:
        </td>
        <td>
          <? echo($_POST['input_article_nr']); ?>
        </td>
      </tr>
      <tr>
        <td>
          Referenzbild:
        </td>
        <td colspan="3" align="left">
          <img src="<? echo('../'.$target_path); ?>">
        </td>
      </tr>
    </table>
	<br><br>
	<a href="index.php?pid=add_product">Weiter...</a>
	</center>
	</body>
</html>
