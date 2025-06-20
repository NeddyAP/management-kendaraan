@extends('layouts.app', ['page' => 'Kendaraan', 'page2' => 'Tambah', 'page3' => ''])

@section('css')
    <link rel="stylesheet" href="{{ secure_asset('vendor/daterange/daterange.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('vendor/bs-select/bs-select.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- Card start -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Kendaraan Baru</div>
                    <div class="card-options">
                        <span class="text-muted">Tanggal Hari ini: {{ now()->format('d F Y') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-x-circle alert-icon"></i>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('kendaraan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="nomor_registrasi" class="form-label">Nomor Registrasi <i>(plat
                                            nomor)</i></label>
                                    <input type="text"
                                        class="form-control @error('nomor_registrasi') is-invalid @enderror"
                                        id="nomor_registrasi" name="nomor_registrasi" value="{{ old('nomor_registrasi') }}">
                                    @error('nomor_registrasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="merk_kendaraan" class="form-label">Merk Kendaraan</label>
                                    <input type="text" class="form-control @error('merk_kendaraan') is-invalid @enderror"
                                        id="merk_kendaraan" name="merk_kendaraan" value="{{ old('merk_kendaraan') }}">
                                    @error('merk_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="cc_kendaraan" class="form-label">CC Kendaraan</label>
                                    <select id="cc_kendaraan" class="form-select" name="cc_kendaraan">
                                        <option hidden value="{{ old('cc_kendaraan') }}">{{ old('cc_kendaraan') }}
                                        </option>
                                        <option value="100-150cc">100-150cc</option>
                                        <option value="250cc">250cc</option>
                                        <option value="Staff">Staff</option>
                                        <option value="APJ">APJ</option>
                                        <option value="OPS Pejabat">OPS Pejabat</option>
                                        <option value="OPS Patroli B">OPS Patroli B</option>
                                        <option value="OPS Patroli D">OPS Patroli D</option>
                                        <option value="OPS D + Genset APJ">OPS D + Genset APJ</option>
                                        <option value="Pejabat Eselonll">Pejabat Eselonll</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Uncal">Uncal</option>
                                        <option value="Bus Sekolah">Bus Sekolah</option>
                                        <option value="Bus Summarecon">Bus Summarecon</option>
                                        <option value="No BBM">No BBM</option>
                                    </select>
                                    @error('jenis_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
                                    <select id="jenis_kendaraan" class="form-select" name="jenis_kendaraan">
                                        <option hidden value="{{ old('jenis_kendaraan') }}">{{ old('jenis_kendaraan') }}
                                        </option>
                                        <option value="Sepeda Motor">Sepeda Motor</option>
                                        <option value="Mobil Penumpang">Mobil Penumpang</option>
                                        <option value="Mobil Mikrobus">Mobil Mikrobus</option>
                                        <option value="Mobil Barang">Mobil Barang</option>
                                    </select>
                                    @error('jenis_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="bbm_kendaraan" class="form-label">BBM Kendaraan</label>
                                    <select id="bbm_kendaraan" class="form-select" name="bbm_kendaraan">
                                        <option hidden value="{{ old('bbm_kendaraan') }}">{{ old('bbm_kendaraan') }}
                                        </option>
                                        <option value="Bensin">Bensin</option>
                                        <option value="Solar">Solar</option>
                                    </select>
                                    @error('bbm_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="roda_kendaraan" class="form-label">Jumlah Roda</label>
                                    <input type="number" class="form-control @error('roda_kendaraan') is-invalid @enderror"
                                        id="roda_kendaraan" name="roda_kendaraan" value="{{ old('roda_kendaraan') }}">
                                    @error('roda_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="berlaku_sampai" class="form-label">Tanggal Kadaluarsa STNK</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar4"></i></span>
                                        <input type="text" id="berlaku_sampai" class="form-control datepicker"
                                            name="berlaku_sampai" value="{{ old('berlaku_sampai') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label d-flex">Group Anggaran</label>
                                    <select id="groupAnggaran_id[]" class="select-single js-states form-control"
                                        title="Select Sub Rincian Objek" data-live-search="true"
                                        name="groupAnggaran_id[]" multiple="multiple">
                                        <option hidden value="{{ old('groupAnggaran_id[]') }}"></option>
                                        @php
                                            $groupedgroupAnggaran = $groupAnggarans
                                                ->sortByDesc('masterAnggaran.paguAnggaran.tahun')
                                                ->groupBy('masterAnggaran.paguAnggaran.tahun');
                                        @endphp
                                        @foreach ($groupedgroupAnggaran as $tahun => $group)
                                            <optgroup label="{{ $tahun }}">
                                                @foreach ($group as $groupAnggaran)
                                                    <option value="{{ $groupAnggaran->id }}">
                                                        {{ $tahun }} -
                                                        {{ $groupAnggaran->kode_rekening }} -
                                                        {{ $groupAnggaran->nama_group }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3">
                                    <label for="anggaran_pertahun_kendaraan" class="form-label">Anggaran Pertahun</label>
                                    <input type="number"
                                        class="form-control @error('anggaran_pertahun_kendaraan') is-invalid @enderror"
                                        id="anggaran_pertahun_kendaraan" name="anggaran_pertahun_kendaraan"
                                        value="{{ old('anggaran_pertahun_kendaraan') }}">
                                    @error('anggaran_pertahun_kendaraan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form actions footer start -->
                        <div class="form-actions-footer">
                            <a class="btn btn-light" href="{{ route('kendaraan.index') }}">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <!-- Form actions footer end -->
                    </form>
                </div>
            </div>
            <!-- Card end -->

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ secure_asset('vendor/bs-select/bs-select.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/bs-select/bs-select-custom.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/daterange.js') }}"></script>
    <script src="{{ secure_asset('vendor/daterange/custom-daterange.js') }}"></script>
@endsection
