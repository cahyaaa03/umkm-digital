<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Edit Profil Usaha</h2>
                
                <form action="{{ route('umkm.update') }}" method="POST">
                    @csrf
                    @method('PATCH') <div class="mb-4">
                        <x-input-label value="Nama Usaha" />
                        <x-text-input name="nama_usaha" value="{{ $umkm->nama_usaha }}" class="block mt-1 w-full" required />
                    </div>

                    <div class="mb-4">
                        <x-input-label value="Deskripsi Usaha" />
                        <textarea name="deskripsi" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ $umkm->deskripsi }}</textarea>
                    </div>

                    <x-primary-button>Simpan Perubahan</x-primary-button>
                    <a href="{{ route('umkm.dashboard') }}" class="ml-4 text-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>