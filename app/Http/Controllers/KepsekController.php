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

class KepsekController extends Controller
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
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftar = Pendaftaran::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $riwayat = RiwayatAdministrasi::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $tindakank = RiwayatTindakan::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $user = Auth::user();
        $penerimaan = Pendaftaran::where('tahun_akademik_id',$akademik)->Count();
        $penilaian = Penilaian::where('tahun_akademik_id',$akademik)->Count();
        $administrasi = RiwayatAdministrasi::where('tahun_akademik_id',$akademik)->Count();
        $tindakan = RiwayatTindakan::where('tahun_akademik_id',$akademik)->Count();
        return view('kepala.Dashboard', compact('user','penerimaan','penilaian','administrasi','tindakan','pendaftar','riwayat','tindakank'));
    }
    public function jadwal(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $kurikulum1 = Kurikulum::where('tahun_akademik_id',$akademik)->where('status',1)->value('id');
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $jadwal = Jadwal::where('kurikulum_id',$kurikulum1)->get();
        return view('kepala.jadwalPelajaran', compact('user','jadwal','ekskul'));
    }

    public function ekskul(){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->get();
        return view('kepala.ekskul', compact('user','ekskul'));
    }
    public function riwayat_ekskul($id){
        $user = Auth::user();
        $REkskul = NilaiEkskul::where('ekskuls_id', $id)->with('siswa')->get();
        $ekskul = Ekskul::where('id',$id)->with('akademik','guru')->get();
        return view('kepala.nilai_ekskul', compact('user','ekskul','REkskul'));
    }
    
    public function submit_riwayat_ekskul(Request $req){
        { $validate = $req->validate([
            'NISN'=> 'required',
            'deskripsi'=> 'required',
            'ekskul_id'=> 'required',
        ]);
        $siswa = Siswa::where('nama_lengkap',$req->get('NISN'))->value('NISN');
        $akademik = TahunAkademik::where('status',1)->value('id');
        $REkskul = new NilaiEkskul;
        $REkskul->NISN = $siswa;
        $REkskul->Deskripsi = $req->get('deskripsi');
        $REkskul->tahun_akademik_id = $akademik;
        $REkskul->ekskuls_id = $req->get('ekskul_id');
        $REkskul->save();
        Session::flash('status', 'Tambah data Nilai Ekskul berhasil!!!');
        return redirect()->back();
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
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $pengampu=Pengampu::where('NUPTK',auth()->user()->id_status)->where('kurikulum_id',$kurikulum)->get();
        return view('kepala.pengampu', compact('user','pengampu','akademik','ekskul'));
    }
    public function penilaian($id){
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pengampu=Pengampu::where('id',$id)->get();
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $penilaian = Penilaian::where('pengampu_id', $id)->where('tahun_akademik_id',$akademik)->get();
        return view('kepala.penilaian', compact('user','penilaian','pengampu','ekskul'));
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
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $riwayat=RiwayatNilai::where('penilaian_id',$id)->get();
        return view('kepala.riwayat', compact('user','riwayat','pengampu','ekskul'));
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
            $nilaiAbsen = ($skorAbsen*0.01/$jumlahAbsen)*10;
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
        $ekskul = Ekskul::where('NUPTK',auth()->user()->id_status)->where('tahun_akademik_id',$akademik)->value('id');
        $nilai=Nilai::where('tahun_akademik_id',$akademik)->where('kelas_id',$kelas)->where('kurikulum_id',$kurikulum)->where('mapel_id',$mapel)->get();
        return view('kepala.nilai', compact('user','nilai','pengampu1','ekskul'));
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
        $RTindakan = RiwayatTindakan::where('tahun_akademik_id',$akademik)->where('NUPTK',auth()->user()->id_statsus)->get();
        return view('kepala.RTindakan', compact( 'user','RTindakan'));
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
            $prasarana = Prasarana::find($id);
            $prasarana->delete();
    
            $success = true;
            $message = "Data Prasarana Berhasil Dihapus";
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
public function riwayat_penilaians(){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $penilaian = DB::table('penilaians')
    ->join('pengampus', 'pengampus.id', '=', 'penilaians.pengampu_id')
    ->join('gurus', 'gurus.NUPTK', '=', 'pengampus.NUPTK')
    ->select('penilaians.id','gurus.NUPTK','penilaians.judul','penilaians.kategori','penilaians.tanggal','gurus.nama_lengkap')
    ->where('penilaians.tahun_akademik_id','=',$akademik)
    ->get();
    return view('kepala.riwayat_penilaian', compact('user','penilaian'));
}
public function laporan_penilaian(Request $req){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $penilaian = DB::table('penilaians')
    ->join('pengampus', 'pengampus.id', '=', 'penilaians.pengampu_id')
    ->join('gurus', 'gurus.NUPTK', '=', 'pengampus.NUPTK')
    ->select('penilaians.id','gurus.NUPTK','penilaians.judul','penilaians.kategori','penilaians.tanggal','gurus.nama_lengkap')
    ->where('penilaians.tahun_akademik_id','=',$akademik)
    ->whereBetween('penilaians.tanggal',[$req->get('dari_tanggal'), $req->get('sampai_tanggal')])
    ->get();
    $kepala = User::where('roles_id',2)->paginate(1);
    $tanggal = Carbon::now()->format('d-M-Y');
    $pdf = PDF::loadview('kepala.penilaian_cetak',['penilaian'=>$penilaian, 'kepala'=>$kepala, 'tanggal'=>$tanggal]);
    return $pdf->stream('laporan_penilaian.pdf');
}
public function riwayat_administrasi(){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $administrasi = RiwayatAdministrasi::where('tahun_akademik_id',$akademik)->get();
    return view('kepala.riwayat_administrasi', compact('user','administrasi'));
}
public function laporan_administrasi(Request $req){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $administrasi = RiwayatAdministrasi::whereBetween('tanggal',[$req->get('dari_tanggal'), $req->get('sampai_tanggal')])->where('tahun_akademik_id',$akademik)->get();
    $jumlah = RiwayatAdministrasi::whereBetween('tanggal',[$req->get('dari_tanggal'), $req->get('sampai_tanggal')])->where('tahun_akademik_id',$akademik)->sum('jumlah');
    $kepala = User::where('roles_id',2)->paginate(1);
    $TU = User::where('roles_id',3)->paginate(1);
    $tanggal = Carbon::now()->format('d-M-Y');
    $pdf = PDF::loadview('kepala.administrasi_cetak',['administrasi'=>$administrasi,'jumlah'=>$jumlah, 'kepala'=>$kepala, 'TU'=>$TU, 'tanggal'=>$tanggal]);
    return $pdf->stream('laporan_administrasi.pdf');
}
public function tindakan(){
    $akademik = TahunAkademik::where('status',1)->value('id');
    $user = Auth::user();
    $tindakan = TindakanKelas::where('tahun_akademik_id',$akademik)->get();
    return view('kepala.tindakan', compact('user','tindakan'));
}
public function laporan_tindakan(Request $req){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $tindakan = TindakanKelas::whereBetween('created_at',[$req->get('dari_tanggal'), $req->get('sampai_tanggal')])->where('tahun_akademik_id',$akademik)->get();
    $kepala = User::where('roles_id',2)->paginate(1);
    $tanggal = Carbon::now()->format('d-M-Y');
    $pdf = PDF::loadview('kepala.tindakan_cetak',['tindakan'=>$tindakan, 'kepala'=>$kepala, 'tanggal'=>$tanggal]);
    return $pdf->stream('laporan_tindakan.pdf');
}
public function penerimaan()
{
    $akademik = TahunAkademik::where('status',1)->value('id');
    $user = Auth::user();
    $penerimaan = Pendaftaran::where('tahun_akademik_id',$akademik)->get();
    return view('kepala.penerimaan', compact('user','penerimaan'));
}
public function laporan_penerimaan(Request $req)
{
    $akademik = TahunAkademik::where('status',1)->value('id');
    $user = Auth::user();
    $kepala = User::where('roles_id',2)->paginate(1);
    $TU = User::where('roles_id',3)->paginate(1);
    $tanggal = Carbon::now()->format('d-M-Y');
    $penerimaan = Pendaftaran::whereBetween('created_at',[$req->get('dari_tanggal'), $req->get('sampai_tanggal')])->where('status_pendaftaran',1)->where('tahun_akademik_id',$akademik)->get();
    $pdf = PDF::loadview('kepala.penerimaan_cetak',['penerimaan'=>$penerimaan, 'kepala'=>$kepala, 'TU'=>$TU, 'tanggal'=>$tanggal]);
    return $pdf->stream('laporan_penerimaan.pdf');
}
}
