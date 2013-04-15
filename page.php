<?php get_header(); ?>

<div id="main">
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
	<div class="maincontent">
            <h3 class="pageclass"><?php the_title(); ?></h3>
            <div class="entry">
                <?php the_content(); ?>
            </div>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>

<?php if(is_page('999')):?>
<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA62n9R6yL42VLkWE1FJBgeRRysmGkFmxk-GRVWUdToKLWwDtneRQe6k3Jx7Qpv2z-yC8KfMmVljdWTw" type="text/javascript"></script>
<script type="text/javascript">
    //<![CDATA[
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        var point = new GLatLng(35.648823, 139.717011);
        map.setCenter(point, 19);
        map.addControl(new GSmallMapControl());
        map.setMapType(G_NORMAL_MAP);
        var marker = new GMarker(point);


        map.addOverlay(marker);

      }
    }
    load();
    //]]>
</script>
<?php endif;?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>