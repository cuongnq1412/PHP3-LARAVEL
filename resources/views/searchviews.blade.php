@extends('layouts.main')
@section('Conten')
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class=" mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
@if (isset($message))
{{ $message }}
@endif

@if (isset($data) && !$data->isEmpty())

    @foreach ($data as $item )
    <article class="blog_item">
        <div class="blog_item_img">
            <img class="card-img rounded-0" src="{{ asset($item->image_url)}}" alt="">
            <a href="{{ url('Article_detail/'.$item->id) }}" class="blog_item_date">
                <h3>15</h3>
                <p>Jan</p>
            </a>
        </div>

        <div class="blog_details">
            <a class="d-inline-block" href="{{ url('Article_detail/'.$item->id) }}">
                <h2>{{ $item->title }}</h2>
            </a>
            <p>cha </p>

        </div>
    </article>

    @endforeach

@endif
</div>
</div>
</div>
</div>
</section>
@endsection
