<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Models\CarVariant;

class CarVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = CarVariant::get();
        
        return view('cms.pages.vehicles.index', [
            "menu" => "vehicles",
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batteries = Battery::orderBy('type')->get();
        return view('cms.pages.vehicles.create', [
            "menu" => "New Vehicle",
            "batteries" => $batteries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'model_note' => 'nullable|string|max:100',
            'engine' => 'nullable|string|max:100',
            'year_start' => 'nullable|integer',
            'year_end' => 'nullable|integer',
            'batteries' => 'required|array',
            'batteries.*' => 'exists:batteries,id'
        ]);

        DB::beginTransaction();

        try {
            $brandName = trim($request->brand);
            $brand = CarBrand::whereRaw('LOWER(name) = ?', [strtolower($brandName)])->first();
            if (!$brand) {
                $brand = CarBrand::create([
                    'name' => $brandName,
                    'slug' => Str::slug($brandName),
                ]);
            }

            $modelName = trim($request->model);
            $model = CarModel::whereRaw('LOWER(name) = ?', [strtolower($modelName)])->first();
            if (!$model) {
                $model = CarModel::create([
                    'name' => $modelName,
                    'brand_id' => $brand->id,
                    'slug' => Str::slug($modelName),
                    'note' => $request->model_note
                ]);
            }

            $variant = CarVariant::create([
                'model_id' => $model->id,
                'engine' => $request->engine,
                'year_start' => $request->year_start,
                'year_end' => $request->year_end,
            ]);

            $variant->batteries()->attach($request->batteries);

            DB::commit();

            Alert::success('Congrats', 'Data Berhasil Ditambahkan');
            return to_route('vehicles.index');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Vehicles create failed', [
                'error' => $e->getMessage()
            ]);

            Alert::error('Failed', 'Gagal Menambahkan Data, Coba Beberapa Saat Lagi.');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CarVariant $vehicle)
    {
        $batteries = Battery::orderBy('type')->get();
        $selectedBatteries = $vehicle->batteries->pluck('id')->toArray();
        return view('cms.pages.vehicles.detail', [
            "menu" => "Detail Vehicle",
            "data" => $vehicle,
            "batteries" => $batteries,
            "selectedBatteries" => $selectedBatteries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarVariant $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarVariant $vehicle)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'model_note' => 'nullable|string|max:100',
            'engine' => 'nullable|string|max:100',
            'year_start' => 'nullable|integer',
            'year_end' => 'nullable|integer',
            'batteries' => 'nullable|array',
            'batteries.*' => 'exists:batteries,id'
        ]);

        DB::beginTransaction();

        try {
            $brandName = trim($request->brand);
            $brand = CarBrand::whereRaw('LOWER(name) = ?', [strtolower($brandName)])->first();
            if (!$brand) {
                $brand = CarBrand::create([
                    'name' => $brandName,
                    'slug' => Str::slug($brandName),
                ]);
            }
            if ($vehicle->model->brand->id !== $brand->id) {
                $vehicle->model->update([
                    'brand_id' => $brand->id
                ]);
            }

            $vehicle->model->update([
                'name' => trim($request->model),
                'slug' => Str::slug($request->model),
                'note' => $request->model_note,
            ]);

            $vehicle->update([
                'model_id' => $vehicle->model->id,
                'engine' => $request->engine,
                'year_start' => $request->year_start,
                'year_end' => $request->year_end,
            ]);

            if ($request->has('batteries')) {
                $vehicle->batteries()->sync($request->batteries ?? []);
            } else {
                $vehicle->batteries()->sync([]);
            }

            DB::commit();

            Alert::success('Congrats', 'Data Berhasil Diupdate');
            return to_route('vehicles.show', $vehicle);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Vehicles update failed', [
                'error' => $e->getMessage()
            ]);

            Alert::error('Failed', 'Gagal Mengupdate Data, Coba Beberapa Saat Lagi.');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarVariant $vehicle)
    {
        //
    }
}
