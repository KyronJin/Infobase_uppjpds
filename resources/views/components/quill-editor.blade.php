{{-- 
    Reusable Quill Editor Component
    
    Usage:
    @component('components.quill-editor', [
        'id' => 'editor',
        'name' => 'content',
        'label' => 'Konten',
        'value' => $model->content ?? '',
        'placeholder' => 'Ketik konten di sini...',
        'minHeight' => '300px'
    ]) @endcomponent
--}}

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label ?? 'Konten' }}
        @if($required ?? false)
            <span class="text-red-600">*</span>
        @endif
    </label>
    
    <!-- Quill Editor -->
    <div id="{{ $id ?? 'editor' }}" 
        class="border border-slate-300 rounded-xl shadow-sm" 
        style="overflow: hidden; min-height: {{ $minHeight ?? '300px' }}; background: white;">
        {!! $value ?? '' !!}
    </div>
    
    <!-- Hidden textarea untuk store Quill content -->
    <textarea name="{{ $name ?? 'content' }}" 
        id="{{ $name ?? 'content' }}-input" 
        class="hidden" 
        @if($required ?? false) required @endif>{{ $value ?? '' }}</textarea>
    
    @error($name ?? 'content')
        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>

<style>
    /* Custom Quill Editor Styles - Global */
    .ql-toolbar.ql-snow {
        border: 1px solid #d1d5db;
        border-radius: 0.75rem 0.75rem 0 0;
        background: #f9fafb;
    }

    .ql-container.ql-snow {
        border: 1px solid #d1d5db;
        border-radius: 0 0 0.75rem 0.75rem;
        font-size: 1rem;
    }

    .ql-editor {
        background: white;
        min-height: inherit;
    }

    /* Quill Link and Image button styling */
    .ql-toolbar.ql-snow .ql-picker-label {
        color: #666;
    }

    .ql-toolbar.ql-snow .ql-stroke {
        stroke: #666;
    }

    .ql-toolbar.ql-snow .ql-fill,
    .ql-toolbar.ql-snow .ql-stroke.ql-fill {
        fill: #666;
    }

    .ql-toolbar.ql-snow button:hover .ql-stroke,
    .ql-toolbar.ql-snow button:hover .ql-fill,
    .ql-toolbar.ql-snow button.ql-active .ql-stroke,
    .ql-toolbar.ql-snow button.ql-active .ql-fill,
    .ql-toolbar.ql-snow .ql-picker-label:hover,
    .ql-toolbar.ql-snow .ql-picker-item:hover,
    .ql-toolbar.ql-snow .ql-picker-item.ql-selected {
        color: #063A76;
    }

    .ql-toolbar.ql-snow button:hover .ql-stroke,
    .ql-toolbar.ql-snow button:hover .ql-fill,
    .ql-toolbar.ql-snow button.ql-active .ql-stroke,
    .ql-toolbar.ql-snow .ql-picker-label:hover,
    .ql-toolbar.ql-snow .ql-picker-item:hover,
    .ql-toolbar.ql-snow .ql-picker-item.ql-selected {
        stroke: #063A76;
    }
</style>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
(function() {
    const editorId = '{{ $id ?? "editor" }}';
    const inputId = '{{ $name ?? "content" }}-input';
    const formSelector = '{{ $formSelector ?? "form" }}';
    
    let quillInstance = null;
    
    function initQuillEditor() {
        // Initialize Quill with full toolbar
        quillInstance = new Quill(`#${editorId}`, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['blockquote', 'code-block'],
                    ['link', 'image'],
                    ['clean']
                ]
            },
            placeholder: '{{ $placeholder ?? "Ketik konten di sini..." }}'
        });
        
        // Sync to textarea on form submit
        const form = document.querySelector(formSelector);
        if (form) {
            form.addEventListener('submit', function(e) {
                const content = quillInstance.root.innerHTML;
                document.getElementById(inputId).value = content;
            });
        }
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initQuillEditor);
    } else {
        initQuillEditor();
    }
})();
</script>
