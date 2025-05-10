<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AgentController extends Controller
{
    public function index(){

        $loggedInUser = User::find(Auth::id());
        $otherUsers = User::where('id', '!=', Auth::id())->get();        
        $data['data_agent'] = collect([$loggedInUser])->merge($otherUsers);

        return view('admin.agent.index', $data);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'role' => 'required',
            'initial_name' => 'required',
        ], [
            // 'property_name.required' => 'custom message',
        ]); 
        
        $reference_code = $request->role === 'Master' || 'master' ? 'BPM-'.  Str::upper($request->initial_name) . '-' . random_int(1000,9999) : 'BPA-' .  Str::upper($request->initial_name) . '-' . random_int(1000,9999);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->phone_number,
            'password' => $request->password,
            'reference_code' => $reference_code,
            'role' => $request->role,
        ]);

        $flashData = [
            'judul' => 'Create Agent Success',
            'pesan' => 'New Agent Added Successfully',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('agent.index')->with('flashData', $flashData);
    }

    public function destroy(string $id)
    {

        // // Delete Image Handler
        // if ($this->getFeaturedImage($id) != null) {
        //     File::delete(public_path('admin/uploads/images/' . $this->getFeaturedImage($id)));
        // }

        // PropertiesFeatureModel::where('properties_id', $id)->delete();
        User::destroy($id);

        $flashData = [
            'judul' => 'Delete Success',
            'pesan' => 'Delete Agent Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}

