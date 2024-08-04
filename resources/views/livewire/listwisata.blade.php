<div class="container mt-4">
    <a href="" class="active btn btn-outline-secondary rounded-pill btn-sm">Semua Kategori</a>
    @foreach ($categories as $items)
    <a href="{{url('category', $items->category_name)}}" class="btn btn-outline-secondary rounded-pill btn-sm mt-1">{{$items->category_name}}</a>
    @endforeach
</div>
<div class="container mt-4">
    @if ($listwisata->count())
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-3">
        @foreach ($listwisata as $items)
        <div class="col my-1">
            <div class="card">
                <small>
                    <p class="text-capitalize position-absolute px-1 py-1 text-white rounded-right" style="background-color: rgba(0, 0, 0, 0.322)">{{ $items->category->category_name }}</p>
                </small>
                <img class="card-img-top" src="{{ asset('/storage/images/' . $items->image) }}" alt="Card image cap" style="height:20vh; width:100%">
                <div class="card-body">
                    <h5 class="card-title text-capitalize">{{ $items->title }}</h5>
                    <p class="card-text text-runcate trix-content">{{ Str::limit($items->description, 100) }}</p>
                    <p class="card-text mt-0"><small class="text-muted">Last update {{ $items->updated_at->diffForHumans() }}</small>
                    </p>
                    <a href="{{ route('detail.wisata', $items->id) }}" class="btn btn-primary rounded-pill text-white">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="col mt-5" style="height: 100vh; width:100%">
        <h2 class=" text-danger font-weight-bold text-center">Opss...</h2>
        <h5 class="text-center mt-2">Sementara belum ada data wisata</h5>
    </div>
    @endif
</div>
<footer class="mt-5" id="about" style="background-color: #EFF2F6">
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
            <p>Follow Wisata Jepara on social media</p>
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
        <p>Copyright © {{ date('Y') }} Makarno</p>
    </div>
</footer>
