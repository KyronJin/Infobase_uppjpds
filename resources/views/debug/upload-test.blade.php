@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h1>Debug: Test File Upload</h1>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Upload Test Form</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Form ini untuk test apakah file upload berfungsi dengan benar.</p>
                    
                    <form id="testForm" method="POST" action="/debug/upload-test" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="slot_1_image" class="form-label">Slot 1 Image</label>
                            <input type="file" class="form-control" id="slot_1_image" name="slot_1_image" accept="image/*">
                            <small class="text-muted">Max 20MB, PNG/JPG/GIF</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="slot_2_image" class="form-label">Slot 2 Image</label>
                            <input type="file" class="form-control" id="slot_2_image" name="slot_2_image" accept="image/*">
                            <small class="text-muted">Max 20MB, PNG/JPG/GIF</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="slot_3_image" class="form-label">Slot 3 Image</label>
                            <input type="file" class="form-control" id="slot_3_image" name="slot_3_image" accept="image/*">
                            <small class="text-muted">Max 20MB, PNG/JPG/GIF</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Test Upload (FETCH)</button>
                    </form>
                </div>
            </div>
            
            <div class="card mt-3" id="resultCard" style="display: none;">
                <div class="card-header">
                    <h5>Test Result</h5>
                </div>
                <div class="card-body">
                    <div id="resultContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('testForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const form = document.getElementById('testForm');
    const formData = new FormData(form);
    
    console.log('FormData contents:');
    for (let [key, value] of formData.entries()) {
        if (value instanceof File) {
            console.log(`${key}: ${value.name} (${value.size} bytes, ${value.type})`);
        } else {
            console.log(`${key}: ${value}`);
        }
    }
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            }
        });
        
        console.log('Response status:', response.status);
        const data = await response.json();
        console.log('Response data:', data);
        
        // Show result
        const resultCard = document.getElementById('resultCard');
        const resultContent = document.getElementById('resultContent');
        
        resultContent.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
        resultCard.style.display = 'block';
        
        // Scroll to result
        resultCard.scrollIntoView({ behavior: 'smooth' });
        
    } catch (error) {
        console.error('Error:', error);
        alert('Error: ' + error.message);
    }
});
</script>

<style>
#resultContent pre {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
    overflow-x: auto;
    font-size: 12px;
}
</style>
@endsection
