

    

@extends('admin.layouts.master')

@section('css')
@endsection

@section('content')
<br><br>

<!-- Modal effects -->
   
                {{--  SUCCESS MESSAGE   --}}
                <div class="row mr-2 ml-2" id="succes_msg" style="display: none">
                    <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                            تم الحفظ بنجاح
                    </button>
                </div>

                {{--  ERROR MESSAGE   --}}
                <div class="row mr-2 ml-2" id="error_msg" style="display: none">
                    <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2">
                            هناك خطا ما برجاء المحاولة فيما بعد
                    </button>
                </div>
                
                <div class="row">
					<div class="col-lg-12 col-md-12">
					<form  class="parsley-style-1" method="post" action="{{ route('suppliers.store') }}" novalidate="">
                                    @csrf

                                    <div class="row">
                                        

                                            {{--  NAME   --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">اسم المورد</label>
                                                    <input type="text" name="name" class="form-control" placeholder="ادخل اسم المورد">
                                                   
                                                        <span class="text-danger" id="name_error"></span>
                                                </div>
                                            </div>

                                            {{--  PHONE   --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">تليفون المورد</label>
                                                    <input type="number" name="phone" class="form-control" placeholder="ادخل تليفون المورد">
                                                   
                                                        <span class="text-danger" id="phone_error"></span>
                                                </div>
                                            </div>

                                            {{--  PHONE 2  --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">تليفون المورد</label>
                                                    <input type="number" name="phone2" class="form-control" placeholder="   ادخل تليفون اخر (اختياري)">
                                                </div>
                                            </div>
                                           

                                            {{--  GOVERNORATE_ID   --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">اسم المحافظة</label>
                                                    
                                                    <select  class="form-control" id="gov">
                                                        <option value="">اختار محافظة</option>
                                                        @foreach ($governorates as $gov)
                                                            <option value="{{ $gov->id }}">
                                                                {{ $gov->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                           

                                           {{-- CITY ID  --}}
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">اختار المدينة</label>
                                                    <select class="search_form_select form-control" name="city_id" id="city">
                                                        <option disabled selected>Select City</option>
                                                
                                                    </select>
                                                    <span class="text-danger" id="city_id_error"></span>
                                                </div> 
                                            </div>

                                            {{--  ADRESS   --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">عنوان المورد</label>
                                                    <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المورد">
                                                   
                                                    <span class="text-danger" id="adress_error"></span>
                                                </div>
                                            </div>
                                        
                                    </div>

                                      
								
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" id="makeCreateSupplier" type="submit">اضافة مورد</button>
									</div>
								</form>
					</div>
				</div>
<!-- End Modal effects-->

@endsection

@section('js')
 <script>
      $('#gov').on('change',function()
                    {
                        var gov = $(this).val();

                        if(gov)
                        {
                            $.ajax(
                                {
                                    url:"{{ url('/admin/suppliers/cities/') }}/" + gov,
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
                        }
                    });
 </script>
@endsection






