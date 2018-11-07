@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Todo</div>
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
                <button type="button" class="btn btn-success" id="add-button" style="width:100%;">Add todo</button>
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
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-sm-6" style="font-size:25px;">Todo list</div>
                    <div class="col-sm-6">
                      <div class="input-group">
                   <input type="text" class="form-control" name = "search" placeholder="Search" id="txtSearch"/>
                   <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                   </div>
                   </div>
                    </div>
                  </div>
                </div>

                <div class="panel-body">
                   <table class="table table-striped">
                   <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Complete</th>
                            <th>Action</th>
                        </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
            </div>
          </div>
    </div>
</div>

<style>

    body{
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(90deg,#1a7d6f,#35bbae);
    }

    .title{
        color: white;
    }

    .disc{
        margin-left: 20px;
    }

    .text{
        padding: 6px;
    }

    </style>



<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit todo</h5>
        </button>
      </div>
      <div class="modal-body">
                       <form class="form-horizontal" id="edit-form">
                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name = "name" placeholder="Title">
                            <input type="hidden" class="form-control" name = "id" placeholder="Title">
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
        <h5 class="modal-title" id="exampleModalLabel">Delete todo</h5>
        </button>
      </div>
      <div class="modal-body">
             <h3>Are you sure want delete this Todo?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="delete-button">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
