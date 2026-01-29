@extends('layouts.app')

@section('content')
<div class="py-24 bg-white pt-28">
  <div class="max-w-6xl mx-auto px-6">
    <div class="admin-section">
        <div class="flex items-center justify-between mb-6">
            <h1 class="h2">Staff Of Month</h1>
            <a href="{{ route('admin.staff.create') }}" class="admin-button">Create</a>
        </div>
        <table class="table">
            <thead><tr><th>Name</th><th>Position</th><th>Month</th><th>Active</th><th>Actions</th></tr></thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->position }}</td>
                    <td>{{ $item->month }}/{{ $item->year }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.staff.edit', $item) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.staff.destroy', $item) }}" method="POST" style="margin:0">
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
