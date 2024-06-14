@extends('layouts.default')
@section('title', 'Add A Task')
@section('content')
    <div class="container">
        {{-- <h1>Add A To-do</h1> --}}
        <div class="row">
            <div class="col">
                <a href="{{ route('tasks.create') }}" class="btn btn-outline-dark float-right mb-3">Add new todo</a>
                @if (!$tasks->isEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Todo</th>
                                <th scope="col">status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($tasks as $task)
                                <tr>
                                    <th scope="col">{{ $i++ }}</th>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->status === 'in_progress' ? 'in progress' : $task->status }}</td>
                                    <td>
                                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="{{ \App\Enums\TaskStatusEnum::Completed->value }}">
                                            <button type="submit" class="btn btn-outline-success">Complete</button>
                                        </form>

                                        <a href="{{ route('tasks.edit', ['id' => $task->id]) }}"
                                            class="btn btn-outline-warning">Update</a>
                                        <a href="{{ route('tasks.destroy', ['id' => $task->id]) }}"
                                            class="btn btn-outline-danger">Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>You have not added any tasks yet!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
