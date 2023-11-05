<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = User::orderBy("id", "desc")
                ->where("roles", "admin")
                ->get();

        return view("pages.admin.index", [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except("_token");

        $data["password"] = Hash::make($request->password);

        $data['roles'] = "admin";

        $user = User::create($data);

        return redirect()
                ->route("admin.index")
                ->with("success", "Berhasil tambah data baru");
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
        $user = User::findOrFail($id);

        return view("pages.admin.edit", [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except("_token", "_method", "password_confirmation");

        $data["password"] = Hash::make($request->password);

        $user = User::where("id", $id)->update($data);

        return redirect()
                ->route("admin.index")
                ->with("success", "Berhasil update data");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
                ->route("admin.index")
                ->with("success", "Berhasil hapus data");

    }
}
