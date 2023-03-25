<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Report;

use Auth;

use App\Models\User;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reports = Report::getAllOrderByUpdated_at();
        return response()->view('report.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // バリデーション
          $validator = Validator::make($request->all(), [
            'maker' => 'required | max:191',
            'year' => 'required | max:191',
            'report' => 'required',
          ]);
          // バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('report.create')
              ->withInput()
              ->withErrors($validator);
          }
        
  
        // dd($request->all());
        $report = new report();
        
         $report->maker=request()->maker;
         $report->year=request()->year;
         
         if(request('report')){
            //  ファイル名をオリジナル名に変更する
             $original = $request->file('report')->getClientOriginalName();
            //  ファイル名が被らないように日時を名前に加える
             $name=date('Ymd_His').'_'.$original;
            //  dd($name);
            
            // リクエストのファイル（レポート）をストレージ配下のレポートに$nameとういう名前で保存する
            // $path = \Storage::put('/public/report', $name);
             $request->file('report')->move('storage/app/public/report',$name);
            //  レポートの名前
              $report->report=$name;
         }
        //  dd($report->report);
         
        $report->save();
        
          // create()は最初から用意されている関数
          // 戻り値は挿入されたレコードの情報
          $data = $request->merge(['user_id' => Auth::user()->id])->all();
          $result = Report::create($request->all());
          // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
          return redirect()->route('report.index');
          
        
        //
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
    
    public function mydata()
  {
    // Userモデルに定義したリレーションを使用してデータを取得する．
    $reports = User::query()
      ->find(Auth::user()->id)
      ->userReports()
      ->orderBy('created_at','desc')
      ->get();
    //   dd($reports);
    return response()->view('report.index', compact('reports'));
  }
}
