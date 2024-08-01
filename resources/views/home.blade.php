@extends('layouts.main')
@section('Conten')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix">
      <div class="container">
        <div class="trending-main">
          <!-- Trending Tittle -->
          <div class="row">
            <div class="col-lg-12">
              <div class="trending-tittle">
                <strong> Thông báo </strong>
                <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                <div class="trending-animated">
                  <ul id="js-news" class="js-hidden">
                    <li class="news-item">
                     Chào mừng bạn đến với trang tin tức Az Neww
                    </li>
                    <li class="news-item">
                      Chúc bạn một ngày tốt lành ......
                    </li>
                    <li class="news-item">
                      Trang tin tức cập nhật những thông tin bổ ích nhất
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8">
              <!-- Trending Top -->
              <div class="trending-top mb-30">
                <div class="trend-top-img">
                  <img src="{{ asset($data->image_url)}}" width="300px"  alt="" />
                  <div class="trend-top-cap">
                    <span>{{ $data->categories_name }}</span>
                    <h2>
                      <a href="{{ url("Article_detail/".$data->id) }}"
                        >{{ $data->title }}</a>
                    </h2>
                  </div>
                </div>
              </div>
              <!-- Trending Bottom -->
              <div class="trending-bottom">
                <div class="row">
                    @foreach ( $data1 as $item )


                  <div class="col-lg-4">
                    <div class="single-bottom mb-35">
                      <div class="trend-bottom-img mb-30">
                        <img
                          src="{{ asset($item->image_url)}}"


                          alt=""
                        />
                      </div>
                      <div class="trend-bottom-cap">
                        <span class="color1">{{$item-> categories_name}}</span>
                        <h4>
                          <a href="{{ url("Article_detail/".$item->id) }}"
                            >{{ $item -> title }}</a
                          >
                        </h4>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <!-- Riht content -->
            <div class="col-lg-4">
            @foreach ($data2 as $item )


              <div class="trand-right-single d-flex">
                <div class="trand-right-img">
                  <img src="{{ asset($item->image_url)}}" alt=""  width="100px" />
                </div>
                <div class="trand-right-cap">
                  <span class="color1">{{ $item -> categories_name }}</span>
                  <h4>
                    <a href="{{ url("Article_detail/".$item->id) }}"
                      >{{ $item ->title }}</a
                    >
                  </h4>
                </div>
              </div>
              @endforeach
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- Trending Area End -->
    <!--   Weekly-News start -->
    <div class="weekly-news-area pt-50">
      <div class="container">
        <div class="weekly-wrapper">
          <!-- section Tittle -->
          <div class="row">
            <div class="col-lg-12">
              <div class="section-tittle mb-30">
                <h3>Tin Tức Hàng Tuần</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="weekly-news-active dot-style d-flex dot-style">
                @foreach ($data3 as $item )

                <div class="weekly-single">
                  <div class="weekly-img">
                    <img src="{{ asset($item->image_url)}}" alt="" />
                  </div>
                  <div class="weekly-caption">
                    <span class="color1">{{ $item->categories_name }}</span>
                    <h4>
                      <a href="{{ url("Article_detail/".$item->id) }}">{{ $item->title }}</a>
                    </h4>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Weekly-News -->



    <!--  Recent Articles start -->
    <div class="recent-articles">
      <div class="container">
        <div class="recent-wrapper">
          <!-- section Tittle -->
          <div class="row">
            <div class="col-lg-12">
              <div class="section-tittle mb-30">
                <h3>  Danh mục</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="recent-active dot-style d-flex dot-style">
                @foreach ($data5 as $item )

                <div class="single-recent mb-100">
                  <div class="what-img">
                    <img src="{{ asset($item->img_category)}}" alt="" />
                  </div>
                  <div class="what-cap">
                    <span class="color1">{{ $item ->name }}</span>
                    <h4 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                      <a href="{{ url("Categories/".$item->id) }}">{{ $item->description }}</a>
                    </h4>
                  </div>
                </div>
                @endforeach


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

@endsection
