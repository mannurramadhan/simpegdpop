<?php

namespace App\Http\Controllers;

use App\Kgb;
use App\Kpp;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PensiunController extends Controller
{
    public function index(){
        $index = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->paginate(10);

        $notification = DB::table('notifs')->get();

        return view('pages.pensiun.index', ['index' => $index, 'notification' => $notification]);
    }

    public function notif(){
        $get = DB::table('pegawais')
                ->get();

        foreach($get as $n){
            $now = date('d-m-Y');
            $start = \Carbon\Carbon::parse($now);
            $end = \Carbon\Carbon::parse($n->tahun_pensiun);

            $interval = \date_diff($start,$end);
            $date = $interval->format("%y Tahun, %m Bulan, %d Hari");
            $days = $interval->days;

            DB::table('pegawais')->where('nip','=',$n->nip)->update([
                'update_pensiun' => $date,
                'durasi_pensiun' => $days
            ]);
        }

        $notif = DB::table('pegawais')
                ->whereIn('status_kepegawaian', ['PNS', 'Non PNS'])
                ->whereBetween('durasi_pensiun', [0, 180])
                ->paginate(10);
        
        $notification = DB::table('notifs')->get();

        return view('pages.pensiun.notif',['notif' => $notif, 'notification' => $notification]);
    }
}
