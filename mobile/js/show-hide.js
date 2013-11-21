jQuery(document).ready(function($) {

  $('.accord-btn').click(function() {
   accord_child($(this));
   cons
  });

  $('.show-child').click(function() {
    show_child($(this));
  });

  $('.no-show').click(function() {
    hide_child($(this));
  });

  $('#troubleshoot').change(function() {
    if($(this).val() == '2') {
      show_child($(this));
    } else {
      hide_child($(this));
    }
  });

  function accord_child(element) {
   var parent = element.closest('.accord');
	
    parent.children('.accord-contents').toggle('slow');
    
    
  }

  function show_child(element) {
    var parent = element.closest('.form-group');
    parent.children('.form-group.child').show('slow');
    parent.not('.child').css('border', '1px solid gray').css('padding', '10px');
  }

  function hide_child(element) {
    var parent = element.closest('.form-group');
    parent.children('.form-group.child').hide('slow');
    parent.css('border', 'none').css('padding', 0);
  }
});