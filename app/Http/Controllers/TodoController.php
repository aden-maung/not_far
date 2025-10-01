<?php
namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // tampilkan semua todos
    public function index()
    {
        $todos = Todo::latest()->get();
        return view('index', compact('todos'));
    }

    // simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Todo::create([
            'title' => $request->title,
            'status' => 'pending',
        ]);

        return redirect()->route('todos.index');
    }
    public function destroy($id)
{
    $todo = Todo::findOrFail($id);
    $todo->delete();

    return redirect()->route('todos.index')->with('success', 'To-Do berhasil dihapus!');
}

}

