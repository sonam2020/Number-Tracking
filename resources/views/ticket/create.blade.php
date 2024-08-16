@extends('layouts.master')

@section('title', 'Number Tracking | Ticket')

@section('head')
    @include('partials.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        .slider img {
            height: 300px;
            cursor: pointer;
        }

        .slick-slide {
            outline: none;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            height: 40px;
            width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background-color: #0056b3;
        }

        .slick-prev:before,
        .slick-next:before {
           font-size: 30px;
             /*background-color: #0056b3;*/
            /*box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);*/
        }
         .slick-prev:focus,
        .slick-next:focus {
             background-color: #007bff;
                z-index: 1;
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
             transition: background-color 0.3s ease;
        }

        .selected {
            border: 3px solid red;
         /*box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);*/
        }
    </style>
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
<!--cc-->
@section('maincontent')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slider">
                                       @foreach ($imagesdata as $i)
                                            <div>
                                                <img class="img-fluid" src="{{ asset('storage/' . $i->image) }}"
                                                    alt="Photo" data-image-id="{{ $i->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:white">
                            <h3 class="card-title mt-2" style="color:black">Generate Ticket</h3>
                            <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#numberModal">Add Numbers</button>
                        </div>
                        <!--model-->
                        <div class="modal fade" id="numberModal" tabindex="-1" role="dialog" aria-labelledby="numberModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="numberModalLabel">Enter Dot Separated Numbers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="numberForm">
                                            <div class="form-group">
                                                <label for="numbersInput">Numbers</label>
                                                <input type="text" class="form-control" id="numbersInput" placeholder="e.g., 2.4#5,6*8">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="submitNumbers"data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--chat-->

                        {{-- <form action="{{ $actionurl }}" method="post" > --}}
                            <form action="{{ $actionurl }}" method="post" id="sbmt">
                            @csrf
                            <div class="card">
                                <div class="card-body">

                                    <div id="ticket_container">
                                        <div id="ticket_row">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="area[]" required>
                                                            <option value="">Select Area</option>
                                                            @if (isset($area))
                                                                @foreach ($area as $a)
                                                                    <option value="{{ $a->id }}">{{ $a->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Number</label>
                                                        <input type="number" class="form-control" name="number[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Amount</label>
                                                        <input type="number" class="form-control" name="amount[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio1_0" name="direction[0]" value="1"
                                                                required>
                                                            <label for="customRadio1_0"
                                                                class="custom-control-label">Normal</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio2_0" name="direction[0]" value="2"
                                                                required>
                                                            <label for="customRadio2_0"
                                                                class="custom-control-label">In</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio3_0" name="direction[0]" value="3"
                                                                required>
                                                            <label for="customRadio3_0"
                                                                class="custom-control-label">Out</label>
                                                        </div>
                                                        <div class="custom-control custom-radio cut"
                                                            style="float: left; margin-right: 35px;">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio4_0" name="direction[0]" value="4"
                                                                required>
                                                            <label for="customRadio4_0"
                                                                class="custom-control-label">Cut</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mix"
                                                            style="display: none;">
                                                            <input class="custom-control-input" type="checkbox"
                                                                id="customCheckbox0" name="mix[0]" value="5">
                                                            <label for="customCheckbox0"
                                                                class="custom-control-label">Mix</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="">&nbsp;</label>
                                                        <button type="button"
                                                            class="form-control btn btn-primary addmorebtn"><i
                                                                class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row aa">
                                        <div class="col-12" style="text-align: end;">
                                            <input type="hidden" id="selectedImage" name="selectedImage"
                                                value="">
                                            {{-- <button type="submit"  class="btn btn-primary"><i
                                                    class="fa fa-save"></i> Submit</button> --}}
                                                    <button type="submit" id="submitFormBtn" class="btn btn-primary"><i
                                                        class="fa fa-save"></i> Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection


@section('scripts')
    @include('partials.scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
@extends('layouts.master')

@section('title', 'Number Tracking | Ticket')

@section('head')
    @include('partials.head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        .slider img {
            height: 120px;
            cursor: pointer;
        }

        .slick-slide {
            outline: none;
        }

        .slick-prev,
        .slick-next {
            z-index: 1;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            height: 40px;
            width: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slick-prev:hover,
        .slick-next:hover {
            background-color: #0056b3;
        }

        .slick-prev:before,
        .slick-next:before {
            font-size: 30px;
        }

        .selected {
            border: 3px solid red;
        }
    </style>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slider">
                                        @foreach ($imagesdata as $i)
                                            <div>
                                                <img class="img-fluid" src="{{ asset('storage/' . $i->image) }}"
                                                    alt="Photo" data-image-id="{{ $i->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header" style="background-color:white">
                            <h3 class="card-title mt-2" style="color:black">Generate Ticket</h3>
                            <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#numberModal">Add Numbers</button>
                        </div>
                        <!--model-->
                        <div class="modal fade" id="numberModal" tabindex="-1" role="dialog" aria-labelledby="numberModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="numberModalLabel">Enter Dot Separated Numbers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="numberForm">
                                            <div class="form-group">
                                                <label for="numbersInput">Numbers</label>
                                                <input type="text" class="form-control" id="numbersInput" placeholder="e.g., 2.4#5,6*8">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="submitNumbers"data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <form action="{{ $actionurl }}" method="post" > --}}
                            <form action="{{ $actionurl }}" method="post" id="sbmt">
                            @csrf
                            <div class="card">
                                <div class="card-body">

                                    <div id="ticket_container">
                                        <div id="ticket_row">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="area[]">
                                                            <option value="">Select Area</option>
                                                            @if (isset($area))
                                                                @foreach ($area as $a)
                                                                    <option value="{{ $a->id }}">{{ $a->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Number</label>
                                                        <input type="number" class="form-control" name="number[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">Amount</label>
                                                        <input type="number" class="form-control" name="amount[]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio1_0" name="direction[0]" value="1"
                                                                required>
                                                            <label for="customRadio1_0"
                                                                class="custom-control-label">Normal</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio2_0" name="direction[0]" value="2"
                                                                required>
                                                            <label for="customRadio2_0"
                                                                class="custom-control-label">In</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio3_0" name="direction[0]" value="3"
                                                                required>
                                                            <label for="customRadio3_0"
                                                                class="custom-control-label">Out</label>
                                                        </div>
                                                        <div class="custom-control custom-radio cut"
                                                            style="float: left; margin-right: 35px;">
                                                            <input class="custom-control-input" type="radio"
                                                                id="customRadio4_0" name="direction[0]" value="4"
                                                                required>
                                                            <label for="customRadio4_0"
                                                                class="custom-control-label">Cut</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox mix"
                                                            style="display: none;">
                                                            <input class="custom-control-input" type="checkbox"
                                                                id="customCheckbox0" name="mix[0]" value="5">
                                                            <label for="customCheckbox0"
                                                                class="custom-control-label">Mix</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="">&nbsp;</label>
                                                        <button type="button"
                                                            class="form-control btn btn-primary addmorebtn"><i
                                                                class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row aa">
                                        <div class="col-12" style="text-align: end;">
                                            <input type="hidden" id="selectedImage" name="selectedImage"
                                                value="">
                                            {{-- <button type="submit"  class="btn btn-primary"><i
                                                    class="fa fa-save"></i> Submit</button> --}}
                                                    <button type="submit" id="submitFormBtn" class="btn btn-primary"><i
                                                        class="fa fa-save"></i> Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection


@section('scripts')
    @include('partials.scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
     <script>

$(document).ready(function() {
    // Initialize Slick slider
    $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        infinite: true,
        prevArrow: '<button type="button" class="slick-prev">‹</button>',
        nextArrow: '<button type="button" class="slick-next">›</button>'
    });

    // Handle image selection
    $('.slider img').on('click', function(event) {
        event.preventDefault();
        $('.slider img').removeClass('selected');
        $(this).addClass('selected');
        $('#selectedImage').val($(this).data('image-id'));
    });

    var rowIndex = 1;

    // Add more rows
    $('#ticket_container').on('click', '.addmorebtn', function() {
        var templateRow = $('#ticket_row .row:first');
        
        // Check if the template row exists
        if (templateRow.length > 0) {
            var newRow = templateRow.clone();
            console.log(newRow.length);  // Should log the length of the cloned row
            newRow.find('input').val('');
            newRow.find('select').val('');

            newRow.find('input[type="checkbox"]').each(function(index) {
                var newCheckboxId = 'customCheckbox_' + rowIndex + '_' + index;
                console.log(newCheckboxId);
                var newCheckboxName = 'mix[' + rowIndex + ']';
                $(this).attr('id', newCheckboxId);
                $(this).attr('name', newCheckboxName);
                $(this).val(1);
            });

            newRow.find('input[type="radio"]').each(function(index) {
                var newRadioId = 'customRadio' + (index + 1) + '_' + rowIndex;
                var newRadioName = 'direction[' + rowIndex + ']';
                var radioValues = ['1', '2', '3', '4']; 
                $(this).attr('id', newRadioId);
                $(this).attr('name', newRadioName);
                $(this).val(radioValues[index]);
                $(this).prop('checked', index === 0); // Default to "Normal" selected
                $(this).next('label').attr('for', newRadioId);
            });

            newRow.find('input[type="number"]').each(function(index) {
                var newInputId = 'input_' + rowIndex + '_' + index;
                console.log(newInputId);
                $(this).attr('id', newInputId);
            });

            $('#ticket_container').append(newRow).append('<br>');
            rowIndex++;

            updateLastRowButton();
        } else {
            // If no template row is found, create a new row with default content
            var newRowHtml = `
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Area</label>
                            <select class="form-control select2bs4" style="width: 100%;" name="area[]" required="">
                                <option value="">Select Area</option>
                                <option value="1">Deshawar</option>
                                <option value="2">Faridabad</option>
                                <option value="10">DMD</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Number</label>
                            <input type="number" class="form-control" name="number[]" required="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="number" class="form-control" name="amount[]" required="">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1_${rowIndex}" name="direction[${rowIndex}]" value="1" checked required="">
                                <label for="customRadio1_${rowIndex}" class="custom-control-label">Normal</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2_${rowIndex}" name="direction[${rowIndex}]" value="2" required="">
                                <label for="customRadio2_${rowIndex}" class="custom-control-label">In</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio3_${rowIndex}" name="direction[${rowIndex}]" value="3" required="">
                                <label for="customRadio3_${rowIndex}" class="custom-control-label">Out</label>
                            </div>
                            <div class="custom-control custom-radio cut" style="float: left; margin-right: 35px;">
                                <input class="custom-control-input" type="radio" id="customRadio4_${rowIndex}" name="direction[${rowIndex}]" value="4" required="">
                                <label for="customRadio4_${rowIndex}" class="custom-control-label">Cut</label>
                            </div>
                            <div class="custom-control custom-checkbox mix" style="display: none;">
                                <input class="custom-control-input" type="checkbox" id="customCheckbox_${rowIndex}" name="mix[${rowIndex}]" value="5">
                                <label for="customCheckbox_${rowIndex}" class="custom-control-label">Mix</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <button type="button" class="form-control btn btn-primary addmorebtn bg-primary"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            `;

            $('#ticket_container').append(newRowHtml).append('<br>');
            rowIndex++;

            updateLastRowButton();
        }
    });

    // Remove rows
    $('#ticket_container').on('click', '.deletebtn', function() {
        $(this).closest('.row').next('br').remove();
        $(this).closest('.row').remove();
        updateLastRowButton();
    });

    // Toggle mix checkbox visibility
    $('#ticket_container').on('change', 'input[type="radio"]', function() {
        var mixCheckbox = $(this).closest('.row').find('.mix');
        if ($(this).val() === '4') {
            mixCheckbox.show();
        } else {
            mixCheckbox.hide();
        }
    });

    $('#ticket_row .row:first').find('.mix').hide();
    $('#ticket_row .row:first').find('input[type="radio"]').first().prop('checked', true); // Default "Normal" selected

    // Submit form via AJAX
    $('#sbmt').submit(function(event) {
        event.preventDefault();

        var im = $('#selectedImage').val();
        if (im == "") {
            Swal.fire({
                title: 'Warning!',
                text: 'Please Choose an image!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return false;
        }

        var formData = new FormData($('#sbmt')[0]);
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Please wait...');

        var listview = "{{ route('ticket.list') }}";
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Add More',
                    cancelButtonText: 'View List'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#sbmt')[0].reset();
                        $('.slider img').removeClass('selected');
                        $('#selectedImage').val('');
                        $('.mix').hide();
                        // Ensure the default "Normal" radio button is checked
                        $('#ticket_row .row:first').find('input[type="radio"]').first().prop('checked', true);
                    } else {
                        window.location.href = listview;
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while submitting the form.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.html('<i class="fa fa-save"></i> Submit');
            }
        });
    });

    // Show modal
    $('#numberModal').on('show.bs.modal', function () {
        $('#numbersInput').val(''); // Clear the input field when the modal is shown

        // Remove previous keypress event listener to avoid duplicate events
        $(document).off('keypress.modalEnter');

        // Add keypress event listener specific to this modal
        $(document).on('keypress.modalEnter', function(event) {
            if (event.key === 'Enter') {
                var input = $('#numbersInput').val().trim(); // Trim to remove any leading/trailing whitespace
                if (input === '') {
                    event.preventDefault(); // Prevent default Enter key behavior
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please enter numbers before submitting.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });

    $('#submitNumbers').on('click', function() {
        var input = $('#numbersInput').val().trim(); // Trim to remove any leading/trailing whitespace

        // Check if the input is empty
        if (input === '') {
            Swal.fire({
                title: 'Warning!',
                text: 'Please enter numbers before submitting.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return; // Prevent further execution
        }

        // Split input by the '#' delimiter
        var parts = input.split('#');

        // Validate the first part of each section for special characters before '*'
        var firstPartPattern = /^[0-9\s\.,\'\"\-\s]+$/;
        for (var i = 0; i < parts.length; i++) {
            var section = parts[i];
            var firstPart = section.split('*')[0]; // Get the part before '*'
            if (!firstPartPattern.test(firstPart)) {
                Swal.fire({
                    title: 'Invalid Input!',
                    text: 'The part before the asterisk (*) contains invalid characters.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return; 
            }
        }

        // Process the input and add new rows
        for (var i = 0; i < parts.length; i++) {
            console.log("Processing part: " + parts[i]);
            processPart(parts[i]);
        }

        updateLastRowButton();

        // Hide the modal after a short delay
        setTimeout(function() {
            $('#numberModal').modal('hide');
        }, 250);
    });

    $('#numbersInput').on('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById("submitNumbers").click();
        }
    });

    function processPart(part) {
        var sections = part.split('*');
        var numbers = sections[0].split(/[\.,\'\"\-\s]+/);
        var amount = sections[1];

        var createdRows = 0;

        for (var i = 0; i < numbers.length; i++) {
            if (i > 0 || $('#ticket_container .row').length > 1) {
                $('.addmorebtn').click();
            }
            $('#ticket_container .row:last').find('input[name="number[]"]').val(numbers[i]);
            $('#ticket_container .row:last').find('input[name="amount[]"]').val(amount);
            $('#ticket_container .row:last').find('input[type="radio"]').first().prop('checked', true); // Default to "Normal" selected
            createdRows++;
        }

        return createdRows;
    }

    function updateLastRowButton() {
        var rows = $('#ticket_container .row');
        rows.find('.addmorebtn').removeClass('addmorebtn bg-primary').addClass('deletebtn bg-danger').html('<i class="fa fa-times"></i>');
        rows.last().find('.deletebtn').removeClass('deletebtn bg-danger').addClass('addmorebtn bg-primary').html('<i class="fa fa-plus"></i>');
    }
});





 

 
 

 
</script> 

 


@endsection