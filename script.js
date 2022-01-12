(function() {
  $('form > input').keyup(function() {
    var empty = false;
    $('form > input').each(function() {
      if ($(this).val() == '') {
        empty = true;
      }
    });

    if (empty) {
      $('#register').attr('disabled', 'disabled');
    } else {
      $('#register').removeAttr('disabled');
    }
  });
})()
