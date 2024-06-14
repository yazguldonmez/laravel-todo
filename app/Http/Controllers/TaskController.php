<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::id();
        //$tasks = Task::where('user_id', $id)->get();
        $tasks = DB::table('tasks')->where('user_id', $id)->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('create')
                ->withErrors($validator);
        }
        $data['user_id'] = Auth::id();
        Task::create($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['title']);

        $validator = Validator::make($data, [
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('tasks.edit', ['id' => $id])
                ->withErrors($validator);
        }

        $task = Task::findOrFail($id);
        $task->update($data);
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Task::destroy($id);
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->status;
        $task = Task::findOrFail($id);
        $task->update($data);

        return redirect()->route('tasks.index');
    }
}
