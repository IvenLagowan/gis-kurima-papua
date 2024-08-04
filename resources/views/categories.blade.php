@extends('layouts.app')
@section('content')
<div class="container mt-5">
    @if ($wisata->count())
    <div class="row container my-2">
        <a href="{{route('list.wisata')}}">
            <i class="bi h3 bi-arrow-left-circle-fill"></i>
        </a>
        <h5 class="my-1 mx-2 text-capitalize">Wisata kategori {{$category}}</h5>
    </div>
    <div class="row mt-4 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-3">
        @foreach ($wisata as $tour)
        <div class="col my-1">
            <div class="card">
                <img class="card-img-top" src="{{ asset('/storage/images/' . $tour->image) }}" alt="Card image cap" style="height:20vh; width:100%">
                <div class="card-body">
                    <h5 class="card-title text-capitalize">{{ $tour->title }}</h5>
                    <p class="text-capitalize">{{ Str::limit($tour->description, 100) }}</p>
                    <p class="card-text"><small class="text-muted">Last update {{ $tour->updated_at->diffForHumans() }}</small>
                    </p>
                    <a href="{{ route('detail.wisata', $tour->id) }}" class="btn btn-primary rounded-pill text-white">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="col mt-5" style="height: 100vh; width:100%">
        <h2 class=" text-danger font-weight-bold text-center">Opss...</h2>
        <h5 class="text-center mt-2">Sementara belum ada data wisata dengan kategori {{$category}}</h5>
    </div>
    @endif
</div>
<footer class="mt-2" id="about" style="background-color: #EFF2F6">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-1 py-5 justify-content-center">
            <div class="col">
                <p class="text-dark text-center fs-6 mt-0 mb-sm-3 opacity-75">Kamu tidak perlu bimbang, apakah kamu
                    akan
                    sukses atau gagal. Karena, orang sukses tidak pernah percaya mengenai kegagalan. Dia hanya
                    percaya bahwa dia sedang Menemukan suatu cara untuk tidak mencapai hasil yang dia harapkan</p>

            </div>
        </div>
        <hr class="my-2" />
        <div class="text-center py-4 align-items-center">
            <p>Follow Wisata Jkurima on social media</p>
            <a href="https://youtube.com" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-youtube"></i>
            </a>
            <a href="https://id-id.facebook.com/" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://twitter.com/i/flow/login" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-twitter"></i>
            </a>
        </div>
    </div>
    <div class="text-center py-3 align-items-center" style="background-color: #D7D9DD">
        <p>Copyright © {{ date('Y') }} Chua</p>
    </div>
</footer>
@endsection
