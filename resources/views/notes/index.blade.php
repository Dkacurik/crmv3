@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            <a href="{{ route('notes.create') }}" style="float: right; margin-bottom: 10px; display: block"><button class="btn btn-primary">Create</button></a>
                </div>
            @foreach($notes as $note)
                <div class="col-lg-4">
                    <div class="col-lg-12" style="background-color: #fff8b3; border-top: 5px solid #ffed4a">
                        <a href="/notes/{{$note->id}}/edit"><button class="btn btn-success" style="    position: absolute;


    height: 25px;
    top: 2px;
    font-size: 10px;
    padding-top: 4px;
                                                                    right: 41px;">+</button></a>
                        <a href="/notes/{{$note->id}}"><form method="POST" action={{ route('notes.destroy', $note->id) }}>{{method_field('DELETE')}} @csrf <button type="submit" class="btn btn-danger" style="    position: absolute;
    right: 5px;
    height: 25px;
    top: 2px;
    font-size: 10px;
    padding-top: 4px;">X</button></form></a>
                        <h3>{{$note->title}}</h3>
                        <p style="word-break: break-all">{{$note->content}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
