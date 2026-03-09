<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToDo\StoreRequest;
use App\Http\Requests\ToDo\UpdateRequest;
use App\Models\ToDo;
use App\Models\ToDoDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index()
    {
        $toDos = ToDo::with('toDoDetails')->get();
        return $toDos;
    }

    public function store(StoreRequest $request)
    {
        $toDo = new ToDo();
        $toDo->title = $request->get('title');

        $toDoDetail = new ToDoDetail();
        $toDoDetail->name = null;
        $toDoDetail->completed_flag = false;

        DB::transaction(function () use ($toDo, $toDoDetail) {
            $toDo->save();
            $toDo->toDoDetails()->save($toDoDetail);
        });

        return $toDo->load('toDoDetails');
    }

    public function update(UpdateRequest $request, $id)
    {
        $toDo = ToDo::findOrFail($id);
        $toDo->title = $request->get('title');
        $toDo->save();

        return $toDo;
    }

    public function destroy($id)
    {
        $toDo = ToDo::findOrFail($id);
        $toDo->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}