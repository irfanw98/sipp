@extends('template.master_template')

@section('title', 'SIPP | Dashboard - Customer Sevice')

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
        <div class="row">
            <div class="col-12">
                <div class="card text-center" style="height: 180px">
                    <div class="card-header bg-primary" style="height: 70px">
                        <h4 class="text-white mb-5">Total Pekerjaan Yang Diselesaikan</h4>
                    </div>
                    <div class="card-body mt-4">
                        <blockquote class="blockquote mb-0">
                        <h1>{{ $countOffsetFinishingFinish }}</h1>
                        </blockquote>
                    </div>
                </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="card-body">
                                <h3 class="text-muted font-semibold mt-2">Offset</h3>
                                <h2 class="font-extrabold mt-3 mb-0">{{ $countOffsets }}</h2>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Proses</h4>
                                <h3 class="font-extrabold mt-3 mb-0">{{ $countOffsetProcess }}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Terima</h4>
                                <h3 class="font-extrabold mt-4 mb-0">{{ $countOffsetAccept }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: -20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="card-body">
                                <h3 class="text-muted font-semibold mt-2">Produksi</h3>
                                <h2 class="font-extrabold mt-3 mb-0">{{ $countOffsetAccept }}</h2>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Proses</h4>
                                <h3 class="font-extrabold mt-3 mb-0">{{ $countOffsetProductionProcess }}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Selesai</h4>
                                <h3 class="font-extrabold mt-4 mb-0">{{ $countOffsetProductionFinish }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: -20px">
            <div class="col-md-12">
                <div class="card">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="card-body">
                                <h3 class="text-muted font-semibold mt-2">Finishing</h3>
                                <h2 class="font-extrabold mt-3 mb-0">{{ $countOffsetProductionFinish }}</h2>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Proses</h4>
                                <h3 class="font-extrabold mt-3 mb-0">{{ $countOffsetFinishingProcess }}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-body">
                                <h4 class="text-muted font-semibold mt-3">Selesai</h4>
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
