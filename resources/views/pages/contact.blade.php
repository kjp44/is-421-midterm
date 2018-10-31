@extends('layouts.default')

@section('content')
    <div class="card mt-3 pl-2 pl-2">
        <div class = "card-title">
            <h1>Contact</h1>
            <p class="lead">Please use this form to contact the site menu.</p>
        </div>
        <div class="card-body">
            <form action="{{route('contact.store')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </div>
@endsection