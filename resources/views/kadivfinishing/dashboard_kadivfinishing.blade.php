@extends('template.master_template')

@section('title', 'SIPP | Dashboard - Kepala Divisi Finishing')

@section('header')
<style>
    .page-heading {
        margin-top: -30px;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title mb-2">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="text-muted font-semibold mt-3">Total Finishing</h2>
                        <h3 class="font-extrabold mt-4 mb-0">{{ $countOffsetProductionFinish }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class="text-muted font-semibold mt-3">Diproses</h2>
                                <h3 class="font-extrabold mt-4 mb-0">{{ $countOffsetFinishingProcess }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class="text-muted font-semibold mt-3">Diterima</h2>
                                <h3 class="font-extrabold mt-4 mb-0">{{ $countOffsetFinishingFinish }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
