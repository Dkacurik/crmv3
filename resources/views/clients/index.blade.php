@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('clients.create') }}" style="float: right; margin-bottom: 10px;"><button class="btn btn-primary">Create</button></a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{$client->client}}</td>
                            <td>{{$client->content}}</td>
                            <td><a href="/clients/{{$client->id}}/edit"><button class="btn btn-success">Edit</button></a></td>
                            <td><a href="/clients/{{$client->id}}"><form method="POST" action={{ route('clients.destroy', $client->id) }}>{{method_field('DELETE')}} @csrf <button type="submit" class="btn btn-danger">Delete</button></form></li>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
