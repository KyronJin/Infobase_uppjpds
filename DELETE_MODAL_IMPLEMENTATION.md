# 🗑️ Fitur Hapus yang Proper - Panduan Implementasi

## Overview
Fitur hapus yang konsisten, elegan, dan proper untuk semua admin pages dengan:
- ✅ Modal konfirmasi yang elegan
- ✅ AJAX delete dengan loading state
- ✅ Error handling & toast notifications
- ✅ Brand colors (orange #F85E38, blue #063A76, red #E83B2B)
- ✅ Smooth animations & UX

## Components Available

### 1. **Delete Modal Component** 
**File**: `resources/views/components/delete-modal.blade.php`

**Usage**:
```blade
<!-- Include in your admin page -->
@component('components.delete-modal', ['id' => 'deleteModal', 'title' => 'Hapus Item?']) @endcomponent
```

**JavaScript Functions**:
```javascript
// Open delete modal
openDeleteModal(modalId, itemName, deleteUrl, callbackFunction);

// Close delete modal
closeDeleteModal();

// Example:
<button onclick="openDeleteModal('deleteModal', 'Item Name', '/admin/item/1', function() { location.reload(); })">
    Hapus
</button>
```

### 2. **Toast Notification Functions**
**Available in**: `resources/views/layouts/app.blade.php` (Global)

**Functions**:
```javascript
showSuccessToast(message, duration);  // Default: 3000ms
showErrorToast(message, duration);
showInfoToast(message, duration);
showToast(message, type, duration);  // Generic function
```

**Example**:
```javascript
showSuccessToast('✓ Item berhasil dihapus!');
showErrorToast('✗ Gagal menghapus item');
showInfoToast('ℹ Menunggu konfirmasi...');
```

## Implementation Pattern

### Step 1: Include Delete Modal Component
```blade
<!-- At bottom of your view before @endsection -->
@component('components.delete-modal', ['id' => 'deleteModal', 'title' => 'Hapus {Item}?']) @endcomponent
```

### Step 2: Update Delete Buttons
```blade
<!-- Change from: -->
<form method="POST" action="{{ route('item.destroy', $item) }}" onsubmit="return confirm('Hapus?')">
    @csrf @method('DELETE')
    <button type="submit">Hapus</button>
</form>

<!-- To: -->
<button type="button" onclick="openDeleteModal('deleteModal', '{{ $item->name }}', '/admin/item/{{ $item->id }}')">
    Hapus
</button>
```

### Step 3: Ensure Controller Returns JSON
```php
// In your controller destroy method:
public function destroy($id)
{
    try {
        $item = Item::findOrFail($id);
        $item->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus!'
        ]);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
```

## Full Example Implementation

### View File (`resources/views/admin/items/index.blade.php`)
```blade
@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12 pt-28">
    <div class="max-w-6xl mx-auto px-6">
        
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Item</h1>
            <a href="{{ route('admin.item.create') }}" class="mt-4 inline-flex items-center px-4 py-2 text-white font-medium rounded-lg" style="background-color: #F85E38;">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Item
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">Nama</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Edit Button - Orange -->
                            <a href="{{ route('admin.item.edit', $item->id) }}" 
                               class="px-3 py-1.5 text-white rounded text-xs font-semibold" 
                               style="background-color: #F85E38;"
                               onmouseover="this.style.backgroundColor='#E64D28'"
                               onmouseout="this.style.backgroundColor='#F85E38'">
                                Edit
                            </a>
                            
                            <!-- Delete Button - Red -->
                            <button type="button" 
                                    onclick="openDeleteModal('deleteModal', '{{ $item->name }}', '/admin/item/{{ $item->id }}')"
                                    class="px-3 py-1.5 text-white rounded text-xs font-semibold"
                                    style="background-color: #E83B2B;"
                                    onmouseover="this.style.backgroundColor='#D62B1C'"
                                    onmouseout="this.style.backgroundColor='#E83B2B'">
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-6 py-10 text-center text-gray-400">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Delete Modal Component -->
@component('components.delete-modal', ['id' => 'deleteModal', 'title' => 'Hapus Item?']) @endcomponent

<script>
    // Setup delete modal click-outside handler
    setupDeleteModalClickOutside('deleteModal');
</script>
@endsection
```

## Supported Admin Pages to Update

1. ✅ **Tata Tertib** - Done
2. ⏳ **Pengumuman** - Should update
3. ⏳ **Profil Pegawai** - Should update
4. ⏳ **Staff of Month** - Should update
5. ⏳ **Profile Ruangan** - Should update
6. ⏳ **Calendar** - Should update
7. ⏳ **Gallery** - Should update

## Color Palette (Brand)

| Warna | Hex | Usage |
|-------|-----|-------|
| Oren (Primary) | #F85E38 | Primary buttons (Tambah, Edit) |
| Biru (Secondary) | #063A76 | Search, Filter buttons |
| Merah (Danger) | #E83B2B | Delete buttons |
| Abu (Neutral) | #ECFDF1 | Cancel, Reset buttons |

### Hover Color Shades
- Orange hover: #E64D28 (darken 15%)
- Blue hover: #052A57 (darken 15%)
- Red hover: #D62B1C (darken 15%)
- Gray hover: #D1F8E6 (lighten 10%)

## Files Modified/Created

### New Files:
- ✅ `resources/views/components/delete-modal.blade.php` - Reusable delete modal
- ✅ `resources/views/components/toast-notification.blade.php` - Toast styles (optional, toast is in app.blade.php now)

### Modified Files:
- ✅ `resources/views/layouts/app.blade.php` - Added toast functions & styles
- ✅ `resources/views/admin/tata_tertib/index.blade.php` - Updated to use delete modal

## Testing Checklist

For each admin page updated:

- [ ] Navigate to admin page
- [ ] Click delete button for an item
- [ ] Modal appears with item name & confirmation
- [ ] Click "Batal" - modal closes without deleting
- [ ] Click delete button again
- [ ] Click "Hapus" - loading state appears
- [ ] Success/error toast appears
- [ ] Item is deleted or error message shows
- [ ] Page refreshes on success

## Troubleshooting

### Modal not appearing
- Check browser console for JavaScript errors
- Verify modal id matches in openDeleteModal call
- Ensure delete-modal component is included

### Delete not working
- Check controller returns JSON response
- Verify DELETE route exists
- Check CSRF token in request headers
- Look at browser Network tab for 403/404 errors

### Toast not showing
- Check toast functions are defined in app.blade.php
- Verify showSuccessToast/showErrorToast are called
- Check z-index conflicts with other elements

## Next Steps

1. Update remaining admin pages with delete modal component
2. Test all delete operations
3. Add delete confirmations to related entities (e.g., jenis before tata_tertib)
4. Consider adding bulk delete functionality
5. Add audit log for deleted items (optional)
