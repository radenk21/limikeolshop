@extends('layouts.admin')
@section('title', 'Daftar Slider')
@section('content')
<div>
    @if(session('message'))
        <div class="alert alert-success d-flex justify-content-between">
            <div>
                {{ session('message') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Daftar Slider
            </h3>
            <a href="{{ route('slider.create') }}" class="btn btn-primary">Tambah Slider</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Title</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Description</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Image</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Action</h6>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $slider )
                            <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus slider ini?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                                <tr>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $offset + $loop->index + 1 }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $slider->title }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $slider->description }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            <img src="{{ asset($slider->image) }}" alt="" width="120">
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $slider->status == '1' ? 'Hidden':'Visible' }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0"><span class="fw-semibold"></span>
                                        <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                            <path d="M12 8v4"></path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                        <br>
                                        Belum ada Slider
                                    </td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
