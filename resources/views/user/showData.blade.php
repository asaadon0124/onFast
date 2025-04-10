@extends(' user.layouts.app')




@section('content')

    <style>
        .card
        {
            margin-top:-5%
        }
        .color
        {
            color: #F7B614;
            font-size: 25px
        }
        .search
        {
            margin-top: 10%
        }
    </style>

    

 {{-- SEARCH FORM  --}}
   <div class="container search" style="width: 50%">
        @if ($type == 'supplier')
            <form id="searchForm">
                <div class="form-group">
                    <input type="text" name="filter" class="form-control" placeholder="بحث برقم الشحنة او اسم العميل او المورد" id="val">
                    <span class="text-danger" id="search_error"></span>
                </div>
                @if ($products && $products->count() > 0)
    
                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $products[0]->supplier->id }}">
    
                @elseif($productCompleted && $productCompleted->count() > 0)
    
                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $productCompleted[0]->product->supplier->id }}">
    
                @elseif($productCompleted && $productCompleted->count() > 0 && $products && $products->count() > 0)
    
                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $productCompleted[0]->product->supplier->id }}">
                @endif
                <input type="submit" value="بحث" id="search" class="form-control btn btn-warning">
    
            </form>
        @else
            <form id="searchForm">
                <div class="form-group">
                    <input type="text" name="filter" class="form-control" placeholder="بحث برقم الشحنة او اسم العميل او المورد" id="val">
                    <span class="text-danger" id="search_error"></span>
                </div>
                @if ($products && $products->count() > 0)

                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $products[0]->id }}">

                @elseif($productCompleted && $productCompleted->count() > 0)

                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $productCompleted[0]->product->id }}">

                @elseif($productCompleted && $productCompleted->count() > 0 && $products && $products->count() > 0)

                    <input type="text" value="{{ $type }}" id="type" class="form-control" typeId="{{ $productCompleted[0]->product->id }}">
                @endif
                <input type="submit" value="بحث" id="search" class="form-control btn btn-warning">

            </form>
        @endif
   </div>


    <div class="container test">
            @if ($products && $products->count() == 0 && $productCompleted && $productCompleted->count() == 0)
                <h2 class="text-center" style="margin-top: 5%">
                    لا يوجد شحنات  
                </h2>
            @else

                {{-- SEARCH RESULTS  --}}
                <div>
                    <div class="row" id="results">
                        
                    </div>
                </div>

                {{-- PRODUCTS WAS STATUS_ID === 1 --}} 
                    @if ($products && $products->count() > 0)
                        <div class="row" id="products">
                            @foreach ($products as $pro)
                        
                                <div  style="margin-top: 10%;" class="col-md-4">
                                    <div class="card">
                                        <div class="card-header text-center" style="font-weight: 600">
                                            <span class="color"> رقم الشحنة </span> <span>: {{ $pro->package_number }}</span>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><span class="color">  حالة الشحنة </span>: {{ $pro->status->name }}</li>
                                            <li class="list-group-item"><span class="color">  اسم المورد </span>: {{ $pro->supplier->name }}</li>
                                            <li class="list-group-item"><span class="color">  اسم المستلم </span>: {{ $pro->resever_name }}</li>
                                            <li class="list-group-item"><span class="color"> تاريخ التوصيل </span>: {{ $pro->rescive_date }}</li>
                                            <li class="list-group-item"><span class="color">قيمة الشحنة </span>: {{ $pro->product_price }}</li>
                                            <li class="list-group-item"><span class="color"> سعر الشحن : </span> {{ $pro->shipping_price }}</li>
                                            <li class="list-group-item"><span class="color">  الاجمالي : </span> {{ $pro->total_price }}</li>
                                            <li class="text-center">
                                                <a href="{{ route('user.packageDetailes',$pro->id) }}" class="btn btn-primary">
                                                    عرض التفاصيل
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            
                            @endforeach
                        </div>
                    @endif


                {{-- PRODUCTS WAS STATUS_ID !== 1 --}}
                    @if ($productCompleted && $productCompleted->count() > 0)
                        <div class="row" id="orderDEtailes">
                            @foreach ($productCompleted as $return)
                                <div  style="margin-top: 10%;" class="col-md-4">
                                    <div class="card">
                                        <div class="card-header text-center" style="font-weight: 600">
                                            <span class="color"> رقم الشحنة </span> : {{ $return->product->package_number }}
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><span class="color">  حالة الشحنة </span>: {{ $return->status->name }}</li>
                                            <li class="list-group-item"><span class="color">  اسم المورد </span>: {{ $return->product->supplier->name }}</li>
                                            <li class="list-group-item"><span class="color">  اسم المستلم </span>: {{ $return->product->resever_name }}</li>
                                            <li class="list-group-item"><span class="color"> تاريخ التوصيل </span>: {{ $return->product->rescive_date }}</li>
                                            <li class="list-group-item"><span class="color">قيمة الشحنة </span>: {{ $return->product->product_price }}</li>
                                            <li class="list-group-item"><span class="color"> سعر الشحن : </span> {{ $return->shipping_price }}</li>
                                            <li class="list-group-item"><span class="color">  الاجمالي : </span> {{ $return->total_price }}</li>
                                            <li class="text-center">
                                                <a href="{{ route('user.packageDetailes',$return->product->id) }}" class="btn btn-primary">
                                                    عرض التفاصيل
                                                </a>
                                            </li>

                                        </ul>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
               
            @endif

            
            {{-- {{ $products->links() }}
            {{ $productCompleted->links() }} --}}
        <br><br>

    </div>





 <br><br><br>


@endsection

@section('js')
 {{-- FILTER FORM  --}}
    <script>
        $(document).on('click','#search',function(e)
        {
            e.preventDefault();
            
            // DELETE ERROR MESSAGE IF INPUT HAVE VALUE WITHOUT REFRESH PAGE
			$('#search_error').text('');

            //Get Form Data
			var formData = new FormData($('#searchForm')[0]);  

            var q       = $('#val').val();
            var type    = $('#type').val(); 
            var typeId    = $('#type').attr('typeId');
            // if (type == 'castomer') 
            // {
                 
            // } else 
            // {
                
            // }
            alert(typeId);
            
            $.ajax(
			{
                url: "{{route('user.filter')}}",
				type: 'GET',
				data: 
                {
                    'filter' : q,
                    'type'   : type,
                    'typeId' : typeId
                },
				
				success: function(data)
                {
                    $("#results").empty();
                    $("#products").hide();
                    $("#orderDEtailes").hide();
                   if (data.dataa && data.dataa.length != 0 && q != '') 
                   {
                        $.each(data.dataa,function(key,value)
                        {
                           if (value.status_id == 1) 
                           {
                            $("#results").append
                                (
                                    '<div style="margin-top:10%" class="col-md-4">'+
                                        '<div class="card">'+
                                            '<div class="card-header text-center" style="font-weight:600">'+
                                                '<span class="color">'+
                                                    'رقم الشحنة :'
                                                +'</span>'
                                                +'<span>'+
                                                    value.package_number+
                                                '</span>'+
                                            '</div>'+
                                            
                                            '<ul class="list-group list-group-flush">'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'حالة الشحنة :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.status.name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'اسم المورد :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.supplier.name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'اسم العميل :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.resever_name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'تاريخ التوصيل :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.rescive_date
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        ' سعر الشحنة :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.product_price
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="text-center">'+
                                                    '<a href="{{ url('/packageDetailes/') }}/'+value.id+'" class="btn btn-warning">'+
                                                        'عرض المزيد'
                                                    +'</a>'+
                                                '</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'
                                )
                           } else 
                           {
                            $("#results").append
                                (
                                    '<div style="margin-top:10%" class="col-md-4">'+
                                        '<div class="card">'+
                                            '<div class="card-header text-center" style="font-weight:600">'+
                                                '<span class="color">'+
                                                    'رقم الشحنة :'
                                                +'</span>'
                                                +'<span>'+
                                                    value.package_number+
                                                '</span>'+
                                            '</div>'+
                                            
                                            '<ul class="list-group list-group-flush">'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'حالة الشحنة :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.status.name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'اسم المورد :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.supplier.name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'اسم العميل :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.resever_name
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        'تاريخ التوصيل :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.rescive_date
                                                    +'</span>'+
                                                '</li>'+

                                                '<li class="list-group-item">'+
                                                    '<span class="color">'+
                                                        ' سعر الشحنة :'
                                                    +'</span>'+
                                                    '<span>'+
                                                        value.product_price
                                                    +'</span>'+
                                                '</li>'+
                                               
                                                '<li class="text-center">'+
                                                    '<a href="{{ url('/packageDetailes/') }}/'+value.id+'" class="btn btn-warning">'+
                                                        'عرض المزيد'
                                                    +'</a>'+
                                                '</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'
                                )
                           }
                        });
                   }else
                   {
                        $("#results").append
                        (
                            '<h2 class="text-center" style="margin-top:20px">'+
                                'لا يوجد شحنات'   
                            +'</h2>'
                        )
                   }
                }
            });
        });
    </script>

 {{-- SHOW ALL DATA IF FILTER INPUT == '' --}}
    <script>
         $(document).on('keyup','#val', function(e)
         {
            e.preventDefault();
            var q = $('#val').val();
            
            if (q == '') 
            {
                $("#results").empty();
                $("#products").show();
                $("#orderDEtailes").show();
            }
         });
    </script>
@endsection



