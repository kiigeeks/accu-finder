<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\CarVariant;
use Illuminate\Http\Request;

class FinderController extends Controller
{
    public function index()
    {
        return view('public.pages.index', [
            'brands' => CarBrand::orderBy('name')->get(),
            'variants' => CarVariant::get(),
            'batteries' => Battery::orderBy('model')->get(),
            'menu' => "ACCU Finder"
        ]);
    }

    public function vehicleResult(CarVariant $variant)
    {
        $variant->load('model.brand','batteries');

        return view('public.includes.vehicles', compact('variant'));
    }

    public function batteryResult(Battery $battery)
    {
        $battery->load('variants.model.brand');

        return view('public.includes.batteries', compact('battery'));
    }
}
