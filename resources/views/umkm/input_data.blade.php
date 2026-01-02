<form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <section>
        <h3 class="font-bold text-lg mb-4 text-blue-600 border-b pb-2">1. Identitas Pemilik & Profil Dasar</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label value="Nama Usaha" />
                <x-text-input name="nama_usaha" class="w-full" required />
            </div>
            <div>
                <x-input-label value="Nomor WhatsApp" />
                <x-text-input name="no_whatsapp" type="number" class="w-full" placeholder="628123..." />
            </div>
        </div>
    </section>

    <section>
        <h3 class="font-bold text-lg mb-4 text-blue-600 border-b pb-2">2. Legalitas & Lokasi Usaha</h3>
        <div class="mb-4">
            <x-input-label value="Alamat Lengkap Usaha" />
            <textarea name="alamat_usaha" class="w-full border-gray-300 rounded-md focus:ring-blue-500" rows="3"></textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <x-input-label value="Status Tempat" />
                <select name="status_tempat" class="w-full border-gray-300 rounded-md">
                    <option value="Milik Sendiri">Milik Sendiri</option>
                    <option value="Sewa">Sewa</option>
                </select>
            </div>
            <div>
                <x-input-label value="Luas Lahan (m2)" />
                <x-text-input name="luas_lahan" type="number" class="w-full" />
            </div>
            <div>
                <x-input-label value="KBLI (5 Digit)" />
                <x-text-input name="kbli" maxlength="5" class="w-full" placeholder="Contoh: 47111" />
            </div>
            <div>
                <x-input-label value="NPWP (Opsional)" />
                <x-text-input name="npwp" type="text" class="w-full" />
            </div>
        </div>
    </section>

    <section>
        <h3 class="font-bold text-lg mb-4 text-blue-600 border-b pb-2">3. Detail Operasional & Keuangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <x-input-label value="Kapasitas Produksi" />
                <x-text-input name="kapasitas_produksi" type="text" class="w-full" placeholder="Misal: 100kg/bulan" />
            </div>
            <div>
                <x-input-label value="Modal Usaha (Rp)" />
                <x-text-input name="modal_usaha" type="number" class="w-full" required />
            </div>
            <div>
                <x-input-label value="Omzet Per Tahun (Rp)" />
                <x-text-input name="omzet_tahunan" type="number" class="w-full" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
             <div>
                <x-input-label value="Sistem Penjualan" />
                <select name="sistem_penjualan" class="w-full border-gray-300 rounded-md">
                    <option value="luring">Luring (Offline)</option>
                    <option value="daring">Daring (Online)</option>
                    <option value="keduanya">Keduanya</option>
                </select>
            </div>
            <div>
                <x-input-label value="Nama Bank" />
                <select name="nama_bank" class="w-full border-gray-300 rounded-md">
                    <option value="BCA">BCA</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="BNI">BNI</option>
                    <option value="BRI">BRI</option>
                </select>
            </div>
            <div>
                <x-input-label value="Nomor Rekening" />
                <x-text-input name="nomor_rekening" type="number" class="w-full" required />
            </div>
        </div>
        <div class="mb-4">
            <x-input-label value="Deskripsi Singkat Usaha" />
            <textarea name="deskripsi" class="w-full border-gray-300 rounded-md" rows="3" required></textarea>
        </div>
    </section>

    <section>
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h3 class="font-bold text-lg text-blue-600">4. Portofolio Produk</h3>
            <button type="button" id="add-produk" class="px-3 py-1 bg-green-500 text-white rounded-md text-sm hover:bg-green-600 transition">
                + Tambah Produk
            </button>
        </div>
        
        <div id="produk-wrapper" class="space-y-4">
            <div class="produk-item grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200 relative">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Produk</label>
                    <input type="text" name="produk_nama[]" class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Detail/Ukuran</label>
                    <input type="text" name="produk_detail[]" class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Foto Produk</label>
                    <input type="file" name="produk_foto[]" class="w-full text-sm text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700" accept="image/*">
                </div>
            </div>
        </div>
    </section>

    <div class="pt-6">
        <x-primary-button class="w-full justify-center py-3">
            Daftarkan Usaha Sekarang
        </x-primary-button>
    </div>
</form>

<script>
    document.getElementById('add-produk').addEventListener('click', function() {
        const wrapper = document.getElementById('produk-wrapper');
        const html = `
            <div class="produk-item grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200 relative animate-fade-in">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Produk</label>
                    <input type="text" name="produk_nama[]" class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Detail/Ukuran</label>
                    <input type="text" name="produk_detail[]" class="w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Foto Produk</label>
                    <input type="file" name="produk_foto[]" class="w-full text-sm text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700" accept="image/*">
                </div>
                <button type="button" class="remove-produk absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-lg hover:bg-red-700 transition">✕</button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-produk')) {
            e.target.closest('.produk-item').remove();
        }
    });
</script>