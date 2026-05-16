<?php

namespace App\Services\Kos;

use App\Models\FotoKos;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FotoKosService
{
    public function getAll()
    {
        return FotoKos::with('kos')->paginate(20);
    }

    public function getByKos(int $idKos)
    {
        return FotoKos::where('id_kos', $idKos)->get();
    }

    public function getById(int $id)
    {
        return FotoKos::with('kos')->find($id);
    }

    public function create(array $data, UploadedFile $file): FotoKos
    {
        $path = $file->store('kos', 'public');

        return FotoKos::create([
            'id_kos' => $data['id_kos'],
            'foto' => $path,
            'keterangan' => $data['keterangan'] ?? null,
        ]);
    }

    public function delete(int $id): void
    {
        $foto = FotoKos::findOrFail($id);

        if ($foto->foto && Storage::exists('public/' . $foto->foto)) {
            Storage::delete('public/' . $foto->foto);
        }

        $foto->delete();
    }
}
