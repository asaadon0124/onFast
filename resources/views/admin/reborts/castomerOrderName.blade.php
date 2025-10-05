@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


@endsection

@section('content')
@endsection

@section('js')
	<!-- Internal Data tables -->
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

	<!--Internal  Datatable js -->
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>


	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!-- Internal Select2 js-->
	<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
	<!-- Internal Modal js-->
	<script src="{{URL::asset('assets/js/modal.js')}}"></script>

{{-- GET TOTAL RECORDES --}}
    <script>
        $(document).ready(function()
        {
            // alert("hello");
            var sum = 0;
            var status_id = $('#total').attr('status_id');
            if (status_id == 1 || status_id == 3 || status_id == 4 || status_id == 7)
            {
                $('.total_price').each(function ()
                {
                    sum =+ 0;
                });
            } else
            {
               $('.total_price').each(function ()
                {
                	sum += Number($(this).html());
                });
            }

            // alert(sum);

            $('#total').val(sum);
        });

    </script>

	 {{--  CHANGE STATUS  --}}
<script>
	$(document).on('click','.makeStatus',function(e)
	{
		e.preventDefault();

		//Get Form Data
		var itemId = $(this).attr('id');
		var sel_val = document.getElementById("package_status"+itemId).value;

		$.ajax(
		{
			type: 'post',
			url: "{{route('orders.restoreReturns')}}",
			data:
			{
				'_token' 			: "{{ csrf_token() }}",
				'product_status' 	: sel_val,
				'id'     			: itemId,
			},

			success: function(data)
			{
				if(data.status == true)
				{

					if(data.status == true)
					{
						$('#succes_msg').html(data.msg);
						$('.statusA'+itemId).html(data.status_name);
						$('#successStatus').show().fadeOut(500);
						if (data.status_name == 'تم رفضه')
						{
							$('#last_status'+itemId).show().fadIn(500);
						}else
						{
							$('#last_status'+itemId).hide();
						}
					}
				}
			},
			error: function(reject)
			{
				var response = $.parseJSON(reject.responseText);
				$.each(response.errors,function(key,val)
				{
				$("#" + key + "_error").text(val[0]);
				});
			}

		});
	});
</script>

<script>
	$('#print').on('click', function()
	{
		$("#logo").show();
		$("#example1_filter").hide();
		$("#example1_length").hide();
		window.print();
	});

</script>
@endsection
