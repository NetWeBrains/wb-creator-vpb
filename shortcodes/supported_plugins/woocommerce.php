<?php 

/**
	woocommerce plugin support
**/
if( in_array('woocommerce/woocommerce.php', get_option('active_plugins')) ){ //first check if plugin is installed


	$wbcvpb_shortcodes['recent_products'] = array(
		'name' => esc_html__('Recent Products', 'the-creator-vpb' ),
		'description' => esc_html__('Recent products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);



	$wbcvpb_shortcodes['featured_products'] = array(
		'name' => esc_html__('Featured Products', 'the-creator-vpb' ),
		'description' => esc_html__('Featured products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);



	$wbcvpb_shortcodes['products'] = array(
		'name' => esc_html__('Products', 'the-creator-vpb' ),
		'description' => esc_html__('Products', 'the-creator-vpb'),
		'notice' => esc_html__('Show multiple products by IDs or SKUs. To find the Product ID, go to the Product > Edit screen and look in the URL for the postid', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'ids' => array(
				'description' => esc_html__('IDs', 'the-creator-vpb'),
				'info' => esc_html__('coma separated list of product IDs', 'the-creator-vpb'),
			),
			'skus' => array(
				'description' => esc_html__('SKUs', 'the-creator-vpb'),
				'info' => esc_html__('coma separated list of product SKUs', 'the-creator-vpb'),
				'divider' => 'true',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);




	$wbcvpb_shortcodes['product'] = array(
		'name' => esc_html__('Product', 'the-creator-vpb' ),
		'description' => esc_html__('Product', 'the-creator-vpb'),
		'notice' => esc_html__('Show a single product by ID or SKU. To find the Product ID, go to the Product Edit screen and look in the URL for the postid', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('ID', 'the-creator-vpb'),
			),
			'sku' => array(
				'description' => esc_html__('SKU', 'the-creator-vpb'),
			),
		),
	);




	$wbcvpb_shortcodes['add_to_cart'] = array(
		'name' => esc_html__('Add to cart', 'the-creator-vpb' ),
		'description' => esc_html__('Add to cart', 'the-creator-vpb'),
		'notice' => esc_html__('Show the price and add to cart button of a single product by ID.', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('ID', 'the-creator-vpb'),
			),
			'sku' => array(
				'description' => esc_html__('SKU', 'the-creator-vpb'),
			),
		),
	);


	$wbcvpb_shortcodes['add_to_cart_url'] = array(
		'name' => esc_html__('Add to cart URL', 'the-creator-vpb' ),
		'description' => esc_html__('Add to cart URL', 'the-creator-vpb'),
		'notice' => esc_html__('Echo the URL on the add to cart button of a single product by ID.', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('ID', 'the-creator-vpb'),
			),
			'sku' => array(
				'description' => esc_html__('SKU', 'the-creator-vpb'),
			),
		),
	);



	$wbcvpb_shortcodes['product_page'] = array(
		'name' => esc_html__('Product page', 'the-creator-vpb' ),
		'description' => esc_html__('Product page', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('ID', 'the-creator-vpb'),
			),
			'sku' => array(
				'description' => esc_html__('SKU', 'the-creator-vpb'),
			),
		),
	);


	$wbcvpb_shortcodes['product_category'] = array(
		'name' => esc_html__('Product category', 'the-creator-vpb' ),
		'description' => esc_html__('Product category', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'category' => array(
				'description' => esc_html__('Category', 'the-creator-vpb'),
				'info' => esc_html__('Go to: WooCommerce > Products > Categories to find the slug column.', 'the-creator-vpb'),
			),
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'ASC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);




	$wbcvpb_shortcodes['product_categories'] = array(
		'name' => esc_html__('Product categories', 'the-creator-vpb' ),
		'description' => esc_html__('Product categories', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'number' => array(
				'description' => esc_html__('Number', 'the-creator-vpb'),
				'info' => esc_html__('Used to display the number of products', 'the-creator-vpb'),
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'ASC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),  
				'divider' => 'true',    
			),
			'hide_empty' => array(
				'description' => esc_html__('Hide Empty', 'the-creator-vpb'),
				'default' => '1',
				'type' => 'checkbox',
			),
			'ids' => array(
				'description' => esc_html__('IDs', 'the-creator-vpb'),
				'info' => esc_html__('Set ids to a comma separated list of category ids to only show those.', 'the-creator-vpb'),
			),
			'parent' => array(
				'description' => esc_html__('Parent', 'the-creator-vpb'),
				'info' => esc_html__('Set to 0 to only display top level categories.', 'the-creator-vpb'),
			),
		),
	);


	$wbcvpb_shortcodes['sale_products'] = array(
		'name' => esc_html__('Sale Products', 'the-creator-vpb' ),
		'description' => esc_html__('Sale Products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'date',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);


	$wbcvpb_shortcodes['best_selling_products'] = array(
		'name' => esc_html__('Best Selling Products', 'the-creator-vpb' ),
		'description' => esc_html__('Best Selling Products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
			),
		),
	);




	$wbcvpb_shortcodes['top_rated_products'] = array(
		'name' => esc_html__('Top Rated Products', 'the-creator-vpb' ),
		'description' => esc_html__('Top Rated Products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				),      
			),
		),
	);




	$wbcvpb_shortcodes['product_attribute'] = array(
		'name' => esc_html__('Product Attribute', 'the-creator-vpb' ),
		'description' => esc_html__('Product Attribute', 'the-creator-vpb'),
		'notice' => esc_html__('List products with filter by an attribute', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
				'divider' => 'true',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
			'order' => array(
				'default' => 'DESC',
				'type' => 'select',
				'description' => esc_html__( 'Order', 'the-creator-vpb' ),
				'values' => array(
					'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
					'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
				), 
				'divider' => 'true',     
			),
			'attribute' => array(
				'description' => esc_html__('Attribute', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
			),
			'filter' => array(
				'description' => esc_html__('Filter', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
			),
		),
	);




	$wbcvpb_shortcodes['related_products'] = array(
		'name' => esc_html__('Related Products', 'the-creator-vpb' ),
		'description' => esc_html__('Related Products', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-woocommerce',
		'category' =>  esc_html__('Woocommerce', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'per_page' => array(
				'description' => esc_html__('Per Page', 'the-creator-vpb'),
				'info' => esc_html__('How many products to show', 'the-creator-vpb'),
				'default' => '12',
			),
			'columns' => array(
				'description' => esc_html__('Columns', 'the-creator-vpb'),
				'info' => esc_html__('Number of columns to show', 'the-creator-vpb'),
				'default' => '4',
			),
			'orderby' => array(
				'default' => 'title',
				'type' => 'select',
				'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
				'values' => array(
					'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
					'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
					'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
					'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
					'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
					'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
					'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
					'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
					'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
					'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
					'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
				),      
			),
		),
	);

}

