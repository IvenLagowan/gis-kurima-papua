<div wire:ignore class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="content text-center">
        <h1 class="text-white font-weight-bold mb-4">WELCOME TO KURIMA</h1>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 gx-5 mb-4">
            <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
                <img src="{{ asset('image/jepara.jpg') }}" class="img-fluid" alt="about" />
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
        </div>
        <div class="col-md-6 gx-5 mb-4">
            <p class="h4">Kabupaten Yahukimo</p>
            <p class="text-muted">
                Tempat wisata di Kabupaten Yahukimo memiliki pesona wisata alam, pantai, budaya, tradisi dan kearifan lokal
                masyarakatnya yang unik dan menarik untuk ditelusuri.Menelusuri kawasan setiap daerah Indonesia memang memiliki
                kisah dan catatan perjalanan tersendiriyang menarik untuk kita kulik dan nikmati dari setiap kisahnya.Hal ini
                tidak terlepas dari sebuah kawasan yang menarik untuk dikunjungi di Kabupaten Jepara, Jawa Tengah yang menyimpan
                beragam destinasi liburan yang populer dan dikenal banyak wisatawan baik lokal maupan mancanegara.
            </p>
            <p class="h4">Apa Daya Tarik Wisata?</p>
            <p class="text-muted">
                Kabupaten Jepara memiliki potensi besar dalam sektor pariwisata. Letak geografis dan sumber daya pantai yang potensial menjadikan Jepara
                patut untuk menonjolkan wisata bahari. Obyek wisata Jepara Ourland Park (JOP) merupakan obyek wisata bahari di Kabupaten jepara yang diresmikan gubernur Jawa Tengah
                sebagai wisata bahari terbesar dan terlengkap di Jawa Tengah. Kunjungan wisatawan ke destinasi wisata didasarkan pada berbagai pertimbangan,
                namun faktor paling essensial yang mempengaruhi adalah persepsi wisatawan tentang hubungan antara karakteristik
                destinasi dan kebutuhan akan pemenuhan hasratnya untuk berwisata
            </p>
        </div>
    </div>
</div>
<div class="container">
    <hr class="my-5" />
    <h3 class="text-center font-weight-bold mt-5 mb-4">WISATA TERBARU</h3>
    <P class="text-center mb-5">Wisata Terbaru adalah wisata yang paling baru ditambahkan oleh admin. di dalam wisata jepara, mempunyai beragam wisata yang paling sering di kunjungi oleh wisatawan
        mancanegara adalah karimunjawa.
        karimunjawa mempunyai pantai yang bersih air laut yang jernih dan bermacam macam ekosistem yang masih alamai.
    </P>
</div>
<div class="container">
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
        <div class="carousel-inner py-4">
            <div class="carousel-item active">
                <div class="container">
                    @if ($tours->count())
                    <div class="row d-flex justify-content-end">
                        <a class="nav-link mb-2 text-primary text-black-50" href="{{ route('list.wisata') }}">Tampilkan Semua</a>
                    </div>
                    <div class="row">
                        @foreach ($tours->take(3) as $wisata)
                        <div class="col-lg-4">
                            <div class="card">
                                <small>
                                    <p class="text-capitalize position-absolute px-1 py-1 text-white rounded-right" style="background-color: rgba(0, 0, 0, 0.322)">{{ $wisata->category->category_name
                                        }}</p>
                                </small>
                                <img src="{{ asset('/storage/images/' . $wisata->image) }}" class="card-img-top" alt="Waterfall" style="height: 25vh; width:100%" />
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $wisata->title }}</h5>
                                    <p class="card-text text-runcate trix-content">
                                        {{ Str::limit($wisata->description, 100) }} <small class="font-weight-bold">{{$wisata->created_at->diffForHumans()}}</small></p>
                                    <a href="{{ route('detail.wisata', $wisata->id) }}" class="btn btn-primary rounded-pill">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <h2 class="text-danger font-weight-bold">Opss...</h2>
                    <h5>belum ada wisata terbaru</h1>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr class="my-5" />
    <h3 class="text-center font-weight-bold mt-5 mb-4">SEMUA WISATA</h3>
    <P class="text-center mb-5">Kota jepara juga terkenal akan keindahan obyek wisatanya , salah satunya contohnya adalah Wisata Pantai Jepara Jateng ini. Pantai yang terletak di pesisir pantai utara
        Jawa ini menjadi salah satu
        tempat wisata yang cukup menarik untuk dikunjungi.salah satu obyek wisata unggulan di Jepara, kota kelahiran salah satu Pahlawan Nasional R.A. Kartini.</P>
</div>
<div class="container mt-5">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 border-primary">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div wire:ignore id='map' class="border border-grey mb-5" style='width: 100%; height: 70vh'></div>
        </div>
    </div>
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
        <p>Copyright © {{ date('Y') }} Dev Iven</p>
    </div>
</footer>


@push('script')
<script>
    document.addEventListener('livewire:load', () => {
            const defaultLocation = [110.81363804016411, -6.562986445856168];
            const coordinateInfo = document.getElementById('info');
            mapboxgl.accessToken = "{{ env('KEY_MAPBOX') }}";
            let map = new mapboxgl.Map({
                container: "map",
                center: defaultLocation,
                zoom: 9,
                style: "mapbox://styles/mapbox/streets-v11",
                interactive: true
            });
            map.addControl(new mapboxgl.NavigationControl());
            const loadGeoJSON = (geojson) => {
                geojson.features.forEach(function(marker) {
                    const {
                        geometry,
                        properties
                    } = marker
                    const {
                        iconSize,
                        locationId,
                        title,
                        image,
                        description
                    } = properties
                    // Costum marker
                    let el = document.createElement('div');
                    el.className = 'marker' + locationId;
                    el.id = locationId;
                    el.style.backgroundImage = 'url({{ asset('image/marker.png') }})';
                    el.style.backgroundSize = 'cover';
                    el.style.width = iconSize[0] + 'px';
                    el.style.height = iconSize[1] + 'px';
                    const pictureLocation = '{{ asset('/storage/images') }}' + '/' + image

                    const content = `
                        <div style="overflow-y: auto; max-height:400px; width:100%;" class="mt-2">
                            <a>${title}</a>
                        </div>`;
                    let popup = new mapboxgl.Popup({
                        offset: [0, -16]
                    }).setHTML(content).setMaxWidth("400px");

                    el.addEventListener('click', (e) => {
                        const locationId = e.toElement.id
                        @this.findLocationById(locationId)

                    });
                    new mapboxgl.Marker(el)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popup)
                        .addTo(map);
                });
            }
            loadGeoJSON({!! $geoJson !!})
            //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
            const style = "light-v11"
            map.setStyle(`mapbox://styles/mapbox/${style}`);
            const getLongLatByMarker = () => {
                const lngLat = marker.getLngLat();
                return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            }
        })
</script>
@endpush
