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
        .invoice-container {
            background: #fff;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            font-family: "Cairo", sans-serif;
        }

        .invoice-header h2 {
            margin-top: 10px;
            font-weight: bold;
        }

        .invoice-info h5 {
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .invoice-table th,
        .invoice-table td {
            background-color: #f8f9fa !important;
            font-weight: bold;
            vertical-align: middle;
        }

        .invoice-table td.notes-cell {
        min-width: 220px;
        max-width: 300px;
    }

    .notes-input-group .form-control {
        border-radius: 0.375rem 0 0 0.375rem;
    }

    .notes-input-group .btn {
        border-radius: 0 0.375rem 0.375rem 0;
    }

        .invoice-total h4 {
            color: #444;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }

        /* CSS خاص بالطباعة */
        @media print {

            /* اخفاء الأزرار أو العناصر اللي مش عايزها في الطباعة */
            .noPrint,
            .sidebar,
            .navbar,
            footer {
                display: none !important;
            }

            /* ضبط مكان الفاتورة بحيث تبقى في النص */
            .invoice-container {
                margin: 0 auto;
                padding: 0;
                width: 100%;
            }

            .invoice-header {
                text-align: center;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* خلى الألوان واللوجو يبانوا كويس */
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background: #fff !important;
            }

            /* التحكم في هوامش الصفحة */
            @page {
                margin: 10mm;
            }
        }
    </style>
@endsection

@section('content')
    <br><br>
    @livewire('admin.reborts.data')
    @livewire('admin.reports.supplier-report-filter')
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

    <script>
        $('#print').on('click', function() {
            $("#logo").show();
            $("#example1_filter").hide();
            $("#example1_length").hide();
            window.print();
        });
    </script>
@endsection
