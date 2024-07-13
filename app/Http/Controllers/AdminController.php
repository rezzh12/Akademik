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

class AdminController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftar = Siswa::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $riwayat = RiwayatTindakan::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $user = Auth::user();
        $jurusan = Jurusan::where('tahun_akademik_id',$akademik)->Count();
        $ekskul = Ekskul::where('tahun_akademik_id',$akademik)->Count();
        $tindakan = RiwayatTindakan::where('tahun_akademik_id',$akademik)->Count();
        $pengguna = User::Count();
        return view('admin.Dashboard', compact('user','jurusan','ekskul','tindakan','pengguna','pendaftar','riwayat'));
    }
    


    public function jurusan(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $jurusan = Jurusan::where('tahun_akademik_id',$akademik)->get();
        return view('admin.Jurusan', compact('user','jurusan'));
    }

    public function submit_jurusan(Request $req){
        { $validate = $req->validate([
            'program_keahlian'=> 'required',
            'nama_jurusan'=> 'required',
            'singkatan'=> 'required',
            'deskripsi'=> 'required|max:255',
        ]);
        $prefix = $req->get('singkatan');
        $id = IdGenerator::generate(['table' => 'jurusans','field'=>'kode_jurusan', 'length' => 10, 'prefix' =>$prefix]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Jurusan::where('program_keahlian',$req->get('program_keahlian'))->where('nama_jurusan',$req->get('nama_jurusan'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $jurusan = new Jurusan;
            $jurusan->kode_jurusan = $id;
            $jurusan->program_keahlian = $req->get('program_keahlian');
            $jurusan->nama_jurusan = $req->get('nama_jurusan');
            $jurusan->singkatan = $req->get('singkatan');
            if($req->hasFile('foto'))
        {
            $extension = $req->file('foto')->extension();
            $filename = 'ekskul'.time().'.'.$extension;
            $req->file('foto')->storeAS('public/jurusan', $filename);
            $jurusan->foto = $filename;
        }
        $jurusan->deskripsi = $req->get('deskripsi');
            $jurusan->tahun_akademik_id = $akademik;
            $jurusan->save();
            Session::flash('status', 'Tambah data Jurusan berhasil!!!');
            return redirect()->route('admin.jurusan');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.jurusan');
        }
      
    }}
    
    public function update_jurusan(Request $req){
        $jurusan= Jurusan::find($req->get('id'));
        { $validate = $req->validate([
            'program_keahlian'=> 'required',
            'nama_jurusan'=> 'required',
            'singkatan'=> 'required',
            'deskripsi'=> 'required|max:255',
        ]);
        $jurusan->kode_jurusan = $req->get('kode_jurusan');
        $jurusan->program_keahlian = $req->get('program_keahlian');
        $jurusan->nama_jurusan = $req->get('nama_jurusan');
        $jurusan->singkatan = $req->get('singkatan');
        $jurusan->tahun_akademik_id = $req->get('akademik');
        if($req->hasFile('foto'))
        {
            $extension = $req->file('foto')->extension();
            $filename = 'ekskul'.time().'.'.$extension;
            $req->file('foto')->storeAS('public/jurusan', $filename);
            $jurusan->foto = $filename;
            Storage::delete('public/jurusan/'.$req->get('old_foto'));
        }
        $jurusan->deskripsi = $req->get('deskripsi');
        $jurusan->save();
        Session::flash('status', 'Ubah data Jurusan berhasil!!!');
        return redirect()->route('admin.jurusan');
    }}

    public function getDataJurusan($id)
    {
        $jurusan = Jurusan::find($id);
        return response()->json($jurusan);
    }

    public function delete_jurusan($id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->delete();
        $success = true;
        $message = "Data Jurusan Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }

    public function mapel(){
        $user = Auth::user(); 
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum1 = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->value('id');
        $mapel = Mapel::where('kurikulum_id',$kurikulum1)->get();
        $kurikulum = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->get();
        return view('admin.Mapel', compact('user','mapel','kurikulum'));
    }

    public function submit_mapel(Request $req){
        { $validate = $req->validate([
            'nama_mapel'=> 'required',
        ]);
        $id = IdGenerator::generate(['table' => 'mapels','field'=>'kode_mapel', 'length' => 10, 'prefix' =>'MP-']);
        $cek = Mapel::where('nama_mapel',$req->get('nama_mapel'))->where('kurikulum_id',$req->get('kurikulum'))->value('id');
        if($cek == null){
            $mapel = new Mapel;
            $mapel->kode_mapel = $id;
            $mapel->nama_mapel = $req->get('nama_mapel');
            $mapel->kurikulum_id =  $req->get('kurikulum');
            $mapel->save();
            Session::flash('status', 'Tambah data Mapel berhasil!!!');
            return redirect()->route('admin.mapel');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.mapel');
        }
       
    }}
    
    public function update_mapel(Request $req){
        $mapel= Mapel::find($req->get('id'));
        { $validate = $req->validate([
            'nama_mapel'=> 'required',
        ]);
        $mapel->kode_mapel = $req->get('kode');
        $mapel->nama_mapel = $req->get('nama_mapel');
        $mapel->kurikulum_id =  $req->get('kurikulum');
        $mapel->save();
        Session::flash('status', 'Ubah data Mapel berhasil!!!');
        return redirect()->route('admin.mapel');
    }}

    public function getDataMapel($id)
    {
        $mapel = Mapel::find($id);
        return response()->json($mapel);
    }

    public function delete_mapel($id)
    {
        $mapel = Mapel::find($id);
        $mapel->delete();

        $success = true;
        $message = "Data Mata Pelajaran Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function akademik(){
        $user = Auth::user();
        $akademik = TahunAkademik::all();
        return view('admin.tahunAkademik', compact('user','akademik'));
    }

    public function submit_akademik(Request $req){
        { $validate = $req->validate([
            'tahun_akademik'=> 'required|unique:tahun_akademiks',
            'status'=> 'required',
        ]);
        
        if($req->get('status') == 0){
        $akademik = new TahunAkademik;
        $akademik->tahun_akademik = $req->get('tahun_akademik');
        $akademik->status = $req->get('status');
        $akademik->save();
    }else{
        $akademik = new TahunAkademik;
        $akademik->tahun_akademik = $req->get('tahun_akademik');
        $akademik->status = $req->get('status');
        $akademik->save();
        DB::table('tahun_akademiks')->where('tahun_akademik','!=',$req->get('tahun_akademik'))->update(['status' => 0,]);
    }
        Session::flash('status', 'Tambah data Tahun Akademik berhasil!!!');
        return redirect()->route('admin.akademik');
    }}
    
    public function update_akademik(Request $req){
        $akademik= TahunAkademik::find($req->get('id'));
        { $validate = $req->validate([
            'tahun_akademik'=> 'required',
            'status'=> 'required',
        ]);
        if($req->get('status') == 0){
            $akademik->tahun_akademik = $req->get('tahun_akademik');
            $akademik->status = $req->get('status');
            $akademik->save();
        }else{
            $akademik->tahun_akademik = $req->get('tahun_akademik');
            $akademik->status = $req->get('status');
            $akademik->save();
            DB::table('tahun_akademiks')->where('tahun_akademik','!=',$req->get('tahun_akademik'))->update(['status' => 0,]);
        }
        Session::flash('status', 'Ubah data Tahun Akademik berhasil!!!');
        return redirect()->route('admin.akademik');
    }}

    public function getDataAkademik($id)
    {
        $akademik = TahunAkademik::find($id);
        return response()->json($akademik);
    }

    public function delete_akademik($id)
    {
        $akademik = TahunAkademik::find($id);
        $akademik->delete();
        $success = true;
        $message = "Data Akademik Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
       
    }

    public function kurikulum(){
        $user = Auth::user();
        $kurikulum = Kurikulum::all();
        return view('admin.Kurikulum', compact('user','kurikulum'));
    }

    public function submit_kurikulum(Request $req){
        { $validate = $req->validate([
            'nama_kurikulum'=> 'required',
            'status'=> 'required',
        ]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Kurikulum :: where('nama_kurikulum',$req->get('nama_kurikulum'))->where('semester',$req->get('semester'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $kurikulum = new Kurikulum;
            $kurikulum->nama_kurikulum = $req->get('nama_kurikulum');
            $kurikulum->semester = $req->get('semester');
            $kurikulum->status = $req->get('status');
            $kurikulum->tahun_akademik_id = $akademik;
            $kurikulum->save();
            Session::flash('status', 'Tambah data Kurikulum berhasil!!!');
            return redirect()->route('admin.kurikulum');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.kurikulum');
        }
       
    }}
    
    public function update_kurikulum(Request $req){
        $kurikulum = Kurikulum::find($req->get('id'));
        { $validate = $req->validate([
            'nama_kurikulum'=> 'required',
            'status'=> 'required',
        ]);
        $kurikulum->nama_kurikulum = $req->get('nama_kurikulum');
        $kurikulum->semester = $req->get('semester');
        $kurikulum->status = $req->get('status');
        $kurikulum->tahun_akademik_id =  $req->get('akademik');
        $kurikulum->save();
        Session::flash('status', 'Ubah data Kurikulum berhasil!!!');
        return redirect()->route('admin.kurikulum');
    }}

    public function getDataKurikulum($id)
    {
        $kurikulum = Kurikulum::find($id);
        return response()->json($kurikulum);
    }

    public function delete_kurikulum($id)
    {
        $kurikulum = Kurikulum::find($id);
        $kurikulum->delete();
        $success = true;
        $message = "Data Kurikulum Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function kelas(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kelas = Kelas::where('tahun_akademik_id',$akademik)->get();
        $jurusan = Jurusan::all();
        return view('admin.Kelas', compact('user','kelas','jurusan'));
    }

    public function submit_kelas(Request $req){
        { $validate = $req->validate([
            'nama_kelas'=> 'required',
            'tingkatan_kelas'=> 'required',
            'jurusan_id'=> 'required',
        ]);
        $id = IdGenerator::generate(['table' => 'kelas','field'=>'kode_kelas', 'length' => 10, 'prefix' =>'KS-']);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Kelas::where('nama_kelas',$req->get('nama_kelas'))->where('tingkatan_kelas',$req->get('tingkatan_kelas'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $kelas = new Kelas;
            $kelas->kode_kelas =$id;
            $kelas->nama_kelas = $req->get('nama_kelas');
            $kelas->tingkatan_kelas = $req->get('tingkatan_kelas');
            $kelas->jurusan_id = $req->get('jurusan_id');
            $kelas->tahun_akademik_id = $akademik;
            $kelas->save();
            Session::flash('status', 'Tambah data Kelas berhasil!!!');
            return redirect()->route('admin.kelas');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.kelas');
        }
       
    }}
    
    public function update_kelas(Request $req){
        $kelas= Kelas::find($req->get('id'));
        { $validate = $req->validate([
            'nama_kelas'=> 'required',
            'tingkatan_kelas'=> 'required',
            'jurusan_id'=> 'required',
        ]);
        $kelas->kode_kelas = $req->get('kode');
        $kelas->nama_kelas = $req->get('nama_kelas');
        $kelas->tingkatan_kelas = $req->get('tingkatan_kelas');
        $kelas->jurusan_id = $req->get('jurusan_id');
        $kelas->tahun_akademik_id = $req->get('akademik');
        $kelas->save();
        Session::flash('status', 'Ubah data Kelas berhasil!!!');
        return redirect()->route('admin.kelas');
    }}

    public function getDataKelas($id)
    {
        $kelas = Kelas::find($id);
        return response()->json($kelas);
    }

    public function delete_kelas($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        $success = true;
        $message = "Data Kelas Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    

    public function jadwal(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum1 = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->value('id');
        $kurikulum = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->get();
        $jurusan = Jurusan::all();
        $kelas = Kelas::all();
        $mapel = Mapel::where('kurikulum_id',$kurikulum1)->get();
        $guru = Guru::all();
        $jadwal = Jadwal::where('kurikulum_id',$kurikulum1)->get();
        return view('admin.jadwalPelajaran', compact('user','jadwal','guru','akademik','mapel','jurusan','kelas','kurikulum'));
    }

    public function submit_jadwal(Request $req){
        { $validate = $req->validate([
            'kelas'=> 'required',
            'mapel'=> 'required',
            'guru'=> 'required',
            'jam'=> 'required',
            'hari'=> 'required',
        ]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Jadwal::where('jam',$req->get('jam'))->where('guru_id',$req->get('guru'))->where('hari',$req->get('hari'))->value('id');
        $cek3 = Jadwal::where('jam',$req->get('jam'))->where('hari',$req->get('hari'))->value('id');
        if($cek == null){
            $jadwal = new Jadwal;
            $jadwal->tahun_akademik_id = $akademik;
            $jadwal->kurikulum_id = $req->get('kurikulum');
            $jadwal->kelas_id = $req->get('kelas');
            $jadwal->mapel_id = $req->get('mapel');
            $jadwal->guru_id = $req->get('guru');
            $jadwal->jam = $req->get('jam');
            $jadwal->hari = $req->get('hari');
            $jadwal->save();
            $guru = Guru::where('id',$req->get('guru'))->value('NUPTK');
            $cek1 = Pengampu::where('kurikulum_id',$req->get('kurikulum'))->where('NUPTK',$guru)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->value('id');
            $cek2 = Nilai::where('tahun_akademik_id',$akademik)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->where('kurikulum_id',$req->get('kurikulum'))->value('NISN');
            if($cek1 == null){
                $pengampu = new Pengampu;
                $pengampu->tahun_akademik_id = $akademik;
                $pengampu->kurikulum_id = $req->get('kurikulum');
                $pengampu->mapel_id = $req->get('mapel');
                $pengampu->Kelas_id = $req->get('kelas');
                $pengampu->NUPTK = $guru;
                $pengampu->save();
            }else{
                
            }
            if($cek2 == null){
                $siswa = Siswa::where('kelas_id',$req->get('kelas'))->get();
                foreach($siswa as $row){
                    $nilai = new Nilai;
                    $nilai->tahun_akademik_id = $akademik;
                    $nilai->NISN = $row->NISN;
                    $nilai->nilai = null;
                    $nilai->ketercapaian = null;
                    $nilai->deskripsi = null;
                    $nilai->Sakit = 0;
                    $nilai->Izin = 0;
                    $nilai->Alfa = 0;
                    $nilai->kurikulum_id = $req->get('kurikulum');
                    $nilai->mapel_id = $req->get('mapel');
                    $nilai->Kelas_id = $req->get('kelas');
                    $nilai->save();
                }
            }else{
                
            }
            Session::flash('status', 'Tambah data Jadwal berhasil!!!');
            return redirect()->route('admin.jadwal');
        }elseif($cek3 == null){
            $jadwal = new Jadwal;
            $jadwal->tahun_akademik_id = $akademik;
            $jadwal->kurikulum_id = $req->get('kurikulum');
            $jadwal->kelas_id = $req->get('kelas');
            $jadwal->mapel_id = $req->get('mapel');
            $jadwal->guru_id = $req->get('guru');
            $jadwal->jam = $req->get('jam');
            $jadwal->hari = $req->get('hari');
            $jadwal->save();
            $guru = Guru::where('id',$req->get('guru'))->value('NUPTK');
            $cek1 = Pengampu::where('NUPTK',$guru)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->value('id');
            $cek2 = Nilai::where('tahun_akademik_id',$akademik)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->where('kurikulum_id',$req->get('kurikulum'))->value('id');
            if($cek1 == null){
                $pengampu = new Pengampu;
                $pengampu->tahun_akademik_id = $akademik;
                $pengampu->kurikulum_id = $req->get('kurikulum');
                $pengampu->mapel_id = $req->get('mapel');
                $pengampu->Kelas_id = $req->get('kelas');
                $pengampu->NUPTK = $guru;
                $pengampu->save();
            }else{
                
            }
        }
        else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.jadwal');
        }
       
    }}
    public function getDataJadwal($id)
    {
        $jadwal = Jadwal::find($id);
        return response()->json($jadwal);
    }
    public function update_jadwal(Request $req)
    { 
       
        { $validate = $req->validate([
            'kelas'=> 'required',
            'mapel'=> 'required',
            'guru'=> 'required',
            'jam'=> 'required',
            'hari'=> 'required',
        ]);
        $cek = Jadwal::where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('guru_id',$req->get('gurus'))->where('kelas_id',$req->get('kelas'))->count();
        $gurus = Guru::where('id',$req->get('gurus'))->value('NUPTK');
        $guru = Guru::where('id',$req->get('guru'))->value('NUPTK');
        if($cek == 1){
           $hapus = Pengampu :: where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('NUPTK',$gurus)->where('kelas_id',$req->get('kelas'))->delete();
            $jadwal= Jadwal::find($req->get('id'));
            $jadwal->tahun_akademik_id = $req->get('akademik');
            $jadwal->kurikulum_id = $req->get('kurikulum');
            $jadwal->kelas_id = $req->get('kelas');
            $jadwal->mapel_id = $req->get('mapel');
            $jadwal->guru_id = $req->get('guru');
            $jadwal->jam = $req->get('jam');
            $jadwal->hari = $req->get('hari');
            
            $cek1 = Pengampu::where('kurikulum_id',$req->get('kurikulum'))->where('NUPTK',$guru)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->value('id');
            if($cek1 == null){ 
                $pengampu = new Pengampu;
                $pengampu->tahun_akademik_id = $req->get('akademik');
                $pengampu->kurikulum_id = $req->get('kurikulum');
                $pengampu->mapel_id = $req->get('mapel');
                $pengampu->Kelas_id = $req->get('kelas');
                $pengampu->NUPTK = $guru;
                $pengampu->save();
                $jadwal->save();}
                else{
                    $jadwal->save();
                }
           
        }else{
            $jadwal= Jadwal::find($req->get('id'));
            $jadwal->tahun_akademik_id = $req->get('akademik');
            $jadwal->kurikulum_id = $req->get('kurikulum');
            $jadwal->kelas_id = $req->get('kelas');
            $jadwal->mapel_id = $req->get('mapel');
            $jadwal->guru_id = $req->get('guru');
            $jadwal->jam = $req->get('jam');
            $jadwal->hari = $req->get('hari');
            $cek1 = Pengampu::where('kurikulum_id',$req->get('kurikulum'))->where('NUPTK',$guru)->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->value('id');
            if($cek1 == null){ 
                $pengampu = new Pengampu;
                $pengampu->tahun_akademik_id = $req->get('akademik');
                $pengampu->kurikulum_id = $req->get('kurikulum');
                $pengampu->mapel_id = $req->get('mapel');
                $pengampu->Kelas_id = $req->get('kelas');
                $pengampu->NUPTK = $guru;
                $pengampu->save();
                $jadwal->save();}
                else{
                    $jadwal->save();
                }
        }
        $cek2 = Nilai::where('tahun_akademik_id',$req->get('akademik'))->where('mapel_id',$req->get('mapel'))->where('kelas_id',$req->get('kelas'))->where('kurikulum_id',$req->get('kurikulum'))->value('NISN');
        if($cek2 == null){
            $siswa = Siswa::where('kelas_id',$req->get('kelas'))->get();
            foreach($siswa as $row){
                $nilai = new Nilai;
                $nilai->tahun_akademik_id = $req->get('akademik');
                $nilai->NISN = $row->NISN;
                $nilai->nilai = null;
                $nilai->ketercapaian = null;
                $nilai->deskripsi = null;
                $nilai->Sakit = 0;
                $nilai->Izin = 0;
                $nilai->Alfa = 0;
                $nilai->kurikulum_id = $req->get('kurikulum');
                $nilai->mapel_id = $req->get('mapel');
                $nilai->Kelas_id = $req->get('kelas');
                $nilai->save();
            }
        }else{
            
        }
       
        Session::flash('status', 'Ubah data Jadwal berhasil!!!');
        return redirect()->route('admin.jadwal');
    }
    }
    public function delete_jadwal($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        $success = true;
        $message = "Data Jadwal Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function walikelas(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kelas = Kelas::all();
        $guru = Guru::all();
        $walikelas = Walikelas::where('tahun_akademik_id',$akademik)->get();
        return view('admin.dataWalikelas', compact('user','walikelas','guru','akademik','kelas'));
    }
    public function submit_walikelas(Request $req){
        { $validate = $req->validate([
            'kelas'=> 'required',
            'guru'=> 'required',
        ]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Walikelas::where('NUPTK', $req->get('guru'))->where('tahun_akademik_id',$akademik)->value('id');
        DB::table('users')->where('id_status', $req->get('guru'))->update(['roles_id'=>5]);
        if($cek == null){
            $walikelas = new Walikelas;
            $walikelas->tahun_akademik_id = $akademik;
            $walikelas->kelas_id = $req->get('kelas');
            $walikelas->NUPTK = $req->get('guru');
            $walikelas->save();
            Session::flash('status', 'Tambah data Walikelas berhasil!!!');
            return redirect()->route('admin.walikelas');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.walikelas');
        }
       
    }}
    public function getDataWalikelas($id)
    {
        $walikelas = Walikelas::find($id);
        return response()->json($walikelas);
    }
    public function update_walikelas(Request $req)
    { 
        $walikelas= Walikelas::find($req->get('id'));
        { $validate = $req->validate([
            'kelas'=> 'required',
            'guru'=> 'required',
        ]);
        $walikelas->tahun_akademik_id = $req->get('akademik');
        $walikelas->kelas_id = $req->get('kelas');
        $walikelas->NUPTK = $req->get('guru');
        $walikelas->save();
        Session::flash('status', 'Ubah data Walikelas berhasil!!!');
        return redirect()->route('admin.walikelas');
    }
    }
    public function delete_walikelas($id)
    {
        $walikelas = Walikelas::find($id);
        $walikelas->delete();
        $success = true;
        $message = "Data Walikelas Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function ekskul(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $ekskul = Ekskul::where('tahun_akademik_id',$akademik)->get();
        $guru = Guru::all();
        return view('admin.ekskul', compact('user','ekskul','guru'));
    }
    public function submit_ekskul(Request $req){
        { $validate = $req->validate([
            'guru'=> 'required',
            'nama'=> 'required',
            'foto'=> 'required',
            'nama'=> 'required',
            'deskripsi'=> 'required|max:255',
        ]);  
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = Ekskul::where('nama',$req->get('nama'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $ekskul = new Ekskul;
            $ekskul->tahun_akademik_id = $akademik;
            $ekskul->NUPTK = $req->get('guru');
            $ekskul->nama = $req->get('nama');
            if($req->hasFile('foto'))
        {
            $extension = $req->file('foto')->extension();
            $filename = 'ekskul'.time().'.'.$extension;
            $req->file('foto')->storeAS('public/ekskul', $filename);
            $ekskul->foto = $filename;
        }
            $ekskul->deskripsi = $req->get('deskripsi');
            $ekskul->save();
            Session::flash('status', 'Tambah data Ekskul berhasil!!!');
            return redirect()->route('admin.ekskul');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('admin.ekskul');
        }
       
    }}
    public function getDataEkskul($id)
    {
        $ekskul = Ekskul::find($id);
        return response()->json($ekskul);
    }
    public function update_ekskul(Request $req)
    { 
        $ekskul= Ekskul::find( $req->get('id'));
        { $validate = $req->validate([
            'akademik'=> 'required',
            'guru'=> 'required',
            'nama'=> 'required',
            'deskripsi'=> 'required|max:255',
        ]);
        $ekskul->tahun_akademik_id = $req->get('akademik');
        $ekskul->NUPTK = $req->get('guru');
        $ekskul->nama = $req->get('nama');
        if($req->hasFile('foto'))
        {
            $extension = $req->file('foto')->extension();
            $filename = 'ekskul'.time().'.'.$extension;
            $req->file('foto')->storeAS('public/ekskul', $filename);
            $ekskul->foto = $filename;
            Storage::delete('public/ekskul/'.$req->get('old_foto'));
        }
        $ekskul->deskripsi = $req->get('deskripsi');
        $ekskul->save();
        Session::flash('status', 'Ubah data Ekskul berhasil!!!');
        return redirect()->route('admin.ekskul');
    }
    }
    public function delete_ekskul($id)
    {
        $ekskul = Ekskul::find($id);
        $ekskul->delete();
    
        $success = true;
        $message = "Data Ekskul Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function riwayat_ekskul($id){
        $user = Auth::user();
        $REkskul = NilaiEkskul::where('ekskuls_id', $id)->with('siswa')->get();
        $ekskul = Ekskul::where('id',$id)->with('akademik','guru')->get();
        return view('admin.nilai_ekskul', compact('user','ekskul','REkskul'));
    }
    
    public function submit_riwayat_ekskul(Request $req){
        { $validate = $req->validate([
            'NISN'=> 'required',
            'deskripsi'=> 'required',
            'ekskul_id'=> 'required',
        ]);
        $siswa = Siswa::where('nama_lengkap',$req->get('NISN'))->value('NISN');
        $akademik = TahunAkademik::where('status',1)->value('id');
        $cek = NilaiEkskul::where('NISN',$siswa)->where('ekskuls_id',$req->get('ekskul_id'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $REkskul = new NilaiEkskul;
            $REkskul->NISN = $siswa;
            $REkskul->Deskripsi = $req->get('deskripsi');
            $REkskul->tahun_akademik_id = $akademik;
            $REkskul->ekskuls_id = $req->get('ekskul_id');
            $REkskul->save();
            Session::flash('status', 'Tambah data Nilai Ekskul berhasil!!!');
            return redirect()->back();
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->back();
        }
    }}
    public function getDataRiwayatEkskul($id)
    {
        $REkskul = NilaiEkskul::find($id);
        return response()->json($REkskul);
    }
    public function update_riwayat_ekskul(Request $req)
    {  $akademik = TahunAkademik::where('status',1)->value('id');
        $REkskul= NilaiEkskul::find($req->get('id'));
        { $validate = $req->validate([
            'NISN'=> 'required',
            'deskripsi'=> 'required|max:255',
            'ekskul_id'=> 'required',
        ]);
        $REkskul->NISN = $req->get('NISN');
        $REkskul->Deskripsi = $req->get('deskripsi');
        $REkskul->tahun_akademik_id = $akademik;
        $REkskul->ekskuls_id = $req->get('ekskul_id');
        $REkskul->save();
        Session::flash('status', 'Ubah data Nilai Ekskul berhasil!!!');
        return redirect()->back();
    }
    }
    public function delete_riwayat_ekskul($id)
    {
        $REkskul = NilaiEkskul::find($id);
        $REkskul->delete();
        $success = true;
        $message = "Data Nilai Ekskul Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function pengampu(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->value('id');
        $pengampu=Pengampu::where('kurikulum_id',$kurikulum)->get();
        return view('admin.pengampu', compact('user','pengampu','akademik'));
    }
    public function penilaian($id){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pengampu=Pengampu::where('id',$id)->get();
        $penilaian = Penilaian::where('pengampu_id', $id)->where('tahun_akademik_id',$akademik)->get();
        return view('admin.penilaian', compact('user','penilaian','pengampu'));
    }

    public function submit_penilaian(Request $req){
        { $validate = $req->validate([
            'judul'=> 'required',
            'kategori'=> 'required',
        ]);
        $kode = IdGenerator::generate(['table' => 'penilaians','field'=>'kode', 'length' => 10, 'prefix' =>'KD-']);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pengampu = Pengampu::where('id',$req->get('pengampu_id'))->value('id');
        $mapel = Pengampu::where('id',$req->get('pengampu_id'))->value('mapel_id');
        $kelas = Pengampu::where('id',$req->get('pengampu_id'))->value('kelas_id');
        $kurikulum = Pengampu::where('id',$req->get('pengampu_id'))->value('kurikulum_id');
        $penilaian = new Penilaian;
        $penilaian->kode = $kode;
        $penilaian->tanggal = Carbon::now();
        $penilaian->judul = $req->get('judul');
        $penilaian->kategori = $req->get('kategori');
        $penilaian->kurikulum_id = $kurikulum;
        $penilaian->pengampu_id = $pengampu;
        $penilaian->mapel_id = $mapel;
        $penilaian->kelas_id = $kelas;
        $penilaian->tahun_akademik_id = $akademik;
        $penilaian->save();
        $id=Penilaian::where('kode',$kode)->value('id');
        $siswa = Siswa::where('kelas_id',$kelas)->get();
        foreach($siswa as $row){
            $riwayat = new RiwayatNilai;
            $riwayat->NISN = $row->NISN;
            $riwayat->kategori = $req->get('kategori');
            $riwayat->keterangan = null;
            $riwayat->skor = null;
            $riwayat->kurikulum_id = $kurikulum;
            $riwayat->penilaian_id = $id;
            $riwayat->pengampu_id = $pengampu;
            $riwayat->mapel_id = $mapel;
            $riwayat->kelas_id = $kelas;
            $riwayat->tahun_akademik_id = $akademik;
            $riwayat->save();
        }
        Session::flash('status', 'Tambah data Penilaian berhasil!!!');
        return redirect()->back();
    }}
    public function getDataPenilaian($id)
    {
        $penilaian = Penilaian::find($id);
        return response()->json($penilaian);
    }
    public function update_penilaian(Request $req)
    { 
        $penilaian= Penilaian::find($req->get('id'));
        { $validate = $req->validate([
            'judul'=> 'required',
            'kategori'=> 'required',
        ]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pengampu = Pengampu::where('id',$req->get('pengampu_id'))->value('id');
        $mapel = Pengampu::where('id',$req->get('pengampu_id'))->value('mapel_id');
        $kelas = Pengampu::where('id',$req->get('pengampu_id'))->value('kelas_id');
        $penilaian->kode = $req->get('kode');
        $penilaian->tanggal = Carbon::now();
        $penilaian->judul = $req->get('judul');
        $penilaian->kategori = $req->get('kategori');
        $penilaian->pengampu_id = $pengampu;
        $penilaian->mapel_id = $mapel;
        $penilaian->kelas_id = $kelas;
        $penilaian->tahun_akademik_id = $akademik;
        $penilaian->save();
        Session::flash('status', 'Ubah data Penilaian berhasil!!!');
        return redirect()->back();
    }
    }
    public function delete_penilaian($id)
    {
        DB::table('riwayat_nilais')->where('penilaian_id', $id)->delete();
        $penilaian = Penilaian::find($id);
        $penilaian->delete();
        
        $success = true;
        $message = "Data Penilaian Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
    public function riwayat_penilaian($id){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pengampu_id = RiwayatNilai::where('penilaian_id',$id)->value('pengampu_id');
        $pengampu=Pengampu::where('id',$pengampu_id)->get();
        $riwayat=RiwayatNilai::where('penilaian_id',$id)->get();
        $riwayats=RiwayatNilai::where('penilaian_id',$id)->paginate(1);
        return view('admin.riwayat', compact('user','riwayat','pengampu','riwayats'));
    }
    public function getDataRiwayat($id)
    {
        $riwayat = RiwayatNilai::find($id);
        return response()->json($riwayat);
    }
    public function update_riwayat(Request $req)
    { 
        $riwayat= RiwayatNilai::find($req->get('id'));
        $riwayat->NISN = $req->get('NISN');
        $riwayat->kategori = $req->get('kategori');
        $riwayat->kurikulum_id = $req->get('kurikulum');
        $riwayat->penilaian_id = $req->get('penilaian');
        $riwayat->pengampu_id = $req->get('pengampu');
        $riwayat->keterangan = $req->get('keterangan');
        $riwayat->mapel_id = $req->get('mapel');
        $riwayat->kelas_id = $req->get('kelas');
        $riwayat->tahun_akademik_id = $req->get('akademik');
        if($req->get('keterangan')=="Hadir"){
            $riwayat->skor = 1;
            $riwayat->save();
            DB::table('nilais')->where('NISN', $req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->update(['tanggal'=>Carbon::now()]);
        }
        else if($req->get('keterangan')=="Absen"){
            $riwayat->keterangan = $req->get('keterangan');
            $riwayat->skor = 0;
            $riwayat->save();
            $tanggal = Carbon::now()->format('Y-m-d');
            $tanggal1 = Nilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->value('tanggal');
            if($tanggal == $tanggal1){

            }else{
                $alfa = Nilai::where('NISN',$req->get('NISN'))->value('Alfa');
                DB::table('nilais')->where('NISN', $req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->update(['Alfa' => $alfa+1, 'tanggal'=>Carbon::now()]);
            }
        }
        else if($req->get('keterangan')=="Izin"){
            $riwayat->keterangan = $req->get('keterangan');
            $riwayat->skor = 1;
            $riwayat->save();
            $tanggal = Carbon::now()->format('Y-m-d');
            $tanggal1 = Nilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->value('tanggal');
            if($tanggal == $tanggal1){

            }else{
                $izin = Nilai::where('NISN',$req->get('NISN'))->value('Izin');
                DB::table('nilais')->where('NISN', $req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->update(['Izin' => $izin+1, 'tanggal'=>Carbon::now()]);
            }
        }
        else if($req->get('keterangan')=="Sakit"){
            $riwayat->keterangan = $req->get('keterangan');
            $riwayat->skor = 1;
            $riwayat->save();
            $tanggal = Carbon::now()->format('Y-m-d');
            $tanggal1 = Nilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->value('tanggal');
            if($tanggal == $tanggal1){

            }else{
                $sakit = Nilai::where('NISN',$req->get('NISN'))->value('Sakit');
                DB::table('nilais')->where('NISN', $req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->update(['Sakit' => $sakit+1, 'tanggal'=>Carbon::now()]);
            }
        }
        else{
            $riwayat->keterangan = "Sudah Mengerjakan";
            $riwayat->skor = $req->get('skor');
            $riwayat->save();
        }
        $skorAbsen = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Absen')->sum('skor');
        $jumlahAbsen = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Absen')->count();
        $skorTugas = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Tugas')->sum('skor');
        $jumlahTugas = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Tugas')->count();
        $skorPraktikum = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Praktikum')->sum('skor');
        $jumlahPraktikum = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','Praktikum')->count();
        $skorUTS = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','UTS')->sum('skor');
        $jumlahUTS = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','UTS')->count();
        $skorUAS = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','UAS')->sum('skor');
        $jumlahUAS = RiwayatNilai::where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->where('kategori','=','UAS')->count();
        if($jumlahAbsen == 0){
            $nilaiAbsen = (1/1)*10;
        }else{
            $nilaiAbsen = ($skorAbsen/$jumlahAbsen)*10;
        }
        if($jumlahTugas == 0){
            $nilaiTugas = (1/1)*25;
        }else{
            $nilaiTugas = ($skorTugas*0.01/$jumlahTugas)*25;
        }
        if($jumlahPraktikum == 0){
            $nilaiPraktikum = (1/1)*15;
        }else{
            $nilaiPraktikum = ($skorPraktikum*0.01/$jumlahPraktikum)*15;
        }
        if($jumlahUTS == 0){
            $nilaiUTS = (1/1)*25;
        }else{
            $nilaiUTS = ($skorUTS*0.01/$jumlahUTS)*25;
        }
        if($jumlahUAS == 0){
            $nilaiUAS = (1/1)*25;
        }else{
            $nilaiUAS = ($skorUAS*0.01/$jumlahUAS)*25;
        }
        $jumlah = $nilaiAbsen+$nilaiTugas+$nilaiPraktikum+$nilaiUTS+$nilaiUAS;

        if($jumlah>=81 && $jumlah<=100 ){
            $ketercapaian = "Sangat Baik";
        }
        if($jumlah>=71 && $jumlah<=80 ){
            $ketercapaian = "Baik";
        }
        if($jumlah>=61 && $jumlah<=70 ){
            $ketercapaian = "Cukup Baik";
        }
        if($jumlah>=0 && $jumlah<=60 ){
            $ketercapaian = "Kurang";
        }
        DB::table('nilais')->where('NISN',$req->get('NISN'))->where('kurikulum_id',$req->get('kurikulum'))->where('mapel_id',$req->get('mapel'))->update(['nilai' => $jumlah, 'ketercapaian'=>$ketercapaian ]);


        Session::flash('status', 'Ubah data Penilaian berhasil!!!');
        return redirect()->back();
    }

    public function hasil($id){
        $user = Auth::user();
        $pengampu1 = Pengampu::where('id',$id)->get();
        $pengampu = Pengampu::where('id',$id)->value('id');
        $akademik = Pengampu::where('id',$id)->value('tahun_akademik_id');
        $kelas = Pengampu::where('id',$id)->value('kelas_id');
        $kurikulum=Pengampu::where('id',$id)->value('kurikulum_id');
        $mapel=Pengampu::where('id',$id)->value('mapel_id');
        $nilai=Nilai::where('tahun_akademik_id',$akademik)->where('kelas_id',$kelas)->where('kurikulum_id',$kurikulum)->where('mapel_id',$mapel)->get();
        return view('admin.nilai', compact('user','nilai','pengampu1'));
    }
    public function getDataHasil($id)
    {
        $nilai = Nilai::find($id);
        return response()->json($nilai);
    }
    public function update_hasil(Request $req)
    { 
        $nilai= Nilai::find($req->get('id'));
        { $validate = $req->validate([
            'deskripsi'=> 'required',
        ]);
        $nilai->tahun_akademik_id = $req->get('akademik');
        $nilai->tanggal = $req->get('tanggal');
        $nilai->NISN = $req->get('NISN');
        $nilai->nilai = $req->get('nilai');
        $nilai->ketercapaian = $req->get('ketercapaian');
        $nilai->deskripsi = $req->get('deskripsi');
        $nilai->Sakit = $req->get('sakit');
        $nilai->Izin = $req->get('izin');
        $nilai->Alfa = $req->get('alfa');
        $nilai->mapel_id = $req->get('mapel');
        $nilai->kelas_id = $req->get('kelas');
        $nilai->kurikulum_id = $req->get('kurikulum');
        $nilai->save();
        Session::flash('status', 'Ubah data Nilai berhasil!!!');
        return redirect()->back();
    }
    }

    public function RTindakan()
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $user = Auth::user();
        $RTindakan = RiwayatTindakan::where('tahun_akademik_id',$akademik)->get();
        return view('admin.RTindakan', compact( 'user','RTindakan'));
    }

    public function submit_RTindakan(Request $req){
            { $validate = $req->validate([
                'NISN'=> 'required',
                'judul'=> 'required',
                'foto'=> 'required',
                'kategori'=> 'required',
                'skor'=> 'required',
                'deskripsi'=> 'required',
            ]);
            $akademik = TahunAkademik::where('status',1)->value('id');
            $NISN = Siswa::where('tahun_akademik_id',$akademik)->where('nama_lengkap',$req->get('NISN'))->value('NISN');
            $kelas = Siswa::where('tahun_akademik_id',$akademik)->where('nama_lengkap',$req->get('NISN'))->value('kelas_id');
            $tindakan =TindakanKelas::where('tahun_akademik_id',$akademik)->where('NISN',$NISN)->value('id');
            if($NISN == null){
                Session::flash('status', 'Nama Yang Anda Masukan Tidak Ditemukan');
                return redirect()->route('admin.RTindakan');
            }
            else{
            if($tindakan == null){
                $RTindakan = new RiwayatTindakan;
                $RTindakan->NUPTK = auth()->user()->id_status;
                $RTindakan->NISN = $NISN ;
                $RTindakan->judul = $req->get('judul');
                $RTindakan->kategori = $req->get('kategori');
                if($req->hasFile('foto')){
                    $extension = $req->file('foto')->extension();
                    $filename = 'foto'.time().'.'.$extension;
                    $req->file('foto')->storeAS('public/tindakan', $filename);
                    $RTindakan->foto = $filename;
                    }
                $RTindakan->skor = $req->get('skor');
                $RTindakan->deskripsi =  $req->get('deskripsi');
                $RTindakan->tahun_akademik_id =  $akademik;
                $RTindakan->save();

                $tindakan = new TindakanKelas;
                $tindakan->NISN = $NISN ;
                $tindakan->skor = $req->get('skor');
                $tindakan->tindakan = null;
                $tindakan->kelas_id = $kelas;
                $tindakan->tahun_akademik_id =  $akademik;
                $tindakan->save();
            }else{
                $nilai =TindakanKelas::where('tahun_akademik_id',$akademik)->where('NISN',$NISN)->value('skor');
                $total = $nilai + $req->get('skor');
                DB::table('tindakan_kelas')->where('NISN', $NISN)->where('tahun_akademik_id',$akademik)->update(['skor'=>$total]);
            }
            Session::flash('status', 'Tambah data Riwayat Tindakan berhasil!!!');
            return redirect()->route('admin.RTindakan');
        }
        }}
        public function getDataRTindakan($id)
        {
            $RTindakan= RiwayatTindakan::find($id);
            return response()->json($RTindakan);
        }
    public function update_RTindakan(Request $req){
        $RTindakan= RiwayatTindakan::find($req->get('id'));
        { $validate = $req->validate([
            'NISN'=> 'required',
            'judul'=> 'required',
            'foto'=> 'required',
            'kategori'=> 'required',
            'skor'=> 'required',
            'deskripsi'=> 'required',
        ]);
        $RTindakan->NUPTK = $req->get('NUPTK');
        $RTindakan->NISN = $req->get('NISN');
        $RTindakan->judul = $req->get('judul');
        $RTindakan->kategori = $req->get('kategori');
        if($req->hasFile('foto')){
        $extension = $req->file('foto')->extension();
        $filename = 'foto'.time().'.'.$extension;
        $req->file('foto')->storeAS('public/tindakan', $filename);
        Storage::delete('public/tindakan/'.$req->get('foto_lama'));
        $RTindakan->foto = $filename;}
        $RTindakan->skor = $req->get('skor');
        $RTindakan->deskripsi =  $req->get('deskripsi');
        $RTindakan->tahun_akademik_id =  $req->get('akademik');
        $SRTindakan = RiwayatTindakan::where('id',$req->get('id'))->value('skor');
        $STindakan = TindakanKelas::where('NISN',$req->get('NISN'))->where('tahun_akademik_id',$req->get('akademik'))->value('skor');
        $total = $STindakan + $req->get('skor') - $SRTindakan;
        DB::table('tindakan_kelas')->where('NISN', $req->get('NISN'))->where('tahun_akademik_id',$req->get('akademik'))->update(['skor' => $total]);
        $RTindakan->save();
        Session::flash('status', 'Ubah data Riwayat Tindakan berhasil!!!');
        return redirect()->route('admin.RTindakan');
        }}

        public function delete_RTindakan($id)
        {
            $rtindakan = RiwayatTindakan::find($id);
            $rtindakan->delete();
    
            $success = true;
            $message = "Data Riwayat Tindakan Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
        }

        function fetch_siswa(Request $request)
{
    if($request->get('query'))
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $query = $request->get('query');
        $data = DB::table('siswas')
            ->where('NISN', 'LIKE', "%{$query}%")
            ->orwhere('nama_lengkap', 'LIKE', "%{$query}%")
            ->where('tahun_akademik_id', '=', $akademik)
            ->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
        foreach($data as $row)
        {
            $output .= '
            <li><a class="dropdown-item" href="#">'.$row->nama_lengkap.'</a></li>
            ';
        }
        $output .= '</ul>';
        echo $output;
    }
}

    public function tindakan(){
        $akademik = TahunAkademik::where('status',1)->value('id');
        $user = Auth::user();
        $tindakan = TindakanKelas::where('tahun_akademik_id',$akademik)->get();
        return view('admin.tindakan', compact('user','tindakan'));
    }
    
   

    public function laporan(){
        $akademik = TahunAkademik::where('status',1)->value('id');
        $user = Auth::user();
        $laporan = Siswa::where('tahun_akademik_id','=',$akademik)->get();
        return view('admin.laporan', compact('user','laporan'));
    }
   
    public function pilih_kurikulum($id){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum = Nilai::select('kurikulum_id')->where('tahun_akademik_id','=',$akademik)->where('NISN','=',$id)->groupBy('kurikulum_id')->get();
        $NISN = Nilai::where('tahun_akademik_id','=',$akademik)->where('NISN','=',$id)->value('NISN');
        return view('admin.pilihKurikulum', compact('user','kurikulum','NISN'));
    }

    public function cetak($NISN, $id){
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
        ->where('nilais.NISN','=',$NISN)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $nilai = DB::table('nilais')
        ->join('mapels', 'mapels.id', '=', 'nilais.mapel_id')
        ->join('kelas', 'kelas.id', '=', 'nilais.kelas_id')
        ->select('mapels.nama_mapel','nilais.nilai','nilais.ketercapaian','nilais.deskripsi')
        ->where('nilais.NISN','=',$NISN)
        ->where('nilais.kurikulum_id','=',$id)
        ->get();

        $ekskul = DB::table('nilai_ekskuls')
        ->join('nilais', 'nilais.NISN', '=', 'nilai_ekskuls.NISN')
        ->join('ekskuls', 'ekskuls.id', '=', 'nilai_ekskuls.ekskuls_id')
        ->select('ekskuls.nama','nilai_ekskuls.deskripsi')
        ->where('nilai_ekskuls.NISN','=',$NISN)
        ->where('nilai_ekskuls.tahun_akademik_id','=',$akademik)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $absen = DB::table('nilais')
        ->select('nilais.Sakit','nilais.Izin','nilais.Alfa')
        ->where('nilais.NISN','=',$NISN)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $tanggal = DB::table('nilais')
        ->select('nilais.tanggal')
        ->where('nilais.NISN','=',$NISN)
        ->where('nilais.kurikulum_id','=',$id)
        ->paginate(1);

        $walikelas = DB::table('walikelas')
        ->join('nilais', 'nilais.kelas_id', '=', 'walikelas.kelas_id')
        ->join('gurus', 'gurus.NUPTK', '=', 'walikelas.NUPTK')
        ->select('gurus.nama_lengkap','gurus.NUPTK')
        ->where('nilais.NISN','=',$NISN)
        ->where('gurus.tahun_akademik_id','=',$akademik)
        ->paginate(1);

        $kepala = DB::table('users')
        ->join('gurus', 'gurus.NUPTK', '=', 'users.id_status')
        ->select('gurus.nama_lengkap','gurus.NUPTK')
        ->where('users.roles_id','=',2)
        ->where('gurus.tahun_akademik_id','=',$akademik)
        ->paginate(1);
        $poin = DB::table('tindakan_kelas')
        ->where('NISN','=',$NISN)
        ->where('tahun_akademik_id','=',$akademik)
        ->sum('skor');
        $pdf = PDF::loadview('admin.cetak',['riwayat'=>$riwayat,'nilai'=>$nilai, 'absen'=>$absen, 'ekskul'=>$ekskul, 'tanggal'=>$tanggal, 'walikelas'=>$walikelas, 'kepala'=>$kepala,'poin'=>$poin]);
        return $pdf->stream('laporan.pdf');
    }

    public function data_user(){
        $user = Auth::user();
        $pengguna = User::with('roles')->get();
        $roles = Roles::all();
        return view('admin.dataUser', compact('user','pengguna','roles'));
    }

    public function submit_user(Request $req){
        { $validate = $req->validate([
            'id_status'=> 'required|unique:users|min:10|max:16',
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required|unique:users',
            'password'=> 'required',
            'roles_id'=> 'required',
        ]);

        $user = new User;
        $user->id_status = $req->get('id_status');
        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = Hash::make($req->get('password'));
        $user->roles_id = $req->get('roles_id');
        $user->email_verified_at = null;
        $user->remember_token = null;
        $user->save();
        Session::flash('status', 'Tambah data User berhasil!!!');
        return redirect()->route('admin.pengguna');
    }}
    public function getDataUser($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
    public function update_user(Request $req)
    { 
        $user= User::find($req->get('id'));
        { $validate = $req->validate([
            'id_status'=> 'required|min:10|max:16',
            'name'=> 'required',
            'username'=> 'required',
            'email'=> 'required',
            'password'=> 'required',
            'roles_id'=> 'required',
        ]);
        $user->id_status = $req->get('id_status');
        $user->name = $req->get('name');
        $user->username = $req->get('username');
        $user->email = $req->get('email');
        $user->password = Hash::make($req->get('password'));
        $user->roles_id = $req->get('roles_id');
        $user->email_verified_at = null;
        $user->remember_token = null;
        $user->save();
        Session::flash('status', 'Ubah data User berhasil!!!');
        return redirect()->route('admin.pengguna');
    }
    }
    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        $success = true;
        $message = "Data Pengguna Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
