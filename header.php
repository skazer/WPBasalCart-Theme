<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
    <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory') . "/reset.css"; ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Courgette' rel='stylesheet' type='text/css' />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/favicon.ico" />
	<?php wp_head(); ?>
	<?php if(isset($wp_query->query_vars['is_checkout_step']) && (int)$wp_query->query_vars['is_checkout_step']>0):?>
    <meta name="robots" content="noindex,nofollow" />
    <?php elseif(is_archive() || is_paged()):?>
    <meta name="robots" content="noindex,nofollow" />
    <?php else:?>
    <meta name="robots" content="index,follow" />
    <?php endif;?>
	<?php DEFINE('IMGDIR',get_bloginfo('template_directory').'/images/');?>
	<?php //wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
    <?php if(is_single()):?>
    <script>
    $().ready(function() {
        $('#other-products').infinitescroll({
            navSelector  : "div#navigation-link",
            nextSelector : "div#navigation-link a:first",
            itemSelector : "#other-products > div",
			loading: {
				finishedMsg: 'No more pages to load.',
				img: 'http://i.imgur.com/6RMhx.gif'
			}
        });
    });
	</script>
    <?php else:?>
    <script>
    $().ready(function() {
        $('#maincontent').infinitescroll({
            navSelector  : "div#navigation-link",
            nextSelector : "div#navigation-link a:first",
            itemSelector : "#maincontent > div",
			loading: {
				finishedMsg: 'No more pages to load.',
				img: 'http://i.imgur.com/6RMhx.gif'
			}
        });
    });
	</script>
	<?php endif;?>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            <h1 class="courgette">Jetset Tee's</h1>
        </div>
        <div id="nav-menu">
            <ul id="nav-items"><!--
                --><li class="nav-item courgette nav-item-selected"><a href="<?php echo get_bloginfo('home');?>">Home</a></li><!--
                --><li class="nav-item courgette"><a href="javascript:void(0)">Categories</a><!--
                    --><ul>
                        <?php
							$category_terms = get_terms('wp_basalcart_product_category', array('number'=>'5','orderby'=>'name','order'=>'ASC'));
							foreach($category_terms as $category_term) {
								echo "<li><a href=\"".get_term_link($category_term)."\">".$category_term->name." (".$category_term->count.")</a></li>";
							} echo "\n";
						?>
                    </ul><!--
                --></li><!--
                --><li class="nav-item courgette"><a href="javascript:void(0)">Top Ranked</a><!--
                --><ul>
                        <?php
							$sql = 'SELECT '.$wpdb->prefix.'basalcart_product_rating.rating,'.$wpdb->prefix.'posts.ID,'.$wpdb->prefix.'posts.post_title FROM '.$wpdb->prefix.'basalcart_product_rating,'.$wpdb->prefix.'posts WHERE '.$wpdb->prefix.'basalcart_product_rating.productid = '.$wpdb->prefix.'posts.ID ORDER BY '.$wpdb->prefix.'basalcart_product_rating.rating DESC LIMIT 5';
							$top_ranked_products = $wpdb->get_results($sql,ARRAY_A);
							foreach($top_ranked_products as $top_ranked_product) {
								echo "<li><a href=\"".get_permalink($top_ranked_product['ID'])."\">".$top_ranked_product['post_title']."</a></li>";
							} echo "\n";
						?>
                    </ul><!--
                --></li><!--
                --><li class="nav-item courgette"><a href="javascript:void(0)">Popular Tags</a><!--
                --><ul>
                    <?php
						$category_terms = get_terms('wp_basalcart_product_tag', array('number'=>'5','orderby'=>'count','order'=>'DESC'));
						foreach($category_terms as $category_term) {
							echo "<li><a href=\"".get_term_link($category_term)."\">".$category_term->name." (".$category_term->count.")</a></li>";
						} echo "\n";
					?>
                </ul><!--
                --></li><!--
                --><li class="nav-item courgette nav-item-last nav-item-last-selected"><!--
                --><?php global $wp_basalcart; echo $wp_basalcart->wp_basalcart_get_cart_content(false);?><!--
                --></li><!--
            --></ul>
        </div>
    </div>
    
    