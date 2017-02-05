/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function(){
   var wpAdminBar = jQuery('#wpadminbar');
   if (wpAdminBar.length) {
      jQuery("#main-navbar").sticky({topSpacing:wpAdminBar.height()});
   } else {
      jQuery("#main-navbar").sticky({topSpacing:0});
   }
});