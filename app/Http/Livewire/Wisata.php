<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tour;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Wisata extends Component
{
    use WithFileUploads;

    public $count = 5;
    public $locationId, $long, $lat, $title, $description, $image, $category;
    public $imageUrl;
    public $geoJson;
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
        $category = Category::orderBy('id')->get();

        return view('livewire.wisata')->with([
            'cat'=> $category
        ]);
    }

    // public function previewImage()
    // {
    //     if (!$isEdit) {
    //         $this->validate([
    //             'image' => 'image|max:3048'
    //         ]);
    //     }
    // }

    public function store()
    {
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'image|max:20000|required',
        ]);

        $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();
        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        Tour::create([
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imageName,
            'user_id' => Auth::id(),
            'category_id' => $this->category,
        ]);

        session()->flash('info', 'Product Created Successfully');
        $this->clearForm();
        $this->getLocations();
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);
    }

    public function update()
    {
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        $location = Tour::findOrFail($this->locationId);

        if ($this->image) {
            $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();
            Storage::putFileAs(
                'public/images',
                $this->image,
                $imageName
            );
            $updateData = [
                'title' => $this->title,
                'category_id' => $this->category,
                'description' => $this->description,
                'image' => $imageName,
            ];
        } else {
            $updateData = [
                'title' => $this->title,
                'category_id' => $this->category,
                'description' => $this->description,
            ];
        }

        $location->update($updateData);
        session()->flash('info', 'Product Updated Successfully');
        $this->clearForm();
        $this->getLocations();
        $this->dispatchBrowserEvent('updateLocation', $this->geoJson);
    }

    public function deleteLocationById()
    {
        $location = Tour::findOrFail($this->locationId);
        $location->delete();
        $this->clearForm();
        $this->dispatchBrowserEvent('deleteLocation', $location->id);
    }

    public function clearForm()
    {
        $this->long = '';
        $this->lat = '';
        $this->title = '';
        $this->category = '';
        $this->description = '';
        $this->image = '';
        $this->imageUrl = '';
        $this->isEdit = false;
    }

    public function findLocationById($id)
    {
        $location = Tour::findOrFail($id);
        $this->locationId = $id;
        $this->long = $location->long;
        $this->lat = $location->lat;
        $this->title = $location->title;
        $this->description = $location->description;
        $this->imageUrl = $location->image;
        $this->isEdit = true;
    }
}
