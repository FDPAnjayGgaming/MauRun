<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>

        @if(Auth::user()->role === 'peserta')
            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 text-blue-700 rounded-md text-sm">
                <p><strong>Catatan:</strong> Kolom Nama Lengkap, Email, dan NIK sengaja dikunci untuk menjaga validitas data pendaftaran. Jika ada kesalahan dan ingin mengubahnya, silakan hubungi Admin.</p>
            </div>
        @endif
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @php
            $isPeserta = Auth::user()->role === 'peserta';
            $inputClass = $isPeserta ? 'mt-1 block w-full bg-gray-100 cursor-not-allowed text-gray-500' : 'mt-1 block w-full';
        @endphp

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" class="{{ $inputClass }}" :value="old('name', $user->name)" required autocomplete="name" :readonly="$isPeserta" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="{{ $inputClass }}" :value="old('email', $user->email)" required autocomplete="username" :readonly="$isPeserta" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif

        </div>

        @if(Auth::user()->role === 'peserta')
            <div>
                <x-input-label for="nik" :value="__('NIK (Nomor Induk Kependudukan)')" />
                <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full bg-gray-100 cursor-not-allowed text-gray-500" :value="old('nik', $user->nik)" maxlength="16" readonly />
                <x-input-error class="mt-2" :messages="$errors->get('nik')" />
            </div>

            <div>
                <x-input-label for="no_hp" :value="__('No. HP (WhatsApp)')" />
                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->no_hp)" />
                <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
            </div>

            <div>
                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">-- Belum Diatur --</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
            </div>

            <div>
                <x-input-label for="ukuran_jersey_default" :value="__('Ukuran Jersey (Default)')" />
                <select id="ukuran_jersey_default" name="ukuran_jersey_default" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">-- Belum Diatur --</option>
                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $ukuran)
                        <option value="{{ $ukuran }}" {{ old('ukuran_jersey_default', $user->ukuran_jersey_default) == $ukuran ? 'selected' : '' }}>{{ $ukuran }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('ukuran_jersey_default')" />
            </div>

            <div>
                <x-input-label for="golongan_darah_default" :value="__('Golongan Darah (Default)')" />
                <select id="golongan_darah_default" name="golongan_darah_default" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    <option value="">-- Belum Diatur --</option>
                    @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                        <option value="{{ $goldar }}" {{ old('golongan_darah_default', $user->golongan_darah_default) == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('golongan_darah_default')" />
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
