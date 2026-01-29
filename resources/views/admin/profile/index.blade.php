@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Profile Ruangan</h1>
            <a href="{{ route('admin.profile.create') }}" class="admin-button">Create</a>
        </div>
        <table class="table">
            <thead><tr><th>Ruangan</th><th>Lantai</th><th>Kapasitas</th><th>Aktif</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->room_name }}</td>
                    <td>{{ $item->floor }}</td>
                    <td>{{ $item->capacity }}</td>
                    <td>{{ $item->is_active ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.profile.edit', $item) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.profile.destroy', $item) }}" method="POST" style="margin:0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
