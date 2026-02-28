<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\Battery;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Battery::get();
        
        return view('cms.pages.batteries.index', [
            "menu" => "Batteries",
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.pages.batteries.create', [
            "menu" => "New Battery",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'model'     => 'required|string|max:255',
                'type'     => 'required|string|max:255',
                'ah'     => 'required|numeric',
                'cca'     => 'required|numeric',
                'weight'     => 'required|numeric',
                'length'     => 'required|numeric',
                'width'     => 'required|numeric',
                'height'     => 'required|numeric',
                'total_height'     => 'required|numeric',
            ]);

            Battery::create($validatedData);

            DB::commit();

            Alert::success('Congrats', 'Data Berhasil Ditambahkan');
            return to_route('batteries.index');

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Battery create failed', [
                'error' => $e->getMessage()
            ]);

            Alert::error('Failed', 'Gagal Menambahkan Data, Coba Beberapa Saat Lagi.');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Battery $battery)
    {
        $battery->load([
            'variants.model.brand'
        ]);
        return view('cms.pages.batteries.detail', [
            "menu" => "Detail Battery",
            "data" => $battery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Battery $battery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Battery $battery)
    {
        DB::beginTransaction();
    
        try {
            $rules = [
                'model'     => 'required|string|max:255',
                'type'     => 'required|string|max:255',
                'ah'     => 'required|numeric',
                'cca'     => 'required|numeric',
                'weight'     => 'required|numeric',
                'length'     => 'required|numeric',
                'width'     => 'required|numeric',
                'height'     => 'required|numeric',
                'total_height'     => 'required|numeric',
            ];

            $validateData = $request->validate($rules);

            $result = Battery::where('id', $battery->id)->update($validateData);

            DB::commit();

            if ($result) {
                Alert::success('Congrats', 'Berhasil Memperbarui Data.');
                return to_route('batteries.show', $battery);
            } else {
                Alert::error('Failed', 'Gagal Update Data. Coba Beberapa Saat Lagi.');
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error('Battery update failed', [
                'error' => $th->getMessage()
            ]);
            
            Alert::error('Error', 'Terjadi kesalahan sistem: ' . $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Battery $battery)
    {
        //
    }
}
