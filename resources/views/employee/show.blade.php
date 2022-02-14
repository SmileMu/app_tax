@extends('layouts.master')
@section('css')

@section('title')
    جميع الموظفين
@stop

<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">جميع الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                جميع الموظفين</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-sm-1 col-md-2">
                        {{-- @can('اضافة مستخدم') --}}
                        <a class="btn btn-primary btn-sm" href="{{ route('employees.create') }}" {{$i=0}}>اضافة موظف</a>
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">  اسم الموظف </th>
                                <th class="wd-20p border-bottom-0">تاريخ التعيين</th>
                                <th class="wd-20p border-bottom-0">اسم المؤسسه</th>
                                <th class="wd-20p border-bottom-0">العمر</th>
                                <th class="wd-20p border-bottom-0">المرتب </th>
                                <th class="wd-20p border-bottom-0">قيمة الضريبة </th>
                                <th class="wd-20p border-bottom-0">الايميل </th>
                                <th class="wd-20p border-bottom-0">كلمة المرور </th>
                                <th class="wd-20p border-bottom-0">العمليات </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($employee as $employees)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $employees->emp_name }}</td>
                                    <td>{{ $employees->appation_date }}</td>
                                    <td>{{$employees-> institution ? $employees -> institution -> inst_name : 'بدون' }}</td>


                                    {{--                                    <td>{{$inistitutions ->type->type_name ?? 'N/A'}}</td>--}}
                                    {{--                                    <td>{{$inistitutions ->section->section_type ?? 'N/A'}}</td>--}}
                                    <td>{{ $employees->age }}</td>
                                    <td>{{ $employees->primary_sal }}</td>
                                    <td>{{ $employees->tax_value }}</td>
                                    <td>{{ $employees->email }}</td>
                                    <td>{{ $employees->password }}</td>
                                    <td>
                                        {{-- @can('تعديل مستخدم') --}}
                                        <a href="{{ route('employees.edit', $employees->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"><i class="las la-pen"></i></a>
                                        {{-- @endcan --}}

                                        <a href="{{ route('employees.delete', $employees->id) }}" class="btn btn-sm btn-info btn btn-sm btn-danger"
                                           title="حذف"><i class="las la-trash"></i></a>


                                        {{--                                        --}}{{-- @can('حذف مستخدم') --}}
                                        {{--                                        <a href="{{ route('types.delete', $types->id) }}"--}}
                                        {{--                                           class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"--}}
                                        {{--                                           data-toggle="modal" title="حذف"><i--}}
                                        {{--                                                class="las la-trash"></i></a>--}}
                                        {{--                                        --}}{{-- @endcan --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <!-- Modal effects -->



        <!-- /row -->
    </div>
    <!-- Container closed -->

    <!-- main-content closed -->
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
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>

    <script>
        $('#modaldemo8').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var username = button.data('username')
            var modal = $(this)
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #username').val(username);
        })

    </script>


@endsection
