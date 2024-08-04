<?php

namespace App\Http\Livewire;

use App\Models\Tour;
use App\Models\Wisata;
use Livewire\Component;

class Welcome extends Component
{
    public $count = 0;
    public $locationId, $long, $lat, $title, $description, $image;
    public $imageUrl;
    public $geoJson;
    public $created_at;
    public $isEdit = false;

    private function getLocations()
    {
        $locations = Tour::orderBy('created_at', 'desc')->get();
        $customLocation = [];
        foreach ($locations as $location) {
            $customLocation[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [
                        $location->long, $location->lat
                    ],
                    'type' => 'Point'
                ],
                'properties' => [
                    'message' => $location->description,
                    'iconSize' => [27, 33],
                    'locationId' => $location->id,
                    'title' => $location->title,
                    'image' => $location->image,
                    'description' => $location->description
                ]
            ];
        };
        $geoLocations = [
            'type' => 'FeatureCollection',
            'features' => $customLocation
        ];
        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;
    }
    public function render()
    {
        $this->getLocations();
        return view('livewire.welcome', [
            'tours' => Tour::orderBy('created_at', 'desc')->get()
        ]);
    }
}
