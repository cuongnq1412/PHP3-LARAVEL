@extends('layouts.layoutadmin')
@push('style')
<script
src="{{ url('https://kit.fontawesome.com/aa64dc9752.js') }}"
crossorigin="anonymous"
></script>
<link
rel="stylesheet"
href="{{ url('https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css') }}"
/>
<link href="{{ asset('admin/DataTables/datatables.min.css') }}" rel="stylesheet" />

<script src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>

@endpush
@section('noidung')
<div class="bg-gray-100 flex-1 p-6 md:mt-16">

    <h1 class="h5"> Thêm bài viết</h1>


</div>

<div class="  p-4 w-40">

  <a href="{{ url('/Article') }}" class="btn">
    <i class="fa-solid fa-list"></i>
    List Post</a>
</div>

<div class="p-6">
    <form action="{{ route('Article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" id="title" style="display: none" name="author_id" value="{{ Auth::user()->id }}">

        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>

        <div class="w-full flex flex-col py-2 ">



        <label for="title" class="text-black  font-semibold pb-1 capitalize">Tiêu đề:</label>
        <input type="text" id="title" class="p-2  border border-[#a5abb5] rounded" name="title">


    {{-- seo  --}}

    <div class="w-full flex flex-row py-2 space-x-4">


        <div class="flex-1 flex flex-col py-2">
          <label for="keymeta" class="text-black font-semibold pb-1 capitalize">Key meta :</label>
          <input id="keymeta" name="key_meta" type="text" class="p-2 border border-[#a5abb5] rounded" required />

        </div>


        <div class="flex-1 flex flex-col py-2">
          <label for="keytitle" class="text-black font-semibold pb-1 capitalize">Key title :</label>
          <input id="keytitle" name="key_title" type="text" class="p-2 border border-[#a5abb5] rounded" required />
        </div>


        <div class="flex-1 flex flex-col py-2">
          <label for="keytitle" class="text-black font-semibold pb-1 capitalize">Key content :</label>
          <input id="keycontent" name="key_content" type="text" class="p-2 border border-[#a5abb5] rounded" required />
        </div>

      </div>

    {{-- end seo --}}

<div class="w-full flex flex-col py-2 ">
  <label for="short_description" class="text-black  font-semibold pb-1 capitalize">Mô tả ngắn:</label>

  <textarea id="short_description" class="p-2  border border-[#a5abb5] rounded" name="short_description"></textarea>

</div>
<div class="w-full flex flex-row py-2 space-x-4">

    <div class="w-1/2 flex flex-col py-2">
        <label for="status" class="text-black font-semibold pb-1 capitalize"> Trạng Thái:</label>
        <select id="status" name="status" class="p-2 border border-[#a5abb5] rounded" required>


            <option value="1">Hiện</option>
            <option value="2"> Ẩn </option>


        </select>


      </div>
    <div class="w-1/2 flex flex-col py-2">
        <label for="category_id" class="text-black font-semibold pb-1 capitalize">Danh mục:</label>
        <select id="category" name="category_id" class="p-2 border border-[#a5abb5] rounded" required>
            @foreach ($danhmuc as $item )

            <option value="{{ $item->id }}">{{ $item ->name }}</option>
            @endforeach

        </select>


      </div>

</div>
<div class="w-full flex flex-col py-2 ">
<label for="content" class="text-black  font-semibold pb-1 capitalize">Nội dung:</label>

<textarea id="editor" class="p-2  border border-[#a5abb5] rounded" name="content"></textarea>

</div>








<div class="w-full flex flex-col py-2 mt-10">
<label for="product_photo" class="text-black   font-semibold pb-1 capitalize"> <i
        class="fa-solid fa-file-image fa-2xl"></i> Tải lên ảnh đại diện </label>
<input type="file" class="product_photo" name="imgpost" id="product_photo"
    class="p-2  hidden border border-[#E8F0FC] rounded" style="display:none">

      <img id="preview_img" class="mt-4 hidden  border border-gray-300 rounded"  style="width: 100px; height: auto;">
</div>


<div class="w-full flex justify-end">
<input type="submit"
  class="hover:text-[#0957CB] bg-[#0957CB] rounded-lg p-3 text-sm font-semibold btn"
  value="Thêm sản Phẩm">
</div>
    </form>

</div>


@endsection

@push('js')
<script>

    let table =  new DataTable('#example');

  </script>
    <script src="{{ asset('admin/js/ckeditor.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('product_photo');
            const previewImg = document.getElementById('preview_img');

            input.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                } else {
                    previewImg.classList.add('hidden');
                }
            });
        });
    </script>


@endpush
@section('add')
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}


@if (session('alert'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = @json(session('alert'));

        Swal.fire({
            icon: alert.type,
            title: alert.type === 'error' ? 'Oops!' : 'Success!',
            text: alert.message,
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@endsection

