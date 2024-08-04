<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div wire:ignore id="map" style='width: 100%; height: 88vh;' class="border border-dark "></div>
        </div>
        <div class="col-sm-4">
            <div class="card border border-dark">
                <div class="card-header bg-transparent text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>FORM WISATA</span>
                        @if ($isEdit)
                        <button wire:click="clearForm" class="btn btn-success active">New Wisata</button>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="background-color: #FFFFFF">
                    <form @if ($isEdit) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark">Longtitude</label>
                                    <input type="text" wire:model="long" class="form-control light-input" {{ $isEdit ? 'disabled' : null }} />
                                    @error('long')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-dark">Latitude</label>
                                    <input type="text" wire:model="lat" class="form-control light-input" {{ $isEdit ? 'disabled' : null }} />
                                    @error('lat')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Nama Wisata</label>
                            <input type="text" wire:model="title" class="form-control light-input" />
                            @error('title')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Kategori Wisata</label>
                            <div class="input-group">
                                <select class="custom-select text-dark" id="inputGroupSelect02" wire:model='category'>
                                    <option selected>Select category...</option>
                                    @foreach ($cat as $cats)
                                    <option value="{{$cats->id}}">{{$cats->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Description Wisata</label>
                            <textarea wire:model="description" class="form-control light-input"></textarea>
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Foto Wisata</label>
                            <div class="custom-file light-input">
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label light-input" for="customFile">Choose file</label>
                            </div>
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid mt-3" alt="Preview Image">
                            @endif
                            @if ($imageUrl && !$image)
                            <img src="{{ asset('/storage/images/' . $imageUrl) }}" class="img-fluid" alt="Preview Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn active btn-{{ $isEdit ? 'success text-white' : 'primary' }} btn-block">{{ $isEdit ? 'Update Wisata' : 'Simpan Wisata' }}</button>
                            @if ($isEdit)
                            <button wire:click="deleteLocationById" type="button" class="btn btn-danger active btn-block">Delete Wisata</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="info" style="display:none"></div>

@push('script')
<script>
    document.addEventListener('livewire:load', () => {
            const defaultLocation = [110.79777480684118, -6.520208705683729];
            const coordinateInfo = document.getElementById('info');
            mapboxgl.accessToken = "{{ env('KEY_MAPBOX') }}";
            let map = new mapboxgl.Map({
                container: "map",
                center: defaultLocation,
                zoom: 10,
                style: "mapbox://styles/mapbox/streets-v11"
            });

            map.addControl(new mapboxgl.NavigationControl());
            // my location
            map.addControl(
                new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true,
                    showUserHeading: true
                })
            );

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

                    let el = document.createElement('div');
                    el.id = locationId;
                    el.className = 'marker' + locationId;
                    el.style.backgroundImage = 'url({{ asset('image/marker.png') }})';
                    el.style.backgroundSize = 'cover';
                    el.style.width = iconSize[0] + 'px';
                    el.style.height = iconSize[1] + 'px';

                    //ambil gambar dari storage
                    const pictureLocation = '{{ asset('/storage/images') }}' + '/' + image
                    const content = `
                    <div style="overflow-y: auto; max-height:400px; width:100%;" class="mt-2">
                        <a>${title}</a>
                    </div>`;
                    let popup = new mapboxgl.Popup({
                        offset: [0, -16]
                    }).setHTML(content).setMaxWidth("400px");


                    el.addEventListener('click', (e) => {
                        const locat = e.target.id
                        @this.findLocationById(locat)
                    });

                    new mapboxgl.Marker(el)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popup)
                        .addTo(map);
                });
            }

            loadGeoJSON({!! $geoJson !!})

            // fungsi tambah wisata
            window.addEventListener('locationAdded', (e) => {
                Swal.fire({
                    icon: 'success',
                    title: 'success',
                    text: 'Wisata baru berhasil ditambahkan!',
                }).then((value) => {
                    loadGeoJSON(JSON.parse(e.detail))
                });
            })

            // fungsi delete wisata
            window.addEventListener('deleteLocation', (e) => {
                console.log(e.detail);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your location delete sucessfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then((value) => {
                    $('.marker' + e.detail).remove();
                    $('.mapboxgl-popup').remove();
                });
            })
            // fungsi edit wisata
            window.addEventListener('updateLocation', (e) => {
                console.log(e.detail);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your location update sucessfully!',
                    showConfirmButton: false,
                    timer: 1500
                }).then((value) => {
                    loadGeoJSON(JSON.parse(e.detail))
                    $('.mapboxgl-popup').remove();
                });
            })
            //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
            const style = "streets-v9"
            map.setStyle(`mapbox://styles/mapbox/${style}`);
            const getLongLatByMarker = () => {
                const lngLat = marker.getLngLat();
                return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            }

            map.on('click', (e) => {
                const lat = e.lngLat.lat;
                const long = e.lngLat.lng;
                console.log(lat, long);
                if (@this.isEdit) {
                    return
                } else {
                    coordinateInfo.innerHTML = JSON.stringify(e.point) + '<br />' + JSON.stringify(e.lngLat
                        .wrap());
                    @this.long = e.lngLat.lng;
                    @this.lat = e.lngLat.lat;
                }
            });
        })
</script>
@endpush
