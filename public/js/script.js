

$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      $(modal).fadeIn();
    });
    console.log(modal);
  });
  $('.update').on('click', function () {
    $('button').submit(function () {
    });
    $('.js-modal').fadeOut();
  });
});
