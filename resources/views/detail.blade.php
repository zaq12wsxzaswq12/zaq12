@extends('common.layout')

@section('script')
    <script>
        $(function(){
            $('.btn-upload').click(function(){
                var title = $('#title').val();
                var file = $('#name').val();
                if(title == ""){
                    $('.modal .what-wrong').html('"Title" is required.');
                    $('.modal').fadeIn();
                    $('.overlay').fadeIn();
                }else if(file == ""){
                    $('.modal .what-wrong').html('"File" is required.');
                    $('.modal').fadeIn();
                    $('.overlay').fadeIn();
                }else{
                    $('.submit-store').trigger('click');
                }
                
                
            });

            $('.file-area').click(function(){

            });  

            // $('.close, .overlay').click(function(){
            //     $('.modal').fadeOut();
            //     $('.overlay').fadeOut();
            // });

            // $('.btn-delete').click(function(){
            //     var id = $('tbody .select').attr('id');
            //     if(id == undefined){
            //         $('.modal .what-wrong').html('No row selected');
            //         $('.modal').fadeIn();
            //         $('.overlay').fadeIn();
            //     }else{

            //     }
            // });
        });

        function chooseFile(){
            $('#file').trigger('click');
        }

        function fileChanged(){
            var file = $('#file').val();
            var array = file.split('\\');
            var fileName = array[2];
            $('#name').val(fileName);
        }
    </script>
@endsection

@section('contents')

    <form action="/store" method="post" enctype="multipart/form-data">
    @csrf

        @isset($result['dataId'])
        <input type="hidden" name="dataId" value="{{$result['dataId']}}">
        @else
        <input type="hidden" name="dataId" value="">
        @endisset
        <div class="detail-description" style="text-align:center">        
            Fill in the forms below to upload a new data.
        </div>

        <div class="detail-box">
            <!--============= Title =============-->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1" style="font-weight:bold; width:75px">Title</span>
                @isset($result['data'])
                <input type="text" name="title" id="title" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{$result['data']->title}}">
                @else
                <input type="text" name="title" id="title" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="">
                @endisset
            </div>
            <!--============= //Title =============-->

            <!--============= File =============-->
            <input name="file" class="form-control" type="file" id="file" style="display:none" onchange="fileChanged()">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1" style="font-weight:bold; width:75px" onclick="chooseFile()">File</span>
                @isset($result['data'])
                <input type="text" id="name" name="name" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="{{$result['data']->name}}" onclick="chooseFile()">
                @else
                <input type="text" id="name" name="name" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="" onclick="chooseFile()">
                @endisset
            </div>
            <!--============= //File =============-->

            <!--============= Script =============-->
            <div class="input-group" style="margin-top:20px">
                <span class="input-group-text" style="font-weight:bold">Script</span>
                @isset($result['data'])
                <textarea name="script" class="form-control script" aria-label="With textarea" style="height: 145px;">{{$result['data']->script}}</textarea>
                @else
                <textarea name="script" class="form-control script" aria-label="With textarea" style="height: 145px;" value=""></textarea>
                @endisset
            </div>
            <!--============= //Script =============-->

            <div style="text-align:center">
                <button type="button" class="btn btn-primary btn-upload" style="font-weight: bold;margin-top:20px">
                    <a style="vertical-align:middle"> UPLOAD </a><img src="arrow-up-square-fill.svg">
                </button>
                <button type="button" class="btn btn-warning" style="font-weight: bold; margin-top:20px; width:117px" onclick="location.href='/index'">
                    <a style="vertical-align:middle"> BACK </a><img src="reply-fill.svg">
                </button>
                <button type="submit" class="submit-store" style="display:none"></button>
            </div>
        </div>

    </form>
@endsection