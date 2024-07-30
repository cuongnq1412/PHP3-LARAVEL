@extends('layouts.layoutadmin')
@push('style')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
{{-- noi dung  --}}
<div class="bg-gray-100 flex-1 p-6 ">

    <h1 class="h5"> @isset($dataid)
       Chỉnh sửa danh mục
        @else
        Danh mục
        @endisset
    </h1>


</div>
@isset($dataid)
<div class=" p-2" style="width: 200px">

    <a href="{{ route('Category.create') }}" class="btn">
        <i class="fa-solid fa-plus"></i>
      Add category</a>
  </div>
@endisset
<form
        @isset($dataid)
       action=" {{ route('Category.update',$dataid->id) }}"

        @else
       action=" {{ route('Category.store') }}"
        @endisset
            " method="POST" enctype="multipart/form-data">
    @csrf
    @isset($dataid)
    @method('PUT')
    @endisset

<div class="p-6">

<div class="w-full flex flex-col py-2 ">

    <label for="name" class="text-black  font-semibold pb-1 capitalize">Tên danh mục :</label>
    <input type="text" id="name" class="p-2  border border-[#a5abb5] rounded" name="name"
    @isset($dataid)
    value="{{ $dataid ->name}}"
    @endisset
    >

</div>
<div class="w-full flex flex-col py-2 ">

    <label for="description" class="text-black  font-semibold pb-1 capitalize"> Mo ta :</label>
    <input type="text" id="description" class="p-2  border border-[#a5abb5] rounded" name="description"
    @isset($dataid)
    value="{{ $dataid ->description }}"
    @endisset
    >

</div>
<div class="w-full flex flex-col py-2 mt-10">
    <label for="product_photo" class="text-black   font-semibold pb-1 capitalize"> <i
            class="fa-solid fa-file-image fa-2xl"></i> Tải lên ảnh sản phẩm </label>
    <input type="file" class="product_photo" name="img_category" id="product_photo"
        class="p-2  hidden border border-[#E8F0FC] rounded" style="display:none">
        <img id="preview_img" style="width: 100px; height: auto;"
        @isset($dataid)
        class="mt-4 border border-gray-300 rounded"
        src="{{ asset($dataid->img_category) }}"
        @else
        class="mt-4 hidden border border-gray-300 rounded"
        @endisset
        >

</div>
<div class="w-full flex justify-end">
    <input type="submit"
        class="hover:text-[#0957CB] bg-[#0957CB] rounded-lg p-3 text-sm font-semibold btn"
        @isset($dataid)
value="Chỉnh sửa"
        @else
value="Thêm mới"
        @endisset>

</div>
</form>
</div>


</div>
<div class="card mt-4" >
<div class="p-6">
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Mã Danh Mục</th>
                <th>Tên Danh mục</th>
                <th>Ngày tạo</th>
                <th>ảnh</th>
                <th>chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item )

            <tr>
                <td>DM-{{ $item ->id }}</td>
                <td>{{ $item ->name }}</td>
                <td>{{ $item ->created_at }}</td>
                <td> <img src="{{ asset("$item->img_category") }}" width="100px" ></td>
                <td><a href="{{ route('Category.edit',$item->id) }}" class="text-black">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a></td>
                <td onclick="confirmDelete(event,{{ $item->id }})">
                    <form id="delete-form-{{ $item->id }}" action="{{ route('Category.destroy', $item->id) }}" method="POST" style="display:inline;" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="border: none; background: none; color: red; cursor: pointer;"  >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>




@endsection

@push('js')
<script>

    let table =  new DataTable('#example');

  </script>
    <script src="{{ asset('admin/js/ckeditor.js')}}"></script>
    <script>
        function confirmDelete(event, categoryID) {
            event.preventDefault(); // Ngăn không cho form gửi ngay lập tức

            Swal.fire({
                title: "Bạn chắc chứ?",
                text: "Nếu đồng ý sẽ không thể khôi phục! - sẽ xóa luôn các tin tức của danh mục này !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form nếu người dùng xác nhận
                    document.getElementById(`delete-form-${categoryID}`).submit();
                }
            });
        }
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
