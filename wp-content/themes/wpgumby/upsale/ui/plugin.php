<?php 

$src_image =  get_template_directory_uri() . '/upsale/assets/images/';

$extensions = array(
    '1' => (object) array(
        'image_url' => $src_image . 'icon-social-proof.png',
        'url'       => 'https://shopitpress.com/plugins/sip-social-proof-woocommerce',
        'title'     => __( 'SIP Social Proof for WooCommerce', 'wpgumby' ),
        'desc'      => __( 'Display real time proof of your sales and customers.<br>', 'wpgumby' ),
    ),
    '2' => (object) array(
        'image_url' => $src_image . 'icon-front-end-bundler.png',
        'url'       => 'https://shopitpress.com/plugins/sip-front-end-bundler-woocommerce',
        'title'     => __( 'SIP Front End Bundler for WooCommerce', 'wpgumby' ),
        'desc'      => __( 'Bundle maker with real time offers.<br><br>', 'wpgumby' ),
    ),
    '3' => (object) array(
        'image_url' => $src_image . 'icon-reviews-shortcode.png',
        'url'       => 'https://shopitpress.com/plugins/sip-reviews-shortcode-woocommerce',
        'title'     =>  __( 'SIP Reviews Shortcode for WooCommerce', 'wpgumby' ),
        'desc'      => __( 'Display product reviews in any post/page with a shortcode.', 'wpgumby' ),
    ),
    '4' => (object) array(
      'image_url' => $src_image . 'icon-cookie-check.png',
      'url'       => 'https://shopitpress.com/plugins/sip-cookie-check-woocommerce',
      'title'     => __( 'SIP Cookie Check for WooCommerce', 'wpgumby' ),
      'desc'      => __( 'Encourage visitors to enable cookies so you don\'t lose sales.', 'wpgumby' ),
    ),
);

?>


<div id="sip-wraper">

<?php 
    $i = 0;
    foreach ( (array) $extensions as $i => $extension ) {
        // Attempt to get the plugin basename if it is installed or active.
        $image_url   = $extension->image_url ;
        $url 		 = $extension->url ;
        $title		 = $extension->title ;
        $description = $extension->desc ; 
 		?>
		<div class="sip-addon">
        <h1><?php echo $title ?></h1>
        <p><?php echo $description ?></p>
			<img class="sip-addon-thumb" src="<?php echo $image_url; ?>" width="300px" height="250px" alt="<?php echo $title; ?>">
			<div class="sip-addon-action">
				<a class="button button-primary" title="<?php echo $title; ?>" href="<?php echo $url; ?>" target="_blank"><?php echo __( 'Learn more', 'wpgumby' ); ?></a>
			</div>
		</div> <!-- .shopitpress-addon -->
		<?php $i++; 
	} 
?>
<div class="sip-version">
    <?php $get_optio_version = get_option( 'sip_version_value' ); echo "SIP Version " . $get_optio_version; ?>
</div>
</div><!-- .shopitpress -->