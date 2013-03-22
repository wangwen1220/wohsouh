<?php /* Smarty version 2.6.26, created on 2012-03-20 11:03:59
         compiled from home/home_weibo_group_script.html */ ?>
<?php echo '
<script>
  (function($){
    $(\'#group_form, #group_add_user_form\').submit(function(e){
      e.preventDefault();
      var form = e.target;
      var url = form.action;
      var data = $(form).serialize();

      $.post(url, data, function(data){
        if(data.status == 0){
          alert(data.value);
        }else{
          hideWindow(\'register\');
          location.reload();
        }
      }, \'json\');

    });

  })(jQuery);
</script>
'; ?>
