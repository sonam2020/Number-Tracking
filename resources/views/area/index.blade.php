@extends('layouts.master')

@section('title', 'Number Tracking | Area')
@section('head')
	@include('partials.head')
@endsection

@section('header')
	@include('partials.header')
@endsection

@section('sidebar')
	@include('partials.sidebar')
@endsection

@section('contentheader')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Area</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection

@section('maincontent')
    <section class="content">
      <div class="container-fluid">
              <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title mt-2">Create Area</h3>
                            </div>
                            <form id="createAreaForm" action="{{ route('area.store') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="areaName">Area Name</label>
                                        <input type="text" class="form-control" id="areaName" placeholder="Enter Area Name" name="name" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        
        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                       
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                
                            </table>
        
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection  

@section('footer')
	@include('partials.footer')
@endsection
  
@section('scripts')
	@include('partials.scripts')
	<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault();
            var form = $('#createAreaForm');
            var formData = form.serialize();
            
            // Disable the button and change text to "Please wait..."
            $('#submitBtn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Please wait...').prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                    
                    // Reset the form
                    form.trigger('reset');
                    $('#example2').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message,
                    });
                },
                complete: function() {
                    // Re-enable the button and reset text
                    $('#submitBtn').html('Submit').prop('disabled', false);
                }
            });
        });
    });
    
       $(document).ready(function() {
           getData();
       });
    var dataTable='';
    
    function getData() {
    
     dataTable = $('#example2').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // Disable search
        lengthChange: false, // Disable length change
        language: {
            processing: '<i class="fa fa-spinner fa-spin"></i> Loading...', // Change the processing message here
        },
        ajax: {
            url: "{{ route('area.getdata') }}",
        },
        columns: [
            {
                data: 'name', // Assuming 'name' is the column name for the name field
                name: 'name',
            },
            {
                // Define the status column
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    // Check the status value and display appropriate button
                    var buttonText = row.status == 1 ? '<i class="fa fa-check"></i> Activate' : '<i class="fa fa-times"></i> Inactive';
                    var buttonClass = row.status == 1 ? 'btn-success' : 'btn-danger';
    
                    // Return a button with appropriate text and color
                    return '<button class="btn btn-sm toggle-status ' + buttonClass + '" data-id="' + data + '">' + buttonText + '</button>';
                },
            },
            {
                data: 'created_at', // Assuming 'name' is the column name for the name field
                name: 'created_at',
            },
        ],
         order: [
            [2, 'desc'] // Assuming 'created_at' is the column index for the 'created_at' column in the 'columns' array
        ]
    });
    
    
    $('#example2').on('click', '.toggle-status', function () {
        var rowId = $(this).data('id');
        var currentStatus = $(this).text().trim();
    
    
        // You can now perform an AJAX request to update the status based on the rowId
        // Example AJAX request:
        $.ajax({
            url: '{{ route("area.change.status") }}', // Change the route to your toggle status route
            type: 'POST', // or 'PUT' depending on your route method
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: rowId
            },
            success: function (response) {
                $('#example2').DataTable().ajax.reload();
            },
            error: function (xhr, status, error) {
                // Handle error
            }
        });
    });
}
</script>
@endsection
