
$(function () {
  var open = $('.modal-open'),
    close = $('.modal-close'),
    container = $('.modal-container');

  open.on('click', function () {
    var id = $(this).data('target');
    var modal = document.getElementById(id);
    $(modal).addClass('active');
    return false;
  });

  close.on('click', function () {
    container.removeClass('active');
  });
})
