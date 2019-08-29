@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('tasks.create') }}" style="float: right; margin-bottom: 10px;"><button class="btn btn-primary">Create</button></a>
            <table class="table">
  <thead>
    <tr>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Work</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($tasks as $task)
        <tr>
        <td>{{$task->title}}</td>
        <td>{{$task->content}}</td>
        <td>{{$task->client}}</td>
        <td><a href="/tasks/{{$task->id}}/edit"><button class="btn btn-success">Edit</button></a></td>
            <td><a href="/tasks/{{$task->id}}"><form method="POST" action={{ route('tasks.destroy', $task->id) }}>{{method_field('DELETE')}} @csrf <button type="submit" class="btn btn-danger">Delete</button></form></a></td>
        </tr>
      @endforeach

  </tbody>
</table>
        </div>
    </div>
</div>

@endsection
