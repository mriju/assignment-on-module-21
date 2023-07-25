<?php

use App\Http\Controllers\Controller;
use App\Models\TodoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todoItems = $user->todoItems;
        return response()->json($todoItems, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validatedData['user_id'] = Auth::id();

        $todoItem = TodoItem::create($validatedData);

        return response()->json($todoItem, 201);
    }

    public function show(TodoItem $todoItem)
    {
        $this->authorize('view', $todoItem);
        return response()->json($todoItem, 200);
    }

    public function update(Request $request, TodoItem $todoItem)
    {
        $this->authorize('update', $todoItem);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean',
        ]);

        $todoItem->update($validatedData);

        return response()->json($todoItem, 200);
    }

    public function destroy(TodoItem $todoItem)
    {
        $this->authorize('delete', $todoItem);

        $todoItem->delete();

        return response()->json(['message' => 'Todo item deleted successfully'], 200);
    }
}