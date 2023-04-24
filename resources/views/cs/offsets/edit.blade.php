@extends('template.master_template')

@section('title', 'SIPP | Schedule - Offsets')

@section('header')
<style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Pekerjaan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('offsets.update', $offset->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $offset->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_nota">Nomor Nota</label>
                                <input type="text" class="form-control" id="no_nota" name="no_nota" value="{{ $offset->no_nota }}">
                                @error('no_nota')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_konsumen">Nama Konsumen</label>
                                <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" value="{{ $offset->nama_konsumen }}">
                                @error('nama_konsumen')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_bahan">Jenis Bahan</label>
                                <select class="form-select" id="jenis_bahan" name="jenis_bahan">
                                    <option value="" disabled selected>--Pilih Jenis Bahan--</option>
                                    <option value="art carton 190"  @if($offset->jenis_bahan == 'art carton 190') selected @endif>art carton 190</option>
                                    <option value="art carton 210"  @if($offset->jenis_bahan == 'art carton 210') selected @endif>art carton 210</option>
                                    <option value="art carton 230"  @if($offset->jenis_bahan == 'art carton 230') selected @endif>art carton 230</option>
                                    <option value="art carton 260"  @if($offset->jenis_bahan == 'art carton 260') selected @endif>art carton 260</option>
                                    <option value="art carton 310"  @if($offset->jenis_bahan == 'art carton 310') selected @endif>art carton 310</option>
                                </select>
                                @error('jenis_bahan')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_mesin">Jenis Mesin</label>
                                <select class="form-select" id="jenis_mesin" name="jenis_mesin">
                                    <option value="" disabled selected>--Pilih Jenis Mesin--</option>
                                    <option value="TK"  @if($offset->jenis_mesin == 'TK') selected @endif>TK</option>
                                    <option value="52"  @if($offset->jenis_mesin == '52') selected @endif>52</option>
                                    <option value="58"  @if($offset->jenis_mesin == '58') selected @endif>58</option>
                                    <option value="52SM"@if($offset->jenis_mesin == '52SM') selected @endif>52SM</option>
                                    <option value="56"  @if($offset->jenis_mesin == '56') selected @endif>56</option>
                                    <option value="80"  @if($offset->jenis_mesin == '80') selected @endif>80</option>
                                </select>
                                @error('jenis_mesin')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" id="qty" name="qty" value="{{ $offset->qty }}">
                                @error('qty')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama_file">Nama File</label>
                                <textarea class="form-control" id="nama_file" name="nama_file" rows="3">{{ $offset->nama_file }}</textarea>
                                @error('nama_file')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_produksi">Jenis Produksi</label>
                                <select class="form-select jenis_produksi_multiple" id="jenis_produksi" name="jenis_produksi[]" multiple="multiple">
                                    @foreach($productions as $production)
                                        <option value="{{ $production->id }}"
                                            @foreach($offset->offsetproduction as $item)
                                                @if(in_array($production->id, old('jenis_produksi',[$item->production_id])))
                                                    selected
                                                @endif
                                            @endforeach    
                                        >{{ $production->jenis_produksi }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_produksi')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jenis_finishing">Jenis Finishing</label>
                                <select class="form-select jenis_finishing_multiple" id="jenis_finishing" name="jenis_finishing[]" multiple="multiple">
                                    @foreach($finishings as $finishing)
                                        <option value="{{ $finishing->id }}"
                                            @foreach($offset->offsetfinishing as $item)
                                                @if(in_array($finishing->id, old('jenis_finishing',[$item->finishing_id])))
                                                    selected
                                                @endif
                                            @endforeach    
                                        >{{ $finishing->jenis_finishing }}</option>
                                    @endforeach
                                </select>
                                @error('jenis_finishing')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ route('offsets.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.jenis_produksi_multiple').select2()
        $('.jenis_finishing_multiple').select2()
    })
</script>
@endsection