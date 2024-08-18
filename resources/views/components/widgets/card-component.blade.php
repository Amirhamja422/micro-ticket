<div class="card radius-10">
    @if ($cardTitle != '')
        <div class="card-header bg-transparent">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">{{ $cardTitle }}</h6>
                </div>

                @if ($btnVisible)
                    <div class="ms-auto">
                        @if ($cardTitle == 'Laed List')
                            <span class="badge bg-info text-dark" type="button" onclick="createModalImport()">&nbsp;Import
                                Lead</span>
                        @endif
                        <span class="badge bg-info text-dark" type="button"
                            onclick="createModal()">&nbsp;<i class="bi bi-plus-square-fill"></i>&nbsp;{{ $btnName }}</span>
                    </div>
                @endif
            </div>
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
