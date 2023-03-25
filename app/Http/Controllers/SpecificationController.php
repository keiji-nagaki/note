<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Specification;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $specifications = Specification::getAllOrderByUpdated_at();
        return response()->view('specification.index',compact('specifications'));        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('specification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // バリデーション
          $validator = Validator::make($request->all(), [
            'genre' => 'required | max:191',
            'name' => 'required | max:191',
            'nummber' => 'required | max:191',
            'specification' => 'required',
          ]);
          // バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('specification.create')
              ->withInput()
              ->withErrors($validator);
          }
        
  
        // dd($request->specification);
        $specification = new specification();
        
         $specification->genre=request()->genre;
         $specification->name=request()->name;
         $specification->nummber=request()->nummber;
         
         if(request('specification')){
            //  ファイル名をオリジナル名に変更する
             $original = $request->file('specification')->getClientOriginalName();
            //  ファイル名が被らないように日時を名前に加える
             $name=date('Ymd_His').'_'.$original;
            //  dd($name);
            
            // リクエストのファイル（レポート）をストレージ配下のレポートに$nameとういう名前で保存する
            // $path = \Storage::put('/public/specification', $name);
             $request->file('specification')->move('storage/app/public/specification',$name);
            //  レポートの名前
              $specification->specification=$name;
         }
        //  dd($specification->specification);
         
        $specification->save();
        
          // create()は最初から用意されている関数
          // 戻り値は挿入されたレコードの情報
        //   $result = Report::create($request->all());
          // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
          return redirect()->route('specification.index');
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $specification = Specification::find($id);
        return response()->view('specification.show', compact('specification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

    }
}
