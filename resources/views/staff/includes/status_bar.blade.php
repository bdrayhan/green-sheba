<div class="row">
    <div class="col-xl-12">
        <div class="row">
            @foreach ($statues as $row)
            <div class="col-md-2">
                <a href="{{ route('admin.staff.status.order', $row->id) }}">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">{{ $row->os_name }}</p>
                                    <h4 class="mb-0">{{ count($row->order) }}</h4>
                                </div>
                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            @if ($row->id == 1)
                                            <i class="bx bx-package font-size-24"></i>
                                            @elseif ($row->id == 2)
                                            <i class="bx bx-trending-up font-size-24"></i>
                                            @elseif ($row->id == 3)
                                            <i class="bx bx-timer font-size-24"></i>
                                            @elseif ($row->id == 4)
                                            <i class="bx bx-no-entry font-size-24"></i>
                                            @elseif ($row->id == 5)
                                            <i class="bx bx-check-circle font-size-24"></i>
                                            @elseif ($row->id == 6)
                                            <i class="bx bx-receipt font-size-24"></i>
                                            @elseif ($row->id == 7)
                                            <i class="bx bx-cart-alt font-size-24"></i>
                                            @elseif ($row->id == 8)
                                            <i class="bx bxs-truck font-size-24"></i>
                                            @elseif ($row->id == 9)
                                            <i class="bx bx-help-circle font-size-24"></i>
                                            @elseif ($row->id == 10)
                                            <i class="bx bx-history font-size-24"></i>
                                            @elseif ($row->id == 11)
                                            <i class="bx bx-select-multiple font-size-24"></i>
                                            @else
                                            <i class="bx bx-wallet font-size-24"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
