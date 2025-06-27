<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Region;
use App\Models\Trip;
use App\Models\TripDestination;
use App\Models\TripItternary;
use App\Models\TripSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    //--------
    //Open Trip
    //--------


    //tampilan tabel rental item
    // Tampilkan daftar trip
    public function indexTrip()
    {
        $trips = Trip::latest()->paginate(10);
        return view('trip.data_trip', compact('trips'));
    }

    // Form create trip
    public function create()
    {
        $categories = Categories::all();
        $regions = Region::all();
        return view('trip.create_trip', compact('categories', 'regions'));
    }

    // Simpan trip baru
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

        // Upload gambar
        $images = null;
        if ($request->hasFile('image')) {
            $images = $request->file('image')->store('trip', 'public');
        }

        // Simpan data trip
        Trip::create([
            'title'         => $validated['title'],
            'category_id'   => $validated['category_id'],
            'region_id'     => $validated['region_id'],
            'description'   => $validated['description'],
            'meeting_point' => $validated['meeting_point'],
            'base_price'    => $validated['base_price'],
            'quota'         => $validated['quota'],
            'includes'      => implode(', ', array_map('trim', preg_split('/\r\n|\r|\n/', $validated['includes']))),
            'excludes'      => implode(', ', array_map('trim', preg_split('/\r\n|\r|\n/', $validated['excludes']))),
            'image'         => $images,
            'status'        => $validated['status'],
        ]);

        return redirect('/trip')->with('success', 'Trip berhasil disimpan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        $categories = Categories::all();
        $regions = Region::all();

        // Konversi includes & excludes ke format textarea (baris)
        $trip->includes = str_replace(',', "\n", $trip->includes);
        $trip->excludes = str_replace(',', "\n", $trip->excludes);

        return view('trip.edit_trip', compact('trip', 'categories', 'regions'));
    }

    // Proses update trip
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
            'image'          => 'nullable|image|mimes:jpg,png,jpeg,webp',
            'status'         => 'required|string'
        ]);

        $trip = Trip::findOrFail($id);

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($trip->image && Storage::disk('public')->exists($trip->image)) {
                Storage::disk('public')->delete($trip->image);
            }

            $trip->image = $request->file('image')->store('trip', 'public');
        }

        // Update data
        $trip->update([
            'title'         => $validated['title'],
            'category_id'   => $validated['category_id'],
            'region_id'     => $validated['region_id'],
            'description'   => $validated['description'],
            'meeting_point' => $validated['meeting_point'],
            'base_price'    => $validated['base_price'],
            'quota'         => $validated['quota'],
            'includes'      => implode(', ', array_map('trim', preg_split('/\r\n|\r|\n/', $validated['includes']))),
            'excludes'      => implode(', ', array_map('trim', preg_split('/\r\n|\r|\n/', $validated['excludes']))),
            'status'        => $validated['status'],
        ]);

        return redirect('/trip')->with('success', 'Trip berhasil diupdate.');
    }

    // Hapus trip
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);

        // Hapus gambar jika ada
        if ($trip->image && Storage::disk('public')->exists($trip->image)) {
            Storage::disk('public')->delete($trip->image);
        }

        $trip->delete();

        return redirect('/trip')->with('success', 'Trip berhasil dihapus.');
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
        $tripS->start_date = $validated['start_date'];
        $tripS->end_date = $validated['end_date'];
        $tripS->quota = $validated['quota'];
        $tripS->price = $validated['price'];
        $tripS->status = $validated['status'];
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


    //-------------
    //Trip internaries
    //-------------
    public function indexIT()
    {
        $itineraries = TripItternary::latest()->paginate(10);
        return view('tripItineraries.trip_itineraries', compact('itineraries'));
    }

    // CREATE
    public function createIT()
    {
        $trips = Trip::all();
        return view('tripItineraries.create_trip_itineraries', compact('trips'));
    }

    // STORE
    public function storeIT(Request $request)
    {
        $request->validate([
            'trip_id'  => 'required|exists:rizal_trip,id',
            'day'      => 'required|string',
            'activity' => 'required|string',
        ]);

        // Proses teks multiline jadi 1 string dipisahkan koma
        $activitiesArray = preg_split('/\r\n|\r|\n/', $request->activity);
        $activitiesArray = array_filter(array_map('trim', $activitiesArray));
        $combinedActivities = implode(', ', $activitiesArray);

        TripItternary::create([
            'trip_id'  => $request->trip_id,
            'day'      => $request->day,
            'activity' => $combinedActivities,
        ]);

        return redirect('/itinerary')->with('success', 'Itinerary berhasil ditambahkan.');
    }

    // EDIT
    public function editIT($id)
    {
        $itinerary = TripItternary::findOrFail($id);
        $trips = Trip::all();

        // Konversi dari koma ke newline
        $itinerary->activity = implode("\n", array_map('trim', explode(',', $itinerary->activity)));

        return view('tripItineraries.edit_trip_itineraries', compact('itinerary', 'trips'));
    }


    // UPDATE
    public function updateIT(Request $request, $id)
    {
        $request->validate([
            'trip_id'  => 'required|exists:rizal_trip,id',
            'day'      => 'required|string',
            'activity' => 'required|string',
        ]);

        $activitiesArray = preg_split('/\r\n|\r|\n/', $request->activity);
        $activitiesArray = array_filter(array_map('trim', $activitiesArray));
        $combinedActivities = implode(', ', $activitiesArray);

        $itinerary = TripItternary::findOrFail($id);
        $itinerary->update([
            'trip_id'  => $request->trip_id,
            'day'      => $request->day,
            'activity' => $combinedActivities,
        ]);

        return redirect('/itinerary')->with('success', 'Itinerary berhasil diupdate.');
    }

    // DESTROY
    public function destroyIT($id)
    {
        $itinerary = TripItternary::findOrFail($id);
        $itinerary->delete();

        return redirect('/itinerary')->with('success', 'Itinerary berhasil dihapus.');
    }
}
