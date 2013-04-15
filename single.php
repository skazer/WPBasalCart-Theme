<?php get_header(); ?>
<div id="main">
	<div id="maincontent">
        <div class="product-detail-wrap">
            <div class="product-detail">
                <div class="image-container">
                    <div class="main-image">
                        <div class="slide-wrapper">
                            <?php
								$product_information = maybe_unserialize(get_post_meta($post->ID,'wp_basalcart_metadata',true));
								$main_image = wp_get_attachment_image_src($product_information['mainimage'],'full');
								$main_pic1 = wp_get_attachment_image_src($product_information['pic1'],'full');
								$main_pic2 = wp_get_attachment_image_src($product_information['pic2'],'full');
								$main_pic3 = wp_get_attachment_image_src($product_information['pic3'],'full');
								$main_image_src = $main_image[0];
								$pic1_image_src = $main_pic1[0];
								$pic2_image_src = $main_pic2[0];
								$pic3_image_src = $main_pic3[0];
							;?>
                            <img style="" src="<?php echo $main_image_src;?>" alt="" />
                            <img style="" src="<?php echo $pic1_image_src;?>" alt="" />
                            <img style="" src="<?php echo $pic2_image_src;?>" alt="" />
                            <img style="" src="<?php echo $pic3_image_src;?>" alt="" />
                        </div>
                        <div id="wp_basalcart_product_rating_id_<?php echo $post->ID;?>" class="product-rating-container"><?php echo $wp_basalcart->wp_basalcart_get_product_rating_bar($post->ID);?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="secondary-images">
                        <div class="secondary-image">
                            <img style="width:100%;height:auto;display:block;" src="<?php echo $pic1_image_src;?>" alt="" />
                        </div>
                        <div class="secondary-image">
                            <img style="width:100%;height:auto;display:block;" src="<?php echo $pic2_image_src;?>" alt="" />
                        </div>
                        <div class="secondary-image last">
                            <img style="width:100%;height:auto;display:block;" src="<?php echo $pic3_image_src;?>" alt="" />
                        </div>
                    </div>
                </div>
                <div class="product-description-wrap">
                    <h3 class="product-title courgette"><?php echo $post->post_title;?></h3>
                    <span class="product-price courgette">&yen;<?php echo $product_information['price'];?></span>
                    <p class="product-description"><?php echo $post->post_content;?></p>
                    <h4 class="add-to-cart courgette"><a href="javascript:void(0)" onclick="wp_basalcart_ajax_call(<?php echo $post->ID;?>,'wp_basalcart_add_to_cart')">Add to Cart ></a></h4>
                    <div class="sociallinks">
                        <img src="<?php echo IMGDIR;?>footer-facebook-2.jpg" alt="" />
                        <img src="<?php echo IMGDIR;?>footer-twitter-2.jpg" alt="" />
                        <img src="<?php echo IMGDIR;?>footer-rss-2.jpg" alt="" />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <h4 class="also-bought courgette">People who bought this also bought:</h4>
        <div class="cross-sales">
            <?php
                $sql = "SELECT productid,alsobought,amount FROM ".$wpdb->prefix."basalcart_also_bought WHERE productid=".$post->ID." ORDER BY amount DESC LIMIT 4";
                $query_results = $wpdb->get_results($sql, ARRAY_A);
                $cross_sales_ids = array();
                foreach($query_results as $k=>$v) {
                    $cross_sales_ids[] = $v['alsobought'];
                }
                foreach($cross_sales_ids as $cross_sales_id) {
                    $cross_sales_product = get_post($cross_sales_id);
                    $product_information = maybe_unserialize(get_post_meta($cross_sales_product->ID,'wp_basalcart_metadata',true));
                    $main_image = wp_get_attachment_image_src($product_information['mainimage'],'full');
                    $main_image_src = $main_image[0];
            ?>
                    <div id="wp_basalcart_product_wrap_id<?php echo $cross_sales_product->ID;?>" class="product-wrap">
                        <div class="move-right">
                            <img src="<?php echo IMGDIR;?>footer-facebook-2.jpg" alt="" />
                            <img src="<?php echo IMGDIR;?>footer-twitter-2.jpg" alt="" />
                            <img src="<?php echo IMGDIR;?>footer-rss-2.jpg" alt="" />
                        </div>
                        <div id="wp_basalcart_product_rating_id_<?php echo $cross_sales_product->ID;?>" class="product-rating-container">
                            <?php echo $wp_basalcart->wp_basalcart_get_product_rating_bar($cross_sales_product->ID);?>
                        </div>
                        <div class="main-image">
                            <a href="javascript:void(0)" onclick="showProductBoxes('id<?php echo $cross_sales_product->ID;?>')">
                                <img src="<?php echo $main_image_src;?>" alt="<?php echo $cross_sales_product->post_title;?>" />
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="main-title courgette"><a href="<?php echo get_permalink($cross_sales_product->ID);?>"><?php echo $cross_sales_product->post_title;?></a></h3>
                            <span class="product-price courgette">&yen;<?php echo $product_information['price'];?></span>
                            <h4 class="add-to-cart courgette"><a href="javascript:void(0)" onclick="wp_basalcart_ajax_call(<?php echo $cross_sales_product->ID;?>,'wp_basalcart_add_to_cart')">Add to Cart ></a></h4>
                            <h4 class="go-to-detail-page courgette"><a href="<?php echo get_permalink($cross_sales_product->ID);?>">More Details ></a></h4>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear"></div>
        </div>
        <h4 class="other-products-title courgette">Other Products:</h4>
        <div id="other-products" class="other-products">
            <?php
				global $wp_rewrite;
				if($wp_rewrite->using_permalinks()) {
					preg_match('/\/(\d+)\/$/',$_SERVER['REQUEST_URI'],$matches);
					if(!empty($matches)) {
						$paged = $matches[1];
					} else {
						$paged = 1;
					}
				} else {
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				}
				$query = new WP_Query(array('post_type'=>'wp_basalcart_product','paged'=>$paged));
				if(have_posts()):
					while($query->have_posts()) : $query->the_post();
					$product_information = maybe_unserialize(get_post_meta($post->ID,'wp_basalcart_metadata',true));
					$main_image = wp_get_attachment_image_src($product_information['mainimage'],'full');
					$main_image_src = $main_image[0];
			?>
                    <div id="wp_basalcart_product_wrap_id<?php echo $post->ID;?>" class="product-wrap">
                        <div class="move-right">
                            <img src="<?php echo IMGDIR;?>footer-facebook-2.jpg" alt="" />
                            <img src="<?php echo IMGDIR;?>footer-twitter-2.jpg" alt="" />
                            <img src="<?php echo IMGDIR;?>footer-rss-2.jpg" alt="" />
                        </div>
                        <div id="wp_basalcart_product_rating_id_<?php echo $post->ID;?>" class="product-rating-container">
							<?php echo $wp_basalcart->wp_basalcart_get_product_rating_bar($post->ID);?>
                        </div>
                        <div class="main-image">
                            <a href="javascript:void(0)" onclick="showProductBoxes('id<?php echo $post->ID;?>')">
                                <img src="<?php echo $main_image_src;?>" alt="<?php echo $post->post_title;?>" />
                            </a>
                        </div>
                        <div class="product-info">
                            <h3 class="main-title courgette"><a href="<?php echo get_permalink($post->ID);?>"><?php echo $post->post_title;?></a></h3>
                            <span class="product-price courgette">&yen;<?php echo $product_information['price'];?></span>
                            <h4 class="add-to-cart courgette"><a href="javascript:void(0)" onclick="wp_basalcart_ajax_call(<?php echo $post->ID;?>,'wp_basalcart_add_to_cart')">Add to Cart ></a></h4>
                            <h4 class="go-to-detail-page courgette"><a href="<?php echo get_permalink($post->ID);?>">More Details ></a></h4>
                        </div>
                    </div>
			<?php
					endwhile;
			?>
					<div class="clear"></div>
                    <div id="navigation-link"><!--
                    --><?php
                        $nextpage = $paged+1;
						if($paged<$query->max_num_pages && $query->max_num_pages>0) {
                            global $wp_rewrite;
                            if($wp_rewrite->using_permalinks()) {
                                $uri = $_SERVER['REQUEST_URI'];
								$uri = preg_replace('/(\d+\/)$/','',$uri);
								echo '<a href="'.$uri.$nextpage.'/"></a>';
                            } else {
                                echo '<a href="'.$_SERVER['REQUEST_URI'].'&paged='.$nextpage.'"></a>';
                            }
                        }
                    ?><!--
                --></div>
            <?php
				endif;
				//wp_reset_postdata();
			//endif;
			?>
            <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
