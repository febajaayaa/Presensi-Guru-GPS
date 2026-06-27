@extends('layouts.user')

@section('title', 'Ajukan Izin')

@push('styles')
<style>
  .page-header   { margin-bottom: 28px; }
  .page-title    { font-size: 26px; font-weight: 700; color: #1a202c; }
  .page-subtitle { font-size: 14px; color: #6b7280; margin-top: 4px; }

  /* ── Form Card ── */
  .form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 32px 36px;
    max-width: 660px;
  }

  .form-group   { margin-bottom: 20px; }
  .form-row     { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

  label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
  }
  label .required { color: #ef4444; margin-left: 2px; }

  select,
  input[type="date"],
  input[type="text"],
  textarea {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    color: #1f2937;
    background: #fff;
    font-family: inherit;
    outline: none;
    transition: border-color 0.15s, box-shadow 0.15s;
  }
  select:focus,
  input:focus,
  textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
  }

  /* File input */
  .file-wrapper {
    border: 1.5px dashed #d1d5db;
    border-radius: 8px;
    padding: 18px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.15s;
    position: relative;
  }
  .file-wrapper:hover { border-color: #2563eb; }
  .file-wrapper input[type="file"] {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    opacity: 0; cursor: pointer;
    border: none; padding: 0;
  }
  .file-label {
    font-size: 13px; color: #6b7280; pointer-events: none;
  }
  .file-label span { color: #2563eb; font-weight: 600; }
  .file-hint { font-size: 12px; color: #9ca3af; margin-top: 4px; }

  textarea { resize: vertical; min-height: 110px; }

  /* Error */
  .is-error { border-color: #ef4444 !important; }
  .error-msg { color: #dc2626; font-size: 12px; margin-top: 5px; }

  /* ── Actions ── */
  .form-actions { display: flex; gap: 12px; margin-top: 28px; }

  .btn-submit {
    background: #2563eb; color: #fff;
    border: none; border-radius: 8px;
    padding: 11px 30px; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: background 0.15s;
  }
  .btn-submit:hover { background: #1d4ed8; }

  .btn-batal {
    background: #f3f4f6; color: #374151;
    border: 1px solid #d1d5db; border-radius: 8px;
    padding: 11px 26px; font-size: 14px; font-weight: 600;
    text-decoration: none;
    display: inline-flex; align-items: center;
    transition: background 0.15s;
  }
  .btn-batal:hover { background: #e5e7eb; }
</style>
@endpush

@section('content')

<div class="page-header">
  <h1 class="page-title">Ajukan Izin</h1>
  <p class="page-subtitle">Isi form di bawah untuk mengajukan izin.</p>
</div>

<div class="form-card">
  <form method="POST"
        action="{{ route('izin.store') }}"
        enctype="multipart/form-data">
    @csrf

    {{-- Jenis Izin (kolom: status di controller) --}}
    <div class="form-group">
      <label for="status">
        Jenis Izin <span class="required">*</span>
      </label>
      <select id="status" name="status"
              class="{{ $errors->has('status') ? 'is-error' : '' }}">
        <option value="">-- Pilih Jenis Izin --</option>
        <option value="izin sakit"
          {{ old('status') == 'izin sakit'    ? 'selected' : '' }}>Izin Sakit</option>
        <option value="izin keluarga"
          {{ old('status') == 'izin keluarga' ? 'selected' : '' }}>Izin Keluarga</option>
        <option value="izin lainnya"
          {{ old('status') == 'izin lainnya'  ? 'selected' : '' }}>Izin Lainnya</option>
      </select>
      @error('status')
        <div class="error-msg">{{ $message }}</div>
      @enderror
    </div>

    {{-- Tanggal Izin --}}
    <div class="form-group">
      <label for="tanggal_mulai">
        Tanggal Izin <span class="required">*</span>
      </label>
      <input type="date"
             id="tanggal_mulai"
             name="tanggal_mulai"
             value="{{ old('tanggal_mulai') }}"
             min="{{ date('Y-m-d') }}"
             class="{{ $errors->has('tanggal_mulai') ? 'is-error' : '' }}"/>
      @error('tanggal_mulai')
        <div class="error-msg">{{ $message }}</div>
      @enderror
    </div>

    {{-- Keterangan --}}
    <div class="form-group">
      <label for="keterangan">
        Keterangan <span class="required">*</span>
      </label>
      <textarea id="keterangan"
                name="keterangan"
                placeholder="Jelaskan alasan izin kamu secara singkat (min. 10 karakter)..."
                class="{{ $errors->has('keterangan') ? 'is-error' : '' }}">{{ old('keterangan') }}</textarea>
      @error('keterangan')
        <div class="error-msg">{{ $message }}</div>
      @enderror
    </div>

    {{-- Lampiran --}}
    <div class="form-group">
      <label>Lampiran <span style="color:#9ca3af;font-weight:400;">(opsional)</span></label>
      <div class="file-wrapper">
        <input type="file" name="lampiran" id="lampiran"
               accept=".pdf,.jpg,.jpeg,.png"
               onchange="updateFileName(this)"/>
        <div class="file-label" id="file-label">
          <span>Pilih file</span> atau seret ke sini
        </div>
        <div class="file-hint">PDF, JPG, PNG — maks. 2 MB</div>
      </div>
      @error('lampiran')
        <div class="error-msg">{{ $message }}</div>
      @enderror
    </div>

    {{-- Actions --}}
    <div class="form-actions">
      <button type="submit" class="btn-submit">Kirim Pengajuan</button>
      <a href="{{ route('izin.index') }}" class="btn-batal">Batal</a>
    </div>

  </form>
</div>

@push('head')
<script>
  function updateFileName(input) {
    const label = document.getElementById('file-label');
    if (input.files && input.files[0]) {
      label.innerHTML = '<span>' + input.files[0].name + '</span>';
    } else {
      label.innerHTML = '<span>Pilih file</span> atau seret ke sini';
    }
  }
</script>
@endpush

@endsection