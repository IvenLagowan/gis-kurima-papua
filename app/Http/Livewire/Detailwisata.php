<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use Livewire\Component;

class Detailwisata extends Component
{

    public $wisata;
    public $locationId, $long, $lat, $title, $description, $image, $updated_at;
    public $imageUrl;
    public $geoJson;
    public function mount($id)
    {
        $wisata = Tour::findOrFail($id);
        $this->title = $wisata->title;
        $this->description = $wisata->description;
        $this->imageUrl = $wisata->image;
        $this->updated_at = $wisata->updated_at;
        $this->lat = $wisata->lat;
        $this->long = $wisata->long;
        $customLocation = [];
        $customLocation[] = [
            'type' => 'Feature',
            'geometry' => [
                'coordinates' => [
                    $wisata->long, $wisata->lat
                ],
                'type' => 'Point'
            ],
            'properties' => [
                'message' => $wisata->description,
                'iconSize' => [27, 33],
                'locationId' => $wisata->id,
                'title' => $wisata->title,
                'image' => $wisata->image,
                'description' => $wisata->description
            ]
        ];

        $geoLocations = [
            'type' => 'Feature',
            'features' => $customLocation
        ];

        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;

        return view('livewire.detailwisata');
    }
}
