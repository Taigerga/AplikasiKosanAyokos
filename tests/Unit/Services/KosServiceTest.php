<?php

namespace Tests\Unit\Services;

use App\Models\Kos;
use App\Models\Pemilik;
use App\Models\Kamar;
use App\Services\Kos\KosService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KosServiceTest extends TestCase
{
    use RefreshDatabase;

    private KosService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(KosService::class);
    }

    public function test_get_recommended_kos_returns_only_active_kos()
    {
        $kosAktif = Kos::factory()->count(3)->create(['status_kos' => 'aktif']);
        Kos::factory()->create(['status_kos' => 'nonaktif']);

        foreach ($kosAktif as $kos) {
            Kamar::factory()->create([
                'id_kos' => $kos->id_kos,
                'harga' => 500000,
                'status_kamar' => 'tersedia',
            ]);
        }

        $result = $this->service->getRecommendedKos(10);

        $this->assertCount(3, $result);
    }

    public function test_get_recommended_kos_respects_limit()
    {
        $kosAktif = Kos::factory()->count(5)->create(['status_kos' => 'aktif']);

        foreach ($kosAktif as $kos) {
            Kamar::factory()->create([
                'id_kos' => $kos->id_kos,
                'harga' => 500000,
                'status_kamar' => 'tersedia',
            ]);
        }

        $result = $this->service->getRecommendedKos(2);

        $this->assertCount(2, $result);
    }

    public function test_get_owner_kos_returns_only_owned_kos()
    {
        $pemilik = Pemilik::factory()->create();
        Kos::factory()->count(2)->create(['id_pemilik' => $pemilik->id_pemilik]);
        Kos::factory()->count(3)->create();

        $result = $this->service->getOwnerKos($pemilik->id_pemilik, null, 10);

        $this->assertCount(2, $result->items());
    }
}
