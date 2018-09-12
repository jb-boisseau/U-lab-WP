<?php
show_admin_bar(false);
add_thickbox();
$meta_data[] = array();
foreach (RMLP_Constants::$lp_meta as $key => $val) {
	if (is_int($key)) {
		$key = $val;
	}

	$meta_data[$key] = RMLP_Utility::get_post_meta($post->ID, $key, true);

}

if ($meta_data['site_header_enabled'] == 1) {
	get_header();} else {
	wp_head();
}
include_once 'style.php';
?>
<div>

    <div class="rml-container">

  <?php $page_bg = $meta_data['page_bg'];?>

        <?php if ($meta_data['credit_author'] == 1 && $page_bg == 'img'): ?>
            <div class="rml-credit-author">
                 <span><?php echo RMLP_UI_Strings::get('photo_credits'); ?> : <a href="<?php echo $meta_data['page_bg_image_authlink'] . '?utm_source=LeadMagic&utm_medium=referral&utm_campaign=api-credit'; ?>" target="_blank"><?php echo $meta_data['page_bg_image_auth']; ?></a></span>
            </div>
        <?php endif;?>


        <div class="<?php echo empty($_POST) ? 'rml-loader-overlay' : ''; ?>">

            <?php $loader_text = $meta_data['loader_text'];
if (strlen($loader_text) > 0 && $meta_data['loader_type'] == 'text' && empty($_POST)):
?>
                <div class="rml-loader-text"><?php echo $loader_text; ?> </div>
        <?php endif;?>
        </div>
        <?php

?>
        <div class="rml-bg dbfl <?php echo $page_bg != 'img' ? 'landing_bg_color' : '' ?> <?php echo $meta_data['site_header_enabled'] == 1 ? 'th_header' : ''; ?>">
        </div>

        <div class="rml-bg-overlay dbfl  <?php echo $meta_data['site_header_enabled'] == 1 ? 'th_header-overlay' : ''; ?>">

        </div>



        <?php
$is_top_menu_enabled = $meta_data['top_menu_enabled'];
if ($is_top_menu_enabled && strlen($meta_data['menu_link']) > 0):
	$menu_link_text_color = $meta_data['menu_link_text_color'];
	$menu_bg_color = $meta_data['menu_bg_color'];
	?>
			            <div class="rml-topmenu dbfl">
			    <?php if (empty($meta_data['menu_link_text'])): ?>
			                    <div class="rml-topmenu-link">
			                        <a  class="top-link"> Go to Link</a>
			                    </div>
			    <?php else: ?>

                    <div class="rml-topmenu-link">
                        <a  class="top-link rml-menu-link" href="<?php echo $meta_data['menu_link'] ?>"> <?php echo $meta_data['menu_link_text']; ?></a>
                    </div>
            <?php endif;?>
            </div>
<?php endif;?>
        <div class="rml-page-wrapper dbfl <?php echo $meta_data['site_header_enabled'] == 1 ? 'th_header-wrapper' : ''; ?>">
            <div class="rml-page dbfl">
                <div class="rml-page-overlay dbfl"></div>
                <div class="rml-page-row dbfl">
                    <?php
$is_logo_enabled = $meta_data['logo_enabled'];
if ($is_logo_enabled && strlen($meta_data['logo']) > 0):
?>
                        <div class="rml-page-logo rml-page-childrow dbfl">
                            <?php
$thumbnail_id = $meta_data['logo'];
$thumbnail = wp_get_attachment_image_src($thumbnail_id, 'medium');
?>
                            <img class="rml-logo" src="<?php echo $thumbnail[0]; ?>" />
                        </div>
                        <?php endif;
?>
                        <?php if ($meta_data['logo_header1_text']) {
	;
}
?>
                    <div class="rml-top-header1 rml-page-childrow dbfl">
                    <?php echo $meta_data['logo_header1_text']; ?>
                    </div>
                        <?php if ($meta_data['logo_header2_text']) {
	;
}
?>
                    <div class="rml-top-header2 rml-page-childrow dbfl">
                    <?php echo $meta_data['logo_header2_text']; ?>
                    </div>

                        <?php if (strlen($meta_data['description']) > 0): ?>
                        <div class="rml-top-text rml-page-childrow dbfl">
                        <?php echo $meta_data['description']; ?>
                        </div>
                    <?php endif;?>
                    <?php
if ($meta_data['cover_enabled'] == 1 && strlen($meta_data['cover_image']) > 0):
?>
                        <div class="rml-top-image dbfl">
                            <?php if ($meta_data['cover_caption_enabled'] == 1 && strlen($meta_data['cover_caption']) > 0): ?>
                            <div class="rml-image-caption"><?php echo $meta_data['cover_caption_enabled'] == 1 ? $meta_data['cover_caption'] : ''; ?></div>
                            <?php endif;?>
                        </div>
                        <?php endif;?>
                        <?php if (trim($meta_data['form_header_text']) != ""): ?>
                        <div class="rml-form-header dbfl">
                        <?php echo $meta_data['form_header_text']; ?>

                        </div>
                <?php endif;?>
                </div>

                <div class="rml-page-row dbfl">
                    <div class="rml-form-wrapper">
                        <?php
if ($meta_data['form_type'] == 'rm') {
	$rm_form = (int) $meta_data['rm_form'];
	echo do_shortcode("[RM_Form id='$rm_form']");
} else if ($meta_data['form_type'] == 'shortcode') {
	echo do_shortcode(trim($meta_data['custom_form_shortcode']));
}

?>
                    </div>
                </div>
                <?php
$is_bottom_enabled = $meta_data['bottom_enabled'];
if ($is_bottom_enabled && ((strlen($meta_data['bottom_header_text']) > 0) || (strlen($meta_data['bottom_area_text']) > 0))):
?>
                    <div class="rml-page-row dbfl">
                        <div class="rml-page-bottom dbfl">
                            <div class="rml-bottom-header rml-page-childrow dbfl">
                                <?php echo $meta_data['bottom_header_text']; ?>
                            </div>
                            <div class="rml-bottom-text rml-page-childrow dbfl">
    <?php echo $meta_data['bottom_area_text']; ?>
                            </div>

                        </div>
                    </div>
<?php endif;?>
            </div>
        </div>
        <div class="rml-footer dbfl"></div>
    </div>
    <?php

if ($meta_data['site_header_enabled'] == 1) {
	get_footer();
} else {
	wp_footer();
}

?>

    <?php if ($meta_data['nav_alert_enabled'] == 1): ?>
        <script>
            jQuery(document).ready(function(){
                 jQuery("a").click(function (event) {
                if (rml_confirm_action()) {
                    var href = jQuery(this).attr('href');
                    if(href)
                     window.location= href;
                } else event.preventDefault();
              });
            });
        </script>

    <?php endif;?>

    <script>

        jQuery(document).ready(function () {


            // Terms and Conditions related
           if(jQuery("#rm_terms_textarea textarea").length>0)
           {
               rml_tc= new RML_TC();
               rml_tc.addTermLink();
               jQuery("body").click(function(e) {
                   if(rml_tc.isModalVisible()){
                       if (e.target.id == "rml-thickbox" || jQuery(e.target).parents("#rml-thickbox").size()) {

                       } else {
                          rml_tc.showModal(false);
                       }
                   }

               });
           }

        });

        function rml_confirm_action()
        {
            var confirmed = confirm("<?php echo $meta_data['nav_alert_msg']; ?>");
            return confirmed;
        }


       function RML_TC()
       {
           var termPopup= jQuery("#rml-thickbox #tc_txt");
           var modal= jQuery("#rml-thickbox");
           var term= jQuery("#rm_terms_textarea textarea");
           var termCheckbox= jQuery(".rm_terms_checkbox input");

           termCheckbox.attr('disabled',false);
           termPopup.html(term.val());

           this.addTermLink= function()
           {
               term.parent().html("<div>I agreed to the <span><a href='javascript:void(0)' onclick='rml_tc.showModal(true)'>Terms & Conditions</a></span></div>");
           }

           this.isModalVisible= function()
           {
               return modal.is(":hidden");
           }

           this.agreed= function()
           {
               termCheckbox.attr('checked',true);
               this.showModal(false)
           }

           this.showModal= function(show)
           {
               show ? modal.show() : modal.hide();
           }
       }
    </script>

    <div id="rml-thickbox" class="rml-terms-popup" style="display:none">
       <div class="rml-terms-popup-parent">
           <div class="rml-terms-popup-head">
               <div  onclick='javascript: rml_tc.showModal(false);' class="rml-terms-popup-close"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" style="fill: rgb(214, 80, 80);">
                   <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                   <path d="M0 0h24v24H0z" fill="none"></path>
                   </svg></div>

               <div class="rml-terms-popup-title">Terms & Conditions</div>



           </div>

           <div id="tc_txt" class="rml-terms-popup-wrap"></div>
           <div class="rml-terms-popup-footer">
               <input type='button' onclick='rml_tc.agreed()' value="Accept" />
           </div>
       </div>
   </div>

    <style>
        <?php echo $meta_data['custom_css']; ?>
    </style>

</div>