

$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.update').on('click', function () {
    $('button').submit(function () {
    });
    $('.js-modal').fadeOut();
    return false;
  });
});