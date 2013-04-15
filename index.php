<?php get_header(); ?>
<div id="main">
	<div id="maincontent">
		<?php if($wp_query->query_vars['is_checkout_step']==1 && !empty($_SESSION['wp_basalcart_cart'])):?>
            <div class="checkout-form-wrap">
                <div class="checkout-form-innerwrap">
                    <div class="checkout-form-container">
                        <h3 class="checkout-title courgette">Checkout Form</h3>
                        <form id="wp_basalcart_checkout_form" action="<?php echo $wp_basalcart->wp_basalcart_get_link_to_checkout(2);?>" method="post">
                        <h4 class="checkout-title courgette">Firstname*<span id="firstname-status"></span></h4>
                        <input class="inputfield required" name="firstname" type="text" />
                        <span class="example-text">Tarou</span>
                        <h4 class="checkout-title courgette">Lastname*<span id="lastname-status"></span></h4>
                        <input class="inputfield required" name="lastname" type="text" />
                        <span class="example-text">Yamada</span>
                        <h4 class="checkout-title courgette">Zipcode*<span id="zipcode-status"></span></h4>
                        <input class="inputfield required zipregex" name="zipcode" type="text" />
                        <span class="example-text">000-0000</span>
                        <h4 class="checkout-title courgette">Address*<span id="address-status"></span></h4>
                        <input class="inputfield required addressregex" name="address" type="text" />
                        <span class="example-text">16th Ave, Manhattan, NY</span>
                        <h4 class="checkout-title courgette">Address2<span id="address2-status"></span></h4>
                        <input class="inputfield addressregex" name="address2" type="text" />
                        <span class="example-text">Red brick bldg. 151</span>
                        <h4 class="checkout-title courgette">Phone*<span id="phone-status"></span></h4>
                        <input class="inputfield required phoneregex" name="phone" type="text" />
                        <span class="example-text">000-000-000</span>
                        <h4 class="checkout-title courgette">Email<span id="email-status"></span></h4>
                        <input class="inputfield emailregex" name="email" type="text" />
                        <span class="example-text">aaa@aaa.com</span>
                        <h4 class="checkout-title courgette">Username<span id="username-status"></span></h4>
                        <input class="inputfield userregex" name="username" type="text" />
                        <span class="example-text">myusername</span>
                        <h4 class="checkout-title courgette">Password<span id="password-status"></span></h4>
                        <input class="inputfield passregex" name="password" type="password" />
                        <span class="example-text">mypassword</span>
                        <div style="text-align:center;"><input class="courgette" style="border:0;padding:10px;margin:10px 0;font-size:23px;font-weight:normal;background-color:#D6632A;color:#582D23;cursor:pointer;" type="submit" value="Confirm >" /></div>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif($wp_query->query_vars['is_checkout_step']==2 && !empty($_SESSION['wp_basalcart_cart'])):?>
            <div class="checkout-form-wrap">
                <div class="checkout-form-innerwrap">
                    <div class="checkout-form-container">
                        <h3 class="checkout-title courgette">Please confirm</h3>
                        <h4 class="checkout-title courgette">Firstname*</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['firstname'];?></span>
                        <h4 class="checkout-title courgette">Lastname*</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['lastname'];?></span>
                        <h4 class="checkout-title courgette">Zipcode*</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['zipcode'];?></span>
                        <h4 class="checkout-title courgette">Address*</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['address'];?></span>
                        <h4 class="checkout-title courgette">Address2</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['address2'];?></span>
                        <h4 class="checkout-title courgette">Phone*</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['phone'];?></span>
                        <h4 class="checkout-title courgette">Email</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['email'];?></span>
                        <h4 class="checkout-title courgette">Username</h4>
                        <span class="checkout-content"><?php echo $_SESSION['wp_basalcart_user']['username'];?></span>
                        <div style="text-align:center;"><a href="<?php echo $wp_basalcart->wp_basalcart_get_link_to_checkout(3);?>" class="courgette no-underline" style="border:0;padding:10px;margin:10px 0;font-size:23px;font-weight:normal;background-color:#D6632A;color:#582D23;">Complete Order ></a></div>
                    </div>
                </div>
            </div>
        <?php elseif($wp_query->query_vars['is_checkout_step']==3 && !empty($_SESSION['wp_basalcart_cart']) && !empty($_SESSION['wp_basalcart_user'])):?>
            <div class="checkout-form-wrap">
                <div class="checkout-form-innerwrap">
                    <div class="checkout-form-container">
                        <h3 class="checkout-title courgette">Thank you for your order!</h3>
                    </div>
                </div>
            </div>
        <?php else:?>
            <?php
				if(have_posts()):
					while(have_posts()) : the_post();
					
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
                    <div id="navigation-link"><?php next_posts_link('',$query->max_num_pages);?></div>
            <?php
				endif;
				//wp_reset_postdata();
			//endif;
			?>
		<?php endif;?>
        <div class="clear"></div>
    </div>
</div>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>

