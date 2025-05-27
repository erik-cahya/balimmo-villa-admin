<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertiesModel;
use App\Models\PropertyLegalModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $data['profile'] = $user;

        $property = PropertiesModel::where('internal_reference', $user->reference_code)->first();

        $data['propertiesCount'] = PropertiesModel::where('internal_reference', $user->reference_code)->count();

        $data['leaseholdCount'] = 0;
        $data['freeholdCount'] = 0;

        if ($property) {
            $propertyId = $property->id;

            $data['leaseholdCount'] = PropertyLegalModel::where('properties_id', $propertyId)
                ->where('legal_status', 'Leasehold')
                ->count();

            $data['freeholdCount'] = PropertyLegalModel::where('properties_id', $propertyId)
                ->where('legal_status', 'Freehold')
                ->count();
        }

        return view('admin.profile.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Buat folder jika belum ada
        $userFolder = public_path('admin/profile-image/' . $request->reference_code);
        if (!file_exists($userFolder)) {
            mkdir($userFolder, 0755, true);
        }
        $user = User::where('reference_code', $request->reference_code)->firstOrFail();

        // Cek jika user upload file baru
        if ($request->hasFile('photo_profile')) {
            // Hapus foto lama jika ada
            $oldProfile = $user->profile;
            if ($oldProfile && file_exists("{$userFolder}/{$oldProfile}")) {
                File::delete("{$userFolder}/{$oldProfile}");
            }

            // Simpan foto baru
            $filename = Str::slug('profile-' . $request->name) . '.' . $request->photo_profile->getClientOriginalExtension();
            $request->photo_profile->move($userFolder, $filename);
            $user->profile = $filename;
        }

        // Update field lainnya
        $user->name = $request->name;
        $user->phone_number = $request->phone;
        $user->description = $request->description;
        $user->tagline = $request->tagline;
        $user->address = $request->address;
        $user->save();

        // Flash success
        return back()->with('flashData', [
            'judul' => 'Edit Profile Success',
            'pesan' => 'Your Profile Edited Successfully',
            'swalFlashIcon' => 'success',
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
