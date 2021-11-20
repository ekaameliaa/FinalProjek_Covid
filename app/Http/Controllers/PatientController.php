<?php

namespace App\Http\Controllers;
#import model patient supaya bisa berinteraksi dengan database
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    #membuat method index
    public function index(){
        #menggunakan model pastien untuk melihat data
        $patients = Patient::all();

        #jika data pasien ada maka akan menampilkan seluruh data pasieh
        if ($patients){

            $data = [
                'message' => 'Get all patient',
                'data' => $patients
            ];
    
            #mengirim data (json) dan kode 200
            return response()->json($data, 200);
        }
        #jika tidak ada maka akan menampilkan data not found atau data tidak ada
        else {
            $data = [
                'message' => 'Data not found'
            ];
    
            #mengirim data (json) dan kode 404
            return response()->json($data, 404);
        }
        
    }

    #membuat method store
    public function store(Request $request){

        #membuat validasi data
        $validateData = $request->validate([
            'nama' => "required",
            'phone' => "required|numeric",
            'addres' => "required",
            'status' => "required",
            'in_data_at' => "required",
            'out_data_at' => "nullable"
        ]);

        #input data ke database
        $patients = Patient::create($validateData);

        $data = [
            'message' => 'Patient is created',
            'data' => $patients
        ];
        #mengirim data (json) dan kode 201
        return response()->json($data, 201);
    }

    #membuat method show
    public function show($id){

        #cari id patient yang ingin dilihat
        $patients = Patient::find($id);
        if ($patients){
            $data = [
                'message' => 'Mendapatkan satu buah data',
                'data' => $patients
            ];
            #mengirim data (json) dan kode 200
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => 'Data not found'
            ];

            #mengirim data (json) dan kode 404
            return response()->json($data, 404);
        }

    }

    #membuat method update
    public function update(Request $request, $id)
    {
        #cari id patient yang ingin diupdate
        $patients = Patient::find($id);

        if ($patients){
            #menangkap data request
            #melakukan update data
            $patients->update([
                'nama' => $request->nama??$patients->nama,
                'phone' => $request->phone??$patients->phone,
                'addres' => $request->addres??$patients->addres,
                'status' => $request->status??$patients->status,
                'in_data_at' => $request->in_data_at??$patients->in_data_at,
                'out_data_at' => $request->out_data_at??$patients->out_data_at
            ]);

            $data = [
                'message' => 'Data is update',
                'data' => $patients
            ];
            #mengirim data (json) dan kode 200
            return response()->json($data, 200);
        }
        else{
            $data = [
                'message' => 'Data not found'
            ];

            #mengirim data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    #membuat method delete
    public function destroy($id){
        #cari id patient yang ingin didelete
        $patients = Patient::find($id);

        if ($patients){
            #melakukan delete data
            $patients->delete();

            $data = [
                'message' => 'Data is delete',
            ];

            #mengirim data (json) dan kode 200
            return response()->json($data, 200);
        }
        
        else{
            $data = [
                'message' => 'Data not found'
            ];

            #mengirim data (json) dan kode 404
            return response()->json($data, 404);
        }

    }

    public function search($name){

        #cari data by name menggunakan eloquent where dan get didatabase
        $patients = Patient::where('nama', 'like', "%$name%")->get();

        if ($patients){

            $data = [
                'message' => 'Get searched resource',
                'data' => $patients
            ];

            #mengirim data (json) dan kode 200
            return response()->json($data, 200);
        }
        
        else{
            $data = [
                'message' => 'Data not found'
            ];

            #mengirim data (json) dan kode 404
            return response()->json($data, 404);
        }
    }

    public function positive(){

         #cari data by status menggunakan eloquent where dan get didatabase
        $patients = Patient::where('status', 'like', "%positive%")->get();
        $total = count($patients);

        $data = [
            'message' => 'Get positive resource',
            'total' => $total,
            'data' => $patients
        ];

        #mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

    public function recovered(){

        #cari data by name menggunakan eloquent where dan get didatabase
        $patients = Patient::where('status', 'like', "%recovered%")->get();
        $total = count($patients);

        $data = [
            'message' => 'Get recovered resource',
            'total' => $total,
            'data' => $patients
        ];

        #mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

    public function dead(){

        #cari data by name menggunakan eloquent where dan get didatabase
        $patients = Patient::where('status', 'like', "%dead%")->get();
        $total = count($patients);
        
        $data = [
            'message' => 'Get dead resource',
            'total' => $total,
            'data' => $patients
        ];

        #mengirim data (json) dan kode 200
        return response()->json($data, 200);
    }

}
