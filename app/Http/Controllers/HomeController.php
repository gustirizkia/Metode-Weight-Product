<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $kurir = DB::table("ekspedisi")->orderBy("id", "desc")->get();

        return view("pages.frontend.home", [
            'kurir' => $kurir
        ]);
    }

    public function penilaian($id_ekspedisi){
        $variable = DB::table("variable_penilaian")->orderBy("id", "desc")->get();
        $ekspedisi = DB::table("ekspedisi")->find($id_ekspedisi);
        $cek = DB::table("penilaian_ekspedisi")->where("user_id", auth()->user()->id)
                ->where("ekspedisi_id", $id_ekspedisi)->first();

        if($cek){
            return redirect()->back();
        }

        return view("pages.frontend.penilaian", [
            'variable' => $variable,
            'kurir' => $ekspedisi
        ]);

    }

    public function prosesPenilaian(Request $request)
    {
        foreach($request->variable as $key => $var){
            DB::table("penilaian_ekspedisi")->insert([
                'ekspedisi_id' => $request->ekspedisi_id,
                'penialian_id' => $key,
                'value_nilai' => $var,
                "user_id" => auth()->user()->id
            ]);
        }

        return redirect("/");
    }

}
