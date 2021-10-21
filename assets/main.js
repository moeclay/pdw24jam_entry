$(document).ready(function() {

  // for update attribute password "see password"
  var cek = $('#data-checkbox').val();
  $('#data-checkbox').click(function() {
    if ($(this).is(':checked')) {
      $('#data-password').attr('type', 'text');
    } else {
      $('#data-password').attr('type', 'password');
    }
  });

});