<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariablePenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = DB::table("variable_penilaian")->orderBy("id", "desc")->get();

        return view("pages.variable_penilaian.index", [
            'items' => $item
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.variable_penilaian.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except("_token");

        $insert = DB::table("variable_penilaian")->insertGetId($data);

        return redirect()->route("variable-penilaian.index")->with("success", "Berhasil tambah data baru");
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
        $item = DB::table("variable_penilaian")->find($id);

        return view("pages.variable_penilaian.edit", [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except("_method", "_token");

        $item = DB::table("variable_penilaian")->where("id", $id)->update($data);

        return redirect()->route("variable-penilaian.index")->with("success", "Berhasil update data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = DB::table("variable_penilaian")->where("id", $id)->delete();

        return redirect()->route("variable-penilaian.index")->with("success", "Berhasil hapus data");
    }
}
