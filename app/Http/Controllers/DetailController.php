<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DetailController extends Controller
{
    /**
     * 初期表示
     * dataIdあれば更新画面
     * dataIdなければ新規登録画面
     */
    public function index(Request $request)
    {
        //セッションからユーザー情報を取得
        if(session()->exists('USER')){
            $session = session('USER');
            $result['id'] = $session['id'];
            $result['name'] = $session['name'];

            $dataId = $request->dataId;
            if(empty($dataId)){
                return view('detail', compact('result'));
            }else{
                $result['dataId'] = $dataId;
                $result['data'] = Data::where([['user_id', $session['id']],['id', $dataId]])->first();
                return view('detail', compact('result'));
            }

        }else{
            return redirect('/');
        }
    }

    /**
     * 保存
     * dataIdがあれば更新処理
     * dataIdがなければ新規登録処理
     */
    public function store(Request $request)
    {
        //セッションからユーザー情報を取得
        if(session()->exists('USER')){
            $session = session('USER');
            $result['id'] = $session['id'];
            $result['name'] = $session['name'];

            $title = $request->title;
            $script = $request->script;
            
            $dataId = $request->dataId;
            //新規登録
            if(empty($dataId)){

                $name = $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs('public', $name);             
                $path = '/storage/'.$name;    

                $data = new Data;
                $data->user_id = $session['id'];
                $data->name = $name;
                $data->path = $path;
                $data->title = $title;
                $data->script = $script;                
                $data->save();

            //更新
            }else{            
                $data = Data::find($dataId);  
                if($data->name == $request->name){
                    $data->title = $title;
                    $data->script = $script;                
                    $data->save();                            
                }else{
                    $name = $request->file('file')->getClientOriginalName();
                    $request->file('file')->storeAs('public', $name);    
                    $path = '/storage/'.$name;     
                    
                    $data->name = $name;      
                    $data->path = $path;     
                    $data->title = $title;
                    $data->script = $script;                
                    $data->save();
                }                
            }

            return redirect()->route('index');

        }else{
            return redirect('/');
        }
    }
}
