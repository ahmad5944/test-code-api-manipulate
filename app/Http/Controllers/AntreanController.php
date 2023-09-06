<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use Illuminate\Http\Request;
class AntreanController extends Controller
{
    public function getStatus(Request $request, $kode_poli, $tanggalperiksa)
    {
        $totalAntrean = Antrean::count();
        $sisaAntrean = Antrean::where('statusdipanggil', 0)->count();

        $data = Antrean::select('namaPoli', 'angkaantrean', 'int', 'nomorantrean', 'keluhan')
            ->where('kodepoli', $kode_poli)
            ->where('tglpriksa', $tanggalperiksa)
            ->get();

        if (empty($data)) {
            $metadata = [
                'message' => 'Gagal',
                'code' => 201
            ];
    
            return response()->json(['metadata' => $metadata], 201);
        }

        $metadata = [
            'message' => 'Sukses',
            'code' => 200
        ];


        $response = [];
        foreach ($data as $key => $value) {
            $response[] = [
                'namapoli' => $value->namaPoli,
                'totalantrean' => $totalAntrean,
                'sisaantrean' => $sisaAntrean,
                'antreanpanggil' => $value->nomorantrean,
                'keluhan' => $value->keluhan
            ];
        }
        return response()->json(['resepone' => $response, 'metadata' => $metadata]);
    }
    public function getAntrean(Request $request){
        $req = $request->all();
        $data = Antrean::where('nomorkartu', $req['nomorkartu'])
            ->where('nik', $req['nik'])
            ->where('kodepoli', $req['kodepoli'])
            ->where('tglpriksa', $req['tanggalperiksa'])
            ->where('keluhan', $req['keluhan'])
            ->first();

        if (empty($data)) {
            $metadata = [
                'message' => 'Gagal',
                'code' => 201
            ];
    
            return response()->json(['metadata' => $metadata], 201);
        }

        $metadata = [
            'message' => 'Sukses',
            'code' => 200
        ];

        return response()->json(['metadata' => $metadata]);
        
    }
    public function getSisaAntrean(Request $request, $nomorkartu_jkn, $kode_poli, $tanggalperiksa){
        $totalAntrean = Antrean::count();
        $sisaAntrean = Antrean::where('statusdipanggil', 0)->count();

        $data = Antrean::select('namaPoli', 'angkaantrean', 'int', 'nomorantrean', 'nomorKartu', 'keluhan')
            ->where('kodepoli', $kode_poli)
            ->where('tglpriksa', $tanggalperiksa)
            ->where('nomorKartu', $nomorkartu_jkn)
            ->first();

        if (empty($data)) {
            $metadata = [
                'message' => 'Gagal',
                'code' => 201
            ];
    
            return response()->json(['metadata' => $metadata], 201);
        }

        $metadata = [
            'message' => 'Sukses',
            'code' => 200
        ];


        $response = [
            'response' => [
                'nomorantrean' => $data->nomorantrean,
                'namapoli' => $data->namaPoli,
                'sisaantrean' => $sisaAntrean,
                'antreanpanggil' => 'A8',
                'keterangan' => ''
            ],

            'metadata' => $metadata
        ];
        return response()->json(['resepone' => $response]);
    }
    public function batalAntrean(Request $request){
        $req = $request->all();
        $data = Antrean::where('nomorkartu', $req['nomorkartu'])
            ->where('kodepoli', $req['kodepoli'])
            ->where('tglpriksa', $req['tanggalperiksa'])
            ->update([
                'statusdipanggil' => 3,
            ]);

        if (empty($data)) {
            $metadata = [
                'message' => 'Gagal',
                'code' => 201
            ];
    
            return response()->json(['metadata' => $metadata], 201);
        }

        $metadata = [
            'message' => 'Sukses',
            'code' => 200
        ];

        return response()->json(['metadata' => $metadata]);
        
    }
}
