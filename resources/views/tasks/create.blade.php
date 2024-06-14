@extends('layouts.default')
@section('title', 'Create task')
@section('content')
    <section class="form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <h1>Create a to-do task</h1>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Add new task</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
