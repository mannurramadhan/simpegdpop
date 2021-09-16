<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function indexp(){
        $index = DB::table('kearsipan_pegawais')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->where('pegawais.status_kepegawaian','=','Pensiun')
                ->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.arsippensiun.index', ['index' => $index, 'notification' => $notification]);
    }

    public function notifp(){
        $notif = DB::table('kearsipan_pegawais')
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.arsippensiun.notif', ['notif' => $notif, 'notification' => $notification]);
    }

    public function editp($nip)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $edit = DB::table('pegawais')
                ->where('nip','=',$nip)
                ->get();

        $notification = DB::table('notifs')->get();

	    // passing data pegawai yang didapat ke view edit.blade.php
        return view('pages.arsippensiun.edit',['edit' => $edit, 'notification' => $notification]);

    }

    public function detailp($nip)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $detail = DB::table('kearsipan_pegawais')
                ->where('pegawais_nip','=',$nip)
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->get();

        $notification = DB::table('notifs')->get();

	    // passing data pegawai yang didapat ke view edit.blade.php
        return view('pages.arsippensiun.detail',['detail' => $detail, 'notification' => $notification]);
    }

    public function storep(Request $request)
    {
        // mengubah status kepegawaian menjadi Mutasi
        DB::table('pegawais')->where('nip','=',$request->nip)->update([
            'status_kepegawaian' => 'Pensiun'
        ]);

        // mengirim pegawais_id ke tabel kearsipan_pegawais
        $gets = DB::table('pegawais')->where('nip','=',$request->nip)->get();

        // mengisi nilai pegawais_id dan tahun_pensiun_mutasi
        foreach($gets as $get){
            DB::table('kearsipan_pegawais')->insert([
                'pegawais_nip' => $get->nip,
                'tahun_pensiun_mutasi' => $request->tahun_pensiun_mutasi
            ]);
        }
        
	    // alihkan halaman ke halaman pegawai pensiun
	    return redirect('arsip-pegawai/pensiun/info')->with(['success' => 'Data pegawai pensiun berhasil diarsipkan!']);
    }

    public function deletep(Request $request)
    {
	    // menghapus data pegawai berdasarkan id yang dipilih
	    DB::table('pegawais')->where('nip','=',$request->nip)->delete();
        DB::table('kearsipan_pegawais')->where('pegawais_nip','=',$request->nip)->delete();
        
	    // alihkan halaman ke halaman pegawai
	    return redirect('arsip-pegawai/pensiun/info')->with(['success' => 'Data pegawai pensiun berhasil dihapus!']);
    }

    public function indexm(){
        $index = DB::table('kearsipan_pegawais')
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->where('pegawais.status_kepegawaian','=','Mutasi')
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.arsipmutasi.index', ['index' => $index, 'notification' => $notification]);
    }

    public function notifm(){
        $notif = DB::table('kearsipan_pegawais')->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.arsipmutasi.notif', ['notif' => $notif, 'notification' => $notification]);
    }

    public function editm($nip)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $edit = DB::table('pegawais')
                ->where('nip','=',$nip)
                ->get();
        
        $notification = DB::table('notifs')->get();

	// passing data pegawai yang didapat ke view edit.blade.php
        return view('pages.arsipmutasi.edit',['edit' => $edit, 'notification' => $notification]);

    }

    public function detailm($nip)
    {
        // mengambil data pegawai berdasarkan id yang dipilih
        $detail = DB::table('kearsipan_pegawais')
                ->where('pegawais_nip','=',$nip)
                ->leftJoin('pegawais', 'pegawais_nip', '=', 'pegawais.nip')
                ->get();

        $notification = DB::table('notifs')->get();

	    // passing data pegawai yang didapat ke view edit.blade.php
        return view('pages.arsipmutasi.detail',['detail' => $detail, 'notification' => $notification]);
    }

    public function storem(Request $request)
    {
        // mengubah status kepegawaian menjadi Mutasi
        DB::table('pegawais')->where('nip','=',$request->nip)->update([
            'status_kepegawaian' => 'Mutasi'
        ]);

        // mengirim pegawais_id ke tabel kearsipan_pegawais
        $gets = DB::table('pegawais')->where('nip','=',$request->nip)->get();

        // mengisi nilai pegawais_id dan tahun_pensiun_mutasi
        foreach($gets as $get){
            DB::table('kearsipan_pegawais')->insert([
                'pegawais_nip' => $get->nip,
                'tahun_pensiun_mutasi' => $request->tahun_pensiun_mutasi
            ]);
        }

	    // alihkan halaman ke halaman pegawai mutasi
	    return redirect('arsip-pegawai/mutasi/info')->with(['success' => 'Data pegawai pensiun berhasil diarsipkan!']);
    }

    public function deletem(Request $request)
    {
	    // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('pegawais')->where('nip','=',$request->nip)->delete();
        DB::table('kearsipan_pegawais')->where('pegawais_nip','=',$request->nip)->delete();
		
	    // alihkan halaman ke halaman pegawai
	    return redirect('arsip-pegawai/mutasi/info')->with(['success' => 'Data pegawai pensiun berhasil dihapus!']);
    }
}