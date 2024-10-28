<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>imgbb Clone</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.active {
            display: block;
        }
        .full-width-dropdown {
            position: fixed;
            left: 0;
            right: 0; 
            width: 100%;
            background: white;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 50;
            height: 400px;
            overflow-y: auto;
        }

        #preview-images {
          display: flex;
          flex-wrap: wrap; /* Cho phép xuống hàng khi vượt quá kích thước */
          justify-content: center; /* Căn giữa các ảnh */
          gap: 20px; /* Khoảng cách giữa các ảnh */
          margin-top: 20px;
        }

        #preview-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

    </style>
</head>
<body class="bg-white font-roboto">
    <header class="flex justify-between items-center p-4 border-b">
        <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-info-circle"></i> Giới thiệu
            </a>
        </div>
        <div class="relative">
            <button onclick="toggleUploadDropdown()" class="upload-btn text-gray-600 hover:text-gray-800">
                <i class="fas fa-upload"></i> Upload <i class="fas fa-caret-down ml-1"></i>
            </button>
            <div id="upload-dropdown" class="dropdown-menu full-width-dropdown">
                <main style="height: 400px;" class="container mx-auto mt-10">
                  <form action="{{route('file.upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf  
                    @if(session('urls'))
                        <div class="text-center mt-10">
                            <h3 class="text-2xl font-semibold">Upload xong rồi!</h3>
                            <div class="flex justify-center mt-4">
                                @foreach(session('urls') as $url)
                                    <div class="mx-2">
                                        <a href="{{ $url }}" target="_blank">
                                            <img src="{{ $url }}" alt="Uploaded Image" class="w-24 h-24 object-cover rounded">
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6">
                                <h4 class="font-semibold">Mã nhúng</h4>
                                <select id="embed-type" class="border p-2 rounded mb-4">
                                    <option value="direct">Link người xem</option>
                                    <option value="html">HTML</option>
                                </select>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-8"> <!-- Điều chỉnh kích thước cột -->
                                            <textarea style="width = 550px;font-size: 15px;height: 150px;x;height: 250px;width: 550px;" id="embed-code" class="border p-2 rounded h-24 resize-none" readonly>
                                              @foreach(session('urls') as $url)
                                              {{ $url }}
                                              @endforeach
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('embed-type').addEventListener('change', function () {
                                const embedCode = document.getElementById('embed-code');
                                const urls = @json(session('urls'));

                                switch (this.value) {
                                    case 'html':
                                        embedCode.value = urls.map(url => `<img src="${url}" alt="Image">`).join('\n');
                                        break;
                                    default:
                                        embedCode.value = urls.join('\n');
                                        break;
                                }
                            });
                        </script>
                    @endif
                    <div id="drop-zone" class="bg-white shadow-md rounded-lg p-10 text-center">
                        <i class="fas fa-cloud-upload-alt text-6xl text-blue-500"></i>
                        <p id="drop-zone-text" class="mt-4 text-lg">Kéo thả hoặc paste (Ctrl + V) ảnh vào đây để upload</p>
                        <p class="text-gray-500 mt-2">Bạn có thể <a href="#" class="text-blue-500">tải lên từ máy tính</a> hoặc <a href="#" class="text-blue-500">thêm địa chỉ ảnh</a>.</p>
                        <input class="text-gray-600 mb-4" type="file" id="images" name="images[]" accept="image/*,.pdf,.docx,.zip,.rar" multiple style="display: none;">
                        <div id="preview-images" class="mt-4"></div>
                    </div>
                    <button class="bg-blue-500 text-white py-2 px-6 rounded" type="submit">Upload</button>
                  </form>
                </main>
            </div>
        </div>
    </header>

    <main class="flex flex-col items-center justify-center min-h-screen">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Đăng và chia sẻ dữ liệu trực tuyến</h1>
        <p class="text-gray-600 mb-6 text-center">Kéo thả dữ liệu hoặc hình ảnh của bạn vào bất kỳ đâu để bắt đầu tải lên ngay. Giới hạn 10 MB. Liên kết trực tiếp đến dữ liệu, mã BBCode và hình thu nhỏ HTML.</p>
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700" onclick="showUploadDropdown()">START UPLOADING</button>
    </main>

    <section class="bg-gray-100 py-16">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Nội dung trang chủ</h2>
            <p class="text-gray-600">Đoạn này là bài viết giới thiệu để SEO</p>
        </div>
    </section>

    <footer class="text-center py-4 text-gray-600 text-sm">
        <div class="flex justify-center space-x-4 mb-2">
            <a href="#" class="hover:underline">Giới thiệu</a>
            <a href="#" class="hover:underline">Liên hệ</a>
        </div>
        <p>Sử dụng 10MB.cc là bạn đã đồng ý với <a href="#" class="hover:underline">Quy định sử dụng</a> và <a href="#" class="hover:underline">Chính sách bảo mật</a>.</p>
    </footer>
  </body>
  
</html>

<script>
  document.getElementById('images').addEventListener('change', function(event) {
      const files = event.target.files;
      const previewContainer = document.getElementById('preview-images');
      previewContainer.innerHTML = ''; 
      if (files.length === 0) {
          return;
      }
      for (let i = 0; i < files.length; i++) {
          const file = files[i];

          if (!file.type.match('image.*')) {
              continue;
          }
          const reader = new FileReader();
          reader.onload = (function(theFile) {
              return function(e) {
                  const div = document.createElement('div');
                  div.classList.add('image-preview');
                  const icon = getFileIcon(theFile.name);
                  div.innerHTML = `
                      <i class="${icon}" style="font-size: 30px; margin-right: 10px;"></i>
                      ${file.type.match('image.*') ? `<img src="${e.target.result}" alt="${theFile.name}" style="max-width: 100px; max-height: 100px;">` : ''}
                      <p>${theFile.name}</p>
                  `;
                  previewContainer.appendChild(div);
              };
          })(file);
          if (file.type.match('image.*') || file.type === 'application/pdf' || file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || file.name.endsWith('.zip') || 
            file.name.endsWith('.rar')) {
            reader.readAsDataURL(file); // Đọc file
        }
      }
  });

  const dropZone = document.getElementById('drop-zone');
  const fileInput = document.getElementById('images');

  // Kéo thả file
  dropZone.addEventListener('click', () => fileInput.click());

  dropZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropZone.classList.add('border-blue-500');
  });

  dropZone.addEventListener('dragleave', () => {
      dropZone.classList.remove('border-blue-500');
  });

  dropZone.addEventListener('drop', (e) => {
      e.preventDefault();
      dropZone.classList.remove('border-blue-500');
      
      const files = e.dataTransfer.files;
      if (files.length) {
          fileInput.files = files; // Cập nhật danh sách file trong input
          handleFiles(files); // Gọi hàm handleFiles để xử lý
      }
  });

  function handleFiles(files) {
      const previewContainer = document.getElementById('preview-images');
      previewContainer.innerHTML = ''; // Xóa các hình ảnh đã xem trước

      for (let i = 0; i < files.length; i++) {
          const file = files[i];
          const reader = new FileReader();

          if (file.type.match('image.*') || 
                file.type === 'application/pdf' || 
                file.type === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' || 
                file.type === 'application/zip' || 
                file.name.endsWith('.zip') || 
                file.name.endsWith('.rar')) {
              reader.onload = (function(theFile) {
                  return function(e) {
                      const div = document.createElement('div');
                      div.classList.add('image-preview');
                      const icon = getFileIcon(theFile.name);
                      div.innerHTML = `
                      ${file.type.match('image.*') ? 
                    `<img src="${e.target.result}" alt="${theFile.name}" style="width: 100px; height: 100px;">` : 
                    `<i class="${icon}"></i>`
                }
                <p>${theFile.name}</p>
            `;
                      previewContainer.appendChild(div);
                  };
              })(file);
              reader.readAsDataURL(file); // Đọc file dưới dạng URL
          }
      }
  }
  function getFileIcon(fileName) {
      const extension = fileName.split('.').pop().toLowerCase();
      switch (extension) {
          case 'pdf': return 'fas fa-file-pdf text-red-500';
          case 'docx': return 'fas fa-file-word text-blue-500';
          case 'zip':
            return 'fas fa-file-archive text-yellow-500';
        case 'rar':
            return 'fas fa-file-archive text-purple-500';
          case 'gif':
          case 'jpeg':
          default: return 'fas fa-file';
      }
  }

  function toggleUploadDropdown(event) {
        const dropdown = document.getElementById('upload-dropdown');
        dropdown.classList.toggle('active');
        event.stopPropagation(); // Ngăn sự kiện click lan lên document
      }

        // Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            const uploadBtn = document.querySelector(".upload-btn");
            const dropdown = document.getElementById("upload-dropdown");

            if (!dropdown.contains(event.target) && !event.target.classList.contains('upload-btn')) {
                dropdown.classList.remove("active"); // Ẩn dropdown nếu nhấn ra ngoài
            }
        });

        // Ngăn dropdown đóng khi thao tác các phần tử con
        document.getElementById('upload-dropdown').addEventListener('click', function(event) {
            event.stopPropagation();
        });

  function showUploadDropdown() {
    const dropdown = document.getElementById('upload-dropdown');
    dropdown.classList.toggle('active');
    document.getElementById('images').click(); // Tự động mở hộp thoại chọn file
  }

</script>


