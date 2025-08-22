<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Obat;

class MasterObat extends Component
{
    public $kode_obat, $nama_obat, $pabrik, $golongan, $komposisi, $generik = false;
    public $kemasan, $satuan, $isi_obat, $dosis, $sediaan, $barcode;
    public $harga_hna, $harga_ppn, $hja;

    public $obats, $obatId;

    public function mount()
    {
        $this->obats = Obat::all();
    }


    public $isUpdate = false;

    public function render()
    {
        // Ambil semua data dari tabel 'obats'
        $obats = Obat::all();

        // Teruskan variabel $obats ke view
        return view('livewire.master-obat', ['obats' => $obats]);
    }


    public function store()
    {
        $this->validate([
            'kode_obat' => 'required|unique:obats,kode_obat,' . $this->obatId,
            'nama_obat' => 'required',
        ]);

        Obat::updateOrCreate(
            ['id' => $this->obatId],
            [
                'kode_obat' => $this->kode_obat,
                'nama_obat' => $this->nama_obat,
                'pabrik' => $this->pabrik,
                'golongan' => $this->golongan,
                'komposisi' => $this->komposisi,
                'generik' => $this->generik,
                'kemasan' => $this->kemasan,
                'satuan' => $this->satuan,
                'isi_obat' => $this->isi_obat,
                'dosis' => $this->dosis,
                'sediaan' => $this->sediaan,
                'barcode' => $this->barcode,
                'harga_hna' => $this->harga_hna,
                'harga_ppn' => $this->harga_ppn,
                'hja' => $this->hja,
            ]
        );

        $this->resetInput();

        // kirim event ke frontend
        $this->dispatch('focus-nama-obat');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $this->obatId = $obat->id;
        $this->kode_obat = $obat->kode_obat;
        $this->nama_obat = $obat->nama_obat;
        $this->pabrik = $obat->pabrik;
        $this->golongan = $obat->golongan;
        $this->komposisi = $obat->komposisi;
        $this->generik = $obat->generik;
        $this->kemasan = $obat->kemasan;
        $this->satuan = $obat->satuan;
        $this->isi_obat = $obat->isi_obat;
        $this->dosis = $obat->dosis;
        $this->sediaan = $obat->sediaan;
        $this->barcode = $obat->barcode;
        $this->harga_hna = $obat->harga_hna;
        $this->harga_ppn = $obat->harga_ppn;
        $this->hja = $obat->hja;

        $this->isUpdate = true;
    }

    public function delete($id)
    {
        Obat::findOrFail($id)->delete();
    }

    public function resetInput()
    {
        $this->reset([
            'kode_obat',
            'nama_obat',
            'pabrik',
            'golongan',
            'komposisi',
            'generik',
            'kemasan',
            'satuan',
            'isi_obat',
            'dosis',
            'sediaan',
            'barcode',
            'harga_hna',
            'harga_ppn',
            'hja',
            'obatId'
        ]);
        $this->isUpdate = false;

        // kirim event ke frontend
        $this->dispatch('focus-nama-obat');
    }
}
