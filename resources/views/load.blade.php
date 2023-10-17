<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CeLOE - Learning Management System (LMS)</title>
    <meta name="description" content="CeLOE - Learning Management System (LMS)">
    <meta name="author" content="CeLOE - Learning Management System (LMS)">
    <link rel="shortcut icon" href="{{ asset('lms.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #drop-area {
            border: 3px dashed #b80606;
            border-radius: 100px;
            padding: 300px;
            cursor: pointer;

        }
        #file-input {
            display: none;
        }
        #preview {
            margin-top: 20px;
        }
        #preview img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>

    <form id="upload-form" method="post" action="{{ route('all-lms.store') }}" enctype="multipart/form-data">
        @csrf
        <div id="drop-area">
            <p>Drag & drop file di sini atau <a href="#" onclick="openFileInput()">Pilih File</a></p>
            <input type="file" id="file-input" name="fileToUpload" multiple>
        </div>
        <div id="preview"></div>
        <button type="submit">Upload</button>
    </form>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file-input');
        const preview = document.getElementById('preview');

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.style.borderColor = 'blue';
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.style.borderColor = '#ccc';
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.style.borderColor = '#ccc';
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', () => {
            const files = fileInput.files;
            handleFiles(files);
        });

        function openFileInput() {
            fileInput.click();
        }

        function handleFiles(files) {
            preview.innerHTML = '';
            for (const file of files) {
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    preview.appendChild(img);
                }
                const fileItem = document.createElement('p');
                fileItem.textContent = file.name;
                preview.appendChild(fileItem);
            }
        }
    </script>
</body>
</html>
