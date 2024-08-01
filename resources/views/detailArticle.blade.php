@extends('layouts.main')
@section('Conten')
<main>
    <!-- About US Start -->
    <div class="about-area">
        <div class="container">
                <!-- Hot Aimated News Tittle-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                    <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                    <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
               <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Tittle -->
                        <div class="about-right mb-90">
                            <div class="about-img">
                                <img src="{{ asset($dulieu->image_url)}}" alt="">
                            </div>
                            <div class="section-tittle mb-30 pt-30">
                                <h3>{{ $dulieu->title }}</h3>
                            </div>
                            <div class="about-prea">
                                {{-- {{ $dulieu->id }} --}}
                                <p class="about-pera1 mb-25"><b>{{ $dulieu->short_description	 }}</b></p>
                                <p class="about-pera1 mb-25">{!! $dulieu->content !!}</p>
                                <p class="about-pera1 mb-25"><i> Tác giả : {{ $dulieu->tg_name }}</i></p>

                            </div>

                            <div class="social-share pt-30">
                                <div class="section-tittle">
                                    <h3 class="mr-20">Share:</h3>
                                    <ul>
                                        <li><a href="#"><img src="{{ asset('storage/news/icon-ins.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('storage/news/icon-fb.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('storage/news/icon-tw.png')}}" alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('storage/news/icon-yo.png')}}" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        {{-- binh luan  --}}

                        <div class="comments-area">
                            <h4>{{ $sum }} Comments</h4>
                            @foreach ($dataus as $item )


                            <div class="comment-list">
                               <div class="single-comment justify-content-between d-flex">
                                  <div class="user justify-content-between d-flex">
                                     <div class="thumb">
                                        <img src="{{ asset('storage/user/user.svg') }}" alt="">
                                     </div>
                                     <div class="desc">
                                        <p class="comment">
                                                {{ $item->comment }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                           <div class="d-flex align-items-center">
                                              <h5>
                                                 <a href="#">{{ $item->name }}</a>
                                              </h5>
                                              <p class="date">{{ $item->created_at }} </p>
                                           </div>
                                           <div class="reply-btn">
                                              <a href="#" class="btn-reply text-uppercase">reply</a>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                            @endforeach

                            <div class=" blog-pagination  d-flex">
                                {{ $dataus->links('pagination::bootstrap-4') }} <!-- Hiển thị các liên kết phân trang -->
                            </div>

                         </div>
                        <!-- From -->
                        @if(Auth::check())
                        <div class="row">
                            <div class="col-lg-8">
                                <form class="form-contact contact_form mb-80" action="{{ route('cmt') }}" method="post" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                <input type="hidden" name="article_id" value="{{$dulieu->id}}">
                                                <input type="hidden" name="status_cmt" value="1">
                                                <textarea class="form-control w-100 error" name="comment" id="message" cols="30" rows="9" ></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="submit" class="button button-contactForm boxed-btn" value="Send">
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>Follow Us</h3>
                        </div>
                        <!-- Flow Socail -->
                        <div class="single-follow mb-45">
                            <div class="single-box">
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('storage/news/icon-fb.png')}}" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('storage/news/icon-tw.png')}}" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                    <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('storage/news/icon-ins.png')}}" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('storage/news/icon-yo.png')}}" alt=""></a>
                                    </div>
                                    <div class="follow-count">
                                        <span>8,045</span>
                                        <p>Fans</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Poster -->
                        <div class="news-poster d-none d-lg-block">
                            <img src="{{ asset('storage/news/news_card.jpg')}}" alt="">
                        </div>
                    </div>
               </div>
        </div>
    </div>
    <!-- About US End -->
</main>

@endsection
