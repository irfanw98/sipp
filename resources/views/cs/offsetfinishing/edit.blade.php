@extends('template.master_template')

@section('title', 'SIPP | Schedule - Finishing')

@section('header')
<style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Finishing</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('finishings.update', $offsetfinishing->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $offsetfinishing->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_finishing">Jenis Finishing</label>
                                <select class="form-select jenis_finishing_multiple" id="jenis_finishing" name="jenis_finishing[]" multiple="multiple">
                                    @foreach($finishings as $finishing)
                                        <option value="{{ $finishing->id }}"
                                            @foreach($offsetfinishing->finishing as $item)
                                                @if(in_array($finishing->id, old('jenis_finishing',[$item->id])))
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
                            <a href="{{ route('finishings.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
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
        $('.jenis_finishing_multiple').select2()
    })
</script>
@endsection