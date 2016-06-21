<table id="statusbar">
<table id="statusbar">
	<tr>
		<? require_once('statusbar.php'); ?>
	</tr>
	<tr>
		</td>
			<table class="global">
				<tr>
					<td class="global">
						<?php
							require_once('admin_panel_nav.php');
						?>
					</td>
					<td>
						<?php
							switch($_GET['pid'])
							{
								case 'shop_conf':
									require_once('admin_panel_shop_conf.php');
									break;
								case 'admin_conf':
									require_once('admin_panel_admin_conf.php');
									break;
								
								case 'add_admin':
									require_once('admin_panel_admin_add.php');
									break;
									
								case 'add_location':
									require_once('admin_panel_location_add.php');
									break;
									
								case 'add_category':
									require_once('admin_panel_category_add.php');
									break;
									
								case 'add_user':
									require_once('admin_panel_user_add.php');
									break;
									
								case 'edit_user':
									require_once('admin_panel_user_edit.php');
									break;
								case 'edit_admin':
									require_once('admin_panel_admin_edit.php');
									break;
								
								case 'account_conf':
									require_once('admin_panel_account_conf.php');
									break;
								
								case 'user_conf':
									require_once('admin_panel_user_conf.php');
									break;
									
								case 'category_conf':
									require_once('admin_panel_category_conf.php');
									break;
								case 'edit_cat':
									require_once('admin_panel_category_edit.php');
									break;
								
								case 'location_conf':
									require_once('admin_panel_location_conf.php');
									break;

								case 'edit_location':
									require_once('admin_panel_location_edit.php');
									break;
									
								case 'add_product':
									require_once('admin_panel_add_product.php');
									break;
								
								case 'products':
									require_once('admin_panel_products.php');
									break;
								
								case 'products_edit':
									require_once('admin_panel_products_edit.php');
									break;
								
								case 'products_comment_update':
									require_once('admin_panel_products_edit_update_comments.php');
									break;
								
								case 'orders':
									require_once('admin_panel_orders.php');
									break;
								
								default:
									break;
							}
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
