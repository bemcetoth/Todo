
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
     var complete;

     if (data[i]["complete"]) {
       complete = "uncomplete";
     }else{
       complete = "complete";
     }
     $('tbody').prepend('<tr id="todo-'+data[i]["id"]+'"><td id="name-'+data[i]["id"]+'">'+data[i]["name"]+'</td><td id="desc-'+data[i]["id"]+'">'+data[i]["desc"]+'</td><td>'+data[i]["updated_at"]+'</td><td>  <button type="button" class="btn btn-success" id="changeItem" data-complete = "'+data[i]["complete"]+'" data-id ="'+data[i]["id"]+'">'+complete+'</button></td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal" data-id ="'+data[i]["id"]+'" data-name ="'+data[i]["name"]+'" data-desc ="'+data[i]["desc"]+'">Edit</button><button type="button" class="btn btn-danger" data-toggle ="modal" data-target="#delete-modal" data-id ="'+data[i]["id"]+'">Delete</button></td></tr>')


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

$('#delete-modal').on('show.bs.modal',function(e){


$('#delete-button').click(function(){

 var id = $(e.relatedTarget).attr('data-id');


$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$.ajax({
type:'post',
url:'/delete',
data: {
 id: id
 },
success:function(response){
 $('#delete-modal').modal('hide');
 $('tbody').find('tr#todo-'+response.id).remove();

  }

 })
})
})

// Edit

$('#edit-modal').on('show.bs.modal',function(e){

 $('#edit-form input[name=name]').val($(e.relatedTarget).attr('data-name'));
 $('#edit-form input[name=id]').val($(e.relatedTarget).attr('data-id'));
 $('#edit-form textarea').val($(e.relatedTarget).attr('data-desc'));

 $('#edit-button').click(function(){

     var data = $('#edit-form').serializeArray();

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $.ajax({
         type:'post',
         url:'/edit',
         data: data,
         success:function(response){
             $('#edit-modal').modal('hide');
             $('tbody').find('td#name-'+response.id).text(response.name);
             $('tbody').find('td#desc-'+response.id).text(response.desc);

             $('tr#todo-'+response.id).find('button').attr('data-name', response.name);
             $('tr#todo-'+response.id).find('button').attr('data-desc', response.desc);
         }
     });
 });
});

$(document).on("click", "#changeItem", function() {
 item = $(this);
 id = $(this).data('id');
 var complete = $(this).attr("data-complete");

 $.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax ({
        url: '/change',
        type: 'POST',
        data: {"id": id,
                "complete": complete,
              },
        success: function(data)
        {
         item.attr("data-complete", data.complete);
            var complete;

            if (data.complete) {
              complete = "uncomplete";
            }else{
              complete = "complete";
            }
            item.text(complete);
        },

    });

});
