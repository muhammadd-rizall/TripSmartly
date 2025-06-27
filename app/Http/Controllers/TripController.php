<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Region;
use App\Models\Trip;
use App\Models\TripDestination;
use App\Models\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    //--------
    //Open Trip
    //--------


    //tampilan tabel rental item
    public function indexTrip()
    {
        $trips = Trip::latest()->paginate(10);
        return view('trip.data_trip', compact('trips'));
    }

    public function create()
    {
        $categories = Categories::all();
        $regions = Region::all();
        return view('trip.create_trip', compact('categories', 'regions'));
    }

    //input data trip
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string',
            'category_id'    => 'required|exists:rizal_categories,id',
            'region_id'      => 'required|exists:rizal_regions,id',
            'description'    => 'nullable|string',
            'meeting_point'  => 'required|string',
            'base_price'     => 'required|numeric|min:0',
            'quota'          => 'required|integer',
            'includes'       => 'required|string',
            'excludes'       => 'required|string',
            'image'          => 'required|image|mimes:jpg,png,jpeg,webp',
            'status'         => 'required|string'
        ]);

        //ambil input file dan simpan ke storage
        $images = null;
        if ($request->hasFile('image')) {
            $images = $request->file('image')->store('trip', 'public');
        }

        Trip::create(
            [
                'title'          => $validated['title'],
                'category_id'    => $validated['category_id'],
                'region_id'      => $validated['region_id'],
                'description'    => $validated['description'],
                'meeting_point'  => $validated['meeting_point'],
                'base_price'     => $validated['base_price'],
                'quota'          => $validated['quota'],
                'includes'       => array_map('trim', explode(',', $validated['includes'])),
                'excludes'       => array_map('trim', explode(',', $validated['excludes'])),
                'image'          => $images,
                'status'         => $validated['status'],
            ]
        );

        return redirect('/trip')->with('succes', 'Item Rental Saved Successfully');
    }

    //edit trip
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $categories = Categories::all();
        $regions = Region::all();

        // Konversi array ke string join
        $trip->includes = is_array($trip->includes) ? implode("\n", $trip->includes) : $trip->includes;
        $trip->excludes = is_array($trip->excludes) ? implode("\n", $trip->excludes) : $trip->excludes;

        return view('trip.edit_trip', compact('trip', 'categories', 'regions'));
    }

    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'title'          => 'required|string',
            'category_id'    => 'required|exists:rizal_categories,id',
            'region_id'      => 'required|exists:rizal_regions,id',
            'description'    => 'nullable|string',
            'meeting_point'  => 'required|string',
            'base_price'     => 'required|numeric|min:0',
            'quota'          => 'required|integer',
            'includes'       => 'required|string',
            'excludes'       => 'required|string',
            'image'          => 'required|image|mimes:jpg,png,jpeg,webp',
            'status'         => 'required|string'
        ]);

        $trip = Trip::findOrFail($id);

        if ($request->hasFile('image')) {
            $images = $request->file('image')->store('trip', 'public');
            $trip->image = $images;
        }

        //update data
        $trip->title = $validated['title'];
        $trip->category_id = $validated['category_id'];
        $trip->region_id = $validated['region_id'];
        $trip->description = $validated['description'];
        $trip->meeting_point = $validated['meeting_point'];
        $trip->base_price = $validated['base_price'];
        $trip->quota = $validated['quota'];
        $trip->includes = array_map('trim', explode(',', $validated['includes']));
        $trip->excludes = array_map('trim', explode(',', $validated['excludes']));
        $trip->status = $validated['status'];
        $trip->save();

        return redirect('/trip');
    }

    //delete trip
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);

        // Jika ada file gambar, hapus juga (opsional)
        if ($trip->image && Storage::disk('public')->exists($trip->image)) {
            Storage::disk('public')->delete($trip->image);
        }

        $trip->delete();

        return redirect('/trip')->with('success', 'Item berhasil dihapus.');
    }


    //-------------
    //Trip Schedule
    //-------------
    public function indexSchedule()
    {
        $tripSchedules = TripSchedule::latest()->paginate(10);
        return view('tripSchedule.trip_schedule', compact('tripSchedules'));
    }

    public function createSchedule()
    {
        $tripSchedules = trip::all();
        return view('tripSchedule.create_trip_schedule', compact('tripSchedules'));
    }

    //input
    public function storeSchedule(Request $request)
    {
        $validated = $request->validate([
            'trip_id'       => 'required|exists:rizal_trip,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
            'quota'         => 'nullable|integer',
            'price'         => 'nullable|numeric|min:0',
            'status'        => 'required|string'
        ]);

        TripSchedule::create(
            [
                'trip_id'          => $validated['trip_id'],
                'start_date'       => $validated['start_date'],
                'end_date'         => $validated['end_date'],
                'quota'            => $validated['quota'],
                'price'            => $validated['price'],
                'status'           => $validated['status'],
            ]
        );

        return redirect('/trip-schedule')->with('succes', 'Item Rental Saved Successfully');
    }


    //edit
    public function editSchedule($id)
    {
        $tripS = TripSchedule::findOrFail($id);
        $tripSchedules = Trip::all();


        return view('tripSchedule.edit_trip_schedule', compact('tripS', 'tripSchedules'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $validated = $request->validate([
            'trip_id'       => 'required|exists:rizal_trip,id',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date',
            'quota'         => 'nullable|integer',
            'price'         => 'nullable|numeric|min:0',
            'status'        => 'required|string'
        ]);

        $tripS = TripSchedule::findOrFail($id);
        $tripS->trip_id = $validated['trip_id'];
        $tripS->start_date =$validated['start_date'];
        $tripS->end_date =$validated['end_date'];
        $tripS->quota =$validated['quota'];
        $tripS->price =$validated['price'];
        $tripS->status =$validated['status'];
        $tripS->save();

        return redirect('/trip-schedule');
    }


    //hapus
    public function destroySchedule($id)
    {
        $tripS = TripSchedule::findOrFail($id);

        $tripS->delete();

        return redirect('/trip-schedule')->with('success', 'Item berhasil dihapus.');
    }


    //-------------
    //Trip Destination
    //-------------
    public function indexTD()
    {
        $tds = TripDestination::latest()->paginate(10);
        return view('tripDestination.data_trip_destination', compact('tds'));
    }

    public function createTD()
    {
        $trips = Trip::all();
        return view('tripDestination.create_trip_destination', compact('trips'));
    }


    public function storeTD(Request $request)
    {
        $request->validate([
            'trip_id' => 'required|exists:rizal_trip,id',
            'places' => 'required|string',
            'description' => 'required|string',
        ]);

        $placesArray = preg_split('/\r\n|\r|\n/', $request->places);
        $placesArray = array_filter(array_map('trim', $placesArray));
        $combinedPlaces = implode(', ', $placesArray);

        TripDestination::create([
            'trip_id' => $request->trip_id,
            'place_name' => $combinedPlaces,
            'description' => $request->description,
        ]);

        return redirect('/trip-destination')->with('success', 'Data berhasil disimpan!');
    }


    public function editTD($id)
    {
        $td = TripDestination::findOrFail($id);
        $trips = Trip::all();
        return view('tripDestination.edit_trip_destination', compact('td', 'trips'));
    }


    public function updateTD(Request $request, $id)
    {
        $request->validate([
            'trip_id' => 'required|exists:rizal_trip,id',
            'places' => 'required|string',
            'description' => 'required|string',
        ]);

        $placesArray = preg_split('/\r\n|\r|\n/', $request->places);
        $placesArray = array_filter(array_map('trim', $placesArray));
        $combinedPlaces = implode(', ', $placesArray);

        $td = TripDestination::findOrFail($id);
        $td->update([
            'trip_id' => $request->trip_id,
            'place_name' => $combinedPlaces,
            'description' => $request->description,
        ]);

        return redirect('/trip-destination')->with('success', 'Data berhasil diupdate!');
    }

    public function destroyTD($id)
    {
        $tripS = TripDestination::findOrFail($id);

        $tripS->delete();

        return redirect('/trip-destination')->with('success', 'Item berhasil dihapus.');
    }
}
