
  $(document).on("click","#add-button",function(){

       var data = $('#add-form').serializeArray();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

      $.ajax({
        type:'post',
        url:'/save',
        data: data,

        success: function(response){
          $('#add-form')[0].reset();
          $('tbody').prepend('<tr id="todo-'+response.id+'"><td id="name-'+response.id+'">'+response.name+'</td><td id="desc-'+response.id+'">'+response.desc+'</td><td>'+response.updated_at+'</td><td>'+response.complete+'</td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal" data-id ="'+response.id+'" data-name ="'+response.name+'" data-desc ="'+response.desc+'">Edit</button><button type="button" class="btn btn-danger" data-toggle ="modal" data-target="#delete-modal" data-id ="'+response.id+'">Delete</button></td></tr>')

        },
        error: function(){

        }

      })

  });

  function Select($search = ""){

    $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
     type:'get',
       url: '/search',
     data: {'search':$search},
     dataType:"json",
     success: function(data){
      $('tbody').empty();
      for (var i = 0; i < data.length; i++) {
        $('tbody').prepend('<tr id="todo-'+data[i]["id"]+'"><td id="name-'+data[i]["id"]+'">'+data[i]["name"]+'</td><td id="desc-'+data[i]["id"]+'">'+data[i]["desc"]+'</td><td>'+data[i]["updated_at"]+'</td><td>'+data[i]["complete"]+'</td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal" data-id ="'+data[i]["id"]+'" data-name ="'+data[i]["name"]+'" data-desc ="'+data[i]["desc"]+'">Edit</button><button type="button" class="btn btn-danger" data-toggle ="modal" data-target="#delete-modal" data-id ="'+data[i]["id"]+'">Delete</button></td></tr>')
      }



             }
         });
  }


//search
  $(document).on("keyup","#txtSearch",function(){
    var value =$(this).val();
    Select(value);


     });

 $(document).ready(function() {
  Select();
});
