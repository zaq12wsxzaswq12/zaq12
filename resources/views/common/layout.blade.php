@extends('common.base')
@section('body')
    <div class="wrap">
        <!--====================== header ======================-->
        <nav class="navBar">
            <div class="title" href="/index">MP3 Repeater</div>
            @isset($result['name'])
            <div class="hello">Hello, {{$result['name']}}.</div>
            <div class="logout">
                <button type="button" class="btn btn-danger" onclick="location.href='/'">
                    <a> LOGOUT </a><img src="door-open-fill.svg">
                </button>
            </div>
            @else
            <div class="hello"></div>
            <div class="logout"></div>
            @endisset
        </nav>
        <!--====================== //header ======================-->

        <!--====================== contents ======================-->
        @yield('contents')
        <!--====================== //contents ======================-->
    </div>

    <!--====================== modal ======================-->
    <div class="modal">
        <p class="modal-text"><img src="exclamation-triangle-fill.svg" style="width:25px;height:25px"></p>
        <p class="modal-text what-wrong"></p>
        <div class="close">Close</div>
    </div>    

    <div class="overlay"></div>
    <div class="overlay-script"></div>
    <!--====================== //modal ======================-->
@endsection