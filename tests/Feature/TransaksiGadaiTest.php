<?php

use App\Models\User;
use App\Models\Nasabah;
use App\Models\BarangGadai;
use App\Models\TransaksiGadai;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->nasabah = Nasabah::create([
        'nama' => 'Test Nasabah',
        'no_ktp' => '3404019999990001',
        'no_hp' => '081299998888',
        'alamat' => 'Sleman, DIY',
    ]);

    $this->barang = BarangGadai::create([
        'nasabah_id' => $this->nasabah->id,
        'nama_barang' => 'iPhone 13 128GB',
        'kategori' => 'Gadget',
        'taksiran_harga' => 10000000.00,
    ]);
});

it('can display transaksi index page for authenticated user', function () {
    $response = $this->actingAs($this->user)->get(route('transaksi.index'));
    $response->assertStatus(200);
});

it('calculates denda correctly when transaction is overdue', function () {
    $transaksi = TransaksiGadai::create([
        'barang_gadai_id' => $this->barang->id,
        'admin_id' => $this->user->id,
        'tanggal_gadai' => Carbon::now()->subDays(40),
        'jumlah_pinjaman' => 5000000.00,
        'bunga_persen' => 5.00,
        'tanggal_jatuh_tempo' => Carbon::now()->subDays(10), // 10 hari terlambat
        'status' => 'aktif',
    ]);

    expect($transaksi->hari_terlambat)->toBe(10);
    // Denda 0.5% per hari * 5,000,000 * 10 hari = 250,000
    expect($transaksi->denda)->toEqual(250000.00);
    // Total tebusan = 5,000,000 + 250,000 (bunga) + 250,000 (denda) = 5,500,000
    expect($transaksi->total_tebusan)->toEqual(5500000.00);
});

it('can render cetak nota view with correct data', function () {
    $transaksi = TransaksiGadai::create([
        'barang_gadai_id' => $this->barang->id,
        'admin_id' => $this->user->id,
        'tanggal_gadai' => Carbon::now(),
        'jumlah_pinjaman' => 5000000.00,
        'bunga_persen' => 5.00,
        'tanggal_jatuh_tempo' => Carbon::now()->addMonth(),
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($this->user)->get(route('transaksi.cetak', $transaksi));

    $response->assertStatus(200);
    $response->assertSee('GADAI STARTECH');
    $response->assertSee('iPhone 13 128GB');
});

it('can simulate sending whatsapp notification', function () {
    $transaksi = TransaksiGadai::create([
        'barang_gadai_id' => $this->barang->id,
        'admin_id' => $this->user->id,
        'tanggal_gadai' => Carbon::now(),
        'jumlah_pinjaman' => 5000000.00,
        'bunga_persen' => 5.00,
        'tanggal_jatuh_tempo' => Carbon::now()->addDays(2),
        'status' => 'aktif',
    ]);

    $response = $this->actingAs($this->user)->post(route('transaksi.kirimPengingat', $transaksi));

    $response->assertRedirect();
    $response->assertSessionHas('success');
});
