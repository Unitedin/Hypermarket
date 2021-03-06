<?php
/**
 * Split WordPress Posts into Multiple Pages.
 *
 * @package 		Hooked into "hypermarket_end_single_post_content"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4
 */
if (hypermarket_is_post_paginated()):
	echo '<div class="pagination hypermarket-pagination">' . PHP_EOL;
	echo '<div class="pager post-pager">' . PHP_EOL;
	$args = apply_filters('hypermarket_post_paging_args', array(
		'before' => __('Pages:', 'hypermarket') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
		'after' => '',
		'next_or_number' => 'number',
		'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
		'nextpagelink' => __('Next', 'hypermarket') ,
		'previouspagelink' => __('Prev', 'hypermarket') ,
		'pagelink' => '%'
	));
	wp_link_pages($args);
	echo '</div><!-- .pager -->' . PHP_EOL;
	echo '</div><!-- .pagination -->' . PHP_EOL;
endif;