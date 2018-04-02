/* This script auto update post on enter edit post page - it's only as a mean to refrash the database in case of ACF changes or similar that requier you to save the post again without any changes
*  Add it to exec with CJS chrome extention or similar - https://chrome.google.com/webstore/detail/custom-javascript-for-web/ddbjnfjiigjmcpcpkmhogomapikjbjdk
*/

jQuery( document ).ready(function() {
    var post_id = getUrlParameter('post');
    var action = getUrlParameter('action');
    var first_run = localStorage.getItem(post_id+':first_run');
    if(action == 'edit'){
      if(first_run != 'no'){
        console.log( "saving post" );
        localStorage.setItem(post_id+':first_run','no');
        if(jQuery('#save-post').length){
          jQuery('#save-post').click(); 
        }else if(jQuery('#publish[value="Update"]').length){
          jQuery('#publish').click();
        }
      }else{
        console.log(action+':allready done');
      } 
    }
});
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
