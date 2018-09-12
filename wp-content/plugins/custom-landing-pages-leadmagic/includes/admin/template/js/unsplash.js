"use strict";
var RMLP_Unsplash = (function () {
    function RMLP_Unsplash(appId) {
        this.appId = appId;
        this.api = 'https://api.unsplash.com';
        this.perPage = 10;
        this.page = 1;
        this.orderby = 'latest';
        this.query="";
        
    }
    RMLP_Unsplash.prototype.getPhotos = function (query) {
        jQuery("#unsplash_loader").css('display', 'block');
        var url = this.api + "/search/photos/?client_id=" + this.appId + "&query=" + query + "&per_page=" + this.perPage + "&page=" + this.page + "&order_by=" + this.orderby;
        return jQuery.getJSON(url,function (data) { return data; }).error(function(){
            alert("Error accessing Unsplash API.")
        });
    };


    RMLP_Unsplash.prototype.loadPhotos = function (page) {
        var self= this;
        var element = jQuery('#unsplash_ph_container');
        if (page === void 0) { page = 1; element.html('');}
        var el = '';
        var no_more_results= "<div class='uirm-image-not-found'>No Images found.</div>";
        var no_results= "<div class='uirm-image-not-found'>No results are found. Please use another keyword.</div>"; 
        var currentQuery = jQuery("#unsplash_query").val();
        if(currentQuery!=this.query){
            element.html("");
            page=1;
        }
            
        this.query= currentQuery;   
        
        jQuery("#unsplash_query2").val(this.query);
        if (this.query === '') {
            alert('Please insert search keyword');
            return;
        }
        
        
            
        this.page = page;
        this.getPhotos(this.query).then(function (data) {
          
            jQuery("#unsplash_loader").css('display', 'none');
            data = data.results;
            jQuery(".uirm-unsplash-popup-parent, .uirm-unsplash-popup-overlay").css('display','block');
            if (data.length == 0){
                console.log(self.page);
                if(self.page>1) 
                    jQuery("#unsplash-no-results").html(no_more_results);
                else
                    jQuery("#unsplash-no-results").html(no_results);
                return;
            }
                
            if(data.length>0)
                jQuery("#unsplash-no-results").html('');
            for (var elem in data) {
                var photo = data[elem], id = photo.id, img = photo.urls.small, full_size = photo.urls.regular, author = photo.user.name, username = photo.user.username, link = photo.links.html, likes = photo.likes, authlink = photo.user.links.html;
                // Photo Template   
             
            
            el += "<div class=\"item uirm-unsplash-item\">" +
                   ("<div class=\"uirm-img-wrap\"><img id='selecteUsImage_" + id + "' src=\"" + img + "\" /></div>") +
                   ("<div class=\"uirm-unsplash-overlay\"></div>") +
                   ("<div class=\"uirm-unsplash-selector\"><div class=\"uirm-unsplash-btn\" onclick=\"rmlp_unsplash.selectImage('"+id+"','" + full_size + "','" + author + "','" + authlink + "')\">Use</div> </div>") +
                   ("<div class=\"uirm-unsplash-atr\"><a class=\"uirm-img-ahuthor\" target=\"thickbox\" href=\"https://unsplash.com/@" + username + "?utm_source=LeadMagic&utm_medium=referral&utm_campaign=api-credit\"><img src='" + photo.user.profile_image.small +"'/><span class=\"uirm-img-ahuthor-name\">By "+photo.user.name+"</span></a>") +
                   "</div></div>";
            }
            element.append(el);
            jQuery("#loadmore_btn").css('display', 'block');
 
                        jQuery(".uirm-unsplash-modal-close, .uirm-unsplash-popup-overlay, .item.uirm-unsplash-item .uirm-unsplash-selector").click(function(){
            jQuery(".uirm-unsplash-popup-parent").hide();
});
        });
    };
    RMLP_Unsplash.prototype.loadMorePhotos = function () {
        this.page++;
        this.loadPhotos(this.page);
    };
    
    RMLP_Unsplash.prototype.selectImage = function (imgId, imgURL,imgAuth, authLink) { 
        removeMedia('page_bg_image');
        var src = jQuery("#selecteUsImage_" + imgId).attr('src');
        jQuery("#page_us_image").attr('src', src);
        jQuery("#page_bg_image_url").val(imgURL);
        if(jQuery('input#credit_author').prop("checked")){
            var checked = 1;
            jQuery('input#credit_author').val(checked);
            jQuery("#page_bg_image_authlink").val(authLink);
            jQuery("#page_bg_image_auth").val(imgAuth);
        }
        else{
            var checked = 0;
            jQuery('input#credit_author').val(checked);
        }
        

    };
    
    RMLP_Unsplash.prototype.loadPhotos2= function()
    {
        jQuery("#unsplash_query").val(jQuery("#unsplash_query2").val());
        this.loadMorePhotos();
    }
    return RMLP_Unsplash;
}());
/*
RM KEY: var rmlp_unsplash= new RMLP_Unsplash('e1bff30648e847743daf088ed608db8ac56f74b90b94d9119af1b3c05e943fb9');

 */

var rmlp_unsplash= new RMLP_Unsplash('e1bff30648e847743daf088ed608db8ac56f74b90b94d9119af1b3c05e943fb9');
