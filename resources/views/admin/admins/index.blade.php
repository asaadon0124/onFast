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
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">

								
							{{--  START GET FLASH MESSAGES   --}}
								<div class="row mr-2 ml-2" id="successMsg" style="display: none">
									<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
											تم الحزف بنجاح
									</button>
								</div>

								@include('admin.alerts.success')
								@include('admin.alerts.errors')

							{{--  END GET FLASH MESSAGES   --}}
								

					<div class="row mr-2 ml-2" id="successMsg" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم حزف الشحنة من المخزن بنجاح
						</button>
					</div>
					<div class="row mr-2 ml-2" id="successStatus" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم تعديل الحالة بنجاح
						</button>
					</div>

					
				{{--  END GET FLASH MESSAGES   --}}

								@include('admin.admins.create')

								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1" rowID="{{ $admins->count()+1 }}">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0"> رقم</th>
												<th class="wd-15p border-bottom-0">اسم المدير</th>
												<th class="wd-20p border-bottom-0">ايميل المدير </th>
												<th class="wd-15p border-bottom-0">تليفون المدير</th>
												<th class="wd-10p border-bottom-0">الاجرائات</th>
												
											</tr>
										</thead>
										<tbody>
											@if ($admins && $admins->count() > 0)
											@php
												$x = 1;
											@endphp
											@foreach ($admins as $admin)
												<tr class="adminRow{{ $admin->id }}">
													<td>{{ $x++ }}</td>
													<td>{{ $admin->name }}</td>
													<td>{{ $admin->email }}</td>
													<td>{{ $admin->phone }}</td>
													<td>
													<div class="btn-icon-list">
														<a href="{{ route('admins.edit',$admin->id) }}" style="margin-left: 10px">
															<button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
														</a>
														<a href="" class="makeDeleteAdmin" admin_id="{{ $admin->id }}">
															<button class="btn btn-primary btn-icon"><i class="fa fa-trash"></i></button>
														</a>
													</div>
													</td>
												</tr>
											@endforeach
											@else
												<h1>لا يوجد مديرين</h1>
											@endif										
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

				

				
				
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
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



	{{--  CREATE NEW ADMIN   --}}

	<script>
		$(document).on('click','#makeCreateAdmin',function(e)
		{
			e.preventDefault();

			// DELETE ERROR MESSAGE IF INPUT HAVE VALUE WITHOUT REFRESH PAGE
			$('#name_error').text('');
			$('#email_error').text('');
			$('#phone_error').text('');
			$('#password_error').text('');

			//Get Form Data
			var formData = new FormData($('#createAdmin')[0]);  


			$.ajax(
			{
				type: 'post',
				url: "{{route('admins.store')}}",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(data)
				{

					if(data)
					{
						var x =   '{{ url("admin/admins/edit/") }}/'+data.dataa.id;
						var admin_d = $(this).attr('admin_id');
						var rowD = $("table").attr('rowID');

						$("#example1 tbody").append('<tr class="adminRow'+data.dataa.id+'"><td>'+rowD+'</td>'+
							'<td>'+data.dataa.name+'</td>'+
							'<td>'+data.dataa.email+'</td>'+
							'<td>'+data.dataa.phone+'</td>'+
							'<td>'+
								'<div class="btn-icon-list">'+
									'<a href="'+x+'">'+
										'<button class="btn btn-success btn-icon">'+
											'<i class="typcn typcn-document-add"></i>'+
										'</button>'+
									'</a>'+
									'<a admin_id="'+data.dataa.id+'" class="makeDeleteAdmin">'+
										'<button class="btn btn-primary btn-icon">'+
											'<i class="typcn typcn-calendar-outline"></i>'+
										'</button>'+
									'</a>'+
								'</div>'+
							'</td>'+
						'</tr>');
										
						$("#createAdmin")[0].reset();
					}

					if(data.status == true)
					{
						
						if(data.status == true)
						{
							$('#succes_msg').show().fadeOut(2500);
							$('#succes_msg').show().fadeOut(2500);
							setTimeout(function(){
								$('#modaldemo8').modal('hide')
							}, 3000);

							
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

	


	{{--  DELETE ADMIN   --}}
	<script>
		$(document).on('click','.makeDeleteAdmin',function(e)
		{
			e.preventDefault();

			

			//Get Form Data
			var formData2 = new FormData($('#deleteAdmin')[0]);           
			var admin_id = $(this).attr('admin_id');
			$.ajax(
			{
				type: 'post',
				url: "{{route('admins.destroy')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
             		'id'     : admin_id
				},
				
				success: function(data)
				{
					if(data.status == true)
					{
						
						if(data.status == true)
						{
							$('#successMsg').show().fadeOut(2500);
						}
						  // DELETE ROW FROM TABLE
						  $('.adminRow'+data.id).remove();
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
		$("#flashMessages").fadeOut(3000);
	</script>
@endsection