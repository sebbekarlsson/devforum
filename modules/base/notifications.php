<div id="notifications">

</div>
<script type="text/javascript">

  fetchNotifications();

  setInterval(function(){
    fetchNotifications();
  },3000);

  function fetchNotifications(){
    var DOM = $("#notifications");

    var request = $.ajax({
      type:"post",
      cache:false,
      url:"apps/notifications.php",
      data:{userID:<?php echo $USER->id; ?>}
    });

    request.done(function(data){
      var notis = JSON.parse(data);
      var doms = "";

      for(var i = 0; i < notis.length; i++){
        var url = notis[i].url;
        var act = "<a href='apps/notification_handler.php?ID="+notis[i].id+"'><button>Ok</button></a>";
        doms += "<div class='notification'>"+notis[i].message+"<div class='right'>"+act+"</div></div>";
      }

      $("#notifications").html(doms);

    });
  }

</script>
