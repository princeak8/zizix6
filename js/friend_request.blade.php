$(document).ready(function() {

    //Request Scripts
    $(document).on('click', '.req', function() {
      var html = $(this).html();
      $(this).html('<img src="{{env('APP_STORAGE')}}images/gifs/spinner5.gif" width="30" height="30" id="gif" />');
      var btn = $(this);
      var id = $(this).data('id');
      var action = $(this).data('action');
      var ajaxUrl = "{{env('APP_URL')}}process_friend_request";
      var gifUrl = "{{env('APP_STORAGE')}}images/gifs/spinner5.gif";
      //alert(id);

        $.ajax({
            url:ajaxUrl, 
            data:{id: id, action: action, ajax: ajax,  _token: CSRF_TOKEN}, 
            type: "post", 
            async: false, 
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
                result = 0;
                //alert(xhr.responseText);
            },
            success: function(data) { //alert(data);
              if(data==1) {
                btn.css('display', 'none');
                if(action=='send') {
                  btn.parent().append('Friend Request Sent');
                }
              }else{
                btn.html(html);
              }
            }
        })//ajax ends here

    })

  })