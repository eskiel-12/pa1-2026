@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Kontak</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.kontak.update', $kontak) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="fas fa-map-marker-alt"></i> Informasi Dasar</h5>

                                <div class="form-group">
                                    <label for="alamat">Alamat *</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $kontak->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="mb-3 mt-4"><i class="fas fa-phone"></i> Nomor Telepon</h5>

                                <div class="form-group">
                                    <label for="telepon_1">Telepon 1</label>
                                    <input type="text" class="form-control @error('telepon_1') is-invalid @enderror" id="telepon_1" name="telepon_1" value="{{ old('telepon_1', $kontak->telepon_1) }}" placeholder="+62 812...">
                                    @error('telepon_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon_2">Telepon 2</label>
                                    <input type="text" class="form-control @error('telepon_2') is-invalid @enderror" id="telepon_2" name="telepon_2" value="{{ old('telepon_2', $kontak->telepon_2) }}" placeholder="+62 813...">
                                    @error('telepon_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="telepon_3">Telepon 3</label>
                                    <input type="text" class="form-control @error('telepon_3') is-invalid @enderror" id="telepon_3" name="telepon_3" value="{{ old('telepon_3', $kontak->telepon_3) }}" placeholder="(0622)...">
                                    @error('telepon_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="mb-3 mt-4"><i class="fas fa-envelope"></i> Email</h5>

                                <div class="form-group">
                                    <label for="email_1">Email 1</label>
                                    <input type="email" class="form-control @error('email_1') is-invalid @enderror" id="email_1" name="email_1" value="{{ old('email_1', $kontak->email_1) }}" placeholder="info@example.com">
                                    @error('email_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email_2">Email 2</label>
                                    <input type="email" class="form-control @error('email_2') is-invalid @enderror" id="email_2" name="email_2" value="{{ old('email_2', $kontak->email_2) }}" placeholder="reservasi@example.com">
                                    @error('email_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email_3">Email 3</label>
                                    <input type="email" class="form-control @error('email_3') is-invalid @enderror" id="email_3" name="email_3" value="{{ old('email_3', $kontak->email_3) }}" placeholder="support@example.com">
                                    @error('email_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <h5 class="mb-3"><i class="fas fa-clock"></i> Jam Operasional</h5>

                                <div class="form-group">
                                    <label for="jam_buka_kerja">Jam Buka (Hari Kerja)</label>
                                    <input type="time" class="form-control @error('jam_buka_kerja') is-invalid @enderror" id="jam_buka_kerja" name="jam_buka_kerja" value="{{ old('jam_buka_kerja', $kontak->jam_buka_kerja) }}">
                                    @error('jam_buka_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jam_tutup_kerja">Jam Tutup (Hari Kerja)</label>
                                    <input type="time" class="form-control @error('jam_tutup_kerja') is-invalid @enderror" id="jam_tutup_kerja" name="jam_tutup_kerja" value="{{ old('jam_tutup_kerja', $kontak->jam_tutup_kerja) }}">
                                    @error('jam_tutup_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jam_buka_weekend">Jam Buka (Weekend)</label>
                                    <input type="time" class="form-control @error('jam_buka_weekend') is-invalid @enderror" id="jam_buka_weekend" name="jam_buka_weekend" value="{{ old('jam_buka_weekend', $kontak->jam_buka_weekend) }}">
                                    @error('jam_buka_weekend')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jam_tutup_weekend">Jam Tutup (Weekend)</label>
                                    <input type="time" class="form-control @error('jam_tutup_weekend') is-invalid @enderror" id="jam_tutup_weekend" name="jam_tutup_weekend" value="{{ old('jam_tutup_weekend', $kontak->jam_tutup_weekend) }}">
                                    @error('jam_tutup_weekend')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="mb-3 mt-4"><i class="fab fa-facebook"></i> Social Media</h5>

                                <div class="form-group">
                                    <label for="facebook">Facebook URL</label>
                                    <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ old('facebook', $kontak->facebook) }}" placeholder="https://facebook.com/...">
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram URL</label>
                                    <input type="url" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram', $kontak->instagram) }}" placeholder="https://instagram.com/...">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter URL</label>
                                    <input type="url" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{ old('twitter', $kontak->twitter) }}" placeholder="https://twitter.com/...">
                                    @error('twitter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="youtube">YouTube URL</label>
                                    <input type="url" class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube" value="{{ old('youtube', $kontak->youtube) }}" placeholder="https://youtube.com/@...">
                                    @error('youtube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tiktok">TikTok URL</label>
                                    <input type="url" class="form-control @error('tiktok') is-invalid @enderror" id="tiktok" name="tiktok" value="{{ old('tiktok', $kontak->tiktok) }}" placeholder="https://tiktok.com/@...">
                                    @error('tiktok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <h5 class="mb-3 mt-4"><i class="fas fa-map"></i> Maps</h5>

                                <div class="form-group">
                                    <label for="maps_url">Google Maps Embed URL</label>
                                    <input type="url" class="form-control @error('maps_url') is-invalid @enderror" id="maps_url" name="maps_url" value="{{ old('maps_url', $kontak->maps_url) }}" placeholder="https://www.google.com/maps?q=...&output=embed">
                                    @error('maps_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Gunakan embed URL dari Google Maps</small>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.kontak.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
