$(function() {

  $( ".newsroom-search" ).on( "click", function() {
    var mobile = $( "#header-menu" ).hasClass( "show" );

      if( mobile == true){
      return;
    }

        event.preventDefault();

    $( ".search-bar" ).slideToggle("slow");


  });


  // Remove empty fields from GET forms
  // Author: Bill Erickson
  // URL: http://www.billerickson.net/code/hide-empty-fields-get-form/

    // Change 'form' to class or ID of your specific form
  $(".search-input").submit(function() {
    $(this).find(".cat-dropdown, .unit-dropdown").filter(function(){ return !this.value; }).attr("disabled", "disabled");
    return true; // ensure form still submits
  });

  // Un-disable form fields when page loads, in case they click back after submission
  $( "form" ).find( ".cat-dropdown, .unit-dropdown" ).prop( "disabled", false );



});
