{{-- resources/views/components/admin/tinymce.blade.php --}}

@props(['id' => 'content', 'height' => 500])

@push('styles')
    <style>
        /* TinyMCE Custom Styling */
        .tox-tinymce {
            border-radius: 0.5rem !important;
            border-color: #d1d5db !important;
        }

        .tox-tinymce:focus-within {
            border-color: #0053C5 !important;
            box-shadow: 0 0 0 2px rgba(0, 83, 197, 0.1) !important;
        }
    </style>
@endpush

@push('scripts')
    {{-- TinyMCE Self-Hosted (No API Key Required) --}}
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js"></script>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#{{ $id }}',
            height: {{ $height }},
            menubar: true,
            branding: false,
            promotion: false,

            // Plugins
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'codesample'
            ],

            // Toolbar
            toolbar: 'undo redo | blocks fontsize | ' +
                'bold italic underline strikethrough | forecolor backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | removeformat | ' +
                'link image media table codesample | code fullscreen | help',

            // Code Sample Languages
            codesample_languages: [{
                    text: 'HTML/XML',
                    value: 'markup'
                },
                {
                    text: 'JavaScript',
                    value: 'javascript'
                },
                {
                    text: 'CSS',
                    value: 'css'
                },
                {
                    text: 'PHP',
                    value: 'php'
                },
                {
                    text: 'Python',
                    value: 'python'
                },
                {
                    text: 'Java',
                    value: 'java'
                },
                {
                    text: 'C',
                    value: 'c'
                },
                {
                    text: 'C++',
                    value: 'cpp'
                },
                {
                    text: 'C#',
                    value: 'csharp'
                },
                {
                    text: 'SQL',
                    value: 'sql'
                },
                {
                    text: 'Ruby',
                    value: 'ruby'
                },
                {
                    text: 'Go',
                    value: 'go'
                },
                {
                    text: 'Rust',
                    value: 'rust'
                },
                {
                    text: 'TypeScript',
                    value: 'typescript'
                },
                {
                    text: 'Bash',
                    value: 'bash'
                },
            ],

            // Content Style
            content_style: `
                body { 
                    font-family: 'Inter', Helvetica, Arial, sans-serif; 
                    font-size: 14px; 
                    line-height: 1.6; 
                    color: #3d3d3d;
                    padding: 10px;
                }
                h1, h2, h3, h4, h5, h6 {
                    color: #3d3d3d;
                    font-weight: 700;
                    margin-top: 1em;
                    margin-bottom: 0.5em;
                }
                h1 { font-size: 2em; }
                h2 { font-size: 1.5em; }
                h3 { font-size: 1.25em; }
                p { margin-bottom: 1em; }
                a { color: #0053C5; text-decoration: underline; }
                pre, code {
                    background: #f7f7f7;
                    border: 1px solid #e3e3e3;
                    border-radius: 4px;
                    padding: 2px 6px;
                    font-family: 'Courier New', Courier, monospace;
                    font-size: 0.95em;
                }
                pre {
                    padding: 10px;
                    overflow-x: auto;
                }
                blockquote {
                    border-left: 4px solid #0053C5;
                    padding-left: 1em;
                    margin-left: 0;
                    color: #666666;
                }
                img {
                    max-width: 100%;
                    height: auto;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                table td, table th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }
                table th {
                    background-color: #f7f7f7;
                    font-weight: bold;
                }
            `,

            // Image Upload Handler
            images_upload_handler: function(blobInfo, success, failure, progress) {
                let xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route('admin.tinymce.upload') }}');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.upload.onprogress = function(e) {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = function() {
                    if (xhr.status === 403) {
                        failure('HTTP Error: ' + xhr.status + ' - Unauthorized', {
                            remove: true
                        });
                        return;
                    }

                    if (xhr.status < 200 || xhr.status >= 300) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    let json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                xhr.onerror = function() {
                    failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            },

            // Image configuration
            automatic_uploads: true,
            file_picker_types: 'image',
            image_advtab: true,
            image_caption: true,
            image_description: false,

            // URL configuration
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,

            // Additional styling
            content_css: [
                '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
            ],

            // Custom styles
            style_formats: [{
                    title: 'Headings',
                    items: [{
                            title: 'Heading 1',
                            format: 'h1'
                        },
                        {
                            title: 'Heading 2',
                            format: 'h2'
                        },
                        {
                            title: 'Heading 3',
                            format: 'h3'
                        },
                        {
                            title: 'Heading 4',
                            format: 'h4'
                        },
                    ]
                },
                {
                    title: 'Blocks',
                    items: [{
                            title: 'Paragraph',
                            format: 'p'
                        },
                        {
                            title: 'Blockquote',
                            format: 'blockquote'
                        },
                        {
                            title: 'Div',
                            format: 'div'
                        },
                        {
                            title: 'Pre',
                            format: 'pre'
                        },
                    ]
                },
                {
                    title: 'Inline',
                    items: [{
                            title: 'Bold',
                            format: 'bold'
                        },
                        {
                            title: 'Italic',
                            format: 'italic'
                        },
                        {
                            title: 'Underline',
                            format: 'underline'
                        },
                        {
                            title: 'Code',
                            format: 'code'
                        },
                    ]
                },
            ],
        });
    </script>
@endpush
