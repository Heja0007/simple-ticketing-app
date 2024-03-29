@extends('errors::layout')

@section('title', __('Not Found'))
@section('message')
    <h1>404 Not Found</h1>
    <p>Sorry, the page you are looking for could not be found.</p>
    <button class="btn btn-info" onclick="goBack()">Go Back</button>
    <button class="btn btn-info" onclick="goToHome()">Go to Home Page</button>
@endsection

<script>
    function goBack() {
        window.history.back();
    }

    function goToHome() {
        window.location.href = "/";
    }
</script>