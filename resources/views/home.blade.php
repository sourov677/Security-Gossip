@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <li><a href="{{URL::to('/chat')}}">Chatting</a></li>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged as   {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
