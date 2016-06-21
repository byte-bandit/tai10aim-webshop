<?php

  //require_once('../authgate.php'); Unlogged Users can do da same! :)

		if( !isset($_COOKIE['cart_items']))
		{
			//Initialize Shopping Cart if it's not set
			//And also, assign it!
			setcookie('cart_items', '1x'.$_GET['id'], time()+60*60*2 , ".tai10aim.no-ip.org");
		}else{
			$value = $_COOKIE['cart_items'];
			$value_str = explode('_', $value);
			$matchFound = false;
			$myCount = 0;
			foreach($value_str as $substring)
			{
				$myID = substr($substring, strpos($substring, 'x') + 1);
				$myAmount = intval(substr($substring, 0, strpos($substring, 'x')));
				
				if($myID == $_GET['id'])
				{
					$myAmount ++;
					array_splice($value_str, $myCount, 1, strval($myAmount).'x'.$myID);
					$matchFound = True;
				}
				
				$myCount ++;
			}
			if($matchFound)
			{
				$value = implode('_', $value_str);
				setcookie('cart_items', $value, time()+60*60*2,  ".tai10aim.no-ip.org" );
			}else{
				$value = $value.'_1x'.$_GET['id'];
				setcookie('cart_items', $value, time()+60*60*2, ".tai10aim.no-ip.org" );
			}
			
		}		


?>