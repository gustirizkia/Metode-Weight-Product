<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = DB::table("ekspedisi")->orderBy("id")->get();

        $ekspedisi = DB::table("ekspedisi")
                    ->get();

        $niliai_S_Ekspedisi = collect();

        foreach($ekspedisi as $idx => $itemEKspedisi)
        {

            // untuk Kriteria
            $criteria = DB::table("variable_penilaian")->get();

            // untuk Normalisasi Kriteria
            $arrSumC = array_sum(DB::table("variable_penilaian")->get()->pluck("kriteria")->toArray());

            $weight  = [];
            foreach ($criteria as $criteria) {

                array_push($weight, [
                    "id" => $criteria->id,
                    "value" => number_format($criteria->kriteria / $arrSumC, 2)
                ]);
            }

            $sPenialian = collect();
            foreach($weight as $key => $item){

                $sum_penilaian  = DB::table("penilaian_ekspedisi")
                                    // ->where("ekspedisi_id", $item['id'])
                                    ->groupBy("ekspedisi_id")
                                    ->where("penialian_id", $item["id"])
                                    ->select(DB::raw("SUM(value_nilai) as sum_value_nilai"), "penilaian_ekspedisi.*",
                                        DB::raw("COUNT(*) as total_row")
                                    )
                                    ->get();
                foreach($sum_penilaian as $sumP){
                    $sumP->s = number_format(pow($sumP->sum_value_nilai, $item["value"]), 2);
                    $sPenialian->push($sumP);

                }

            }

            $jumlahNilaiS = 0;
            foreach($sPenialian->where("ekspedisi_id", $itemEKspedisi->id) as $SP){
                if ($jumlahNilaiS === 0) {
                    $jumlahNilaiS = $SP->s;
                }else{
                    $jumlahNilaiS *= $SP->s;
                }

            }
            $niliai_S_Ekspedisi->push([
                "ekspedisi_id" => $itemEKspedisi->id,
                "value_s" => $jumlahNilaiS
            ]);


        }

        $sum_Nilai_s = $niliai_S_Ekspedisi->sum("value_s");

        foreach($items as $key => $ekspedisi){
            if($sum_Nilai_s){
                $items[$key]->value_v = number_format($niliai_S_Ekspedisi->where("ekspedisi_id", $ekspedisi->id)->first()["value_s"] / $sum_Nilai_s, 2);
                $count = DB::table("penilaian_ekspedisi")
                                                ->where("ekspedisi_id", $ekspedisi->id)
                                                ->groupBy("user_id")
                                                ->get();
                $items[$key]->count_penilaian = count($count);
            }else{
                $items[$key]->value_v = 0;
                $items[$key]->count_penilaian = 0;
            }

        }

        return view("pages.ekspedisi.index", [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.ekspedisi.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except("_token");
        $image = $request->image->store("ekspedisi", "public");
        $data["image"] = $image;

        $insertData = DB::table("ekspedisi")->insertGetId($data);

        return redirect()->route("ekspedisi.index")->with("success", "Berhasil Tambah Data Baru");
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
        $item = DB::table("ekspedisi")->find($id);
        if(!$item){
            return redirect()->back()->with("error", "Data tidak ditemukan");
        }

        return view("pages.ekspedisi.edit", [
            'item' => $item
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->except("_token", "_method");

        if($request->image){
            $data['image'] = $request->image->store("ekspedisi", "public");
        }

        $update = DB::table("ekspedisi")->where("id", $id)->update($data);

        return redirect()->route("ekspedisi.index")->with("success", "Berhasil Edit Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ekspedisi = DB::table("ekspedisi")->where("id", $id)->delete();

        return redirect()->back()->with("success", "Berhasil hapus data");
    }
}
