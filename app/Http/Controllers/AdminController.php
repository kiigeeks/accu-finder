<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\CarVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $batteries = Battery::count();
        $vehicles = CarVariant::count();

        return view('cms.pages.dashboard.index', [
            'menu' => 'Dashboard',
            'batteries' => $batteries,
            'vehicles' => $vehicles,
        ]);
    }

    public function adminProfile()
    {
        return view('cms.pages.profile.index', [
            'menu' => 'Profile',
        ]);
    }

    public function adminUpdate(Request $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find(auth()->id());

            $request->validate([
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6'
            ]);

            $user->fullname = $request->fullname;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            DB::commit();

            Alert::success('Berhasil', 'Profile berhasil diperbarui');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Profile update failed', [
                'error' => $e->getMessage()
            ]);

            Alert::error('Gagal', 'Terjadi kesalahan saat update profile');
            return redirect()->back()->withInput();
        }
    }
}
