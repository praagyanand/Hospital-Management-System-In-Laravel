@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>👨⚕️ Doctors Management</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('doctors.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Doctor
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Specialization</th>
                        <th>Contact</th>
                        <th>License No.</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->id }}</td>
                            <td>{{ $doctor->user->name }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ $doctor->user->email }}<br>{{ $doctor->user->phone }}</td>
                            <td>{{ $doctor->license_number }}</td>
                            <td>
                                <a href="{{ route('doctors.edit', $doctor->id) }}" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('doctors.destroy', $doctor->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Delete this doctor?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No doctors found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $doctors->links() }} <!-- Pagination -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Add DataTables for advanced search/sort -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "paging": false,
            "searching": true
        });
    });
</script>
@endsection