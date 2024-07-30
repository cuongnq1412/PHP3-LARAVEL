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
    <h1 class="h5">Bình luận </h1>
  </div>




  <div class="p-6">
  <table id="example" class="display" style="width: 100%">
    <thead>
      <tr>
        <th>Mã Bình Luận</th>
        <th>Mã - Tên Bài Viết</th>
        <th>Mã - Tên</th>
        <th> Bình luận </th>
        <th> Trạng Thái </th>



      </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)


        <tr>
            <td>BL-{{ $item->id }}</td>
            <td>{{ $item->article_id }} - {{ $item->title }}</td>
            <td>{{ $item->user_id }} - {{ $item->name }}</td>
            <td>{{ $item->comment }}</td>
            <td>
                <form action="{{ route('Upstatuscmt',$item->id) }}" method="POST" id="autoSubmitForm{{ $item->id }}">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div id="selectionContainer" >

                        <select id="your_selection{{ $item->id }}" class="p-2 border border-[#a5abb5] rounded" name="status_cmt">
                            <option value="0" {{ $item->status_cmt == 0 ? 'selected' : '' }}>Ấn </option>
                            <option value="1" {{ $item->status_cmt == 1 ? 'selected' : ''}} >Hiện</option>

                        </select>
                    </div>


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
