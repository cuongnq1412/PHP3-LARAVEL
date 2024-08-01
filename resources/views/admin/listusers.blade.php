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
 <div class="card">
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
    <h1 class="h5">Bình luận </h1>
  </div>




  <div class="p-6">
  <table id="example" class="display" style="width: 100%">
    <thead>
      <tr>
        <th> Id</th>
        <th> Họ Tên</th>
        <th>Email</th>
        <th> Ngày Tạo </th>
        <th> Quyền </th>
        <th> Trạng Thái </th>



      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)


        <tr>
            <td>BL-{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->role }}</td>
            <td>
                <form action="{{ route('Upstatususer',$item->id) }}" method="POST" id="autoSubmitForm{{ $item->id }}">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div id="selectionContainer" >

                        <select id="your_selection{{ $item->id }}" class="p-2 border border-[#a5abb5] rounded" name="status">
                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Khóa </option>
                            <option value="1" {{ $item->status == 1 ? 'selected' : ''}} >Hoạt Động</option>

                        </select>
                    </div>


                </form>


            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
 </div>
@endsection
@push('js')
<script>
       document.querySelectorAll('select[id^="your_selection"]').forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            var id = this.id.replace('your_selection', '');
            document.getElementById('autoSubmitForm' + id).submit();
        });
    });

</script>
<script>

    let table =  new DataTable('#example');

  </script>
@endpush
