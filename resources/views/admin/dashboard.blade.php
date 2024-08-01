@extends('layouts.layoutadmin')
@section('noidung')



        <div class="grid grid-cols-5 gap-5 mt-5 lg:grid-cols-2">
          <!-- nguoi dung -->
          <div class="card col-span-1">
            <div class="card-body">
              <div class="h6 text-green-700 fad fa-users"></div>
              <h5 class="uppercase text-xs tracking-wider font-extrabold">
                Người Dùng
              </h5>
              <h1 class="capitalize text-lg mt-1 mb-1">{{ $sumuser }}</h1>
            </div>
          </div>
          <!-- status -->

          <!-- status -->
          <div class="card col-span-1">
            <div class="card-body">
              <div
                class="bg-teal-200 text-teal-700 border-teal-300 border w-10 h-10 rounded-full flex justify-center items-center"
              >
                <i class="fad fa-eye"></i>
              </div>
              <h1 class="capitalize text-lg mt-1 mb-1">{{ $sumviews }} Views</h1>
            </div>
          </div>
          <!-- status -->

          <!-- status -->
          <div class="card col-span-1">
            <div class="card-body">
              <div class="h6 text-yellow-600 fad fa-sitemap"></div>

              <h1 class="capitalize text-lg mt-1 mb-1"> {{ $sumnews }} Bài viết</h1>
            </div>
          </div>

          <div class="card col-span-1">
            <div class="card-body">
              <i class="fad fa-comments"></i>

              <h1 class="capitalize text-lg mt-1 mb-1">{{ $sumcmt }} Bình Luận </h1>
            </div>
          </div>
          <div class="card col-span-1">
            <div class="card-body">
              <div class="h6 text-red-700 fad fa-store"></div>

              <h1 class="capitalize text-lg mt-1 mb-1">Danh Mục {{ $sumctgr }}</h1>
            </div>
          </div>
          <!-- status -->
        </div>
        <!-- end status -->

        <!-- best seller & traffic -->
        <div class="grid grid-cols-2 lg:grid-cols-1 gap-5 mt-5">
          <div class="card">
            <div class="card-body">
              <div class="flex flex-row justify-between items-center">
                <h1 class="font-extrabold text-lg">Bài Viết Hot</h1>
                <!-- <a href="#" class="btn-gray text-sm">view all</a> -->
              </div>

              <table class="table-auto w-full mt-5 text-right">
                <thead>
                  <tr>
                    <td class="py-4 font-extrabold text-sm text-left">
                      Bài viết
                    </td>
                    <td class="py-4 font-extrabold text-sm">Views</td>
                    <td class="py-4 font-extrabold text-sm">cmt</td>
                  </tr>
                </thead>

                <tbody>
                  <!-- item -->
                  @foreach ($list5newsviewshot as $item )

                  <tr class="">
                    <td
                      class="py-4 text-sm text-gray-600 flex flex-row items-center text-left"
                    >

                      <div class="w-8 h-8 overflow-hidden mr-3">
                        <img src="{{ $item->image_url }}" class="object-cover" />
                      </div>
                     {{ $item->title }}
                    </td>
                    <td class="py-4 text-xs text-gray-600">
                      {{ $item->views }}
                    </td>
                    <td class="py-4 text-xs text-gray-600">
                      {{ $item->comments_count }}
                    </td>
                  </tr>
                  <!-- end item -->

                  @endforeach

                  <!-- end item -->
                </tbody>
              </table>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h2 class="font-bold text-lg mb-10">Người cống hiến</h2>

              <!-- start a table -->
              <table class="table-fixed w-full">
                <!-- table head -->
                <thead class="text-left">
                  <tr>
                    <th
                      class="w-1/2 pb-10 text-sm font-extrabold tracking-wide"
                    >
                      Người dùng
                    </th>
                    <th
                      class="w-1/4 pb-10 text-sm font-extrabold tracking-wide text-right"
                    >
                      Cmt
                    </th>
                    <th
                      class="w-1/4 pb-10 text-sm font-extrabold tracking-wide text-right"
                    >
                      Ngày tham gia
                    </th>
                  </tr>
                </thead>
                <!-- end table head -->

                <!-- table body -->
                <tbody class="text-left text-gray-600">
                  <!-- item -->
                  @foreach ($list5userhot as $item  )


                  <tr>
                    <!-- name -->
                    <th
                      class="w-1/2 mb-4 text-xs font-extrabold tracking-wider flex flex-row items-center w-full"
                    >
                      <div class="w-8 h-8 overflow-hidden rounded-full">
                        <img src="{{ asset('storage/user/user.svg') }}" class="object-cover" />
                      </div>
                      <p class="ml-3">{{ $item->name }}</p>
                    </th>
                    <!-- name -->

                    <!-- product -->
                    <th
                      class="w-1/4 mb-4 text-xs font-extrabold tracking-wider text-right"
                    >
                     {{ $item->comments_count }}
                    </th>
                    <!-- product -->

                    <!-- invoice -->
                    <th
                      class="w-1/4 mb-4 text-xs font-extrabold tracking-wider text-right"
                    >
                      {{ $item->created_at }}
                    </th>
                  </tr>
                  @endforeach
                </tbody>
                <!-- end table body -->
              </table>
              <!-- end a table -->
            </div>
          </div>

@endsection
