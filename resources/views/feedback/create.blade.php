@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/feedback" method="POST">
            @csrf

            <div class="row justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        <h6>Thank you! An anonymous feedback has been successfully created for {{ session()->get('success')->name }}</h6>
                    </div>
                @endif
            </div>
            <div class="from-group row justify-content-center">
                <label for="exampleDataList" class="form-label">Select an email</label>
                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search for an email" name="email">
                <datalist id="datalistOptions">
                    @foreach ($emails as $id => $email)
                        <option id= {{$id}} value="{{$email}}">
                    @endforeach
                </datalist>
            </div>
            <div class="from-group row justify-content-center py-5">
                <div class="rate">
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="text">1 star</label>
                </div>
            </div>
            <div class="from-group">
                <div class="row justify-content-center">
                    <label for="description">Feedback Description (Optional)</label>
                </div>
                <div class="row justify-content-center pb-3">
                    <textarea id="description" rows="4" cols="150" name="description"></textarea>
                </div>
            </div>

            <div class="from-group">
                <div class="row justify-content-center py-3">
                    <h5>Don't worry, your feedback will be anonymous. No one will ever know you left it.</h5>
                </div>

                <div class="row justify-content-center py-3">
                    <button class="btn btn-primary">Leave Feedback</button>
                </div>
            </div>
        </form>
    </div>


@endsection
