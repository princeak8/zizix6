
    //alert('working');
   // var admin_id = $('input[name=admin_id]').val();
    CSRF_TOKEN = $('input[name=_token]').val();
    ajax = 1
    result_content = $('#result-content');
    $('#search').keyup(function(){
      var searchVal = this.value;
      if(searchVal.length < 3){
        result_content.html('<p style="text-align:center;">NO RESULT FOUND FOR THE SEARCH YET</p>');
      }else{
        var ajaxUrl = "{{env('APP_URL').'members_ajax_search'}}";
        $.ajax({
          url:ajaxUrl, 
          data:{searchVal: searchVal,  _token: CSRF_TOKEN, ajax: ajax}, 
          type: "post", 
          //async: false, 
          error: function(xhr, textStatus, errorThrown) {
              console.log(xhr.responseText);
            //alert(xhr.responseText);
          },
          success: function(data) { 
            data = JSON.parse(data);
            var n = 0;
            
            var acceptRequestUrl = "{{env('APP_URL')}}accept_friend_request/";
            var content = '';
            $.each(data, function(key, val) { n++;
              console.log(val.firstname);
              var viewUrl = "{{env('APP_URL')}}view_user/"+val.firstname+val.lastname;
              var photoUrl = "{{env('APP_STORAGE')}}images/profile_photos/"+val.photo;
              content += '<table id="example1" class="table table-bordered table-hover">';
              content += '<tr>';
              content += '<td>'+n+'</td>';
              content += '<td><img src="'+photoUrl+'" height="80" width="100"></td>';
              content += '<td>'+val.firstname+'</td>';
              content += '<td>'+val.lastname+'</td>';
              content += '<td>';
              if(val.is_friend==1){
                if(val.status==0) {
                  if(val.action_user==val.id) {
                   content +='<a href="javascript:void(0)" data-id="'+val.id+'" data-action="accept" class="btn btn-success req">';
                    content +='ACCEPT FRIEND REQUEST';
                    content +='</a>';
                  }else{
                    content += 'FRIEND REQUEST PENDING<br/>';
                   content +='<a href="javascript:void(0)" data-id="'+val.id+'" data-action="cancel" class="btn btn-danger req">';
                    content +='CANCEL REQUEST';
                    content +='</a>';
                  }
                }
                if(val.status==2) {
                  if(val.action_user==val.id) {
                    content += 'FRIEND REQUEST DECLINED';
                   content +='<a href="javascript:void(0)" data-id="'+val.id+'" data-action="cancel" class="btn btn-danger req">';
                    content +='CANCEL REQUEST';
                    content +='</a>';
                  }
                }
              }else{
                content +='<a href="javascript:void(0)" data-id="'+val.id+'" data-action="send" class="btn btn-warning req">';
                content +='SEND FRIEND REQUEST';
                content +='</a>';
              }
              content += '</td>';
              content += '<td><a href="'+viewUrl+'" class="btn btn-primary">VIEW</td>';
              content += '</tr>';
            })
            content += '</table>'
            console.log(content);
            result_content.html(content);
          }
        })//ajax ends here
      }
    })