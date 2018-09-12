<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RM_Frontend_Form_Multipage extends RM_Frontend_Form_Base
{

    protected $form_pages;

    public function __construct(RM_Forms $be_form, $ignore_expiration=false)
    {
        parent::__construct($be_form, $ignore_expiration);

        if ($this->form_options->form_pages == null)
            $this->form_pages = array('Page 1');
        else
            $this->form_pages = $this->form_options->form_pages;
    }

    public function get_form_pages()
    {
        return $this->form_pages;
    }

    public function pre_sub_proc($request, $params)
    {
        return true;
    }

    public function post_sub_proc($request, $params)
    {
        return true;
    }
    
    //Following two methods can be overloaded by child classes in order to add custom fields to any page of the form.
    protected function hook_pre_field_addition_to_page($form, $page_no)
    {
        
    }
    
    protected function hook_post_field_addition_to_page($form, $page_no)
    {
        
    }
    
    public function render($data = array())
    {
        global $rm_form_diary;
        $settings = new RM_Options;
        $theme = $settings->get_value_of('theme');
        $layout = $settings->get_value_of('form_layout');
        $class= "rm_theme_{$theme} rm_layout_{$layout}"; 
        $btn_align_class = "rmagic-form-btn-".(isset($this->form_options->form_btn_align)?$this->form_options->form_btn_align:"center");
        echo '<div class="rmagic '.$class.'">';
        
        //$this->form_number = $rm_form_diary[$this->form_id];
        $form = new RM_PFBC_Form('form_' . $this->form_id . "_" . $this->form_number);

        $form->configure(array(
            "prevent" => array("bootstrap", "jQuery", "focus"),
            "action" => "", /*add_query_arg('rmcb', time()),*/
            "class" => "rmagic-form $btn_align_class",
            "name"=>"rm_form",
            "view" => ($layout == 'two_columns')? new View_UserFormTwoCols: new View_UserForm,
            "name" => "rm_form",
            "number" => $this->form_number,
            "style" => isset($this->form_options->style_form)?$this->form_options->style_form:null
        ));
        
        //Render content above the form
        if (!empty($this->form_options->form_custom_text))
                $form->addElement(new Element_HTML('<div class="rmheader">' . $this->form_options->form_custom_text . '</div>'));

        //check if form has expired
        $edit_submission= false;
        if($_POST && !empty($_POST['rm_slug']) && $_POST['rm_slug']=='rm_user_form_edit_sub'){
             $edit_submission= true;
        }
        if (!$this->preview && empty($edit_submission) && $this->is_expired())
        {
            if ($this->form_options->form_message_after_expiry)
                echo $this->form_options->form_message_after_expiry;
            else
                echo '<div class="rm-no-default-from-notification">'.RM_UI_Strings::get('MSG_FORM_EXPIRY').'</div>';
            echo '</div>';
            return;
        }

        if (isset($data['stat_id']) && $data['stat_id'])
        {
            $form->addElement(new Element_HTML('<div id="rm_stat_container" style="display:none">'));
            $form->addElement(new Element_Textbox('RM_Stats', 'stat_id', array('value' => $data['stat_id'], 'style' => 'display:none')));
            $form->addElement(new Element_HTML('</div>'));
        }
        
        if (isset($data['submission_id']) && $data['submission_id'])
        {
            $form->addElement(new Element_HTML('<div id="rm_stdat_container" style="display:none">'));
            $form->addElement(new Element_Textbox('RM_Slug', 'rm_slug', array('value' => 'rm_user_form_edit_sub', 'style' => 'display:none')));
            $form->addElement(new Element_Textbox('RM_form_id', 'form_id', array('value' => $this->form_id, 'style' => 'display:none')));
            $form->addElement(new Element_HTML('</div>'));
        }
        
        parent::pre_render();
        $this->base_render($form);
        parent::post_render();

        echo '</div>';
    }
    
    public function get_form_object($data = array())
    {
        $settings = new RM_Options;
        $theme = $settings->get_value_of('theme');
        $layout = $settings->get_value_of('form_layout');
        $class= "rm_theme_{$theme} rm_layout_{$layout}"; 
       
        //$this->form_number = $rm_form_diary[$this->form_id];
        $form_model = new RM_PFBC_Form('form_' . $this->form_id . "_" . $this->form_number);

        $form_model->configure(array(
            "prevent" => array("bootstrap", "jQuery", "focus"),
            "action" => "",
            "class" => "rmagic-form",
            "name" => "rm_form",
            "number" => $this->form_number,
            "view" => ($layout == 'two_columns')? new View_UserFormTwoCols: new View_UserForm,
            "style" => isset($this->form_options->style_form)?$this->form_options->style_form:null
        ));
        
        //Render content above the form
        if (!empty($this->form_options->form_custom_text))
                $form_model->addElement(new Element_HTML('<div class="rmheader">' . $this->form_options->form_custom_text . '</div>'));

        $form_model->addElement(new Element_HTML('<div id="rm_stat_container" style="display:none">'));
        $form_model->addElement(new Element_Textbox('RM_Stats', 'stat_id', array('value' => "__form_model", 'style' => 'display:none')));
        $form_model->addElement(new Element_HTML('</div>'));
        
        //Since pre-render only adds style and expiry countdown no need to call it.
        //parent::pre_render();
        //$this->base_render($form_model);
        $this->prepare_fields_for_render($form_model);
        if (get_option('rm_option_enable_captcha') == "yes" && $this->form_options->enable_captcha[0]=='yes')
            $form_model->addElement(new Element_Captcha());
        //$this->prepare_button_for_render($form_model);
        //Nothing special in post render for now, do not call.
        //parent::post_render();
        return $form_model;
    }
    
    protected function prepare_fields_for_render($form)
    {        
       
        //foreach ($this->form_pages as $k => $page)
        {$i = 1;//actual page no.
            //if ($i == 1)
            {$n=1;
                $form->addElement(new Element_HTML("<div class=\"rmformpage_form_".$this->form_id."_".$this->form_number."\" id=\"rm_form_page_form_".$this->form_id ."_".$this->form_number. "_".$n."\">"));
                $form->addElement(new Element_HTML("<fieldset class='rmfieldset'>"));
                $this->hook_pre_field_addition_to_page($form, $i);
                    foreach ($this->fields as $field)
                    {  
                        $pf = $field->get_pfbc_field();
                        if (!$pf)
                            continue;

                        if (is_array($pf))
                        {
                            foreach ($pf as $f)
                            {
                                if (!$f)
                                    continue;
                                $form->addElement($f);
                            }
                        } else
                            $form->addElement($pf);
                        
                    }
                    
                    $this->hook_post_field_addition_to_page($form, $i);
                    $form->addElement(new Element_HTML("</fieldset>"));
                    $form->addElement(new Element_HTML("</div>")); 
            } 
            
        }

        
    }
    
    protected function prepare_button_for_render($form)
    {
        if ($this->service->get_setting('theme') != 'matchmytheme')
        {
            if(isset($this->form_options->style_btnfield))
                unset($this->form_options->style_btnfield);
        }
        $sub_btn_label = $this->form_options->form_submit_btn_label ? $this->form_options->form_submit_btn_label : "Submit";
        
        //$form->addElement(new Element_Button("Prev", "button", array("bgColor" => "#$submit_btn_bgcolor", "fgColor" => "#$submit_btn_fgcolor", "id"=>"rm_prev_form_page_button", "onclick"=>'gotoprev()', "disabled"=>"1")));
        //$form->addElement(new Element_Button(stripslashes($sub_btn_label), "button", array(
//"style" => isset($this->form_options->style_btnfield)?$this->form_options->style_btnfield:null,"id"=>"rm_next_form_page_button_".$this->form_id.'_'.$this->form_number,"class"=>"rm_next_btn","onclick"=>'gotonext_form_'.$this->form_id.'_'.$this->form_number.'()')));
        $form->addElement(new Element_Button(stripslashes($sub_btn_label), "submit", array(
"style" => isset($this->form_options->style_btnfield)?$this->form_options->style_btnfield:null,"id"=>"rm_next_form_page_button_".$this->form_id.'_'.$this->form_number,"class"=>"rm_next_btn")));
        $form->addElement(new Element_Button(stripslashes($sub_btn_label), "submit", array(
"style" => isset($this->form_options->style_btnfield)?$this->form_options->style_btnfield:null,"class"=>"rm_noscript_btn")));
        //$form->addElement(new Element_Button($btn_label != "" ? $btn_label : "Submit", "submit", array("bgColor" => "#$submit_btn_bgcolor", "fgColor" => "#$submit_btn_fgcolor")));
        
        $this->insert_JS($form);
    }
    
    protected function get_jqvalidator_config_JS()
    {
$str = <<<JSHD
        jQuery.validator.setDefaults({errorClass: 'rm-form-field-invalid-msg',
                                        ignore:'hidden,.ignore,.rm_untouched',wrapper:'div',
                                       errorPlacement: function(error, element) { 
                                                            var elementId= element.attr('id');
                                                            var target_element_id= elementId.replace('-error','');
                                                            var target_element= jQuery("#" + target_element_id);
                                                            if(target_element.length>0){
                                                                if(target_element.hasClass('rm_untouched')){
                                                                    return true;
                                                                    }
                                                            }
                                                            error.appendTo(element.closest('div'));
                                                          }
                                    });
JSHD;
        return $str;
    }

    protected function insert_JS($form)
    {
        if(is_admin()) // Restricting front js loading in dashboard.
            return;
        
        $max_page_count = 1;
        $form_identifier = "form_".$this->get_form_id();
        $form_id = $this->get_form_id();
        $validator_js = $this->get_jqvalidator_config_JS();
        
        $jqvalidate = RM_Utilities::enqueue_external_scripts('rm_jquery_validate', RM_BASE_URL."public/js/jquery.validate.min.js");
        $jqvalidate .= RM_Utilities::enqueue_external_scripts('rm_jquery_validate_add', RM_BASE_URL."public/js/additional-methods.min.js");
        $jq_front_form_script = RM_Utilities::enqueue_external_scripts('rm_front_form_script', RM_BASE_URL."public/js/rm_front_form.js");
        wp_enqueue_script('rm_front');
        wp_enqueue_script('rm_jquery_conditionalize');
        $str = <<<JSHD
                
   <pre class='rm-pre-wrapper-for-script-tags'><script>
                
if (typeof window['rm_multipage'] == 'undefined') {

    rm_multipage = {
        global_page_no_{$form_identifier}_{$this->form_number}: 1
    };

}
else
 rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;

function gotonext_{$form_identifier}_{$this->form_number}(){
	
        maxpage = {$max_page_count} ;
        {$validator_js}
        if(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length > 0)
        {
            var elements_to_validate= jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input");
            var valid = elements_to_validate.valid();
            elements_to_validate.each(function(){
            var if_mobile= jQuery(this).attr('data-mobile-intel-field');
                if(if_mobile){
                    var tel_error= rm_toggle_tel_error(jQuery(this).intlTelInput('isValidNumber'),jQuery(this),jQuery(this).data('error-message'));
                    if(tel_error){
                        valid= false;
                    }
                    else
                    {
                        jQuery(this).val(jQuery(this).intlTelInput('getNumber'));
                    }
                }
            });
                
            if(!valid)
            {
                setTimeout(function(){ jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}").removeProp('disabled');}, 1000);
                var error_element= jQuery(document).find("input.rm-form-field-invalid-msg")[0];
                if(error_element){
                    error_element.focus();
                }
                return false;
            }
        }
        
        /* Server validation for Username and Email field */
        for(var i=0;i<rm_validation_attr.length;i++){
            var validation_flag= true;
            jQuery("[" + rm_validation_attr[i] + "=0]").each(function(){
               validation_flag= false;
               return false;
            });
            
            if(!validation_flag)
              return;
        }
        
        
        rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}++;
        
        /*skip blank form pages*/
        while(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0)
        {
        
            if(maxpage <= rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
            {
                    if(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0){
                        jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}").prop('type','submit');
                        jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}").prop('disabled',true);
                        return;
                    }        
                    else
                        break;
            }
        
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}++;
        }
            
	
	if(maxpage < rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
	{
		rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = maxpage;
		jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}").prop('type','submit');
                jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}").prop('disabled',true);
		return;
	}
	jQuery(".rmformpage_{$form_identifier}_{$this->form_number}").each(function (){
		var visibledivid = "rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number};
		if(jQuery(this).attr('id') == visibledivid)
			jQuery(this).show();
		else
			jQuery(this).hide();
	});  
    jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}").prop('disabled',false);
        rmInitGoogleApi();
}
function gotoprev_{$form_identifier}_{$this->form_number}(){
	
	maxpage = {$max_page_count} ;
	rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}--;
        jQuery("#rm_next_form_page_button_{$form_id}_{$this->form_number}").attr('type','button');        
        
        /*skip blank form pages*/
        while(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0)
        {
            if(1 >= rm_multipage.global_page_no_{$form_identifier}_{$this->form_number})
            {
                    if(jQuery("#rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}+" :input").length == 0){
                        rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;
                        jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}").prop('disabled',true);
                        return;
                    }        
                    else
                        break;
            }
        
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number}--;
        }
        
	jQuery(".rmformpage_{$form_identifier}_{$this->form_number}").each(function (){
		var visibledivid = "rm_form_page_{$form_identifier}_{$this->form_number}_"+rm_multipage.global_page_no_{$form_identifier}_{$this->form_number};
		if(jQuery(this).attr('id') == visibledivid)
			jQuery(this).show();
		else
			jQuery(this).hide();
	});
        
        if(rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} <= 1)
        {
            rm_multipage.global_page_no_{$form_identifier}_{$this->form_number} = 1;
            jQuery("#rm_prev_form_page_button_{$form_id}_{$this->form_number}").prop('disabled',true);
        }
}         
</script></pre>
JSHD;
        $str = $jqvalidate.$jq_front_form_script.$str;
        $form->addElement(new Element_HTML($str));
    }

}
