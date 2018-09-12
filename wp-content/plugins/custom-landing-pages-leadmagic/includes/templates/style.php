<style>
.rm-color-switcher {display: none !important;}
.rm-magic-popup {display:none;}
    
<?php 
$is_anim_enabled = $meta_data['anim_enabled'];
if($is_anim_enabled): ?>
 
/*
===========================
Animations
===========================
*/

@keyframes rml-appear1 {
    from {transform: translateY(-60px);}
    to {transform: translateY(0px);}
}



@keyframes rml-wobble {
    0% {transform: translateY(0px);}
    25% {transform: translateY(-5px);}
    50% {transform: translateY(0px);}
    75% {transform: translateY(5px);}
    100% {transform: translateY(0px);}
}

@keyframes rml-blur {
    from {filter: blur(0); transform: scale(1,1);}
    to {filter: blur(5px);transform: scale(1.05,1.05);}
}

        @keyframes rml-appear2 {
        from {transform: scale(1.02,1.02); box-shadow: 0 0 20px 20px rgba(0,0,0,0.2);}
        to {transform: scale(1,1); box-shadow: 0 0 10px 2px rgba(0,0,0,0.2);}
    }
    .rml-page-animate {
    animation: rml-appear2 2s ease-out 1;
}

  
 <?php endif;?>
    
    <?php $loader_enabled = $meta_data['loader_enabled'];
   
    if($loader_enabled):
         $loader_bg_color = $meta_data['loader_bg_color'];
        if($loader_bg_color):?>
            .rml-loader-overlay{
            background-color: <?php echo '#'.$loader_bg_color;?>;
      }
      <?php
      else:?>
        .rml-loader-overlay{
            background-color: #FFF;}
      <?php  endif;
      
      
      
    $loader_type = $meta_data['loader_type'];
      if($loader_type=='ic'):
        
        $loader_icon = $meta_data['loader_icon'];
         if($loader_icon): ?>
            .rml-loader-overlay{
               background: url(<?php echo plugin_dir_url(__DIR__).'/admin/template/images/'.$loader_icon.'.gif';?>) center no-repeat <?php echo '#'.$loader_bg_color;?> !important;
         }.rml-loader-text { display: none; }  
      <?php  
       endif;
      else:
                $loader_text = $meta_data['loader_text'];
                $loader_text_color = $meta_data['loader_text_color'];
                $loader_text_size = $meta_data['loader_text_size'];?>
                .rml-loader-text{
                     color: #<?php echo $loader_text_color; ?> !important;
                      font-size: <?php echo $loader_text_size; ?>px;
                      display: block;
                      
                    }
                .rml-loader-overlay{background-image: none !important;
                background-color:<?php echo '#'.$loader_bg_color;?>;}
     <?php     endif;
          
        endif; ?>
         <?php
         $menu_link_text_color = $meta_data['menu_link_text_color'];
        $menu_bg_color = $meta_data['menu_bg_color']; 
        if(strlen($menu_link_text_color)>0): ?>
            .top-link {
                   color: <?php echo "#".$menu_link_text_color; ?> !important;

            }
         <?php endif;
           if(strlen($menu_bg_color)>0): ?>
            .rml-topmenu  {
                  background-color: <?php echo "#".$menu_bg_color; ?> !important; }
         <?php endif; ?>
            

<?php 
$page_bg = $meta_data['page_bg'];
if($page_bg=="img"):
    $page_bg_image_overlay = $meta_data['page_bg_image_overlay'];
    
    if(!empty($page_bg_image_overlay)): 
        $alpha = 0.5;
        $data = RMLP_Utility::HTMLToRGB($page_bg_image_overlay);
        $bg_color= $data[0].','.$data[1].','.$data[2].','.$alpha; 
    ?>
            .rml-bg-overlay{
                    background-color :rgba(<?php echo $bg_color; ?>);
        }
    <?php        
    endif;    
    $bg_image_id = $meta_data['page_bg_image'];
    if(!empty($bg_image_id))
        $bg_image = wp_get_attachment_image_src($bg_image_id, 'full');
    else
        $bg_image = array($meta_data['page_bg_image_url']);
    
    ?>
            .rml-bg{
        background-image: url('<?php echo $bg_image[0]; ?>')
        }
        
       <?php
 else:
    $page_bg_color_overlay = $meta_data['page_bg_color_overlay'];

    if(!empty($page_bg_color_overlay)):
         $alpha = 0.5;
        $data = RMLP_Utility::HTMLToRGB($page_bg_color_overlay);

        $bg_color=  $data[0].','.$data[1].','.$data[2].','.$alpha;
    ?>   
        .rml-bg-overlay{
                    background-color :rgba(<?php echo $bg_color; ?>);
        }
    <?php
      $data = RMLP_Utility::HTMLToRGB($page_bg_image_overlay);
        
    endif;
    if(!empty($meta_data['page_bg_color'])): 
        $data= RMLP_Utility::HTMLToRGB($meta_data['page_bg_color']);
        $alpha=1;
        $bg_color= $data[0].','.$data[1].','.$data[2].','.$alpha;
        ?>
        .rml-bg {
                    background-color :rgba(<?php echo $bg_color; ?>);
        }
    <?php endif;
endif;
?>
        
    <?php if(!empty($meta_data['cover_image'])) : $img_src= wp_get_attachment_image_src($meta_data['cover_image'],'full'); ?> 
           .rml-top-image {background-image: url('<?php echo $img_src[0];  ?>')}
    <?php endif; ?>       
   
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

</style>
