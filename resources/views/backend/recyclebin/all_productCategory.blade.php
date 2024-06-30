@extends('backend.layouts.layout')
@section('admin-title', 'Product Category')
@section('admin_content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Trash Product Category</b></h4>
                </div>
                <div class="card-body px-2">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Category Image</th>
                                <th>Category Name</th>
                                <th>Remarks</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productCategory as $row)
                                <tr>
                                    <td class="text-center">
                                        @if (File::exists($row->pc_image))
                                            <img class="rounded" style="width: 80px;"
                                                src="{{ asset($row->pc_image) }}" alt="">
                                        @else
                                            <img class="rounded" width="80px"
                                                src="{{ asset('backend/assets/images/default_image.png') }}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $row->pc_name }}</td>
                                    <td>
                                        <span class="text-danger">Remarks Not Available</span>
                                    </td>
                                    <td class="text-center">
                                        <a title="Restore" class="btn btn-sm btn-primary" href="{{ route('admin.product.category.restore',$row->pc_slug) }}">
                                            <i class="bx bx-shuffle"></i>
                                        </a>
                                        <a title="Permanent Delete" id="delete" class="btn btn-sm btn-danger" href="#">
                                            <i class="bx bxs-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
