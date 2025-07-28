<?php
namespace App\Livewire\Admin;

use App\Models\Periksa;
use App\Models\Tindakan;
use App\Models\Layanan;
use Livewire\Component;

class ProsesPembayaran extends Component
{
    public $periksa;
    public $tindakans;
    public $totalTagihan = 0;

    public function mount($periksaId)
    {
        $this->periksa = Periksa::with('patient')->findOrFail($periksaId);
        $this->tindakans = Tindakan::with('layanan')->where('periksa_id', $periksaId)->get();

        $this->totalTagihan = $this->tindakans->sum(fn ($t) => $t->layanan->harga);
    }

    public function prosesPembayaran()
    {
        foreach ($this->tindakans as $tindakan) {
            $layanan = $tindakan->layanan;
            $harga = $layanan->harga;
            $kategori = strtolower($layanan->kategori);

            $persentase = match ($kategori) {
                'umum' => 0.40,
                'bedah' => 0.60,
                'odon' => 0.70,
                'lab' => 0.55,
                default => 0.40,
            };

            $feeDokter = round($harga * $persentase);
            $feeKlinik = $harga - $feeDokter;

            $tindakan->update([
                'uang_masuk' => $harga,
                'fee_dokter' => $feeDokter,
                'pendapatan_klinik' => $feeKlinik,
            ]);
        }

        $this->periksa->update([
            'status' => 'selesai',
        ]);

        session()->flash('success', 'Pembayaran berhasil diproses.');
        return redirect()->route('admin.patient.daftar-periksa');
    }

    public function render()
    {
        return view('livewire.admin.proses-pembayaran');
    }
}
