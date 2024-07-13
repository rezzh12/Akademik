<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Ekskul;
use App\Models\NilaiEkskul;
use App\Models\Pendaftaran;
use App\Models\Penilaian;
use App\Models\Guru;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\TahunAkademik;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Roles;
use App\Models\Nilai;
use App\Models\Walikelas;
use App\Models\Kurikulum;
use App\Models\Pengampu;
use App\Models\RiwayatNilai;
use App\Models\RiwayatTindakan;
use App\Models\TindakanKelas;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $angkatan = TahunAkademik::where('status',1)->value('tahun_akademik');
        $akademik = TahunAkademik::where('status',1)->value('id');
        $siswa = Siswa::where('tahun_akademik_id',$akademik)->Count();
        $guru = Guru::where('tahun_akademik_id',$akademik)->Count();
        $jurusan = Jurusan::where('tahun_akademik_id',$akademik)->Count();
        $ekskul = Ekskul::where('tahun_akademik_id',$akademik)->Count();
        $ekskul1 = Ekskul::where('tahun_akademik_id',$akademik)->get();
        $jurusan1 = Jurusan::where('tahun_akademik_id',$akademik)->get();
        return view('home', compact('siswa','guru','jurusan','ekskul','ekskul1','jurusan1','angkatan'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index1()
    {
        return view('home1');
    }
}
