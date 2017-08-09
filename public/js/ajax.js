$(document).ready(function(){

	$('#add-button').click(function(){

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
	 			$('tbody').prepend('<tr id="todo-'+response.id+'"><td id="name-'+response.id+'">'+response.name+'</td><td id="desc-'+response.id+'">'+response.desc+'</td><td>'+response.update_at+'</td><td>'+response.complete+'</td><td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal" data-id ="'+response.id+'" data-name ="'+response.name+'" data-desc ="'+response.desc+'">Edit</button><button type="button" class="btn btn-danger" data-toggle ="modal" data-target="#delete-modal" data-id ="'+response.id+'">Delete</button></td></tr>')

	 		},
	 		error: function(){

	 		}

	 	})

	});


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
			$('tbody').find('td#button-'+response.id).html('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-modal" data-id ="'+response.id+'" data-name ="'+response.name+'" data-desc ="'+response.desc+'">Edit</button><button type="button" class="btn btn-danger" data-toggle ="modal" data-target="#delete-modal" data-id ="'+response.id+'">Delete</button>');
		}


	})




		})
	})

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


	 $(document).ready(function(){



        $('#txtSearch').on('keyup', function(){
			 var value =$(this).val();

			 $.ajaxSetup({
   			 headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   		 }
	 });

			 $.ajax({
				type:'get',
			    url: '/search',
				data: {'search':value},
				success: function(data){
					$('tbody').html(data);


                }
            });

		  });



    });
	 var outlet_id;


$(document).on("click", ".changeItem", function() {

     outlet_id = $(this).data('id');

    $(".changeItem").find("input[type=checkbox]").on("change",function() {

        var complete = $(this).prop('checked');

        if(complete == true) {
            complete = "done";
        } else {
            complete = "pending";
        }

        $.ajax ({
            url: 'change/'+outlet_id+'/complete',
            type: 'POST',              
            data: {"id": outlet_id, "complete": complete, "_token": '{{ csrf_token() }}'},
            success: function(data)
            {   
                if(data.complete==true) {
                    swal("Updated", "Status updated successfully", "success");
                } else if(data.complete==false) {
                    swal("Failed", "Fail to update status try again", "error");
                }
            },
            error: function(error)
            {
                swal("Failed", "Fail to update status try again", "error");
            }
        });

    });

});

})
