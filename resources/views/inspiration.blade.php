@extends('layout.layout')
@section('title', 'Cảm hứng cho bộ Lego')
@section('content')
    <!-- START MAIN -->

    <section class="inspiration_section m-0 p-0">
        <div class="m-0 p-0">
            <div class="inspiration_title">
                <h2>Cảm hứng cho bộ LEGO®</h2>
            </div>
            <div class="inspiration_banner">
                @foreach ($banners as $item)
                    @if ($item->position == 4 && $item->status == 1)
                        @foreach ($item->bannerImages as $image)
                            @if ($image->status == 1)
                                <div class="inspiration_banner_img">
                                    <img src="{{ asset('img/' . $image->image_desktop) }}" alt="" />
                                </div>
                                <div class="inspiration_banner_content">
                                    <h2>{{ $image->title }}</h2>
                                    <span>{{ $image->description }}
                                    </span>
                                </div>
                            @break
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="inspiration_banner_mobile">
            @foreach ($banners as $item)
                @if ($item->position == 4 && $item->status == 1)
                    @foreach ($item->bannerImages as $image)
                        @if ($image->status == 1)
                            <div class="inspiration_banner_mobile_image">
                                <img src="{{ asset('img/' . $image->image_mobile) }}" alt="" />
                            </div>
                            <div class="inspiration_banner_mobile_text">
                                <h2 class="inspiration_banner_mobile_text_h2">{{ $image->title }}
                                </h2>
                                <span class="inspiration_banner_mobile_text_span">{{ $image->description }}</span>
                            </div>
                        @break
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>

    <div class="container-fluid">
        <div class="two_title_inspiration">
            <h2>Chia sẻ với chúng tôi
            </h2>
        </div>
        <div class="box_image_inspiration">
            <ul>
                @foreach ($inspirationBuildImageById as $item)
                    <li>
                        <a href="#">
                            <div class="box_image_inspiration_img">
                                <img src="{{ asset('img/' . $item->images) }}" alt="" />
                            </div>
                            <span
                                onclick="window.location.href='{{ route('detail', $item->comment->product->slug) }}'">Mua
                                ngay</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</section>

<!-- END MAIN -->

@endsection
