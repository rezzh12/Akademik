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
use App\Models\AdministrasiSiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\Pemberitahuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BendaharaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftar = Pendaftaran::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $riwayat = RiwayatAdministrasi::select(DB::raw("COUNT(*) as count"))->whereYear("created_at",date('Y'))->groupBy(DB::raw("Year(created_at)"))->pluck('count');
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('tahun_akademik_id',$akademik)->Count();
        $siswa = Siswa::where('tahun_akademik_id',$akademik)->Count();
        $guru = Guru::where('tahun_akademik_id',$akademik)->Count();
        $riwayatA = RiwayatAdministrasi::where('tahun_akademik_id',$akademik)->Count();
        return view('TU.Dashboard', compact('user','siswa','guru','pendaftaran','riwayatA','pendaftar','riwayat'));
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
    public function view_pendaftar()
    {
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftaran = Pendaftaran::where('tahun_akademik_id',$akademik)->get();
        $jurusan = jurusan::all();
        return view('TU.dataPendaftar', compact('user','pendaftaran', 'jurusan'));
    }
    public function view_orangtua()
    {
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftaran = Pendaftaran::where('tahun_akademik_id',$akademik)->get();
        return view('TU.dataOrangtua', compact('user', 'pendaftaran'));
    }
    public function view_sekolah()
    {
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftaran = Pendaftaran::where('tahun_akademik_id',$akademik)->get();
        return view('TU.dataSekolah', compact('user', 'pendaftaran'));
    }
    public function view_input()
    {
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $pendaftaran = Pendaftaran::all();
        $jurusan = Jurusan::where('tahun_akademik_id',$akademik)->get();
        return view('TU.inputDaftar', compact('user', 'pendaftaran', 'jurusan'));
    }

    public function view_edit($id)
    {
        $user = Auth::user();
        $akademik = TahunAkademik::where('status',1)->value('id');
        $jurusan = Jurusan::where('tahun_akademik_id',$akademik)->get();
        $pendaftaran =  pendaftaran::where('id',$id)->get();
        return view('TU.editDaftar', compact('user','pendaftaran','jurusan'));
    }

    public function submit_pendaftar(Request $req)
    { $validate = $req->validate([
        'NISN'=> 'required|max:255',
        'nama'=> 'required',
        'jenis_kelamin'=> 'required',
        'agama'=> 'required',
        'email'=> 'required',
        'no_hp'=> 'required',
        'no_hp_ortu'=> 'required',
        'tempat_lahir'=> 'required',
        'tanggal_lahir'=> 'required',
        'alamat'=> 'required',
        'jurusan'=> 'required',
        'nama_ayah'=> 'required',
        'nama_ibu'=> 'required',
        'pekerjaan_ayah'=> 'required',
        'pekerjaan_Ibu'=> 'required',
        'kk'=> 'required',
        'asal_sekolah'=> 'required',
        'alamat_sekolah'=> 'required',
    ]);
    $cek = Pendaftaran::where('NISN',$req->get('NISN'))->value('id');
    if($cek == null){
        $akademik = TahunAkademik::where('status',1)->value('id');
        $Pendaftaran = new Pendaftaran;
        $Pendaftaran->NISN = $req->get('NISN');
        $Pendaftaran->nama = $req->get('nama');
        $Pendaftaran->jenis_kelamin = $req->get('jenis_kelamin');
        $Pendaftaran->agama = $req->get('agama');
        $Pendaftaran->email = $req->get('email');
        $Pendaftaran->no_hp = $req->get('no_hp');
        $Pendaftaran->no_hp_ortu = $req->get('no_hp_ortu');
        $Pendaftaran->tempat_lahir = $req->get('tempat_lahir');
        $Pendaftaran->tanggal_lahir = $req->get('tanggal_lahir');
        $Pendaftaran->alamat = $req->get('alamat');
        $Pendaftaran->jurusan_id = $req->get('jurusan');
        $Pendaftaran->nama_ayah = $req->get('nama_ayah');
        $Pendaftaran->nama_ibu = $req->get('nama_ibu');
        $Pendaftaran->pekerjaan_ayah = $req->get('pekerjaan_ayah');
        $Pendaftaran->pekerjaan_Ibu = $req->get('pekerjaan_Ibu');
        $Pendaftaran->asal_sekolah = $req->get('asal_sekolah');
        $Pendaftaran->alamat_sekolah = $req->get('alamat_sekolah');
        $Pendaftaran->status_pendaftaran = 0;
        $Pendaftaran->tahun_akademik_id = $akademik;
        $Pendaftaran->tgl_pendaftaran = carbon::now();
        if($req->hasFile('pas_foto'))
        {
            $extension = $req->file('pas_foto')->extension();
            $filename = 'pas_foto'.time().'.'.$extension;
            $req->file('pas_foto')->storeAS('public/pas_foto', $filename);
            $Pendaftaran->pas_foto = $filename;
        }
        if($req->hasFile('kk'))
        {
            $extension = $req->file('kk')->extension();
            $filename = 'kk'.time().'.'.$extension;
            $req->file('kk')->storeAS('public/kk', $filename);
            $Pendaftaran->kk = $filename;
        }
        if($req->hasFile('nilai_raport'))
        {
            $extension = $req->file('nilai_raport')->extension();
            $filename = 'nilai_raport'.time().'.'.$extension;
            $req->file('nilai_raport')->storeAS('public/nilai_raport', $filename);
            $Pendaftaran->nilai_raport = $filename;
        }
        if($req->hasFile('ijazah'))
        {
            $extension = $req->file('ijazah')->extension();
            $filename = 'ijazah'.time().'.'.$extension;
            $req->file('ijazah')->storeAS('public/ijazah', $filename);
            $Pendaftaran->ijazah = $filename;
        }
        if($req->hasFile('prestasi'))
        {
            $extension = $req->file('prestasi')->extension();
            $filename = 'prestasi'.time().'.'.$extension;
            $req->file('prestasi')->storeAS('public/prestasi', $filename);
            $Pendaftaran->prestasi = $filename;
        }
        $Pendaftaran->save();
        Session::flash('status', 'Input Data Pendaftaran berhasil!!!');
        return redirect()->route('TU.pendaftaran');
    }else{
        Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
        return redirect()->route('TU.pendaftaran');
    }
    
    }

    public function update_pendaftar(Request $req)
    {
        $Pendaftaran = Pendaftaran::find($req->get('id'));
    
        $validate = $req->validate([
        'NISN'=> 'required|max:255',
        'nama'=> 'required',
        'jenis_kelamin'=> 'required',
        'agama'=> 'required',
        'email'=> 'required',
        'no_hp'=> 'required',
        'no_hp_ortu'=> 'required',
        'tempat_lahir'=> 'required',
        'tanggal_lahir'=> 'required',
        'alamat'=> 'required',
        'jurusan'=> 'required',
        'nama_ayah'=> 'required',
        'nama_ibu'=> 'required',
        'pekerjaan_ayah'=> 'required',
        'pekerjaan_Ibu'=> 'required',
        'kk'=> 'required',
        'asal_sekolah'=> 'required',
        'alamat_sekolah'=> 'required',
        ]);
        $akademik = TahunAkademik::where('status',1)->value('id');
        $Pendaftaran->NISN = $req->get('NISN');
        $Pendaftaran->nama = $req->get('nama');
        $Pendaftaran->jenis_kelamin = $req->get('jenis_kelamin');
        $Pendaftaran->agama = $req->get('agama');
        $Pendaftaran->email = $req->get('email');
        $Pendaftaran->no_hp = $req->get('no_hp');
        $Pendaftaran->no_hp_ortu = $req->get('no_hp_ortu');
        $Pendaftaran->tempat_lahir = $req->get('tempat_lahir');
        $Pendaftaran->tanggal_lahir = $req->get('tanggal_lahir');
        $Pendaftaran->alamat = $req->get('alamat');
        $Pendaftaran->jurusan_id = $req->get('jurusan');
        $Pendaftaran->nama_ayah = $req->get('nama_ayah');
        $Pendaftaran->nama_ibu = $req->get('nama_ibu');
        $Pendaftaran->pekerjaan_ayah = $req->get('pekerjaan_ayah');
        $Pendaftaran->pekerjaan_Ibu = $req->get('pekerjaan_Ibu');
        $Pendaftaran->asal_sekolah = $req->get('asal_sekolah');
        $Pendaftaran->alamat_sekolah = $req->get('alamat_sekolah');
        $Pendaftaran->status_pendaftaran = 0;
        $Pendaftaran->tahun_akademik_id = $akademik;
        $Pendaftaran->tgl_pendaftaran = carbon::now();
        if($req->hasFile('pas_foto'))
        {
            $extension = $req->file('pas_foto')->extension();
            $filename = 'pas_foto'.time().'.'.$extension;
            $req->file('pas_foto')->storeAS('public/pas_foto', $filename);
            $Pendaftaran->pas_foto = $filename;
            Storage::delete('public/pas_foto/'.$req->get('old_pas_foto'));
        }
        if($req->hasFile('kk'))
        {
            $extension = $req->file('kk')->extension();
            $filename = 'kk'.time().'.'.$extension;
            $req->file('kk')->storeAS('public/kk', $filename);
            $Pendaftaran->kk = $filename;
            Storage::delete('public/kk/'.$req->get('old_kk'));
        }
        if($req->hasFile('nilai_raport'))
        {
            $extension = $req->file('nilai_raport')->extension();
            $filename = 'nilai_raport'.time().'.'.$extension;
            $req->file('nilai_raport')->storeAS('public/nilai_raport', $filename);
            $Pendaftaran->nilai_raport = $filename;
            Storage::delete('public/nilai_raport/'.$req->get('old_nilai_raport'));
        }
        if($req->hasFile('ijazah'))
        {
            $extension = $req->file('ijazah')->extension();
            $filename = 'ijazah'.time().'.'.$extension;
            $req->file('ijazah')->storeAS('public/ijazah', $filename);
            $Pendaftaran->ijazah = $filename;
            Storage::delete('public/ijazah/'.$req->get('old_ijazah'));
        }
        if($req->hasFile('prestasi'))
        {
            $extension = $req->file('prestasi')->extension();
            $filename = 'prestasi'.time().'.'.$extension;
            $req->file('prestasi')->storeAS('public/prestasi', $filename);
            $Pendaftaran->prestasi = $filename;
            Storage::delete('public/prestasi/'.$req->get('old_prestasi'));
        }
        $Pendaftaran->save();
        Session::flash('status', 'Edit data Pendaftar berhasil!!!');
        return redirect()->route('TU.pendaftaran');
    }

    public function delete_pendaftar($id)
    {
        $pendaftaran = pendaftaran::find($id);
        Storage::delete('public/pas_foto/'.$pendaftaran->pas_foto);
        Storage::delete('public/kk/'.$pendaftaran->kk);
        Storage::delete('public/nilai_raport/'.$pendaftaran->nilai_raport);
        Storage::delete('public/ijazah/'.$pendaftaran->ijazah);
        Storage::delete('public/prestasi/'.$pendaftaran->prestasi);
        $pendaftaran->delete();
    
            $success = true;
            $message = "Data Pendaftar Berhasil Dihapus";
            return response()->json([
                'success' => $success,
                'message' => $message,
            ]);
}

public function penerimaan()
{
    $akademik = TahunAkademik::where('status',1)->value('id');
    $user = Auth::user();
    $penerimaan = Pendaftaran::where('tahun_akademik_id',$akademik)->get();
    return view('TU.penerimaan', compact('user','penerimaan'));
}
public function terima($id){
    $terima = DB::table('pendaftarans')->where('id', $id)->update(['status_pendaftaran' => 1, ]);
    $user = pendaftaran::with('jurusan')->find($id);
    $receiver =  DB::table('pendaftarans')->where('id', $id)->Value('email');
    Mail::to($receiver)->send(new Pemberitahuan($user));
    $NISN =  DB::table('pendaftarans')->where('id', $id)->value('NISN');
    $Email = DB::table('pendaftarans')->where('id', $id)->value('email');
    $Nama = DB::table('pendaftarans')->where('id', $id)->value('nama');
  
    $tempat=Pendaftaran::where('id', $id)->where('status_pendaftaran',1)->value('tempat_lahir');
    $tanggal=Pendaftaran::where('id', $id)->where('status_pendaftaran',1)->value('tanggal_lahir');
    $gender=Pendaftaran::where('id', $id)->where('status_pendaftaran',1)->value('jenis_kelamin');
    $agama=Pendaftaran::where('id', $id)->where('status_pendaftaran',1)->value('agama');
    $jurusan=Pendaftaran::where('id', $id)->where('status_pendaftaran',1)->value('jurusan_id');
    $kelas=Kelas::where('tingkatan_kelas','=','X')->where('jurusan_id',$jurusan)->value('id');
    $akademik = TahunAkademik::where('status',1)->value('id');
    $siswa = new Siswa;
    $siswa->NISN = $NISN;
    $siswa->nama_lengkap = $Nama;
    $siswa->tanggal_lahir = $tanggal;
    $siswa->tempat_lahir = $tempat;
    $siswa->gender = $gender;
    $siswa->agama = $agama;
    $siswa->kelas_id = $kelas;
    $siswa->tahun_akademik_id = $akademik;
    $siswa->save();
    $user = new User;
    $user->id_status = $NISN;
    $user->name = $Nama;
    $user->username = $Nama;
    $user->email = $Email;
    $user->password = bcrypt('12345');
    $user->roles_id = 6;
    $user->email_verified_at = null;
    $user->remember_token = null;
    $user->save();
    Session::flash('status', 'Pendaftar Berhasil di Terima!!!');
    return redirect()->back();
}
public function tolak($id){
    $terima = DB::table('pendaftarans')->where('id', $id)->update(['status_pendaftaran' => 2, ]);
    $user = pendaftaran::with('jurusan')->find($id);
    $receiver =  DB::table('pendaftarans')->where('id', $id)->Value('email');
    Mail::to($receiver)->send(new Pemberitahuan($user));
    Session::flash('status', 'Pendaftar Berhasil di Tolak!!!');
    return redirect()->back();
}
public function data_siswa(){
    $akademik = TahunAkademik::where('status',1)->value('id');
    $user = Auth::user();
    $siswa = Siswa::where('tahun_akademik_id',$akademik)->get();
    $kelas = Kelas::all();
    return view('TU.dataSiswa', compact('user','siswa','kelas'));
}

public function submit_siswa(Request $req){
    { $validate = $req->validate([
        'NISN'=> 'required',
        'nama'=> 'required',
        'kelas'=> 'required',
    ]);
    $tanggal=Pendaftaran::where('NISN',$req->get('NISN'))->where('status_pendaftaran',1)->value('tanggal_lahir');
    $tempat=Pendaftaran::where('NISN',$req->get('NISN'))->where('status_pendaftaran',1)->value('tempat_lahir');
    $gender=Pendaftaran::where('NISN',$req->get('NISN'))->where('status_pendaftaran',1)->value('jenis_kelamin');
    $agama=Pendaftaran::where('NISN',$req->get('NISN'))->where('status_pendaftaran',1)->value('agama');
    $akademik = TahunAkademik::where('status',1)->value('id');
    if($tanggal == null){
        Session::flash('warning', 'NISN Yang Anda Masukan Tidak Tersedia');
        return redirect()->route('TU.siswa');
    }else{
        $cek=Siswa::where('NISN',$req->get('NISN'))->where('tahun_akademik_id',$akademik)->value('id');
        if($cek == null){
            $siswa = new Siswa;
            $siswa->NISN = $req->get('NISN');
            $siswa->nama_lengkap = $req->get('nama');
            $siswa->tanggal_lahir = $tanggal;
            $siswa->tempat_lahir = $tempat;
            $siswa->gender = $gender;
            $siswa->agama = $agama;
            $siswa->kelas_id = $req->get('kelas');
            $siswa->tahun_akademik_id = $akademik;
            $siswa->save();
            Session::flash('status', 'Tambah data Siswa berhasil!!!');
            return redirect()->route('TU.siswa');
        }else{
            Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
            return redirect()->route('TU.siswa');
        }
   
}
}}
public function getDataSiswa($id)
{
    $siswa = Siswa::find($id);
    return response()->json($siswa);
}
public function update_siswa(Request $req)
{ 
    $siswa= Siswa::find($req->get('id'));
    { $validate = $req->validate([
        'NISN'=> 'required',
        'nama'=> 'required',
        'kelas'=> 'required',
    ]);
    $tanggal=Pendaftaran::where('NISN',$req->get('NISN'))->value('tanggal_lahir');
    $tempat=Pendaftaran::where('NISN',$req->get('NISN'))->value('tempat_lahir');
    $gender=Pendaftaran::where('NISN',$req->get('NISN'))->value('jenis_kelamin');
    $agama=Pendaftaran::where('NISN',$req->get('NISN'))->value('agama');
    $akademik = TahunAkademik::where('status',1)->value('id');
    $siswa->NISN = $req->get('NISN');
    $siswa->nama_lengkap = $req->get('nama');
    $siswa->tanggal_lahir = $tanggal;
    $siswa->tempat_lahir = $tempat;
    $siswa->gender = $gender;
    $siswa->agama = $agama;
    $siswa->kelas_id = $req->get('kelas');
    $siswa->tahun_akademik_id = $req->get('akademik');
    $siswa->save();
    Session::flash('status', 'Ubah data Siswa berhasil!!!');
    return redirect()->route('TU.siswa');
}
}
public function delete_siswa($id)
{
    $siswa = Siswa::find($id);
    $siswa->delete();
    $success = true;
    $message = "Data Siswa Berhasil Dihapus";
    return response()->json([
        'success' => $success,
        'message' => $message,
    ]);
}

public function data_guru(){
    $user = Auth::user();
    $akademik = TahunAkademik::where('status',1)->value('id');
    $guru = Guru::where('tahun_akademik_id',$akademik)->get();
    return view('TU.dataGuru', compact('user','guru'));
}

public function submit_guru(Request $req){
    { $validate = $req->validate([
        'NUPTK'=> 'required',
        'nama'=> 'required',
        'tanggal_lahir'=> 'required',
        'tempat_lahir'=> 'required',
        'gender'=> 'required',
        'agama'=> 'required',
    ]);
    $akademik = TahunAkademik::where('status',1)->value('id');
    $cek = Guru::where('NUPTK',$req->get('NUPTK'))->where('tahun_akademik_id',$akademik)->value('id');
    if($cek == null){
        $guru = new Guru;
        $guru->NUPTK = $req->get('NUPTK');
        $guru->nama_lengkap = $req->get('nama');
        $guru->tanggal_lahir = $req->get('tanggal_lahir');
        $guru->tempat_lahir = $req->get('tempat_lahir');
        $guru->gender = $req->get('gender');
        $guru->agama = $req->get('agama');
        $guru->tahun_akademik_id = $akademik;
        $guru->save();
        Session::flash('status', 'Tambah data Guru berhasil!!!');
        return redirect()->route('TU.guru');
    }else{
        Session::flash('warning', 'Data Yang Anda Masukan Sudah Tersedia!!!');
        return redirect()->route('TU.guru');
    }
    
}}
public function getDataGuru($id)
{
    $guru = Guru::find($id);
    return response()->json($guru);
}
public function update_guru(Request $req)
{ 
    $guru= Guru::find($req->get('id'));
    { $validate = $req->validate([
        'NUPTK'=> 'required',
        'nama'=> 'required',
        'tanggal_lahir'=> 'required',
        'tempat_lahir'=> 'required',
        'gender'=> 'required',
        'agama'=> 'required',
    ]);
    $guru->NUPTK = $req->get('NUPTK');
    $guru->nama_lengkap = $req->get('nama');
    $guru->tanggal_lahir = $req->get('tanggal_lahir');
    $guru->tempat_lahir = $req->get('tempat_lahir');
    $guru->gender = $req->get('gender');
    $guru->agama = $req->get('agama');
    $guru->tahun_akademik_id = $req->get('akademik');
    $guru->save();
    Session::flash('status', 'Ubah data Guru berhasil!!!');
    return redirect()->route('TU.guru');
}
}
public function delete_guru($id)
{
    $guru = Guru::find($id);
    $guru->delete();
    $success = true;
    $message = "Data Guru Berhasil Dihapus";
    return response()->json([
        'success' => $success,
        'message' => $message,
    ]);
}

public function administrasi(){
    $user = Auth::user(); 
    $akademik = TahunAkademik::where('status',1)->value('id');
    $administrasi = AdministrasiSiswa::where('tahun_akademik_id',$akademik)->get();
    return view('TU.listAdministrasi', compact('user','administrasi'));
}

public function submit_administrasi(Request $req){
    { $validate = $req->validate([
        'tingkatan_kelas'=> 'required',
        'jenis'=> 'required',
        'jumlah'=> 'required',
       
    ]);
    $akademik = TahunAkademik::where('status',1)->value('id');
    $cek = AdministrasiSiswa::where('tingkatan_kelas',$req->get('tingkatan_kelas'))->where('jenis',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->value('id');
    $id = IdGenerator::generate(['table' => 'administrasi_siswas','field'=>'kode', 'length' => 10, 'prefix' =>'BY-']);
    if($cek == null){
        $administrasi = new AdministrasiSiswa;
        $administrasi->kode = $id;
        $administrasi->tingkatan_kelas = $req->get('tingkatan_kelas');
        $administrasi->jenis =  $req->get('jenis');
        $administrasi->jumlah =  $req->get('jumlah');
        $administrasi->tahun_akademik_id =  $akademik;
        $administrasi->save();
        Session::flash('status', 'Tambah data List Administrasi berhasil!!!');
        return redirect()->route('TU.administrasi');
    }else{
        Session::flash('warning', 'List Administrasi Sudah Tersedia!!!');
        return redirect()->route('TU.administrasi');
    }
    
}}

public function update_administrasi(Request $req){
    $administrasi= AdministrasiSiswa::find($req->get('id'));
    { $validate = $req->validate([
        'tingkatan_kelas'=> 'required',
        'jenis'=> 'required',
        'jumlah'=> 'required',
    ]);
    $administrasi->kode = $req->get('kode');
    $administrasi->tingkatan_kelas = $req->get('tingkatan_kelas');
    $administrasi->jenis =  $req->get('jenis');
    $administrasi->jumlah =  $req->get('jumlah');
    $administrasi->tahun_akademik_id =  $req->get('akademik');
    $administrasi->save();
    Session::flash('status', 'Ubah data List Administrasi berhasil!!!');
    return redirect()->route('TU.administrasi');
}}

public function getDataAdministrasi($id)
{
    $administrasi = AdministrasiSiswa::find($id);
    return response()->json($administrasi);
}

public function delete_administrasi($id)
{
    $administrasi = AdministrasiSiswa::find($id);
    $administrasi->delete();

    $success = true;
    $message = "Data List Administrasi Berhasil Dihapus";
    return response()->json([
        'success' => $success,
        'message' => $message,
    ]);
}

public function administrasi_siswa(){
    $user = Auth::user(); 
    $akademik = TahunAkademik::where('status',1)->value('id');
    $siswa = Siswa::where('tahun_akademik_id',$akademik)->get();
    return view('TU.lihatSiswa', compact('user','siswa'));
}

public function pembayaran($NISN,$id){
    $user = Auth::user(); 
    $akademik = TahunAkademik::where('status',1)->value('id');
    $cek = Siswa::where('NISN',$NISN)->where('tahun_akademik_id',$akademik)->value('kelas_id');
    $cek2 = Kelas::where('id',$cek)->where('tahun_akademik_id',$akademik)->value('tingkatan_kelas');
    $administrasi1 = AdministrasiSiswa::where('tingkatan_kelas',$id)->where('tahun_akademik_id',$akademik)->get();
    $bayar = AdministrasiSiswa::where('tingkatan_kelas',$cek2)->where('jenis','!=','UDB')->where('tahun_akademik_id',$akademik)->sum('jumlah');
    $UDB = AdministrasiSiswa::where('tingkatan_kelas',$cek2)->where('jenis','=','UDB')->where('tahun_akademik_id',$akademik)->sum('jumlah');
    $dibayar = RiwayatAdministrasi::where('NISN',$NISN)->where('tahun_akademik_id',$akademik)->sum('jumlah');
    $pembayaran = RiwayatAdministrasi::where('NISN',$NISN)->where('tahun_akademik_id',$akademik)->get();
    $siswa = Siswa::where('NISN',$NISN)->where('tahun_akademik_id',$akademik)->paginate(1);
    $UDB1 = $UDB*12; 
        $total1 = $bayar+$UDB1;
        $total = $total1-$dibayar;
    return view('TU.pembayaran', compact('user','pembayaran','siswa','total1','dibayar','total','administrasi1'));
}

public function submit_bayar(Request $req){
    { $validate = $req->validate([
        'jenis'=> 'required',
        'bulan'=> 'required',
        'foto'=> 'required',
        'keterangan'=> 'required',
       
    ]);
    $akademik = TahunAkademik::where('status',1)->value('id');
    $lihat = AdministrasiSiswa::where('id',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->value('jenis');
    $jumlah = AdministrasiSiswa::where('id',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->value('jumlah');
    $UDB = AdministrasiSiswa::where('jenis',$lihat)->where('tahun_akademik_id',$akademik)->value('id');
    $cek = RiwayatAdministrasi::where('NISN',$req->get('NISN'))->where('administrasi_siswa_id',$UDB)->where('tahun_akademik_id',$akademik)->count();
    $cek1 = RiwayatAdministrasi::where('NISN',$req->get('NISN'))->where('administrasi_siswa_id',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->count();
   if($lihat == "UDB"){
        if($cek <=12){
            $cek2 = RiwayatAdministrasi::where('NISN',$req->get('NISN'))->where('bulan',$req->get('bulan'))->where('administrasi_siswa_id',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->count();
        if($cek2 == null){
            $RAdministrasi = new RiwayatAdministrasi;
            $RAdministrasi->tanggal = carbon::now();
            $RAdministrasi->bulan = $req->get('bulan');
            $RAdministrasi->jumlah =  $jumlah;
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'bukti'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                $RAdministrasi->foto = $filename;
            }
            $RAdministrasi->keterangan =  $req->get('keterangan');
            $RAdministrasi->NISN =  $req->get('NISN');
            $RAdministrasi->administrasi_siswa_id =  $req->get('jenis');
            $RAdministrasi->tahun_akademik_id =  $akademik;
            $RAdministrasi->save();
            Session::flash('status', 'Tambah data Pembayaran berhasil!!!');
            return redirect()->back();
        }else{
            Session::flash('warning', 'Pembayaran Sudah Tersedia!!!');
            return redirect()->back();
        }
        }
   }else{
    $cek1 = RiwayatAdministrasi::where('NISN',$req->get('NISN'))->where('administrasi_siswa_id',$req->get('jenis'))->where('tahun_akademik_id',$akademik)->count();
        if($cek1 == 0){
            $RAdministrasi = new RiwayatAdministrasi;
            $RAdministrasi->tanggal = carbon::now();
            $RAdministrasi->bulan = null;
            $RAdministrasi->jumlah =  $jumlah;
            if($req->hasFile('foto'))
            {
                $extension = $req->file('foto')->extension();
                $filename = 'bukti'.time().'.'.$extension;
                $req->file('foto')->storeAS('public/bukti', $filename);
                $RAdministrasi->foto = $filename;
            }
            $RAdministrasi->keterangan =  $req->get('keterangan');
            $RAdministrasi->NISN =  $req->get('NISN');
            $RAdministrasi->administrasi_siswa_id =  $req->get('jenis');
            $RAdministrasi->tahun_akademik_id =  $akademik;
            $RAdministrasi->save();
            Session::flash('status', 'Tambah data Pembayaran berhasil!!!');
            return redirect()->back();
        }
        else{
            Session::flash('warning', 'Pembayaran Sudah Tersedia!!!');
            return redirect()->back();
        }
   }
   
    
}
}
}
