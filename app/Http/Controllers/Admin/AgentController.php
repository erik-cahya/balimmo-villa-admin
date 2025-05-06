<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function index(){

        $data['data_agent'] = User::orderByRaw("id = ? DESC", [Auth::user()->id])->get();
        $data['count_agent'] = User::count();

        return view('admin.agent.index', $data);
    }

    public function store(Request $request){
        // dd($request->all());

        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
        ], [
            // 'property_name.required' => 'custom message',
        ]); 

        $reference_code = $request->role == 'master' ? 'MSTR_' . random_int(100,999) : 'AGNT_' . random_int(100,999);
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

