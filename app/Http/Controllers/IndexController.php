<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class IndexController extends Controller
{
    /**
     * 初期表示
     */
    public function index()
    {
        //セッションからユーザー情報を取得
        if(session()->exists('USER')){
            $session = session('USER');
            $result['id'] = $session['id'];
            $result['name'] = $session['name'];
        }else{
            return redirect('/');
        }
        $result['datas'] = Data::where('user_id', $session['id'])->get();

        return view('index', compact('result'));
    }

    /**
     * 削除
     */
    public function delete(Request $request)
    {
        //セッションからユーザー情報を取得
        if(session()->exists('USER')){
            $session = session('USER');
            $userId = $session['id'];
            $dataId = $request->dataId;
            $userId = $session['id'];


            $data = Data::where([['user_id', $userId],['id', $dataId]])->first();
            $data->delete();
            
            return redirect()->route('index');

        }else{
            return redirect('/');
        }
    }

    /**
     * 新規登録
     */
    // public function insert(Request $request)
    // {
    //     //セッションからユーザー情報を取得
    //     if(session()->exists('USER')){
    //         $session = session('USER');
    //         $result['id'] = $session['id'];
    //         $result['name'] = $session['name'];

    //         return view('detail', compact('result'));
            
    //     }else{
    //         return redirect('/');
    //     }
    // }

    /**
     * 更新
     */
    // public function update(Request $request)
    // {
    //     //セッションからユーザー情報を取得
    //     if(session()->exists('USER')){
    //         $session = session('USER');
    //         $result['id'] = $session['id'];
    //         $result['name'] = $session['name'];

    //         $ = $request->dataId;

    //         return view('detail', compact('result'));
            
    //     }else{
    //         return redirect('/');
    //     }
    // } 
}
