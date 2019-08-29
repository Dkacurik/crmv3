@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <form method="POST" action="{{ route('tasks.update', $task->id)}}">
                {{ method_field('PATCH') }}

            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Task title" value="{{$task->title}}">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{$task->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="tasktype" name="worktaskid" >
                    <option value="1">WeRise</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->client}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Edit</button>
        </form>
    </div>
    </div>
</div>

@endsection
