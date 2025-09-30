<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoList; // ← panggil model

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil semua data dari tabel to_do_list
        $todos = ToDoList::all();

        // kirim ke view resources/views/todolist/index.blade.php
        return view('todolist.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todolist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'status'      => 'required',
            'deadline'    => 'nullable|date',
        ]);

        ToDoList::create($request->all());

        return redirect()->route('todolist.index')
                         ->with('success', 'To Do berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = ToDoList::findOrFail($id);
        return view('todolist.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = ToDoList::findOrFail($id);
        return view('todolist.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'status'      => 'required',
            'deadline'    => 'nullable|date',
        ]);

        $todo = ToDoList::findOrFail($id);
        $todo->update($request->all());

        return redirect()->route('todolist.index')
                         ->with('success', 'To Do berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = ToDoList::findOrFail($id);
        $todo->delete();

        return redirect()->route('todolist.index')
                         ->with('success', 'To Do berhasil dihapus!');
    }
}
