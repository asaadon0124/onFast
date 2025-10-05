
@extends('admin.layouts.master')

@section('css')
@endsection

@section('content')


 {{--  SUCCESS MESSAGE   --}}
                <div class="row mr-2 ml-2" id="succes_msg" style="display: none">
                    <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2" id="success">

                    </button>
                </div>

                {{--  ERROR MESSAGE   --}}
                <div class="row mr-2 ml-2" id="error_msg" style="display: none">
                    <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2">
                            هناك خطا ما برجاء المحاولة فيما بعد
                    </button>
                </div>


<!-- Modal effects -->
    
               

               

                <div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="card">
							<div class="card-body">

								<form  class="parsley-style-1" novalidate="" action="{{ route('servants.store') }}" method="post">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">

                                            {{--  NAME   --}}
                                            <div class="form-group">
                                                <label for="">اسم المندوب</label>
                                                <input type="text" name="name" class="form-control" placeholder="ادخل اسم المندوب">

                                                @error("name")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror  
                                            </div>
                                        </div>

                                        {{--  ADRESS   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">عنوان المندوب</label>
                                                <input type="adress" name="adress" class="form-control" placeholder="ادخل عنوان المندوب">
                                                @error("adress")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror  
                                            </div>
                                        </div>

                                        {{--  PHONE   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">رقم التليفون</label>
                                                <input type="number" name="phone" class="form-control" placeholder="ادخل رقم تليفون المدير">
                                                @error("phone")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror  
                                            </div>
                                        </div>

                                        {{--  AGE   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">السن</label>
                                                <input type="number" name="age" class="form-control" placeholder="ادخل سن المندوب">
                                                @error("age")
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror  
                                            </div>
                                        </div>

                                        {{--  PASSWORD   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">كلمة السر</label>
                                                <input type="password" name="password" class="form-control" placeholder="ادخل  كلمة السر">
                                                @error("password")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror  
                                            </div>
                                        </div>
                                    </div>

									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" id="makeCreateServant" type="submit">اضافة مندوب</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
         
<!-- End Modal effects-->

<br>
@endsection

@section('js')

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
						url:"{{ url('/admin/products/cities/') }}/" + gov,
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

@endsection





