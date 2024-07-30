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
<div class="bg-gray-100 flex-1 p-6">
            <h1 class="h5">Bai viet</h1>
          </div>

            <div class="p-4 w-40">
              <a href="{{ url('/Article/create') }}" class="btn">
                <i class="fa-solid fa-plus"></i>
                Add Post</a
              >
            </div>


          <div class="p-6">
          <table id="example" class="display" style="width: 100%">
            <thead>
              <tr>
                <th>Mã Bài viết</th>
                <th>Tên bài viết</th>
                <th>mô tả</th>
                <th>mã - tên Danh mục</th>
                <th>ngày đăng</th>

                <th>ảnh</th>
                <th>chỉnh sửa</th>
                <th>Xóa</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item )

              <tr>
                  <td>{{ $item->id }}   </td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->short_description }}</td>
                <td>MD{{ $item->category_id }}-{{ $item->category_name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <img src="{{ asset("$item->image_url") }}" width="100px" >
                    </td>

                <td><a href="{{ route('Article.edit',$item->id) }}" class="text-black">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a></td>
                <td onclick="confirmDelete(event,{{ $item->id }})">
                    <form id="delete-form-{{ $item->id }}" action="{{ route('Article.destroy', $item->id) }}" method="POST" style="display:inline;" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="border: none; background: none; color: red; cursor: pointer;">
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
        function confirmDelete(event, articleId) {
            event.preventDefault(); // Ngăn không cho form gửi ngay lập tức

            Swal.fire({
                title: "Bạn chắc chứ?",
                text: "Nếu đồng ý sẽ không thể khôi phục!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form nếu người dùng xác nhận
                    document.getElementById(`delete-form-${articleId}`).submit();
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
