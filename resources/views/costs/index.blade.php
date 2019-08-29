@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('costs.create') }}" style="float: right; margin-bottom: 10px;"><button class="btn btn-primary">Create</button></a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($costs as $cost)
                        <tr>
                            <td>{{$cost->title}}</td>
                            <td>{{$cost->content}}</td>
                            <td>{{$cost->price}}</td>
                            <td><a href="/costs/{{$cost->id}}/edit"><button class="btn btn-success">Edit</button></a></td>
                            <td><a href="/costs/{{$cost->id}}"><form method="POST" action={{ route('costs.destroy', $cost->id) }}>{{method_field('DELETE')}} @csrf <button type="submit" class="btn btn-danger">Delete</button></form></a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
