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
use App\Models\RiwayatAdministrasi;
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

class PengunjungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $data = Pendaftaran::where('NISN',auth()->user()->id_status)->get();
        return view('pengunjung.dashboard', compact('user','data'));
    }
}
