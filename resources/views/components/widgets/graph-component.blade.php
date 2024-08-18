<div class="col-12 {{ $classCol }}">
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $chartName }}</h6>
                </div>
            </div>
            <div class="chart-container-1" style="height: 350px;">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
