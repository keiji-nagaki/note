<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Task;

use Auth;

use App\Models\User;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::getAllOrderByUpdated_at();
        return response()->view('task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('task.create');
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
    'task' => 'required',
    'deadline' => 'required',
    // 'finish' => 'required',
  ]);
  // バリデーション:エラー
  if ($validator->fails()) {
    return redirect()
      ->route('task.create')
      ->withInput()
      ->withErrors($validator);
  }
     $data = $request->merge(['user_id' => Auth::user()->id])->all();
     $result = Task::create($data);

    // tweet.index」にリクエスト送信（一覧ページに移動）
    return redirect()->route('task.index');
//   // create()は最初から用意されている関数
//   // 戻り値は挿入されたレコードの情報
//   $result = Task::create($request->all());
//   // ルーティング「tweet.index」にリクエスト送信（一覧ページに移動）
//   return redirect()->route('task.index');
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
          $task = Task::find($id);
          return response()->view('task.edit', compact('task'));
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
          //バリデーション
          $validator = Validator::make($request->all(), [
            'deadline' => 'required',
            'finish' => 'required',
          ]);
          //バリデーション:エラー
          if ($validator->fails()) {
            return redirect()
              ->route('task.edit', $id)
              ->withInput()
              ->withErrors($validator);
          }
          //データ更新処理
          $result = Task::find($id)->update($request->all());
          return redirect()->route('task.index');
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
         $result = Task::find($id)->delete();
         return redirect()->route('task.index');
    }
    public function mydata()
  {
    // Userモデルに定義したリレーションを使用してデータを取得する．
    $tasks = User::query()
      ->find(Auth::user()->id)
      ->userTasks()
      ->orderBy('created_at','desc')
      ->get();
    return response()->view('task.index', compact('tasks'));
  }
}
