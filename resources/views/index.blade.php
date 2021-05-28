@extends('common.layout')

@section('script')
    <script>
        @isset($result)
            var result = @json($result);
        @endisset

        $(function(){            
            $('.btn-delete').click(function(){
                var id = $('tbody .select').attr('id');
                if(id == undefined){
                    $('.modal .what-wrong').html('No row selected.');
                    $('.modal').fadeIn();
                    $('.overlay').fadeIn();
                }else{
                    $('.delete .dataId').val(id);
                    $('.delete .submit-delete').trigger('click');
                }
            });
        });

        function audioPlay(i){
            document.getElementById("audio_" + i).play();
        }
        
        function audioPause(i){
            document.getElementById("audio_" + i).pause();
        }

        function selectRow(rowId){
            var id = $('tbody .select').attr('id');
            $('tbody .select').toggleClass('table-info');
            $('tbody .select').toggleClass('select');
            if(id != rowId){
                $('#' + rowId).toggleClass('select');
                $('tbody .select').toggleClass('table-info');
            }
        }

        function showScript(i){
            result.datas.forEach(function(data){
                if(data.id == i){
                    var script = data.script;
                    $('.modal-script-'+i).fadeIn();
                    $('.overlay-script').fadeIn();
                }
            });
        }
    </script>
@endsection

@section('contents')

    <div class="index-table">
        <table class="table">
            <thead>
                <tr style="border:none;width:100%;margin-right:auto:margin-left:auto">
                    <div class="button-area">
                        <button type="button" class="btn btn-primary btn-upload" style="font-weight: bold" onclick="location.href='/detail'">
                            <a style="vertical-align:middle"> UPLOAD </a><img src="arrow-up-square-fill.svg">
                        </button>
                        <button type="button" class="btn btn-warning btn-delete" style="font-weight: bold">
                            <a style="vertical-align:middle"> DELETE </a><img src="trash-fill.svg">
                        </button>
                    </div>
                </tr>
                <tr style="background-color: #384452; color:white">
                    <th style="width:10%">DATE</th>
                    <th style="width:50%">TITLE</th>
                    <th style="width:10%">EDIT</th>
                    <th style="width:10%">PLAY</th>
                    <th style="width:10%">PAUSE</th>
                    <th style="width:10%">SCRIPT</th>
                </tr>
            </thead>
            <tbody>                     
                @if(!count($result['datas']) == 0)
                    @foreach($result['datas'] as $data)
                    <form action="/detail" method="post" class="detail">
                        @csrf
                        <tr class="table-info" id="{{$data->id}}" onclick="selectRow({{$data->id}})">
                            @isset($data->created_at)
                            <td>{{$data->created_at->format('Y/m/d')}}</td>
                            @else
                            <td>NO DATE</td>
                            @endisset
                            <td>{{$data->title}}</td>
                            <td><button class="btn btn-outline-primary btn-edit" type="submit"><img src="pencil-square.svg"></button></td>
                            <td><button class="btn btn-outline-primary" type="button" onclick="audioPlay({{$data->id}})"><img src="play-btn-fill.svg"></button></td>
                            <td><button class="btn btn-outline-primary" type="button" onclick="audioPause({{$data->id}})"><img src="pause-btn-fill.svg"></button></td>
                            <td><button class="btn btn-outline-primary" type="button" onclick="showScript({{$data->id}})"><img src="chat-dots-fill.svg"></button></td>
                        </tr>    
                        <input type="hidden" name ="dataId" value="{{$data->id}}">
                        <audio id="audio_{{$data->id}}" src="{{$data->path}}" controls loop style="display:none"></audio>
                        <div class="modal-script modal-script-{{$data->id}}">
                            <p class="modal-text script">{!! nl2br(e($data->script))!!}</p>
                            <div class="close-script">Close</div>
                        </div>
                    </form>
                    @endforeach
                    
                @else
                    <tr class="table-info">
                        <td>
                            <a>You have no data. Click the "UPLOAD" button above to upload a new data.</a>
                        </td>
                    </tr>
                @endif     
            </tbody>
        </table>
    </div>

    <form action="/delete" method="post" class="delete">
        @csrf
        <input type="hidden" name="dataId" class="dataId" value="">
        <button type="submit" class="submit-delete" style="display:none"></button>
    </form>

@endsection