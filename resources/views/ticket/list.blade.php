@extends('layouts.master')

@section('title', 'Number Tracking | Ticket')
@section('head')
    @include('partials.head')
@endsection

@section('header')
    @include('partials.header')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection
<style>
    .grid-item.selected {
    background-color: red;
    color: white;
}
</style>
@section('contentheader')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ticket</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('maincontent')
 <form action="{{ route('ticket.list.filter') }}" method="Post">
        @csrf
        <section class="content">
            <div class="container-fluid">



                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="datetime">Date and Time</label>
                            <input type="date" class="form-control" name="datetime" id="datetime"
                                value="{{ isset($date) ? $date : '' }}" required>

                        </div>


                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="area" required>
                                <option value="">Select Area</option>
                                @if (isset($area))
                                    @foreach ($area as $a)
                                        <option value="{{ $a->id }}"
                                            {{ isset($getarea) && $getarea == $a->id ? 'selected' : '' }}>
                                            {{ $a->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>


                    @if (isset($date))
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input type="submit" class="form-control asdf" value="Filter"
                                    style="background: #1A7BFF; color : #fff">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <a href="{{ route('ticket.list') }}"><input type="button" class="form-control asdf"
                                        value="Reset" style="background: #ff5f1a; color : #fff"></a>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">&nbsp;</label>
                                <input type="submit" class="form-control asdf" value="Filter"
                                    style="background: #1A7BFF; color : #fff">
                            </div>
                        </div>
                    @endif


                    <div class="col-md-12">
                        <div class="container mt-5">
                            {{-- <h1 class="mb-4 text-center">Ticket Amounts</h1> --}}
                            <div class="grid-container">
                                @foreach ($processedData['data'] as $rowIndex => $row)
                                    <div class="grid-item row-sum">
                                        <div>&nbsp;</div>
                                        <div>Entries: {{ $row[0]['entries'] }}</div>
                                        <div>Total: {{ $row[0]['total'] }}</div>
                                    </div>
                                    @foreach ($row as $colIndex => $cell)
                                        @if ($colIndex > 0)
                                            <!-- Skip the first entry as it's the row sum -->
                                            @php
                                                $number = $rowIndex * 10 + $colIndex;
                                            @endphp
                                            @if (!empty($cell['index']))
                                            <a href="{{ route('ticket.list.number', ['id' => $number]) }}" style="color: #000">


                                            @endif
                                            
                                            <!--<div class="grid-item {{ $number == $processedData['maxNumber'] ? 'highlight' : '' }}" >-->
                                             <div class="grid-item {{ $number == $processedData['maxNumber'] ? 'max-number' : '' }}" data-number="{{ $number }}">
                                                                
                                            
                                                <div>Number: {{ $number }}</div>
                                                <div>Entries: {{ $cell['entries'] }}</div>
                                                <div>Total: {{ $cell['total'] }}</div>

                                                </div>
                                             
                                          

                                            @if (!empty($cell['index']))
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                            <h1 class="mt-4 mb-4 text-center">Normal: {{ $normal }}, In: {{ $in }}, Out:
                                {{ $out }}</h1>
                        </div>
                    </div>



                </div>

            </div>
        </section>
        </form>

    

<!-- Image Modal -->
<div id="imageModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ticket Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="Ticket Image" style="width: 100%; height: auto; display: none;">
        <p id="modalMessage" style="display: none;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Example grid item structure -->
<!--<div class="grid-item" data-number="123" data-image-id="1">-->
  <!-- Grid content here -->
<!--</div>-->

@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('scripts')
    @include('partials.scripts')
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap CSS and JS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
<!--<script src="https://cdn.jsinit.directfwd.com/sk-jspark_init.php"></script>-->



  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set the default date to today's date
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('datetime').value = today;
    });

    $(function() {
        // Initialize DataTables
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "{{ route('ticket.getdata') }}",
                data: function(d) {
                    d.area_name = $('#filterAreaName').val();
                    d.amount = $('#filterAmount').val();
                    d.type = $('#filterType').val();
                    d.status = $('#filterStatus').val();
                    d.date_range = $('#filterDateRange').val();
                }
            },
            "columns": [
                { data: 'area.name', name: 'area.name', title: 'Area Name' },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                    title: 'Image',
                    render: function(data, type, row) {
                        // Adjust the image path and size as needed
                        return '<img src="' + data + '" alt="Image" style="width: 100px; height: auto;">';
                    }
                },
                { data: 'amount', name: 'amount', title: 'Amount' },
                { data: 'type', name: 'type', title: 'Type' },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        var buttonText = row.status == 'Active' ? '<i class="fa fa-check"></i> Active' : '<i class="fa fa-times"></i> Inactive';
                        var buttonClass = row.status == 'Active' ? 'btn-success' : 'btn-danger';
                        return '<button class="btn btn-sm toggle-status ' + buttonClass + '" data-id="' + row.id + '">' + buttonText + '</button>';
                    },
                    orderable: false,
                    searchable: false,
                    title: 'Status'
                },
                { data: 'created_at', name: 'created_at', title: 'Created at' }
            ],
            "order": [
                [5, 'desc']
            ]
        });

        $('#filterButton').click(function() {
            $('#example2').DataTable().ajax.reload();
        });

        $('#example2').on('click', '.toggle-status', function() {
            var rowId = $(this).data('id');
            var currentStatus = $(this).text().trim();

            $.ajax({
                url: '{{ route("ticket.change.status") }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: rowId
                },
                success: function(response) {
                    $('#example2').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                }
            });
        });
    });

    // Grid item selection logic
    $(document).ready(function() {
        $('.grid-item').on('click', function() {
            // Remove 'selected' class from all items
               var id = $(this).data('id');
            $('.grid-item').removeClass('selected');

            // Add 'selected' class to the clicked item
            $(this).addClass('selected');

            // Update URL based on clicked item's ID
             if (id) {
            var newUrl = `/ticket-list/${id}`;
            window.history.pushState({ path: newUrl }, '', newUrl);
        }
            
        });
    });
    
// document.addEventListener('DOMContentLoaded', function() {
//     const modal = document.getElementById('imageModal');
//     const modalImageContainer = document.getElementById('modalImageContainer');
//     const modalMessage = document.getElementById('modalMessage');
//     const closeBtn = document.querySelector('.close');

//     document.querySelectorAll('.grid-item').forEach(item => {
//         item.addEventListener('click', function() {
//             const ticketId = this.getAttribute('data-ticket-id');

//             fetch(`/ticket/image/${ticketId}`)
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.image_url) {
//                         modalImageContainer.innerHTML = `<img src="${data.image_url}" alt="Ticket Image" />`;
//                         modalMessage.style.display = 'none';
//                     } else {
//                         modalImageContainer.innerHTML = '';
//                         modalMessage.style.display = 'block';
//                     }
//                     modal.style.display = 'block';
//                 })
//                 .catch(error => {
//                     console.error('Error fetching image:', error);
//                     modalMessage.style.display = 'block';
//                     modalImageContainer.innerHTML = '';
//                     modal.style.display = 'block';
//                 });
//         });
//     });

//     closeBtn.addEventListener('click', function() {
//         modal.style.display = 'none';
//     });

//     window.addEventListener('click', function(event) {
//         if (event.target === modal) {
//             modal.style.display = 'none';
//         }
//     });
// });

// });
$(document).ready(function() {
  $('.grid-item').on('click', function() {
    var number = $(this).data('number');
 
    // var imageId = $(this).data('image_id');
     console.log("The number is: " + number); // For debugging


    $.ajax({
      
      url: '/ticket-list/filter/', 
      method: 'GET',
      success: function(response) {
        //   console.log(response);
        if (response.imageStatus === 'Image found') {
            // console.log(if (response.imageStatus === 'Image found'));
          $('#modalImage').attr('src', response.imageUrl).show();
          console.log("Image Url"+ response.imageUrl);
          $('#modalMessage').hide(); // Hide any previous message
        } else {
          $('#modalImage').attr('src', '').hide();
          $('#modalMessage').text('Image not found').show(); // Display message
        }
        // Show the modal
        $('#imageModal').modal('show');
      },
      error: function() {
        $('#modalImage').attr('src', '').hide();
        $('#modalMessage').text('Error loading image').show(); 
        // Show the modal
        $('#imageModal').modal('show');
      }
    });
  });
});


</script>


 
@endsection
