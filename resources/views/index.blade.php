@extends('layouts.app')

@section('title', 'List of tasks')

@section('content')
    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}"  class="link">Add Task</a>
    </nav>

    <!-- to deplay list of element like arrays or collection we use foreach or forelse directive -->
    @forelse ($tasks as $task)
        <div>
            <!-- a link to a single task -->
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>{{ $task->title}}</a>
        </div>
    @empty
    <p>There are no tasks</p>
    @endforelse

    <!-- if there is any tasks at all, the only thing we have to do is to display the links anfd to do that we call the link()-->
    @if ($tasks->count())
        <nav class="mt-6">
            {{ $tasks->links()}}
        </nav>
    @endif
    
@endsection
