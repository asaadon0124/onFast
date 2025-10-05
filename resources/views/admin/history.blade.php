@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <style>
        @media print {
            .noPrint {
                display: none;
            }
        }


        .main {

            font-size: 18px;

        }


        hr {
            margin-top: 10px;
        }

        td {
            text-align: center;
        }

        .glyphicon-tag {
            font-size: 50px;
        }

    </style>

@endsection

@section('content')
    <br><br>




    {{-- FIRST HEADER  --}}
    <div class="row row-sm noPrint">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                         <a href="{{ route('Dashboard.history') }}" class="btn btn-info">
                            الصفحة الرئسية 
                        </a>
                    </div>

                    <div class="main">
                        <h2><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;الصفــحة الرئيسيــــة</h2>
                        <ul class="breadcrumb">
                            <li><a href="">الصفحـة الرئيسيـة</a> /</li>
                        </ul>
                        <p>أهــــلا بــك : {{ auth()->user()->name }}</p>
                        <hr />
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- SECOUND HEADER--}}
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">الشحنات المتاحة بخط السير</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                        <button href="#" onclick="window.print();" class="btn btn-info btn-lg "
                            style=" margin-top:-1%; margin-right:-81%;">
                            <span class="fa fa-print noPrint	"></span>
                        </button>
                    </div>
                </div>

                <div class="card-body">

                    {{-- START GET FLASH MESSAGES --}}
                    @include('admin.alerts.success')
                    @include('admin.alerts.errors')

                    <div class="row mr-2 ml-2" id="successMsg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                            تم حزف الشحنة من المخزن بنجاح
                        </button>
                    </div>
                    {{-- END GET FLASH MESSAGES --}}

                    @include('admin.dashBoard_data.orderDetailes')



                </div>
            </div>
        </div>
    </div>


   
@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>





    {{-- CHANGE STATUS  1 --}}
    <script>
        $(document).on('click', '.makeStatus', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');
            // var sel_val = document.getElementById("package_status"+itemId).value;
            var sel_val = $(".st_id" + itemId).val();
            // alert(sel_val);

            $.ajax({
                type: 'post',
                url: "{{ route('orders.restoreReturns') }}",
                data: 
                {
                    '_token': "{{ csrf_token() }}",
                    'product_status': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        if (data.status == true) {
                            $('#succes_msg').html(data.msg);
                            // alert(itemId);
                            $('.statusA' + itemId).html(data.status_name);
                            $('#successStatus').show().fadeOut(500);
                            if (data.status_name == 'تم رفضه') 
                            {
                                $('#last_status' + itemId).show().fadIn(500);
                            } else {
                                $('#last_status' + itemId).hide();
                            }

                            if (data.status_name == 'تم التحصيل') 
                            {
                                 $('.pro_row' + itemId).hide();
                                $('.pro_row' + itemId).remove();
                            } 

                        }
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>


    {{-- CHANGE STATUS  2 --}}
    <script>
        $(document).on('click', '.makeStatus', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');
            // var sel_val = document.getElementById("package_status"+itemId).value;
            // var sel_val = $(".st_id"+itemId).val();
            var sel_val = $("#select" + itemId).val();
            // alert(sel_val);

            $.ajax({
                type: 'post',
                url: "{{ route('orders.restoreReturns') }}",
                data: 
                {
                    '_token': "{{ csrf_token() }}",
                    'product_status': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        if (data.status == true) {
                            $('#succes_msg').html(data.msg);
                            // alert(itemId);
                            $('.statusA' + itemId).html(data.status_name);
                            $('#successStatus').show().fadeOut(500);
                            if (data.status_name == 'تم رفضه') {
                                $('#last_status' + itemId).show().fadIn(500);
                            } else {
                                $('#last_status' + itemId).hide();
                            }

                            if (data.status_name == 'تم التحصيل') 
                            {
                                  $('.pro_row' + itemId).hide();
                                $('.pro_row' + itemId).remove();
                            } 
                        }
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>


    {{-- SEARCH --}}
    <script>
        $(document).ready(function() {

            $(document).on('keyup', '#val', function() {
                var query = $(this).val();
                fetch_customer_data(query);

                function fetch_customer_data(query = '') 
                {

                    $.ajax({
                        url: "{{ route('Dashboard.filter') }}",
                        method: 'GET',
                        data: {
                            'filter': query
                        },
                        dataType: 'json',
                        success: function(data) 
                        {
                            if (query != '') {
                                $("#paginate").hide();
                                $("#productRow").hide();
                                // alert(data.table_data);
                                $('#productRow2').show().html(data.table_data);
                            } else {
                                $("#productRow").show();
                                $("#productRow2").hide();
                                $("#paginate").show();
                            }
                        },

                    })
                }
            });
        });
    </script>



    {{-- CHANGE NOTES 1 --}}
    <script>
        $(document).on('click', '.notes', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');

            var sel_val = document.getElementById("notes" + itemId).value;
            // alert(sel_val);

            $.ajax({
                type: 'get',
                url: "{{ route('Dashboard.notes') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'notes': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        $('#successS').html(data.msg);
                        $('#successS').show().fadeOut(500);
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>

    {{-- CHANGE NOTES 2 --}}
    <script>
        $(document).on('click', '.notes2', function(e) {
            e.preventDefault();

            //Get Form Data
            var itemId = $(this).attr('id');

            var sel_val = document.getElementById("notes2" + itemId).value;
            // alert(sel_val);

            $.ajax({
                type: 'get',
                url: "{{ route('Dashboard.notes') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'notes': sel_val,
                    'id': itemId,
                },

                success: function(data) {
                    if (data.status == true) {

                        $('#successS').html(data.msg);
                        $('#successS').show().fadeOut(500);
                    }
                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }

            });
        });
    </script>

	 {{-- SHOW AND HIDE INPUTS  --}}
	 <script>
		$(document).on('change','#filter',function(e)
		{
			var filter = $(this).val();
			// alert(filter);
			if (filter == 'status') 
			{
				$('#staus_input').show();
				$('#filter_input').show();
				$('#search_input').hide();
				$('#city_input').hide();
				$('#gov_input').hide();
				$('#from_input').hide();
				$('#to_input').hide();
				// alert(filter);
			}

			if (filter == 'city') 
			{
				$('#city_input').show();
				$('#gov_input').show();
				$('#filter_input').show();

				$('#staus_input').hide();
				$('#search_input').hide();
				$('#from_input').hide();
				$('#to_input').hide();
				// alert(filter);
			}
			
			if (filter == 'date') 
			{
				$('#filter_input').show();
				$('#from_input').show();
				$('#to_input').show();
				$('#search_input').hide();
				$('#city_input').hide();
				$('#gov_input').hide();
				$('#staus_input').hide();
				// alert(filter);
			}

			if (filter != 'date' &&  filter != 'city' && filter != 'status') 
			{
				$('#filter_input').show();
				$('#from_input').hide();
				$('#to_input').hide();
				$('#search_input').show();
				$('#city_input').hide();
				$('#gov_input').hide();
				$('#staus_input').hide();
				// alert(filter);
			}
			
		});
	</script>

	{{--  GET CITIES  --}}
	<script>

		$(document).ready(function()
		{
			$('#gov').on('change',function()
			{
				var gov = $(this).val();

				if(gov)
				{
					$.ajax(
						{
							url:"{{ url('/admin/orderDetailes/cities/') }}/" + gov,
							type:"GET",
							dataType:"json",
							success:function(data)
							{
								$("#city").empty();
								$.each(data,function(key,value)
								{
									$("#city").append('<option value="'+value.id+'">'+value.name+'</option>')
								});
							}
						});
				}else
				{
					alert('Error');
				}
			});
		});
	</script>



{{-- SEARCH 2  --}}
 {{-- SEARCH --}}
 <script>
    $(document).ready(function() 
    {
    // SEARCH FOR SUPPLIERS AND RESIVERS 
        $(document).on('keyup', '#search', function() 
        {
            var query = $(this).val();
            var type = $('#filter').val();
            // var itemId = $(this).attr('id');
            // alert(type);

            fetch_customer_data(query);

            function fetch_customer_data(query = '') 
            {

                $.ajax({
                    url: "{{ route('Dashboard.filter2') }}",
                    method: 'GET',
                    data: {
                        'filter': query,
                        'type'  : type,
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if (query != '') 
                        {
                            $("#productRow").hide();
                            $("#paginate").hide();
                            // alert(data.table_data);
                            $('#productRow2').show().html(data.table_data);
                            $('#paginate_castom').show();
                        } else 
                        {
                            $("#productRow").show();
                            $("#paginate").show();
                            $("#productRow2").hide();
                            $("#paginate_castom").hide();
                        }
                        // if (query.status_id == 6) 
                        // {
                        //     $('.pro_row' + itemId)
                        // }
                    },

                })
            }
            
        });


    // SEARCH FOR STATUS 
        $(document).on('change', '#status', function() 
        {
            var query = $(this).val();
            var type = $('#filter').val();
            // alert(query);

            fetch_customer_data(query);

            function fetch_customer_data(query = '') 
            {

                $.ajax({
                    url: "{{ route('Dashboard.filter2') }}",
                    method: 'GET',
                    data: {
                        'filter': query,
                        'type'  : type,
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if (query != '') 
                        {
                            $("#productRow").hide();
                            $("#paginate").hide();
                            // alert(data.table_data);
                            $('#productRow2').show().html(data.table_data);
                            $('#paginate_castom').show();
                        } else 
                        {
                            $("#productRow").show();
                            $("#paginate").show();
                            $("#productRow2").hide();
                            $("#paginate_castom").hide();
                        }
                    },

                })
            }
            
        });


    // SEARCH FOR CITY 
        $(document).on('change', '#city', function() 
        {
            var query = $('#city').val();
            var type = $('#filter').val();
            // alert(query);

            fetch_customer_data(query);

            function fetch_customer_data(query = '') 
            {

                $.ajax({
                    url: "{{ route('Dashboard.filter2') }}",
                    method: 'GET',
                    data: {
                        'filter': query,
                        'type'  : type,
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if (query != '') 
                        {
                            $("#productRow").hide();
                            $("#paginate").hide();
                            // alert(data.table_data);
                            $('#productRow2').show().html(data.table_data);
                            $('#paginate_castom').show();
                        } else 
                        {
                            $("#productRow").show();
                            $("#paginate").show();
                            $("#productRow2").hide();
                            $("#paginate_castom").hide();
                        }
                    },

                })
            }
            
        });

        
    // SEARCH FOR DATE 
        $(document).on('change', '#to', function() 
        {
            var query = $('#from').val();
            var query2 = $('#to').val();
            var type = $('#filter').val();
            alert(query2);

            fetch_customer_data(query);

            function fetch_customer_data(query = '') 
            {

                $.ajax({
                    url: "{{ route('Dashboard.filter2') }}",
                    method: 'GET',
                    data: 
                    {
                        'filter': query,
                        'date'  : query2,
                        'type'  : type,
                    },
                    dataType: 'json',
                    success: function(data) 
                    {
                        if (query != '') 
                        {
                            $("#productRow").hide();
                            $("#paginate").hide();
                            // alert(data.table_data);
                            $('#productRow2').show().html(data.table_data);
                            $('#paginate_castom').show();
                        } else 
                        {
                            $("#productRow").show();
                            $("#paginate").show();
                            $("#productRow2").hide();
                            $("#paginate_castom").hide();
                        }
                    },

                })
            }
            
        });
    });
</script>

@endsection
