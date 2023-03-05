<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use DB;
use Auth;
class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        if (request()->ajax()) {
            $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->get();

            return Datatables::of($data)
               ->editColumn('kategori', function($data){
                if ($data->kategori == 'Free') {
                    return "<span class='badge badge-success'>". $data->kategori ."</span>";
                } else {
                    return "<span class='badge badge-danger'>". $data->kategori ."</span>";
                }
                
                 
               })
               ->addColumn('action', function($data){
               return view('artikel.action._action', [
                   'model' => $data
               ]);

           })
           ->rawColumns(['action','kategori'])
           ->make(true);
       }
    }
    public function index()
    {
        return view('artikel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('artikel')->insert([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi
        ]);
        return response()->json([
            'status' => 1,
            'message' => 'Data berhasil ditambahkan!'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('artikel')->where('id', $id)->update([
            'judul'=> $request->judul,
            'kategori'=> $request->kategori,
            'deskripsi'=> $request->deskripsi
        ]);
        return response()->json([
            'status'=> 1,
            'message'=> 'Data berhasil diubah'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('artikel')->where('id', $id)->delete();
        return response()->json([
            'status'=> 1,
            'message'=> 'Data berhasil dihapus!'
        ], 200);
    }
    public function dashboardShowAdmin()
    {
        $data = DB::table('artikel')->get();
        $free = DB::table('artikel')->where('kategori','=','Free')->count();
        $berbayar = DB::table('artikel')->where('kategori','=','Berbayar')->count();
        return view('artikel.guestdash.index', compact('data','free','berbayar'));
    }
    public function dashboardShowdetailAdmin($id)
    {
        $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->where('id', $id)->first();
        return view('artikel.guestdash.detail', compact('data'));
    }
    public function free(Request $request)
    {
        $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->where('kategori','=','Free')->get();
        $free = DB::table('artikel')->where('kategori','=','Free')->count();
        $berbayar = DB::table('artikel')->where('kategori','=','Berbayar')->count();
        return view('artikel.guestdash.categories.free', compact('data','free','berbayar'));
    }
    public function berbayar(Request $request)
    {
        $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->where('kategori','=','Berbayar')->get();
        $free = DB::table('artikel')->where('kategori','=','Free')->count();
        $berbayar = DB::table('artikel')->where('kategori','=','Berbayar')->count();

        // $cek = DB::table('orders')->where('')
        return view('artikel.guestdash.categories.berbayar', compact('data','free','berbayar'));
    }
}
