<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>imgbb Clone</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .image-preview {
        display: inline-block;
        margin: 10px;
        text-align: center;
    }
    .image-preview img {
        width: 150px;
        height: auto;
        border: 1px solid #ddd;
        padding: 5px;
    }
</style>
</head>

<body class="bg-gray-50">

  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-4">
      <a href="#" class="text-2xl font-bold">imgbb</a>
      <nav>
        <ul class="flex space-x-4">
          <li><a href="#" class="text-gray-700 hover:text-blue-500">Tải ảnh lên</a></li>
          <li><a href="#" class="text-gray-700 hover:text-blue-500">API</a></li>
          <li><a href="#" class="text-gray-700 hover:text-blue-500">Liên hệ</a></li>
          <li><a href="#" class="text-gray-700 hover:text-blue-500">Đăng nhập</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main class="container mx-auto mt-16 flex flex-col items-center">
    <h1 class="text-3xl font-semibold text-gray-700 mb-6 text-center">Tải ảnh lên và chia sẻ</h1>
    <div class="w-full sm:w-3/4 md:w-2/3 lg:w-1/2 bg-gray-100 border-2 border-dashed border-gray-300 p-6 md:p-12 text-center rounded-lg">
  <form action="{{route('file.upload')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session('success'))
      <div>
          {{ session('success') }}
      </div>
    @endif
      <input class="text-gray-600 mb-4" type="file" id="images" name="images[]" multiple><br>
      <div id="preview-images">
      </div>
      <button class="bg-blue-500 text-white py-2 px-6 rounded" type="submit">Upload</button>
  </form>  
    </div>
  </main>

  <!-- Information Section -->
  <section class="mt-8">
    <div class="container mx-auto text-center">
      <p class="text-gray-600">Hỗ trợ tải ảnh nhanh chóng. Định dạng được hỗ trợ: PNG, JPG, GIF.</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-6 mt-10">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 imgbb. <a href="#" class="text-blue-400">Điều khoản sử dụng</a> | <a href="#" class="text-blue-400">Chính sách bảo mật</a></p>
    </div>
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
                  div.innerHTML = `
                      <img src="${e.target.result}" alt="${theFile.name}">
                      <p>${theFile.name}</p>
                  `;
                  previewContainer.appendChild(div);
              };
          })(file);
          reader.readAsDataURL(file);
      }
  });
</script>