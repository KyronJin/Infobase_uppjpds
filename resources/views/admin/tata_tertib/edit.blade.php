@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Tata Tertib</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.tata_tertib.update', $tata_tertib) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Jenis Tata Tertib</label>
                <select name="jenis_tata_tertib_id" class="form-control" required>
                    <option value="">Pilih Jenis</option>
                    @foreach ($jenis as $item)
                        <option value="{{ $item->id }}" {{ old('jenis_tata_tertib_id', $tata_tertib->jenis_tata_tertib_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ old('content', $tata_tertib->content) }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $tata_tertib->is_active) ? 'checked' : '' }} class="mr-2"> 
                    Active
                </label>
            </div>
            
            <button type="submit" class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="admin-section">
        <h1 class="admin-header">Edit Tata Tertib</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.tata_tertib.update', $tata_tertib) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Jenis Tata Tertib</label>
                <select name="jenis_tata_tertib_id" class="form-control" required>
                    <option value="">Pilih Jenis</option>
                    @foreach ($jenis as $item)
                        <option value="{{ $item->id }}" {{ old('jenis_tata_tertib_id', $tata_tertib->jenis_tata_tertib_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="5" required>{{ old('content', $tata_tertib->content) }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $tata_tertib->is_active) ? 'checked' : '' }} class="mr-2"> 
                    Active
                </label>
            </div>
            
            <button type="submit" class="form-submit">Save</button>
        </form>
    </div>
</div>
@endsection