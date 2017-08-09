@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <form class="form-horizontal" id="add-form">
                                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name ="name" placeholder="Title">
                         </div>
                        </div>
                      <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                 <div class="col-sm-10">
                <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                 </div>
                  </div>
                <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" id="add-button">Add</button>

             </div>
         </div>
        </form>                
            </div>
          </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <table class="table">
                   <thead>
                        <tr>
                            <td>Title</td>
                            <td>Description</td>
                            <td></td>
                        </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $d)
                      <tr id="todo-{{$d->id}}">
                          <td id="name-{{$d->id}}">{{$d->name}}</td>
                          <td id="desc-{{$d->id}}">{{$d->desc}}</td>
                            <td>{{ $d->created_at }}</td>
                          <td id="button-{{$d->id}}">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit-modal" data-id ="{{$d->id}}" data-name ="{{$d->name}}" data-desc ="{{$d->desc}}">Edit</button>
                            <button type="button" class="btn btn-default" data-toggle ="modal" data-target="#delete-modal" data-id = "{{$d->id}}">Delete</button>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
            </div>
          </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                       <form class="form-horizontal" id="edit-form">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name ="name" placeholder="Title">
                            <input type="hidden" class="form-control" name ="id" placeholder="Title">
                         </div>
                        </div>
                      <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
                 <div class="col-sm-10">
                <textarea class="form-control" name="desc" placeholder="Description"></textarea>
                 </div>
            </div>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="edit-button">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
             <h2>Are you sure want delete this Todo?</h2>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="delete-button">yes</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
