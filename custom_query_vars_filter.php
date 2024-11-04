function custom_query_vars_filter($vars) {
  $vars[] = 'orderby';
  $vars[] .= 'order';
  return $vars;
}
add_filter( 'query_vars', 'custom_query_vars_filter' );

function search_filter($query) {
	$orderby = get_query_var( 'orderby' );
	$order = get_query_var( 'order' );
	
	if ( !is_admin() && $query->is_main_query() ) {
		if ($query->is_search) {
			$query->set('post__not_in', array(533,568,676,706));
			$query->set('post_type', array( 'page', 'post'));
			if( $orderby == "date" ){
				$query->set( 'orderby', 'date' );
			} else {
				$query->set( 'orderby', 'title' );
			}
			if( $order == "desc" ){
				$query->set( 'order', 'desc' );
			} else {
				$query->set( 'order', 'asc' );
			}
		}
	}
}

add_action('pre_get_posts','search_filter');
