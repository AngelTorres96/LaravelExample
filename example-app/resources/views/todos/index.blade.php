@extends('app')

@section('css')
    <link style= "stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <div class="container w-25 border mt-4 p-4">
        <form action="{{ route('todos') }}" method="POST">
            @csrf

            @if (session('success'))
                <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif

            @error('title')
                
                <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Título de la tarea</label>
                <input type="text" name="title" class="form-control">
                 
            </div>
            
            <label for="category_id" class="form-label"> Categoria de la tarea</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
        </form>
        <div>
            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('todos-edit',['id'=> $todo->id]) }}">{{$todo->title}}</a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('todos-destroy',[$todo->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container w-75 border mt-4 p-4">
        <table id="todos" class="table table-striped" style="width:100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>Title</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($todos as $todo)
           <tr>
                <th>{{$todo->title}}</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
            </tr>
           @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        </table>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#todos').DataTable();
        } );
    </script>
@endsection