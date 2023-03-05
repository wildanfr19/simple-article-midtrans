<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use DB;
use Auth;
class GuestController extends Controller
{
    public function dashboardShow()
    {
        $data = DB::table('artikel')->get();
        return view('artikel.guestdash.index', compact('data'));
    }
    public function dashboardShowdetail($id)
    {
        $data = DB::table('artikel')->select('id','judul','kategori','deskripsi')->where('id', $id)->first();
        return view('artikel.guestdash.detail', compact('data'));
    }
}
