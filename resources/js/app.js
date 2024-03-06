srequire('./bootstrap');


$(function () {
  $('.modalopen').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('target');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  $('.update').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
