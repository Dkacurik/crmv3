@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('jobs.create') }}" style="float: right; margin-bottom: 10px;"><button class="btn btn-primary">Create</button></a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">FullPrice</th>
                        <th scope="col">Workers</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Complete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($jobs as $job)
                        <tr>
                            <td>{{$job->client}}</td>
                            <td>{{$job->title}}</td>
                            <td>{{$job->description}}</td>
                            <td>{{$job->fullprice}}</td>
                            <td><a href="/jobs/{{$job->id}}"><button class="btn btn-info">Team</button></a></td>
                            <td><a href="/jobs/{{$job->id}}/edit"><button class="btn btn-success">Edit</button></a></td>
                            <td><a href="/jobs/{{$job->id}}"><form method="POST" action={{ route('jobs.destroy', $job->id) }}>{{method_field('DELETE')}} @csrf <button type="submit" class="btn btn-danger">Delete</button></form></a></td>
                            <td><a href="/jobs/{{$job->id}}/complete"><form method="POST" action={{ route('jobs.complete', $job->id) }}>{{method_field('PATCH')}} @csrf <button type="submit" class="btn btn-success">Done</button></form></a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
