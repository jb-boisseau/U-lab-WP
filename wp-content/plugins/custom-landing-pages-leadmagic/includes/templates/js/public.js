jQuery(window).load(function() {
    // Animate loader off screen
   jQuery(".rml-loader-overlay").fadeOut("slow");
    if (window.innerWidth > 900) {
        jQuery(".rml-bg").addClass("rml-bg-animate");
        jQuery(".rml-page").addClass("rml-page-animate");
    }
    
    jQuery('#rm_terms_textarea').closest('.rmrow').addClass('rml-terms-textarea');
    jQuery(".rml-container .rmrow .rmfield sup").each(function(){
        var this_jq = jQuery(this);
        if(this_jq.text().toString().trim()=="")
            this_jq.hide();
    });
    
 var viewportMetaTag = document.querySelector('meta[name="viewport"]');
var viewportMetaTagIsUsed = viewportMetaTag && viewportMetaTag.hasAttribute('content') ? true : false;

  if(viewportMetaTagIsUsed==false){
       jQuery('head').append('<meta name="viewport" content="width=device-width, initial-scale=1"/>');

  }

});