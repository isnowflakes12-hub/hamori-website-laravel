<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use App\Services\PromoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function __construct(private PromoService $svc) {}

    public function index(Request $request)
    {
        $query = Promo::query();
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }
        $promos   = $query->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $featured = Promo::where('is_featured', true)->get();
        $canAdd   = Promo::canAddFeatured();
        return view('admin.promo.index', compact('promos','featured','canAdd'));
    }

    public function create()
    {
        $featured      = Promo::where('is_featured', true)->get();
        $canFeatured   = Promo::canAddFeatured();
        return view('admin.promo.form', ['promo' => null, 'featured' => $featured, 'canFeatured' => $canFeatured]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:150',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'deskripsi'        => 'nullable|string|max:300',
            'detail'           => 'nullable|string|max:1000',
            'syarat_ketentuan' => 'nullable|string',
            'berlaku_mulai'    => 'nullable|date',
            'berlaku_sampai'   => 'nullable|date|after_or_equal:berlaku_mulai',
            'link_cta'         => 'nullable|url|max:255',
        ]);

        try {
            $data = $request->only('judul', 'deskripsi', 'detail', 'syarat_ketentuan', 'berlaku_mulai', 'berlaku_sampai', 'link_cta');
            $data['terima_bpjs'] = $request->boolean('terima_bpjs');
            $data['is_home_featured'] = $request->boolean('is_home_featured');

            if ($request->file('gambar')) {
                $file = $request->file('gambar');

                // 🔍 ambil isi file
                $image = imagecreatefromstring(file_get_contents($file));

                // ❌ tidak resize → ambil ukuran asli
                $width = imagesx($image);
                $height = imagesy($image);

                // canvas sama ukuran asli
                $canvas = imagecreatetruecolor($width, $height);

                // handle background putih (buat PNG transparan)
                $white = imagecolorallocate($canvas, 255, 255, 255);
                imagefill($canvas, 0, 0, $white);

                imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height);

                // 🎯 compress (0–100, makin kecil makin ringan)
                ob_start();
                imagejpeg($canvas, null, 75); // 75% kualitas
                $compressed = ob_get_clean();

                $filename = 'promo_' . time() . '.jpg';

                Storage::disk('public')->put('promo/' . $filename, $compressed);

                $data['gambar'] = 'promo/' . $filename;
            }

            $this->svc->store(array_merge(
                $data,
                [
                    'is_featured'          => $request->boolean('is_featured'),
                    'benefit_text'         => $request->benefit_text ?? '',
                    'cara_mendapatkan_text'=> $request->cara_mendapatkan_text ?? '',
                ]
            ));

            return redirect()->route('admin.promo.index')
                ->with('success','Promo berhasil ditambahkan.');

        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(Promo $promo)
    {
        $featured    = Promo::where('is_featured', true)->where('id','!=',$promo->id)->get();
        $canFeatured = Promo::canAddFeatured() || $promo->is_featured;
        return view('admin.promo.form', compact('promo','featured','canFeatured'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'judul'            => 'required|string|max:150',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'deskripsi'        => 'nullable|string|max:300',
            'detail'           => 'nullable|string|max:1000',
            'syarat_ketentuan' => 'nullable|string',
            'berlaku_mulai'    => 'nullable|date',
            'berlaku_sampai'   => 'nullable|date|after_or_equal:berlaku_mulai',
            'link_cta'         => 'nullable|url|max:255',
        ]);

        try {
            $data = $request->only(
                'judul', 'deskripsi', 'detail', 'syarat_ketentuan',
                'berlaku_mulai', 'berlaku_sampai', 'link_cta'
            );

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // 🔍 ambil isi file
                $image = imagecreatefromstring(file_get_contents($file));

                // ❌ tidak resize → ambil ukuran asli
                $width = imagesx($image);
                $height = imagesy($image);

                // canvas sama ukuran asli
                $canvas = imagecreatetruecolor($width, $height);

                // handle background putih (buat PNG transparan)
                $white = imagecolorallocate($canvas, 255, 255, 255);
                imagefill($canvas, 0, 0, $white);

                imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height);

                // 🎯 compress (0–100, makin kecil makin ringan)
                ob_start();
                imagejpeg($canvas, null, 75); // 75% kualitas
                $compressed = ob_get_clean();

                $filename = 'promo_' . time() . '.jpg';

                Storage::disk('public')->put('promo/' . $filename, $compressed);

                // Hapus gambar lama jika ada
                if ($promo->gambar && Storage::disk('public')->exists($promo->gambar)) {
                    Storage::disk('public')->delete($promo->gambar);
                }

                $data['gambar'] = 'promo/' . $filename;
            }

            $this->svc->update($promo, array_merge(
                $data,
                [
                    'is_featured'          => $request->boolean('is_featured'),
                    'is_home_featured'     => $request->boolean('is_home_featured'),
                    'terima_bpjs'          => $request->boolean('terima_bpjs'),
                    'benefit_text'         => $request->benefit_text ?? '',
                    'cara_mendapatkan_text'=> $request->cara_mendapatkan_text ?? '',
                ]
            ));
            return redirect()->route('admin.promo.index')->with('success','Promo berhasil diperbarui.');
        } catch (\RuntimeException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Promo $promo)
    {
        $this->svc->delete($promo);
        return back()->with('success','Promo dihapus.');
    }

    public function toggleFeatured(Promo $promo)
    {
        try {
            $this->svc->toggleFeatured($promo);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success','Status unggulan diperbarui.');
    }

    public function toggleHomeFeatured(Promo $promo)
    {
        try {
            $this->svc->toggleHomeFeatured($promo);
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
        return back()->with('success','Status tampil di Beranda & Popup diperbarui.');
    }

    public function bulkFeatured(Request $request)
    {
        $ids = $request->input('promo_ids', []);
        if (count($ids) > 3) {
            return back()->with('error', 'Maksimal 3 promo unggulan yang bisa dipilih.');
        }
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal 1 promo untuk dijadikan unggulan.');
        }

        // Reset semua unggulan dulu, lalu set yang dipilih
        Promo::query()->update(['is_featured' => false]);
        Promo::whereIn('id', $ids)->update(['is_featured' => true]);

        return back()->with('success', count($ids) . ' promo berhasil dijadikan unggulan.');
    }

    public function clearFeatured()
    {
        Promo::query()->update(['is_featured' => false]);
        return back()->with('success', 'Semua status unggulan berhasil dibatalkan.');
    }
    
}
