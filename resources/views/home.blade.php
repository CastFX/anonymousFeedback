@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="justify-content-center">
        <happiness-chart :feedbacks="{{json_encode($feedbacks)}}"></happiness-chart>
    </div>
    <div class="row justify-content-center py-3">
        <ranking-list :feedbacks="{{json_encode($feedbacks)}}" v-bind:number-of-rankings="{{$numberOfRankings}}"></ranking-list>
    </div>
    <div class="row justify-content-center py-3">
    </div>


</div>
@endsection
