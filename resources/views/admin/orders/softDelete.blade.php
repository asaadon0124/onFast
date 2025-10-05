@extends('admin.layouts.master')
@section('css')
    <!-- Internal Data table css -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet"> --}}
    <style>
        nav svg 
        {
            padding: 0.5rem 0.75rem; /* Adjust padding */
            height: 30px;
        }
    </style>


@endsection

@section('content')
    <!-- row opened -->
   <livewire:deliveries-orders />
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
   
   

    <!--Internal  Datatable js -->


    <!--Internal  Datepicker js -->
    {{-- <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script> --}}
    <!-- Internal Select2 js-->
    {{-- <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script> --}}
    <!-- Internal Modal js-->
    {{-- <script src="{{ URL::asset('assets/js/modal.js') }}"></script> --}}





    {{-- DELETE ADMIN --}}
    <script>
        $(document).on('click', '.makeRestoreOrder', function(e) {
            e.preventDefault();



            //Get Form Data
            var order_id = $(this).attr('order_id');

            $.ajax({
                type: 'get',
                url: "{{ route('orders.restore') }}",
                data: {

                    'id': order_id
                },

                success: function(data) {
                    if (data.status == true) {

                        if (data.status == true) {
                            $('#successMsg').show();
                        }

                        // DELETE ROW FROM TABLE
                        $('.orderRow' + data.id).remove();
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
@endsection
