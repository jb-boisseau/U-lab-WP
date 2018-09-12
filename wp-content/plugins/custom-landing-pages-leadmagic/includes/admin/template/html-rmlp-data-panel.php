<?php  wp_enqueue_media(); add_thickbox(); ?>
<div class="panel-wrap product_data">
    <div class="rm-landing-page">
        <div class="rmagic">
        
        <!---------------------------------- Page Loader Option --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_EN_LOADER'); ?></div>
            <div class="uirm-input">
                <input name="loader_enabled" id="loader_enabled" type="checkbox" class="rm-landing-toggle" <?php echo $meta_data['loader_enabled'] == 1 ? 'checked' : ''; ?> value="1" style="display:none;" />
                <label for="loader_enabled"></label>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_EN_LOADER'); ?></div></div>

            <div class="<?php echo $meta_data['loader_enabled'] == 1 ? '' : 'rm-hide-child'; ?> child_loader_enabled childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_LOADER_BG_COLOR'); ?></div>
                    <div class="uirm-input">
                        <input type="text" name="loader_bg_color" id="loader_bg_color" class="jscolor"  value="<?php echo $meta_data['loader_bg_color']; ?>" />
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_LOADER_BG_COLOR'); ?></div></div>
                </div>


                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_LOADER_IC'); ?></div>
                    <div class="uirm-input">
                        <div class="uirmradio">
                            <label>
                                <input type="radio" name="loader_type" id="loader_type_ic" <?php echo $meta_data['loader_type'] == 'ic' ? 'checked' : ''; ?> value="ic" />
                                <?php echo RMLP_UI_Strings::get('LABEL_IC'); ?>              
                            </label>
                            <label>
                                <input type="radio" name="loader_type" id="loader_type_text" <?php echo $meta_data['loader_type'] == 'text' ? 'checked' : ''; ?> value="text" />
                                <?php echo RMLP_UI_Strings::get('LABEL_TEXT'); ?>             
                            </label>

                        </div>

                       
                         
         
                            </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_LOADER_TYPE'); ?></div></div>
                   
                           
                            </div>
                
                <div class="uirm-row ">     
                    <div  class="rm-landing-page-subschild">
                        
                         <div class="<?php echo $meta_data['loader_type'] == 'ic' ? '' : 'rm-hide-child'; ?> child_loader_type_ic sibling">
                             <div class="uirm-row ">
                             <div class="rm-radio-icon" >   
                                <div class="uirm-field">
                                    <?php echo RMLP_UI_Strings::get('LABEL_SELECT_IC'); ?>      
                                </div>
                                <div class="uirm-input">
                                    <div class="uirmradio">
                                        <?php                                         
                                        foreach ($loader_icons as $key => $val): ?>
                                            <input type="radio" <?php echo $meta_data['loader_icon'] == $val ? 'checked' : '' ?>   name="loader_icon" id="preloader-<?php echo $key; ?>" value="<?php echo $val; ?>"/>
                                            <label for="preloader-<?php echo $key; ?>" ><img src="<?php echo RMLP_BASE_URL; ?>includes/admin/template/images/<?php echo $val; ?>.gif" class="uirm-loader-icon"></label>

                                        <?php endforeach; ?>

                                    </div>
                                </div>

                            </div>
                             </div>
                             
                        </div>
              
                        <div class="<?php echo $meta_data['loader_type'] == 'text' ? '' : 'rm-hide-child'; ?> child_loader_type_text sibling" > 
                            <div class="uirm-row">
                                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_CONTENT'); ?> </div>
                                    <div class="uirm-input">
                                        <input type="text" name="loader_text" value="<?php echo $meta_data['loader_text']; ?>" />
                                    </div>
                                    
                                       <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_LOADER_TEXT'); ?></div></div>
                         
                                </div>
                            
                            <div class="uirm-row">
                                <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_COLOR'); ?></div>
                                <div class="uirm-input">
                                    <input class="jscolor" type="text" name="loader_text_color" value="<?php echo $meta_data['loader_text_color']; ?>" />
                                </div>
                                  <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_LOADER_TEXT_COLOR'); ?></div></div>
                      
                            </div>
                            <div class="uirm-row">
                                <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_SIZE'); ?></div>
                                <div class="uirm-input">
                                    <input type="number" name="loader_text_size" value="<?php echo $meta_data['loader_text_size'] == "" ? 18 : $meta_data['loader_text_size']; ?>" />
                                </div>
                                
                                       <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_LOADER_TEXT_SIZE'); ?></div></div>
                   
                            </div>
                        </div>

                        
                        
                    </div>
                </div>
                

                        </div>
                    </div>
          

<!---------------------------------- Top Menu Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field">
                Top Menu  </div>
            <div class="uirm-input">
                <input name="top_menu_enabled" <?php echo $meta_data['top_menu_enabled'] == 1 ? 'checked' : ''; ?> id="top_menu_enabled" type="checkbox" class="rm-landing-toggle" value="1" style="display:none;" />
                <label for="top_menu_enabled"></label>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_TOP_MENU'); ?></div></div>

            <div class="<?php echo $meta_data['top_menu_enabled'] == 1 ? '' : 'rm-hide-child' ?> child_top_menu_enabled  childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_BG_COLOR'); ?></div>
                    <div class="uirm-input">
                        <input type="text" name="menu_bg_color" id="rm-menu_bg_color" class="jscolor"  value="<?php echo $meta_data['menu_bg_color']=="" ? '000':$meta_data['menu_bg_color']; ?>" />
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MENU_BG_COLOR'); ?></div></div>
                </div>

                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_HOME_LINK'); ?></div>
                    <div class="uirm-input">
                        <input type="url" name="menu_link" id="rm-top-menu-link"   value="<?php echo $meta_data['menu_link']; ?>" />
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MENU_URL'); ?></div></div>
                </div>

                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_HOME_LINK_TEXT'); ?></div>
                    <div class="uirm-input">
                        <input type="text" name="menu_link_text" id="rm-menu_link_text"   value="<?php echo $meta_data['menu_link_text']; ?>" />
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MENU_TEXT'); ?></div></div>
                </div>

                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_LINK_COLOR'); ?></div>
                    <div class="uirm-input">
                        <input type="text" name="menu_link_text_color" id="rm-menu_link_text_color" class="jscolor"  value="<?php echo $meta_data['menu_link_text_color']; ?>" />
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MENU_TEXT_COLOR'); ?></div></div>
                </div>
            </div>
        </div>




<!---------------------------------- Animation Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_PAGE_ANIMATION'); ?></div>
            <div class="uirm-input">
                <input name="anim_enabled" id="rm-anim_enabled" type="checkbox" class="rm-landing-toggle" value="1" <?php echo $meta_data['anim_enabled'] == 1 ? 'checked' : ''; ?> style="display:none;">
                <label for="rm-anim_enabled"></label>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_PAGE_ANOMATION'); ?></div></div>
        </div>


<!---------------------------------- Site Header and Footers--------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_SITE_HEADER_FOOTER'); ?></div>
            <div class="uirm-input">
                <input name="site_header_enabled" id="rm-site_header_enabled" type="checkbox" class="rm-landing-toggle" value="1" <?php echo $meta_data['site_header_enabled'] == 1 ? 'checked' : ''; ?> style="display:none;">
                <label for="rm-site_header_enabled"></label>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_EN_THEME_HEADER'); ?></div></div>
        </div>


<!---------------------------------- BG Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_PAGE_BG'); ?></div>
            <div class="uirm-input">
                <ul class="uirmradio">
                    <li>
                        <input type="radio" <?php echo $meta_data['page_bg']=='color' ? 'checked': ''; ?> name="page_bg" id="page_bg_color_type" value="color" >
                        <?php echo RMLP_UI_Strings::get('LABEL_COLOR'); ?>             
                    </li>
                    <li>
                        <input type="radio" <?php echo $meta_data['page_bg']=='img' ? 'checked': ''; ?> name="page_bg" id="page_bg_img_type" value="img">
                       <?php echo RMLP_UI_Strings::get('LABEL_IMAGE'); ?>     
                    </li>

                </ul>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_PAGE_BG'); ?></div></div>

            <div class="<?php echo $meta_data['page_bg'] == 'color' ? '' : 'rm-hide-child'; ?> sibling child_page_bg_color_type childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_COLOR'); ?> </div>
                    <div class="uirm-input">
                        <input type="text" name="page_bg_color" id="page_bg_color" class="jscolor"  value="<?php echo $meta_data['page_bg_color']; ?>">
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_PAGE_BG_COLOR'); ?></div></div>
                </div>

            
            </div>

            <div class="<?php echo $meta_data['page_bg'] == 'img' ? '' : 'rm-hide-child'; ?> sibling child_page_bg_img_type childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field">&nbsp;</div>
                    <div class="uirm-input">
                        <ul class="uirmradio">
                            <li>
                                <input name="bg_img_type" type="radio" <?php echo!empty($meta_data['page_bg_image']) ? 'checked' : ''; ?> id="page_bg_media_img">
                                <?php echo RMLP_UI_Strings::get('LABEL_WP_MEDIA'); ?>             
                            </li>
                            <li>
                                <input name="bg_img_type" type="radio" <?php echo (empty($meta_data['page_bg_image']) && !empty($meta_data['page_bg_image_url'])) ? 'checked' : ''; ?>  id="page_bg_unsplash_img">
                                <span class="uirm-select-unsplash-image"> <?php echo RMLP_UI_Strings::get('LABEL_US_TITLE'); ?>   </span>          
                            </li>

                        </ul>
                        
                    </div>
                    <div  class="uirm-unsplash-usage-note">High definition images from Unsplash are free for commercial and noncommercial use. Please read <a href="https://unsplash.com/license" target="_blank">usage license</a> for detailed information. </div>
                </div>
                <div class="<?php echo !empty($meta_data['page_bg_image']) ? '' : 'rm-hide-child'; ?> child_page_bg_media_img sibling" >
                            <div class="uirm-row">
                        <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_BG_IMAGE'); ?></div>
                        <div class="uirm-input">
                        
                        <div>
                            <img src="<?php echo $meta_data['page_bg_image']>0 ? $meta_data['page_bg_image_url']:''; ?>" id="page_bg_image" />
                        </div>
                        <input type="button" onClick="mediaUpload(false,'page_bg_image')" value="<?php echo RMLP_UI_Strings::get('LABEL_BROWSE'); ?>" />
                        <?php if(((int)($meta_data['page_bg_image']))>0) : ?>
                        <input type="button" onClick="removeMedia('page_bg_image')" value="<?php echo RMLP_UI_Strings::get('LABEL_REMOVE'); ?>" />
                        <?php endif; ?>
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_BG_IMAGE'); ?></div></div>
                    
                </div>
                </div>
                
                <div class="<?php echo (empty($meta_data['page_bg_image'])&& !empty($meta_data['page_bg_image_url'])) ? '' : 'rm-hide-child'; ?> child_page_bg_unsplash_img sibling" >
                        <!-- Unsplash Image Options -->
      
                             <div class="uirm-row">
                        <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_US_TITLE'); ?></div>
                        <div class="uirm-input">
                            <div class="uirm-unsplash-thumb">
                                <img src="<?php echo (empty($meta_data['page_bg_image']) && !empty($meta_data['page_bg_image_url']))?$meta_data['page_bg_image_url'].'?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=80&fit=max':''; ?>" id="page_us_image" />
                            </div>
                            <div class="uirm-unsplash-thumb-remove-btn">    
                                <?php if (empty($meta_data['page_bg_image']) && !empty($meta_data['page_bg_image_url'])) : ?>
                                    <input type="button" onClick="removeMedia('page_bg_image')" value="<?php echo RMLP_UI_Strings::get('LABEL_REMOVE'); ?>" />
                                <?php endif; ?>
                            </div>
                                  <div class="uirm-unsplash-search-field">
                           <input type="text" value="" id="unsplash_query" placeholder="Search Keyword" />
                           <input type="button" class="uirm-unsplash-search-btn" value="<?php echo RMLP_UI_Strings::get('LABEL_SEARCH'); ?>" onclick="rmlp_unsplash.loadPhotos()" />
                                  </div>
                        </div>
                        <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_US_SEACRH'); ?></div></div>
                         
                        <div id="unsplash_container" class="uirm-unsplash-popup-parent" style="display:none">
                            <div class="uirm-unsplash-popup-overlay" style="display:none"></div>
                            <div class="uirm-unsplash-popup-inner">
                
                                    
                                    <div class="uirm-unsplash-popup-head">
                                        
                                        <div class="uirm-credit-author difl "><input type="checkbox" value="<?php if($meta_data['credit_author'] == 1 ){ echo $meta_data['credit_author']; } ?>" name="credit_author" id="credit_author" <?php if($meta_data['credit_author'] == 1 ){ echo ' checked=checked'; }?>/>Credit Author</div>
                                        
                                          <div class="uirm-unsplash-search-field difl ">
                           <input type="text" value="" id="unsplash_query2" placeholder="Search Keyword" />
                           <input type="button" class="uirm-unsplash-search-btn" value="<?php echo RMLP_UI_Strings::get('LABEL_SEARCH_MORE'); ?>" onclick="rmlp_unsplash.loadPhotos2()" />
                                  </div>
                                        <div class="uirm-terms difl "><a href="https://unsplash.com/terms">Terms and Conditions​</a></div>
                                        
                                        <div  class="uirm-unsplash-modal-close"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        </svg></div>
                                        
                                    </div>
                                 <div id="unsplash_loader" style="display:none">Loading Images</div>  
                                
                                
                                <div id="unsplash_ph_container"  class="uirm-unsplash-ph-container "> 
                                    
                           
                                </div> 
                                 
                                 <div class="uirm-unsplash-no-results" id="unsplash-no-results">
                                    
                                </div>
                                 
                                 
                            </div>
                          
                        </div>
                             </div>
                   
                   
                </div>
                
 
                    <input type="hidden" name="page_bg_image" id="page_bg_image_id" value="<?php echo $meta_data['page_bg_image']; ?>" />
                    <input type="hidden" name="page_bg_image_url" id="page_bg_image_url" value="<?php echo $meta_data['page_bg_image_url'] ?>" />
                    <input type="hidden" name="page_bg_image_auth" id="page_bg_image_auth" value="<?php echo $meta_data['page_bg_image_auth'] ?>" />
                    <input type="hidden" name="page_bg_image_authlink" id="page_bg_image_authlink" value="<?php echo $meta_data['page_bg_image_authlink'] ?>" />
                    


                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_BG_IMAGE_OVERLAY'); ?></div>
                    <div class="uirm-input">
                        <input type="text" name="page_bg_image_overlay" id="page_bg_image_overlay" class="jscolor" value="<?php echo $meta_data['page_bg_color_overlay']; ?>">
                    </div>
                    <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_BG_IMG_OVERLAY'); ?></div></div>
                </div>
                
                
                
            </div>
        </div>

        <!---------------------------------- Logo Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_LOGO'); ?> </div>
            <div class="uirm-input">
               
                <input name="logo_enabled" id="logo_enabled" type="checkbox" class="rm-landing-toggle" <?php echo $meta_data['logo_enabled'] == 1 ? 'checked' : ''; ?> value="1" style="display:none;">
                <label for="logo_enabled"></label>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_EN_LOGO'); ?></div></div>
            <div class="<?php echo $meta_data['logo_enabled'] == 1 ? '' : 'rm-hide-child'; ?> child_logo_enabled childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_IMAGE'); ?></div>
                    <div class="uirm-input">
                        <div>
                            <img src="<?php echo $meta_data['logo_url']; ?>" id="logo" />
                        </div>
                        <input type="button" onClick="mediaUpload(false,'logo')" value="<?php echo RMLP_UI_Strings::get('LABEL_BROWSE'); ?>" />
                        <?php if(((int)($meta_data['logo']))>0) : ?>
                        <input type="button" onClick="removeMedia('logo')" value="<?php echo RMLP_UI_Strings::get('LABEL_REMOVE'); ?>" />
                        <?php endif; ?>
                     
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_IMG_LOGO'); ?></div></div>
             
                    <input type="hidden" id="logo_id" name="logo" value="<?php echo $meta_data['logo'] ?>" />
                    <input type="hidden" id="logo_url" name="logo_url" value="<?php echo $meta_data['logo_url'] ?>" />
                </div>
            </div>
        </div>
        
        <!---------------------------------- Header Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_H1_TEXT'); ?></div>
            <div class="uirm-input">
                <textarea name="logo_header1_text"  id="rm-header-text-1" maxlength="50"><?php echo $meta_data['logo_header1_text']; ?></textarea>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MAIN_HEADER'); ?></div></div>
        </div>

        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_H2_TEXT'); ?></div>
            <div class="uirm-input">
                <textarea name="logo_header2_text" id="rm-header-text-2" maxlength="200"><?php echo $meta_data['logo_header2_text']; ?></textarea>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_SUB_HEADER'); ?></div></div>
        </div>
        
        <!---------------------------------- Description --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_DESCRIPTION'); ?></div>
            <div class="uirm-input">
                <textarea name="description" id="rm-landing-page-desc" ><?php echo $meta_data['description']; ?></textarea>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_MAIN_TEXT'); ?></div></div>
        </div>
        
        <!---------------------------------- Featured Image Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_COVER_IMAGE'); ?></div>
            <div class="uirm-input">
                <input name="cover_enabled" <?php echo $meta_data['cover_enabled'] == 1 ? 'checked' : ''; ?> id="cover_enabled" type="checkbox" class="rm-landing-toggle" value="1" style="display:none;">
                <label for="cover_enabled"></label>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_FEATURED_IMAGE'); ?></div></div>
            
            <div class="<?php echo $meta_data['cover_enabled']==1 ? '' : 'rm-hide-child'; ?> child_cover_enabled  childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_IMAGE'); ?></div>
                    <div class="uirm-input">
                        <div>
                            <img src="<?php echo $meta_data['cover_image_url']; ?>" id="cover_image" />
                        </div>
                        <div class="uirm-media-btn">
                        <input type="button" onClick="mediaUpload(false,'cover')" value="<?php echo RMLP_UI_Strings::get('LABEL_BROWSE'); ?>" />
                        <?php if(((int)($meta_data['cover_image']))>0) : ?>
                        <input type="button" onClick="removeMedia('cover')" value="<?php echo RMLP_UI_Strings::get('LABEL_REMOVE'); ?>" />
                        </div>
                        <?php endif; ?>
                    </div>
        
                    
                    <input type="hidden" name="cover_image" id="cover_image_id"  value="<?php echo $meta_data['cover_image']; ?>"/>
                    <input type="hidden" name="cover_image_url" id="cover_image_url" value="<?php echo $meta_data['cover_image_url']; ?>"/>
                </div>
                
                
            </div>
        </div>
        </div>
           <!---------------------------------- Cover Image Caption --------------------------------------->
        
        <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_IMAGE_CAPTION'); ?></div>
                    <div class="uirm-input">
                        <input name="cover_caption_enabled" <?php echo $meta_data['cover_caption_enabled'] == 1 ? 'checked' : ''; ?> id="cover_caption_enabled" type="checkbox" class="rm-landing-toggle" value="1" style="display:none;">
                        <label for="cover_caption_enabled"></label>
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_EN_CAPTION'); ?></div></div>
                    <div class="<?php echo $meta_data['cover_caption_enabled']==1 ?'':'rm-hide-child'; ?> child_cover_caption_enabled childfieldsrow">
                        <div class="uirm-row">
                            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_COVER_CAPTION'); ?></div>
                            <div class="uirm-input">
                                <textarea  name="cover_caption" maxlength="100"><?php echo $meta_data['cover_caption']; ?> </textarea>
                            </div>
                            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_IMAGE_CAPTION'); ?></div></div>
                        </div>
                        </div>
                    </div>
             
        
        
   
        
        <!---------------------------------- Form Header Text --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_FORM_H_TEXT'); ?></div>
            <div class="uirm-input">
                <textarea name="form_header_text" id="rm-form-header-text" maxlength="100" ><?php echo $meta_data['form_header_text']; ?></textarea>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_FORM_HEADER'); ?></div></div>
        </div>
        
        <!---------------------------------- Form Options --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_SELECT_FORM'); ?></div>
            <div class="uirm-input">
                <ul class="uirmradio">
                    <li>
                        <input type="radio" <?php echo $meta_data['form_type']=='rm' ? 'checked': ''; ?> name="form_type" id="rm_form_type" value="rm" >
                        <?php echo RMLP_UI_Strings::get('LABEL_RM_FORM'); ?>             
                    </li>
                    <li>
                        <input type="radio" <?php echo $meta_data['form_type']=='shortcode' ? 'checked': ''; ?> name="form_type" id="shortcode_form_type" value="shortcode">
                        <?php echo RMLP_UI_Strings::get('LABEL_FORM_SHORTCODE'); ?>             
                    </li>

                </ul>
            </div>
            <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_SELECT_FORM'); ?></div></div>
            
            <!---------------------------------- List of RM Forms --------------------------------------->
            <div class="<?php echo $meta_data['form_type'] == 'rm' ? '' : 'rm-hide-child'; ?> sibling child_rm_form_type childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_RM_FORM'); ?></div>
                    <div class="uirm-input">
                        <select name="rm_form" id="select-rm-form">
                            <option value=""><?php echo RMLP_UI_Strings::get('LABEL_SELECT_FORM'); ?></option>
                            <?php
                            foreach ($rm_forms as $key => $value):
                                $selected = $key == $meta_data['rm_form'] ? 'selected' : '';
                                echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_SELECT_FORM'); ?></div></div>
                </div>
            </div>
            
            <!---------------------------------- List of RM Forms --------------------------------------->
            <div class="<?php echo $meta_data['form_type'] == 'shortcode' ? '' : 'rm-hide-child'; ?> sibling child_shortcode_form_type childfieldsrow">
                 <div class="uirm-row">
                <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_FORM_SHORTCODE'); ?></div>
                <div class="uirm-input">
                    <textarea name="custom_form_shortcode" id="custom_form_shortcode" class="" maxlength="100"><?php echo $meta_data['custom_form_shortcode']; ?></textarea>
                </div>
                <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_SHORTCODE_FORM'); ?></div></div>
                 </div>
            </div>
            
        </div>
        
        
        
        <!---------------------------------- Bottom Text --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_BOTTOM_AREA'); ?></div>
            <div class="uirm-input">
                <input name="bottom_enabled" <?php echo $meta_data['bottom_enabled'] == 1 ? 'checked' : ''; ?> id="bottom_enabled" type="checkbox" class="rm-landing-toggle" value="1" style="display:none;">
                <label for="bottom_enabled"></label>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_BOTTOM_AREA'); ?></div></div>
            
            <div class="<?php echo $meta_data['bottom_enabled']==1 ? '': 'rm-hide-child'; ?> child_bottom_enabled childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_H_TEXT'); ?></div>
                    <div class="uirm-input">
                        <textarea name="bottom_header_text" id="bottom_header_text" class="" maxlength="50"><?php echo $meta_data['bottom_header_text']; ?></textarea>
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_BOTTOM_HEADER_TEXT'); ?></div></div>
                </div>
                
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_AREA_TEXT'); ?></div>
                    <div class="uirm-input">
                        <textarea name="bottom_area_text" id="bottom_area_text" class="" maxlength="200"><?php echo $meta_data['bottom_area_text']; ?></textarea>
                    </div>
                    <div class="rmnote"> <div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_BOTTOM_AREA_TEXT'); ?></div></div>
                </div>
                
            </div>
        </div>
        
      
        
        <!---------------------------------- Navigating Away Alert --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_NAV_AW_ALERT'); ?></div>
            <div class="uirm-input">
                <input name="nav_alert_enabled" id="nav_alert_enabled" type="checkbox" class="rm-landing-toggle" value="1" <?php echo $meta_data['nav_alert_enabled'] == 1 ? 'checked' : ''; ?> style="display:none;">
                <label for="nav_alert_enabled"></label>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_ALERT-NAVIGATION-AWAY'); ?></div></div>
            
            <div class="<?php echo $meta_data['nav_alert_enabled']==1 ? '': 'rm-hide-child'; ?> child_nav_alert_enabled childfieldsrow">
                <div class="uirm-row">
                    <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_ALERT_MSG'); ?></div>
                    <div class="uirm-input">
                        <textarea name="nav_alert_msg" id="nav_alert_msg" maxlength="50"><?php echo $meta_data['nav_alert_msg']; ?></textarea>
                    </div>
                 
                </div>
            </div>
        </div>
        
        <!---------------------------------- Form Header Text --------------------------------------->
        <div class="uirm-row">
            <div class="uirm-field"><?php echo RMLP_UI_Strings::get('LABEL_CUSTOM_CSS'); ?></div>
            <div class="uirm-input">
                <textarea name="custom_css" id="custom_css" maxlength="1000" ><?php echo $meta_data['custom_css']; ?></textarea>
            </div>
            <div class="rmnote"><div class="rmnotecontent"><?php echo RMLP_UI_Strings::get('HELP_CUSTOM_CSS'); ?></div></div>
        </div>
        

</div>
</div>
</div>

<script>

    jQuery(document).ready(function () {
        jQuery(".rm-landing-toggle").click(function () {
            rm_toggle(jQuery(this));
        });

        
        jQuery("#rm-site_header_enabled").change(function(){
            if(jQuery(this).prop('checked')){
                jQuery("#top_menu_enabled").attr('checked',false);
                jQuery(".child_top_menu_enabled").hide();
            }
                
        })
        
        jQuery("#top_menu_enabled").change(function(){
            if(jQuery(this).prop('checked'))
                jQuery("#rm-site_header_enabled").attr('checked',false);
        })
        
        jQuery("#page_bg_media_img").change(function(){
            if(this.checked)
            {
                jQuery("#credit_author").val('-1');
            }
        });
    });

    function rm_toggle(obj)
    {
        var elementId = jQuery(obj).attr('id');
        if (jQuery(obj).is(":checked")) {
            jQuery(".child_" + elementId).show();
        } else {
            jQuery(".child_" + elementId).hide();
        }
    }
    
    function removeMedia(type)
    {
        if(type=="cover")
        {
            jQuery("#cover_image").attr("src",'');
            jQuery("#cover_image_id").val('');
            jQuery("#cover_image_url").val('');
        } else if(type=="page_bg_image")
        {
            jQuery("#page_bg_image").attr("src",'');
            jQuery("#page_bg_image_id").val('');
            jQuery("#page_bg_image_url").val('');
            jQuery("#page_us_image").attr('src','');
        } else if(type=="logo")
        {
            jQuery("#logo").attr("src",'');
            jQuery("#logo_id").val('');
            jQuery("#logo_url").val('');
        }
    }
    function mediaUpload(multiImage,type)
    {
        var mediaUploader;
        // If the uploader object has already been created, reopen the dialog
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        // Extend the wp.media object
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: multiImage});

        
        mediaUploader.on('select', function () {
            attachments = mediaUploader.state().get('selection');
            attachments.map(function (attachment) {
                attachment = attachment.toJSON();
                if (multiImage) {
                    // For gallery images
                   // var imageObj = {src: [attachment.sizes.thumbnail.url], id: attachment.id};
                  var imageObj = attachment.sizes.thumbnail===undefined ? {src: [attachment.sizes.full.url], id: attachment.id} : {src: [attachment.sizes.thumbnail.url], id: attachment.id};
                    //$scope.data.post.images.push(imageObj);

                  //  $scope.data.post.gallery_image_ids.push(attachment.id);

                } else {
                    url= attachment.sizes.thumbnail===undefined ? attachment.sizes.full.url : attachment.sizes.thumbnail.url;
                    if(type=='cover'){
                         jQuery("#cover_image").attr("src",url);
                         jQuery("#cover_image_id").val(attachment.id);
                         jQuery("#cover_image_url").val(url);
                    } else if(type=="page_bg_image")
                    {
                         jQuery("#page_bg_image").attr("src",url);
                         jQuery("#page_bg_image_id").val(attachment.id);
                         jQuery("#page_bg_image_url").val(url);
                          jQuery("#page_us_image").attr('src','');
                    } else if(type=="logo")
                    {
                         jQuery("#logo").attr("src",url);
                         jQuery("#logo_id").val(attachment.id);
                         jQuery("#logo_url").val(url);
                    }
                      
                   
                    // For cover image
                   // $scope.data.post.cover_image_id = attachment.id;
                }
            });
        });
        // Open the uploader dialog
        mediaUploader.open();
        
        
    }
    
    
    jQuery('.uirm-row .uirmradio input[type="radio"]').click(function () {
        var inputValue = jQuery(this).attr("id");
        jQuery(".child_" + inputValue).siblings(".sibling").hide();
        jQuery(".child_" + inputValue).show();
    });

</script>
