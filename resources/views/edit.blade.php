<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit To-Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            ✏ Edit To-Do
        </div>
        <div class="card-body">
            <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Judul -->
                <div class="mb-3">
                    <label for="title" class="form-label">Judul To-Do</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control" 
                           value="{{ old('title', $todo->title) }}" 
                           required>
                </div>

                <!-- Input Status -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="pending" {{ $todo->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="done" {{ $todo->status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <!-- Tombol -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success px-4">💾 Update</button>
                    <a href="{{ route('todos.index') }}" class="btn btn-secondary px-4">↩ Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
