var total=0;
var total_readonly=0;
jQuery(document).ready(function () {   
    jQuery(".rmagic-form").each(function(){
        var form= jQuery(this);
        form.find("[data-rmfieldtype],.rm_price_field_quantity").change(function(){
            rm_calculate_final_price(form);
        });
    });
    
    rm_price_widget_init();
});

function rm_calculate_final_price(form){ 
    var currentVal;
    var price_data;
    var currentQty;
    total=0;
    form.find("[data-rmfieldtype='price']").each(function(){ 
        var element= jQuery(this);
        console.log(element.attr('id'));
        if (element.is(":checkbox")) {
            if (element.is(":checked")){
                currentVal = element.val();
                price_data = element.data("rmfieldprice");
                if(price_data[currentVal] && price_data[currentVal]>0){
                 // Check for quanity field
                 currentQty= rm_get_price_quantity(element);
                 if(currentQty>0)
                    total += parseFloat(price_data[currentVal]) * currentQty;
                 else
                 total += parseFloat(price_data[currentVal]); 
                }
            }
        } else if (element.is("select")) {
            currentVal = element.val();
            price_data = element.data("rmfieldprice");
            if (price_data[currentVal] && price_data[currentVal]>0) {
                // Check for quanity field
                 currentQty= rm_get_price_quantity(element);
                 if(currentQty>0)
                    total += parseFloat(price_data[currentVal]) * currentQty;
                 else
                    total += parseFloat(price_data[currentVal]);
            }
        } else if (element.attr("type") == "number" && !element.is("[readonly]")) { 
            currentVal= parseFloat(element.val());
            if(currentVal>0)
            total += parseFloat(element.val());
        } else if(element.attr("type") == "text" && element.is("[readonly]")){
             currentQty= rm_get_price_quantity(element);
             currentVal= parseFloat(element.data("rmfieldprice"));
             if(currentQty>0 && currentVal>0){
                total += currentVal * (currentQty); 
            }
        }
    });
   
    form.find(".rm-total-price").html(total + total_readonly);
}

function rm_price_widget_init(){
    // Check for fixed price fields
    jQuery(".rmagic-form").each(function(){
       total=0;
       total_readonly=0;  
       var form= jQuery(this);
       form.find("input[data-rmfieldtype=price]").each(function(){
       var form= jQuery(this).parents('.rmagic-form');
            if(jQuery(this).is("[readonly]")){
                currentVal= parseFloat(jQuery(this).data("rmfieldprice"));
                if(currentVal>0){
                    total_readonly += currentVal;
                }
            } 
        });
        form.find(".rm-total-price").html(total + total_readonly);
    }); 
}

function rm_get_price_quantity(element){
    var currentElementName,currentElementQtyName,currentQtyElement,currentQty;
    currentElementName= element.attr("name");
    currentElementQtyName= element.attr("name") + "_qty"
    currentQtyElement= jQuery("input[name='" + currentElementQtyName +"']");
    if(currentQtyElement.length>0){
        currentQty= parseInt(currentQtyElement.val());
        if(currentQty>0)
            return currentQty;
    } else{
        // Check for multi select field
        currentQtyElement= jQuery("[data-price-field='"+element.attr("id")+"']");
        if(currentQtyElement.length>0){
          currentQty= parseInt(currentQtyElement.val());
          if(currentQty>0)
            return currentQty;
        }
    }
    return 0;
}
