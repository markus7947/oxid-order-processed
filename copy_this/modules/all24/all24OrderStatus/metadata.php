<?php
/**
 * ALL24 OrderStatus Modul
 *
 * @author Markus Koller
 */
$sMetadataVersion = '1.0';
$aModule = array(
    'id'           => 'all24OrderStatus',
    'title'        => 'ALL24 OrderStatus',
    'description'  => 'erweitert Bestellungen mit "jetzt bearbeiten"',
    'thumbnail'    => 'all24_orderstatus.png',
    'version'      => '1.0.0',
    'author'       => 'Markus Koller',
    'email'        => '',
    'extend'       => array(
			'order_overview' => 'all24/all24OrderStatus/application/controllers/admin/all24_order_overview',
			'oxemail' => 'all24/all24OrderStatus/core/all24_oxemail'
			
    ),
    'files'        => array(
			'all24orderoverview' =>'all24/all24OrderStatus/application/controllers/admin/all24_order_overview.php',
			'oxemail' => 'all24/all24OrderStatus/core/all24_oxemail.php'
	),
	'templates' => array(
    'processed_html.tpl' => 'all24/all24OrderStatus/application/views/tpl/email/html/processed_html.tpl',
	'processed_plain.tpl'=> 'all24/all24OrderStatus/application/views/tpl/email/plain/processed_plain.tpl',
 ),
    'blocks'       => array(
			array('template'=> 'order_overview.tpl',
				'block' => 'admin_order_overview_send_form',
				'file'  => '/application/views/admin/all24_order_overview.tpl'),
			array('template'=> 'page/account/order.tpl',
				'block'=> 'account_order_history',
				'file' => '/application/views/tpl/page/account/all24_order.tpl'),
			array('template'=> 'shop_main.tpl',
				'block'=> 'admin_shop_main_emailsubject',
				'file' => '/application/views/admin/all24_shop_main.tpl'),
			
    
    )
	
    
);


