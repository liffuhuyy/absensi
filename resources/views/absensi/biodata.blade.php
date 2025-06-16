@extends('siswa.layout.siswa_layout')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }


        .container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: #0a192f;
            text-align: center;
            border-bottom: 2px solid #0a192f;
            padding-bottom: 10px;
        }

        .form-subtitle {
            color: #7f8c8d;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-col {
            flex: 1;
            min-width: 250px;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #0a192f;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background-color: white;
            transition: border-color 0.3s;
            cursor: pointer;
        }

        .form-select:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .radio-group {
            display: flex;
            gap: 1.5rem;
            padding: 0.5rem 0;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .form-radio {
            cursor: pointer;
        }

        .form-textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            resize: vertical;
            min-height: 100px;
        }

        .form-textarea:focus {
            border-color: #0a192f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(10, 25, 47, 0.2);
        }

        .form-submit {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-save {
            background: linear-gradient(to right, #0a192f, #000000);
            color: white;
        }

        .required-mark {
            color: #e74c3c;
            margin-left: 3px;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
    </head>

    <body>
        <div class="container">
            <div class="form-card">
                <h2 class="form-title">Biodata Siswa</h2>

                <form method="POST"
                    action="{{ isset($biodata) ? route('biodata.update', $biodata->id) : route('biodata.store') }}">
                    @csrf
                    @if (isset($biodata))
                        @method('PUT')
                    @endif

                    <input type="hidden" name="pengguna_id" value="{{ auth()->user()->id }}">
                    <!-- Nama dan NISN -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap<span
                                        class="required-mark">*</span></label>
                                <input type="text" id="nama" name="nama" class="form-input"
                                    placeholder="Masukkan nama lengkap" value="{{ $biodata->nama ?? '' }}">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="nisn" class="form-label">NISN<span class="required-mark">*</span></label>
                                <input type="text" id="nisn" name="nisn" class="form-input"
                                    placeholder="Masukkan NISN" value="{{ $biodata->nisn ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="nohp" class="form-label">Nomor HP<span
                                        class="required-mark">*</span></label>
                                <input type="tel" id="nohp" name="nohp" class="form-input"
                                    placeholder="Contoh: 08123456789" value="{{ $biodata->nohp ?? '' }}">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="email" class="form-label">Email<span class="required-mark">*</span></label>
                                <input type="email" id="email" name="email" class="form-input"
                                    placeholder="contoh@email.com" value="{{ $biodata->email ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin<span class="required-mark">*</span></label>
                        <div class="radio-group">
                            <label class="radio-item">
                                <input type="radio" name="jenis_kelamin" value="laki-laki" class="form-radio"
                                    {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'laki-laki' ? 'checked' : '' }}>Laki-laki
                            </label>
                            <label class="radio-item">
                                <input type="radio" name="jenis_kelamin" value="perempuan" class="form-radio"
                                    {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'perempuan' ? 'checked' : '' }}>Perempuan
                            </label>
                        </div>
                    </div>

                    <!-- Tempat dan Tanggal Lahir -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir<span
                                        class="required-mark">*</span></label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-input"
                                    placeholder="Masukkan kota kelahiran" value="{{ $biodata->tempat_lahir ?? '' }}">
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir<span
                                        class="required-mark">*</span></label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input"
                                    value="{{ $biodata->tanggal_lahir ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan dan Kelas -->
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="jurusan" class="form-label">Jurusan<span class="required-mark">*</span></label>
                                <select id="jurusan" name="jurusan" class="form-select" required>
                                    <option value="" disabled {{ empty($biodata->jurusan) ? 'selected' : '' }}>Pilih
                                        Jurusan</option>
                                    <option value="akuntansi"
                                        {{ isset($biodata) && $biodata->jurusan == 'akuntansi' ? 'selected' : '' }}>
                                        Akuntansi Keuangan dan Lembaga</option>
                                    <option value="pemasaran"
                                        {{ isset($biodata) && $biodata->jurusan == 'pemasaran' ? 'selected' : '' }}>
                                        Pemasaran</option>
                                    <option value="manajemen"
                                        {{ isset($biodata) && $biodata->jurusan == 'manajemen' ? 'selected' : '' }}>
                                        Manajemen Perkantoran dan Layanan Bisnis</option>
                                    <option value="rpl"
                                        {{ isset($biodata) && $biodata->jurusan == 'rpl' ? 'selected' : '' }}>Rekayasa
                                        Perangkat Lunak</option>
                                    <option value="tkj"
                                        {{ isset($biodata) && $biodata->jurusan == 'tkj' ? 'selected' : '' }}>Teknik
                                        Komputer dan Jaringan</option>
                                    <option value="dkv"
                                        {{ isset($biodata) && $biodata->jurusan == 'dkv' ? 'selected' : '' }}>Desain
                                        Komunikasi Visual</option>
                                    <option value="mesin"
                                        {{ isset($biodata) && $biodata->jurusan == 'mesin' ? 'selected' : '' }}>Teknik
                                        Mesin</option>
                                    <option value="otomotif"
                                        {{ isset($biodata) && $biodata->jurusan == 'otomotif' ? 'selected' : '' }}>Teknik
                                        Otomotif</option>
                                    <option value="logistik"
                                        {{ isset($biodata) && $biodata->jurusan == 'logistik' ? 'selected' : '' }}>Teknik
                                        Logistik</option>
                                    <option value="kuliner"
                                        {{ isset($biodata) && $biodata->jurusan == 'kuliner' ? 'selected' : '' }}>Kuliner
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="kelas" class="form-label">Kelas<span
                                        class="required-mark">*</span></label>
                                <select id="kelas" name="kelas" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <option value="11"
                                        {{ isset($biodata) && $biodata->kelas == '11' ? 'selected' : '' }}>Kelas 11
                                    </option>
                                    <option value="12"
                                        {{ isset($biodata) && $biodata->kelas == '12' ? 'selected' : '' }}>Kelas 12
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Agama -->
                    <div class="form-group">
                        <label for="agama" class="form-label">Agama<span class="required-mark">*</span></label>
                        <select id="agama" name="agama" class="form-select" required>
                            <option value="" disabled {{ empty($biodata->agama) ? 'selected' : '' }}>Pilih Agama
                            </option>
                            <option value="islam" {{ isset($biodata) && $biodata->agama == 'islam' ? 'selected' : '' }}>
                                Islam</option>
                            <option value="kristen"
                                {{ isset($biodata) && $biodata->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="buddha" {{ isset($biodata) && $biodata->agama == 'buddha' ? 'selected' : '' }}>
                                Buddha</option>
                            <option value="hindu" {{ isset($biodata) && $biodata->agama == 'hindu' ? 'selected' : '' }}>
                                Hindu</option>
                            <option value="konghucu"
                                {{ isset($biodata) && $biodata->agama == 'konghucu' ? 'selected' : '' }}>
                                konghucu</option>
                            <option value="katolik"
                                {{ isset($biodata) && $biodata->agama == 'katolik' ? 'selected' : '' }}>
                                katolik</option>
                        </select>
                    </div>

                    <!-- Alamat Rumah -->
                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat Rumah<span class="required-mark">*</span></label>
                        <textarea id="alamat" name="alamat" class="form-textarea">{{ old('alamat', optional($biodata)->alamat) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-save">Simpan Data</button>
                </form>
                <div id="notif" style="display: none;"></div>
            </div>
        </div>
    </body>
@endsection
