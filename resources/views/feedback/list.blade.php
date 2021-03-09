@extends('layouts.app')

@section('content')
    <div class="container">
        <feedback-list :emails="{{json_encode($emails)}}"></feedback-list>
    </div>
@endsection
