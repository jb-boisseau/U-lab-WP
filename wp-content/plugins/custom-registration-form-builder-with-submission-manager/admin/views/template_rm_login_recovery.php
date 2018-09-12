<?php $params= $data->params; ?>
<div class="rmagic">
    <div class="operationsbar">
        <div class="rmtitle"><?php echo _e('Password Recovery', 'custom-registration-form-builder-with-submission-manager'); ?></div>
    </div>

    <!--Dialogue Box Starts-->
    <div class="rmcontent">
        <?php
        $form = new RM_PFBC_Form("login-recovery");

        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery"),
            "action" => ""
        ));
        
        $form->addElement(new Element_Checkbox("<b>" .__('Display Password recovery link?', 'custom-registration-form-builder-with-submission-manager')."</b>", "en_pwd_recovery", array(1 => ""), array("class" => "rm-role-based rm-static-field rm_input_type", "value" => isset($params['en_pwd_recovery']) ? $params['en_pwd_recovery']:0, "longdesc" => __('Display a link below the login button that allows users to initiate a password recovery process.', 'custom-registration-form-builder-with-submission-manager'))));
             
            $form->addElement(new Element_HTML('<div id="rm_password_recovery" style="display:none;" class="childfieldsrow">'));   
                $form->addElement(new Element_Textbox("<b>" . __('Link Anchor Text', 'custom-registration-form-builder-with-submission-manager') . "</b>", "recovery_link_text", array("value" => $params['recovery_link_text'], "longDesc" => __('Password recovery link text.', 'custom-registration-form-builder-with-submission-manager'))));
            $form->addElement(new Element_HTML('</div>'));
            
            $form->addElement(new Element_HTMLL('&#8592; &nbsp; '.__('Cancel','custom-registration-form-builder-with-submission-manager'), '?page=rm_login_sett_manage', array('class' => 'cancel')));
            $form->addElement(new Element_Button(RM_UI_Strings::get('LABEL_SAVE'), "submit", array("id" => "rm_submit_btn", "class" => "rm_btn", "name" => "submit")));
        $form->render();
        ?>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery("#login-recovery-element-0-0").change(function(){
            if(jQuery(this).is(':checked')){
                jQuery("#rm_password_recovery").slideDown();
            }
            else{
                 jQuery("#rm_password_recovery").slideUp();
            }
        });
        jQuery("#login-recovery-element-0-0").trigger('change');
    });
    
    
    
</script>    