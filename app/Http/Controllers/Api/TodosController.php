<?php

namespace Todos\Http\Controllers\Api;

use Todos\Http\Controllers\Controller;
use Todos\Todo;
use Todos\Http\Resources\TodoResource;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->get();

        return TodoResource::collection($todos);
    }

    public function store()
    {
        $todo = Todo::create([
            'name' => request('name'),
        ]);

        return new TodoResource($todo);
    }

    public function update(Todo $todo)
    {
        $todo->update([
            'name' => request('name'),
        ]);

        return new TodoResource($todo);
    }

    public function toggle(Todo $todo)
    {
        $todo->completed = ! $todo->completed;

        $todo->save();

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response('', 204);
    }

    public function clear()
    {
        $completed = Todo::whereCompleted(true)->get();

        foreach ($completed as $todo) {
            $todo->delete();
        }

        return response('', 204);
    }
}
