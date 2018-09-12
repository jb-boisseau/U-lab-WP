<?php

/**
 * This class works as a repository of all the string resources used in  UI
 * for easy translation and management. 
 *
 */
class RMLP_UI_Strings {

    public static function get($identifier) {
        $identifier = strtoupper($identifier);
        switch ($identifier) {
            case 'LABEL_LP':
                return __('LeadMagic', 'rmlp');
            case 'LABEL_ADD':
                return __('Add', 'rmlp');    
            case 'LABEL_ADD_NEW':
                return __('Add New', 'rmlp');  
            case 'LABEL_EDIT':
                return __('Edit', 'rmlp');
            case 'LABEL_VIEW':
                return __('VIEW', 'rmlp');  
            case 'LABEL_RECORD_NOT_FOUND':
                return __('No Record Found', 'rmlp');  
            case 'LABEL_IMAGE':
                return __('Image', 'rmlp');    
            case 'LABEL_LP_DATA':
                return __('Landing Page Data', 'rmlp');     
            case 'VALIDATION_REQUIRED':
                return __('Required Field', 'rmlp');
            case 'LABEL_EN_LOADER':
                return __('Enable Page Loader', 'rmlp');    
            case 'LABEL_LOADER_BG_COLOR':
                return __('Loader Background Color', 'rmlp');    
            case 'LABEL_LOADER_IC':
                return __('Loader Icon', 'rmlp');     
            case 'LABEL_TEXT':
                return __('Text', 'rmlp'); 
            case 'LABEL_IC':
                return __('Icon', 'rmlp');  
            case 'LABEL_SELECT_IC':
                return __('Select Icon', 'rmlp');
            case 'LABEL_CONTENT':
                return __('Content', 'rmlp'); 
            case 'LABEL_COLOR':
                return __('Color', 'rmlp');    
            case 'LABEL_SIZE':
                return __('Size', 'rmlp');    
            case 'LABEL_BG_COLOR':
                return __('Background Color', 'rmlp');
            case 'LABEL_HOME_LINK':
                return __('Home Page Link', 'rmlp');  
            case 'LABEL_HOME_LINK_TEXT':
                return __('Home Page Link Text', 'rmlp'); 
            case 'LABEL_LINK_COLOR':
                return __('Link Color', 'rmlp'); 
            case 'LABEL_PAGE_ANIMATION':
                return __('Page Animation', 'rmlp');
            case 'LABEL_SITE_HEADER_FOOTER':
                return __('Include Site Header & Footer', 'rmlp');
            case 'LABEL_SITE_FOOTER':
                return __('Include Site Footer', 'rmlp');
            case 'LABEL_PAGE_BG':
                return __('Page Background', 'rmlp');
            case 'LABEL_COLOR_OVERLAY':
                return __('Color Overlay', 'rmlp');
            case 'LABEL_BG_IMAGE':
                return __('Background Image', 'rmlp');    
            case 'LABEL_BG_IMAGE_OVERLAY':
                return __('Background Image Overlay', 'rmlp');     
            case 'LABEL_BROWSE':
                return __('Browse', 'rmlp'); 
            case 'LABEL_LOGO':
                return __('Logo', 'rmlp'); 
            case 'LABEL_H1_TEXT':
                return __('Main Header', 'rmlp'); 
            case 'LABEL_H2_TEXT':
                return __('Sub-Header', 'rmlp');
            case 'LABEL_DESCRIPTION':
                return __('Main Text', 'rmlp');
            case 'LABEL_COVER_IMAGE':
                return __('Featured Image', 'rmlp');    
            case 'LABEL_IMAGE_CAPTION':
                return __('Image Caption', 'rmlp');
            case 'LABEL_REMOVE':
                return __('Remove', 'rmlp');
            case 'LABEL_COVER_CAPTION':
                return __('Caption Text', 'rmlp');
            case 'LABEL_FORM_H_TEXT':
                return __('Form Header', 'rmlp');
            case 'LABEL_SELECT_FORM':
                return __('Select Form', 'rmlp');
            case 'LABEL_BOTTOM_AREA':
                return __('Bottom Area', 'rmlp');
            case 'LABEL_AREA_TEXT':
                return __('Bottom Area Text', 'rmlp'); 
            case 'LABEL_H_TEXT':
                return __('Header Text', 'rmlp'); 
            case 'LABEL_WINDOW_ALERT':
                return __('Show alert while closing window', 'rmlp');
            case 'LABEL_ALERT_MSG':
                return __('Alert Message', 'rmlp'); 
            case 'LABEL_NAV_AW_ALERT':
                return __('Show alert while navigating away', 'rmlp');  
            case 'HELP_EN_LOADER':
               return __('Show a loading screen while the landing page loads in the background. This helps in providing consistent user experience.', 'rmlp');
            case 'HELP_LOADER_BG_COLOR':
               return __('Select the background color of the page on which the loading text or icon will be displayed.', 'rmlp');
            case 'HELP_LOADER_TYPE':
               return __('Select between an icon or your own custom text.', 'rmlp');
            case 'HELP_LOADER_TEXT':
               return __('Text to be displayed while landing page is loading.', 'rmlp');
            case 'HELP_LOADER_TEXT_COLOR':
               return __('Color of the text.', 'rmlp');
            case 'HELP_LOADER_TEXT_SIZE':
               return __('Font size of the text (in px)', 'rmlp');
            case 'HELP_TOP_MENU':
               return __('Display a sticky top bar with a custom link on top of the landing page. This only works with theme header turned off.', 'rmlp');
            case 'HELP_MENU_BG_COLOR':
               return __('Background color of the menu bar.', 'rmlp');    
            case 'HELP_MENU_URL':
               return __('URL associated with the menu link on the menu bar. It can be home page link etc.', 'rmlp'); 
            case 'HELP_MENU_TEXT':
               return __('Anchor text of the link.', 'rmlp'); 
            case 'HELP_MENU_TEXT_COLOR':
               return __('Text color of the link anchor text.', 'rmlp'); 
            case 'HELP_PAGE_ANOMATION':
               return __('Display a smooth CSS3 animation when the page appears for the first time.', 'rmlp'); 
            case 'HELP_EN_THEME_HEADER':
               return __('Turn on, if you want to display your theme\'s header and footer areas above and below the landing page respectively.', 'rmlp'); 
            case 'HELP_PAGE_BG':
               return __('Decide between solid color or a custom image to be displayed behind the landing page.', 'rmlp');     
            case 'HELP_PAGE_BG_COLOR':
               return __('Color of the background.', 'rmlp');
            case 'HELP_BG_IMAGE':
               return __('Select image to be displayed in the background. it will file the complete background space.', 'rmlp');
            case 'HELP_BG_IMG_OVERLAY':
               return __('Define a color overlay above the background image.', 'rmlp');
            case 'HELP_EN_LOGO':
               return __('Display your logo on top of the landing page.', 'rmlp'); 
                
            case 'HELP_IMG_LOGO':
               return __('Select the logo image file.', 'rmlp');   
            case 'HELP_MAIN_HEADER':
               return __('Main text or title of your landing page in Max 50 characters.', 'rmlp'); 
            case 'HELP_SUB_HEADER':
               return __('A subtitle for your page in maximum 200 characters.', 'rmlp');
            case 'HELP_MAIN_TEXT':
               return __('Long text for your landing page usually containing sales pitch.', 'rmlp'); 
            case 'HELP_FEATURED_IMAGE':
               return __('Display a full width image below the text. Maximum height 300px.', 'rmlp');
            case 'HELP_EN_CAPTION':
               return __('Display a caption above the image, like product name, credits etc.', 'rmlp');
            case 'HELP_IMAGE_CAPTION':
               return __('Text of the caption above the image.', 'rmlp');
            case 'HELP_FORM_HEADER':
               return __('Large text above the form, like an action call', 'rmlp');
            case 'HELP_SELECT_FORM':
               return __('Select the form which you want to display on the landing page. Form properties will be automatically applied.', 'rmlp');
            case 'HELP_BOTTOM_AREA':
               return __('Display an additional bottom section with text below the form.', 'rmlp');
            case 'HELP_BOTTOM_HEADER_TEXT':
               return __('Text of the bottom section header.', 'rmlp');
             case 'HELP_BOTTOM_AREA_TEXT':
               return __('Long text for the bottom section', 'rmlp');
            case 'HELP_ALERT-NAVIGATION-AWAY':
               return __('Display a browser alert when user tries to navigate away from the page.', 'rmlp');
            case 'LABEL_RM_FORM':
                return __('RegistrationMagic Form', 'rmlp');
            case 'LABEL_FORM_SHORTCODE':
                return __('Custom Shortcode', 'rmlp');    
            case 'HELP_SHORTCODE_FORM':
                return __('Add thirdparty Shortcode of the form which you want to display on the landing page.', 'rmlp'); 
            case 'LABEL_CUSTOM_CSS':
                return __('Custom CSS', 'rmlp'); 
            case 'HELP_CUSTOM_CSS':
                return __('Add CSS to change page appearance. <br>Note*: Do not use style tag. ','rmlp');
            case 'HELP_US_SEACRH':
                return __('Enter search ​keyword​(s) ​in the box on left and hit "Search Images" to begin searching photos from <a href="https://unsplash.com" target="_blank">UNSPLASH.COM</a> ​For example - Manhattan.​ You can search for single ​keyword or join ​keywords using the [+] symbol.','rmlp');
            case 'LABEL_SEARCH':
                return __('Search Images', 'rmlp');
            case 'LABEL_MORE_PHOTOS':
                return __('More Photos', 'rmlp');   
            case 'LABEL_US_TITLE':
                return __('Choose Image from <b>Unsplash</b>', 'rmlp');
            case 'LABEL_WP_MEDIA':
                return __('Media Library', 'rmlp');
            case 'PHOTO_CREDITS':
                return __('Photo Credits', 'rmlp');
            case 'LABEL_SEARCH_MORE':
                return __('Search More Images', 'rmlp');    
                
            default:
                return __('NO STRING FOUND', 'rmlp');
        }
    }

}
