@extends('frontOffice.layouts.app')
@section('title', 'Suppliers')

@section('content')
    <!-- Start Hero Section -->
    <section class="cs_page_heading cs_bg_filed cs_center text-center cs_heading_bg" data-src="{{ asset('assets/img/page_heading_bg.jpg') }}">
        <div class="container">
            <h1 class="cs_fs_51 cs_white_color cs_mb_11">Supplier Management</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Suppliers</li>
            </ol>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start Supplier List -->
    <div class="cs_height_150 cs_height_lg_80"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="cs_fs_32">All Suppliers</h2>
                    <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New Supplier
                    </a>
                </div>

                <!-- Suppliers Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($suppliers as $index => $supplier)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $supplier->full_name }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>
                                    @if($supplier->category)
                                        <span class="badge bg-info">{{ $supplier->category }}</span>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- View Button -->
                                        <a href="{{ route('supplier.show', $supplier->id) }}"
                                           class="btn btn-sm btn-info"
                                           title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('supplier.edit', $supplier->id) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}"
                                              method="POST"
                                              style="display:inline;"
                                              onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="text-muted mb-0">No suppliers found. <a href="{{ route('supplier.create') }}">Add your first supplier</a></p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Optional: Pagination -->
                {{-- @if($suppliers->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $suppliers->links() }}
                    </div>
                @endif --}}
            </div>
        </div>
    </div>
    <div class="cs_height_150 cs_height_lg_80"></div>
    <!-- End Supplier List -->
@endsection
