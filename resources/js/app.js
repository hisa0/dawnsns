require('./bootstrap');

<script>
  $(function(){
    //クリックで動
    $('.acd_trigger').click(function () {
      $(this).toggleClass('active');
      $(this).next('acd').slideToggle();
    })
  });
</script>
