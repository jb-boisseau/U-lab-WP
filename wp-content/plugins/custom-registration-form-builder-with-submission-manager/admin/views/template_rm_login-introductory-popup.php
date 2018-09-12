<?php ?>
<link href="https://fonts.googleapis.com/css?family=Lobster+Two:400,400i,700" rel="stylesheet">

<div>
    <div class="rm-login-intro-top-area rm-dbfl">

        <div class="rm-login-intro-wrap rm-dbfl">

            <div class="rm-login-intro-head"><?php _e('Welcome to a <u>brand new</u> login experience!','custom-registration-form-builder-with-submission-manager'); ?></div> 

            <div class="rm-login-intro-objects rm-dbfl">
                <div class="rm-login-intro-icon-small rm-difl"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-login-planet-small.png'; ?>"> </div>
                <div class="rm-login-intro-icon-big rm-difl"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-login-planet-big.png'; ?>"> </div>
                <div class="rm-login-intro-rocket rm-difl"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-login-popup-rocket.png'; ?>"> </div>
                <div class="rm-login-intro-door rm-difl"><img src="<?php echo plugin_dir_url(dirname(dirname(__FILE__))) . 'images/rm-login-intro-door.png'; ?>"> </div>
            </div>
        </div>
    </div> 

    <div class="rm-login-content-area rm-dbfl">
        <div class="rm-login-content-wrap">
            <div class="rm-login-intro-title"><span class="rm-login-version"><?php _e('RegistrationMagic 4.0','custom-registration-form-builder-with-submission-manager'); ?></span> <b><?php _e('introduces a brand new login experience for you and your website users!','custom-registration-form-builder-with-submission-manager'); ?></b><span class="rm-login-intro-style"> <?php _e('It\'s robust, secure and highly configurable.','custom-registration-form-builder-with-submission-manager'); ?></span></div>  


            <ul class="rm-login-intro-featured" >

                <li><i class="fa fa-check"></i><?php _e('New Login Dashboard just like your other forms!','custom-registration-form-builder-with-submission-manager'); ?>  </li>
                <li><i class="fa fa-check"></i> <?php _e('Advanced features like role based redirects, IP Bans, 2FA and more.','custom-registration-form-builder-with-submission-manager'); ?> </li>
                <li><i class="fa fa-check"></i><?php _e('Analytics, redesigned for user login events.','custom-registration-form-builder-with-submission-manager'); ?> </li>
                <li><i class="fa fa-check"></i><?php _e('Visual login history for individual users in User Manager.','custom-registration-form-builder-with-submission-manager'); ?> </li>
                <li><i class="fa fa-check"></i><?php _e('New widget, customizable forms and logged in view.','custom-registration-form-builder-with-submission-manager'); ?> </li>
                <li class="rm-login-f-last"><?php _e('and much more!','custom-registration-form-builder-with-submission-manager'); ?></li>

            </ul>

        </div> 


    </div>

    <div class="rm-login-footer-area rm-dbfl">
        <div class="rm-login-footer-wrap">
        <div class="rm-difl"> <a href="javascript:void(0)" onclick="rm_login_know_more()"><?php _e('Skip','custom-registration-form-builder-with-submission-manager'); ?></a></div>
        <div class="rm-difr"><a target="_blank" onclick="rm_login_know_more()" href="https://registrationmagic.com/login-revamp-setup-guide"><?php _e('Know More','custom-registration-form-builder-with-submission-manager'); ?></a></div>
        </div>
    </div>

</div>

<script>
    function rm_login_know_more(){
        $= jQuery;
        var data = {
                    action: 'rm_disable_login_popup',
                    value: 1
                   };

        jQuery.post(ajaxurl, data, function (response) {
            
        });
        $('#rm_login-introductory-popup').hide();
    }
    
    jQuery(document).ready(function()
    {
        $= jQuery;
        $("body").mouseup(function(e)
        {
            var subject = $(".rm_login-popup"); 
            if(e.target.id != subject.attr('id'))
            {
                rm_login_know_more();
            }
        });
    });
</script>
