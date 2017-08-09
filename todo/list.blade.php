@extends('layouts.index')

@section('content')
    <h1>Here is Your Todo List <a href="{{ url('/todo/create') }}" class="btn btn-warning pull-right btn-sm ">Add New Project</a></h1>
    

    @include('partials.flash_notification')

    @if(count($todoList))
        <div class="table-responsive">
            <table class="table table-bordered  ">
                <thead>
                <tr class="info">
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Completed</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($todoList as $todo)
                    <tr>
                        <td>{{ $todo->name }}</td>

                        <td>{{ $todo->desc }}</td>

                        <td>{{ $todo->created_at->diffForHumans() }}</td>

                        <td>{{ $todo->complete? 'Completed' : 'Pending' }}</td>
                        <td>
                            {!! Form::open(['route' => ['todo.update', $todo->id], 'class' => 'form-inline', 'method' => 'put']) !!}
                                @if($todo->complete)
                                    {!! Form::submit('Incomplete', ['class' => 'btn btn-info btn-xs' ]) !!}
                                @else
                                    {!! Form::submit('Complete', ['class' => 'btn btn-success btn-xs ']) !!}
                                @endif
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['todo.destroy', $todo->id], 'class' => 'form-inline', 'method' => 'delete']) !!}
                                {!! Form::hidden('id', $todo->id) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {!! $todoList->render() !!}
        </div>
    @else
        <div class="text-center">
            <h3>No todos available yet</h3>
            <p><a href="{{ url('/todo/create') }}">Create new Project</a></p>
        </div>
    @endif
@endsection
