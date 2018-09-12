<?php 

$src_image =  get_template_directory_uri() . '/upsale/assets/images/';

$extensions = array(
    '1' => (object) array(
        'image_url' => $src_image . 'icon-wpgumby.png',
        'url'       => 'https://shopitpress.com/themes/wpgumby',
        'title'     => 'WPGumby',
        'desc'      => __( 'Flat and responsive WooCommerce theme.<br>', 'wpgumby' ),
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
				<a class="button button-primary " title="<?php echo $title; ?>" href="<?php echo $url; ?>" target="_blank"><?php echo __( 'Learn more', 'wpgumby' ); ?></a>
			</div>
		</div> <!-- .shopitpress-addon -->
		<?php $i++; 
	} 
?>
<div class="sip-version">
    <?php $get_optio_version = get_option( 'sip_version_value' ); echo "SIP Version " . $get_optio_version; ?>
</div>
</div><!-- .shopitpress -->