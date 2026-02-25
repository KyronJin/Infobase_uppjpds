# 🗑️ Universal Delete Modal Implementation Guide

**Updated**: February 23, 2026

## Overview

Semua fitur delete/hapus di web ini sekarang menggunakan sistem **Universal Delete Modal** yang konsisten dengan:
- ✅ Modal konfirmasi yang elegan
- ✅ AJAX delete dengan loading state
- ✅ Notifikasi toast (success/error)
- ✅ Progressive enhancement (works with/without JS)
- ✅ Konsisten di semua halaman admin

---

## How to Use Delete Modal

### Basic Implementation

#### 1. Add Delete Modal Component to Your View

Di akhir file view (sebelum `@endsection`), tambahkan:

```blade
<!-- Delete Modal -->
@component('components.delete-modal', ['id' => 'deleteItemModal', 'title' => 'Hapus Item?']) @endcomponent

@endsection
```

#### 2. Update Delete Button

Ubah dari form ke button dengan `onclick`:

```blade
<!-- BEFORE (Form with confirm dialog) -->
<form action="{{ route('item.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin?');">
    @csrf
    @method('DELETE')
    <button type="submit">Hapus</button>
</form>

<!-- AFTER (Button dengan modal) -->
<button type="button" onclick="openDeleteModal('deleteItemModal', '{{ $item->name }}', '/admin/item/{{ $item->id }}')">
    Hapus
</button>
```

#### 3. Ensure Controller Returns JSON

Controller harus support JSON response untuk AJAX:

```php
public function destroy($id)
{
    try {
        $item = Item::findOrFail($id);
        $name = $item->name;
        $item->delete();
        
        // Return JSON for AJAX - CRITICAL!
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus'
            ]);
        }
        
        // Fallback untuk non-AJAX requests
        return redirect()->route('item.index')
            ->with('success', 'Item berhasil dihapus');
    } catch (\Exception $e) {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
        return redirect()->back()->with('error', 'Gagal menghapus');
    }
}
```

---

## Advanced Usage

### Custom Callback Function

Execute custom logic setelah delete berhasil:

```blade
<button type="button" onclick="openDeleteModal('deleteItemModal', '{{ $item->name }}', '/admin/item/{{ $item->id }}', function() {
    // Custom callback
    console.log('Item deleted!');
    // Refresh specific element instead of full page
    document.getElementById('item-list').remove();
})">
    Hapus
</button>
```

### With Loading Message

```blade
<button type="button" onclick="openDeleteModal('deleteItemModal', '{{ $item->name }}', '/admin/item/{{ $item->id }}', null, null, 'DELETE')">
    Hapus
</button>
```

---

## Global JavaScript Functions

### `openDeleteModal(modalId, itemName, deleteUrl, callback, formData, method)`

**Parameters:**
- `modalId` (string): ID dari modal element
- `itemName` (string): Nama item untuk ditampilkan di modal
- `deleteUrl` (string): URL untuk DELETE request
- `callback` (function, optional): Callback setelah delete berhasil
- `formData` (object, optional): Additional form data
- `method` (string, optional): HTTP method, default 'DELETE'

**Example:**
```javascript
openDeleteModal('deleteModal', 'Produk A', '/admin/products/1', function() {
    location.reload();
});
```

### `closeDeleteModal(modalId)`

**Parameters:**
- `modalId` (string): ID dari modal yang akan ditutup

**Example:**
```javascript
closeDeleteModal('deleteModal');
```

### `confirmDeleteAction(modalId)`

Called internally ketika user klik Hapus button.

---

## Implemented Pages

| Page | Modal ID | Status |
|------|----------|--------|
| Admin About | `deleteAboutModal` | ✅ Updated |
| Admin Pengumuman | `deletePengumumanModal` | ✅ Updated |
| Admin Profil Pegawai | `deleteProfilPegawaiModal` | ✅ Updated |
| Admin Staff | `deleteStaffModal` | ✅ Updated |
| Admin Staff Jabatan | `deleteJabatanModal` | ✅ Updated |
| Admin Tata Tertib | `deleteTataTertibModal` | ✅ Updated |
| Admin Gallery | `deleteGalleryModal` | ✅ Updated |
| Admin Profile Ruangan | `deleteProfileRuanganModal` | ✅ Updated |
| Admin Profile Image | `deleteProfileImageModal` | ✅ Updated |

---

## Toast Notifications

Notifikasi success/error secara otomatis ditampilkan setelah delete. 

### Available Functions

```javascript
// Success notification
showSuccessToast('✓ Item berhasil dihapus!');

// Error notification
showErrorToast('✗ Gagal menghapus item');

// Info notification
showInfoToast('ℹ Sedang memproses...');

// Generic notification
showToast(message, type, duration);
```

---

## Error Handling

Modal akan menampilkan error message dari server:

```php
// In controller
return response()->json([
    'success' => false,
    'message' => 'Tidak bisa menghapus karena masih memiliki relasi'
], 500);
```

Error message akan ditampilkan di toast notification dan button akan di-enable kembali untuk retry.

---

## Migration Checklist

### For New Pages

- [ ] Add modal component before `@endsection`
- [ ] Change form delete to button with `onclick="openDeleteModal(...)"`
- [ ] Update controller to return JSON response
- [ ] Test delete action with browser DevTools network tab
- [ ] Verify success/error toasts appear
- [ ] Test with JavaScript disabled (should still work with redirect)

### For Existing Pages (Already Done)

✅ About
✅ Pengumuman
✅ Profil Pegawai  
✅ Staff
✅ Tata Tertib
✅ Gallery
✅ Profile Ruangan

---

## Best Practices

1. **Always use addslashes() for item names**
   ```blade
   onclick="openDeleteModal('modal', '{{ addslashes($item->name) }}', '/url')"
   ```

2. **Consistent modal IDs**
   Use pattern: `delete{ResourceName}Modal`

3. **Meaningful item names**
   Show what's being deleted to user

4. **Proper error messages**
   Return meaningful error messages from controller

5. **Request type checking**
   ```php
   if (request()->expectsJson()) {
       // Return JSON
   } else {
       // Return redirect
   }
   ```

---

## Troubleshooting

### Modal tidak muncul
- Verifikasi modal ID match antara button dan component
- Check browser console for JavaScript errors

### AJAX request returns HTML instead of JSON
- Verify controller method has `request()->expectsJson()` check
- Check if route accepts DELETE method

### Notifications tidak muncul
- Ensure `layouts.app` memiliki toast notification functions
- Check browser console for errors

### Delete button masih reload halaman
- Verify `request()->expectsJson()` returns JSON
- Check network tab in DevTools untuk response type

---

## Contributing

Ketika menambah delete feature baru:
1. Follow pattern dari existing pages
2. Test dengan browser DevTools
3. Test dengan JavaScript disabled
4. Update dokumentasi ini

---

**Last Updated**: February 23, 2026
**Status**: Production Ready ✅
