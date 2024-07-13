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
use App\Models\AdministrasiSiswa;
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

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $riwayat = RiwayatTindakan::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $user = Auth::user();
        $siswa = Siswa::where('tahun_akademik_id',$akademik)->Count();
        $guru = Guru::where('tahun_akademik_id',$akademik)->Count();
        $kelas = Kelas::where('tahun_akademik_id',$akademik)->Count();
        $pengguna = User::Count();
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        return view('siswa.Dashboard', compact('user','siswa','guru','kelas','pengguna','riwayat','ekskul'));
    }

    public function jadwal(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum1 = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->value('id');
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $jadwal = Jadwal::where('kurikulum_id',$kurikulum1)->get();
        return view('siswa.jadwalPelajaran', compact('user','jadwal','ekskul'));
    }

    public function pilih_kurikulum(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kelas = Walikelas::where('NUPTK',auth()->user()->id_status)->value('kelas_id');
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $kurikulum = Nilai::select('kurikulum_id')->where('NISN','=',auth()->user()->id_status)->groupBy('kurikulum_id')->get();
        return view('siswa.pilihKurikulum', compact('user','kurikulum','ekskul'));
    }

    public function cetak($id){
        $user = Auth::user();
        $kurikulum = Kurikulum::where('id',$id)->value('tahun_akademik_id');
        $akademik = TahunAkademik::where('id',$kurikulum)->value('id');
        $riwayat = DB::table('nilais')
        ->join('siswas', 'siswas.NISN', '=', 'nilais.NISN')
        ->join('kelas', 'kelas.id', '=', 'siswas.kelas_id')
        ->join('jurusans', 'jurusans.id', '=', 'kelas.jurusan_id')
        ->join('tahun_akademiks', 'tahun_akademiks.id', '=', 'nilais.tahun_akademik_id')
        ->join('kurikulums', 'kurikulums.id', '=', 'nilais.kurikulum_id')
        ->select('siswas.nama_lengkap','nilais.NISN','nama_kelas','jurusans.program_keahlian','jurusans.nama_jurusan','tahun_akademiks.tahun_akademik','kelas.tingkatan_kelas','kurikulums.semester')
        ->where('nilais.NISN','=',auth()->user()->id_status)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $nilai = DB::table('nilais')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('mapels.nama_mapel','nilais.nilai','nilais.ketercapaian','nilais.deskripsi')
        ->where('nilais.NISN','=',auth()->user()->id_status)
        ->where('nilais.kurikulum_id','=',$id)
        ->get();

        $ekskul = DB::table('nilai_ekskuls')
        ->join('nilais', 'nilais.NISN', '=', 'nilai_ekskuls.NISN')
        ->join('ekskuls', 'ekskuls.id', '=', 'nilai_ekskuls.ekskuls_id')
        ->select('ekskuls.nama','nilai_ekskuls.deskripsi')
        ->where('nilai_ekskuls.NISN','=',auth()->user()->id_status)
        ->where('nilai_ekskuls.tahun_akademik_id','=',$akademik)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $absen = DB::table('nilais')
        ->select('nilais.Sakit','nilais.Izin','nilais.Alfa')
        ->where('nilais.NISN','=',auth()->user()->id_status)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $tanggal = DB::table('nilais')
        ->select('nilais.tanggal')
        ->where('nilais.NISN','=',auth()->user()->id_status)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $walikelas = DB::table('walikelas')
        ->join('nilais', 'nilais.kelas_id', '=', 'walikelas.kelas_id')
        ->join('gurus', 'gurus.NUPTK', '=', 'walikelas.NUPTK')
        ->select('gurus.nama_lengkap','gurus.NUPTK')
        ->where('nilais.NISN','=',auth()->user()->id_status)
        ->where('gurus.tahun_akademik_id','=',$akademik)
        ->paginate(1);

        $kepala = DB::table('users')
        ->join('gurus', 'gurus.NUPTK', '=', 'users.id_status')
        ->select('gurus.nama_lengkap','gurus.NUPTK')
        ->where('users.roles_id','=',2)
        ->where('gurus.tahun_akademik_id','=',$akademik)
        ->paginate(1);
        return view('siswa.cetak', compact('user','riwayat','nilai','absen','ekskul'));
    }

    public function RTindakan()
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $user = Auth::user();
        $RTindakan = RiwayatTindakan::where('tahun_akademik_id',$akademik)->where('NISN',auth()->user()->id_status)->get();
        $tindakan = TindakanKelas::where('tahun_akademik_id',$akademik)->where('NISN',auth()->user()->id_status)->get();
        return view('siswa.RTindakan', compact( 'user','RTindakan','tindakan'));
    }
    public function pembayaran(){
        $user = Auth::user(); 
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Siswa::where('NISN',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('kelas_id');
        $cek2 = Kelas::where('id',$cek)->where('tahun_akademik_id',$akademik)->value('tingkatan_kelas');
        $administrasi1 = AdministrasiSiswa::where('tingkatan_kelas',$cek2)->where('tahun_akademik_id',$akademik)->get();
        $pembayaran = RiwayatAdministrasi::where('NISN',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->get();
        $bayar = AdministrasiSiswa::where('tingkatan_kelas',$cek2)->where('jenis','!=','UDB')->where('tahun_akademik_id',$akademik)->sum('jumlah');
        $UDB = AdministrasiSiswa::where('tingkatan_kelas',$cek2)->where('jenis','=','UDB')->where('tahun_akademik_id',$akademik)->sum('jumlah');
        $dibayar = RiwayatAdministrasi::where('NISN',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->sum('jumlah');
        $siswa = Siswa::where('NISN',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->paginate(1);
        $UDB1 = $UDB*12; 
        $total1 = $bayar+$UDB1;
        $total = $total1-$dibayar;
        return view('siswa.pembayaran', compact('user','pembayaran','siswa','total1','dibayar','total','administrasi1'));
    }
}
