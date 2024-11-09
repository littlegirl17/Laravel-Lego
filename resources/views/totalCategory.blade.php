@extends('layout.layout')
@section('title', 'Danh mục')
@section('content')
    <!-- START MAIN -->
    <div class="container mt-3">
        <div class="title_theme_all">
            <h2>Tất cả chủ đề</h2>
        </div>
        <div class="row category_theme">
            @foreach ($categoryAll as $item)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="card_theme_category">
                        <div class="card_theme_category_img">
                            <img src="{{ asset('img/' . $item->image) }}" class="card-img-top" alt="Architecture" />
                        </div>
                        <div class="card_theme_category_content">
                            <h2>{{ $item->name }}</h2>
                            <span>{{ $item->description }}
                            </span>
                            <div class="">
                                <a href="{{ route('categoryProduct', $item->id) }}">Sản phẩm cửa hàng
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
    <!-- END MAIN -->
@endsection
