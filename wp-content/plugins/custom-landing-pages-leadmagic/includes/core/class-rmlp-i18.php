<?php

/**
* Define the internationalization functionality
*
*/
class RMLP_i18n
{

   /**
    * Load the plugin text domain for translation.
    *
    * @since    1.0.0
    */
   public function load_plugin_textdomain()
   {

       load_plugin_textdomain(
           'rmlp', false, dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
       );
   }

}