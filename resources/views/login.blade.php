@extends('common.layout')

@section('contents')
    <div class="login-box">
        <button type="button" class="btn btn-primary btn-upload" style="font-weight: bold" onclick="location.href='/login/google'">
            <img src="google.svg"> Google Login
        </button>        
    </div>
@endsection