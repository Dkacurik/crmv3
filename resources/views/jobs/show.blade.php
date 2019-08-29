@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <a href="/jobs" style="float: right; margin-bottom: 10px;"><button class="btn btn-primary">Back</button></a>
    @if($job->percentage==50)

                <div class="col-lg-12">
                    <h2>CURRENTLY FREE: {{$job->percentage}} %</h2>
                    <form method="POST" action="{{ route('percentage', $job->id)}}">
                        @csrf
                        <input type="text" style="display: none;" name="id" value="{{$job->id}}">
                        <div class="form-group">
                            <label for="client">Worker</label>
                            <select class="form-control" id="worker" name="worker" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="percentage">Percentage</label>
                            <input type="number" class="form-control" id="percentage" name="percentage" placeholder="Percentage" max="{{$job->percentage}}">
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>

        @else
                <div class="col-lg-12">
                    <h2>CURRENTLY FREE: {{$job->percentage}} %</h2>
                    @foreach($workers as $worker)
                        <h4>{{$worker->name}}  <form method="POST" action="{{ route('jobs.repair', $job->id)}}"> @csrf {{ method_field('PATCH') }}
                                <input type="text" name="oldpercent" value="{{$worker->userpercentage}} " style="display: none;"><input type="number" value="{{$worker->userpercentage}}" max="50" name="reppercent"> %
                                <input type="text" value="{{$worker->userid}}" name="userrepairid" style="display: none;"> <button type="submit" class="btn btn-success">Repair</button></form></h4>
                        @endforeach
                    <form method="POST" action="{{ route('percentage', $job->id)}}">
                        {{ method_field('PATCH') }}
                        @csrf
                        <div class="form-group">
                            <label for="client">Worker</label>
                            <select class="form-control" id="worker" name="worker" >
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Percentage</label>
                            <input type="number" class="form-control" id="title" name="title" placeholder="Percentage"  max="{{$job->percentage}}">
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>

        @endif

        </div>
    </div>
@endsection
