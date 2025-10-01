<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-add {
            background: linear-gradient(90deg, #4facfe, #00f2fe);
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-add:hover {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 114, 255, 0.4);
        }
        .btn-action {
            transition: 0.2s;
        }
        .btn-action:hover {
            transform: scale(1.1);
        }
    </style>
    <script>
        function toggleForm() {
            let form = document.getElementById('form-add');
            form.classList.toggle('d-none');
        }
    </script>
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">📋 To-Do List</h1>
        <!-- Tombol Tambah List -->
        <button onclick="toggleForm()" class="btn btn-add px-4 py-2 rounded-pill shadow">
            + Tambah List
        </button>
    </div>

    <!-- Form Tambah -->
    <div id="form-add" class="card p-4 mb-4 d-none">
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul To-Do</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Contoh: Belajar Laravel" required>
            </div>
            <button type="submit" class="btn btn-success px-4">✅ Simpan</button>
            <button type="button" onclick="toggleForm()" class="btn btn-outline-secondary px-4">❌ Batal</button>
        </form>
    </div>

    <!-- Tabel To-Do -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>NO</th>
                        <th>Judul </th>
                        <th>Status</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                        <tr><?php
                        $no = 1?>
                            <td><?=$no++?></td>
                            <td>{{ $todo->title }}</td>
                            <td>
                                <span class="badge {{ $todo->status == 'done' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ ucfirst($todo->status) }}
                                </span>
                            </td>
                            <td>
                                <td>
    <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-sm btn-info text-white">✏ Edit</a>

    <!-- Tombol hapus dengan modal -->
    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $todo->id }}">
        🗑 Hapus
    </button>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="deleteModal{{ $todo->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus <b>{{ $todo->title }}</b>?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</td>
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
