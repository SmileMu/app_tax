@extends('layouts.master')
@section('css')

@section('title')
   جميع المؤسسسات
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
                <h4 class="content-title mb-0 my-auto">جميع المؤسسات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                جميع المؤسسات</span>
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
                        <a class="btn btn-primary btn-sm" href="{{ route('institutions.create') }}" {{$i=0}}>اضافة مؤسسه</a>
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-hover" id="example1" data-page-length='50' style=" text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">  اسم المؤسسه </th>
                                <th class="wd-20p border-bottom-0">تاريخ التاسيس</th>
                                <th class="wd-20p border-bottom-0">نوع المؤسسه</th>
                                <th class="wd-20p border-bottom-0">قطاع المؤسسه</th>
                                <th class="wd-20p border-bottom-0">موقع المؤسسه</th>
                                <th class="wd-20p border-bottom-0">تلفون المؤسسه</th>
                                <th class="wd-20p border-bottom-0">ايميل المؤسسه</th>
                                <th class="wd-20p border-bottom-0">كلمة المرور </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($inistitution as $inistitutions)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $inistitutions->inst_name }}</td>
                                    <td>{{ $inistitutions->found_year }}</td>
                                    <td>{{$inistitutions -> type ? $inistitutions -> type -> type_name : 'بدون' }}</td>
                                    <td>{{$inistitutions -> section ? $inistitutions -> section -> section_type : 'بدون' }}</td>
{{--                                    <td>{{$inistitutions ->type->type_name ?? 'N/A'}}</td>--}}
{{--                                    <td>{{$inistitutions ->section->section_type ?? 'N/A'}}</td>--}}
                                    <td>{{ $inistitutions->location }}</td>
                                    <td>{{ $inistitutions->phone_no }}</td>
                                    <td>{{ $inistitutions->email }}</td>
                                    <td>{{ $inistitutions->password }}</td>
                                    <td>
                                        {{-- @can('تعديل مستخدم') --}}
                                        <a href="{{ route('institutions.edit', $inistitutions->id) }}" class="btn btn-sm btn-info"
                                           title="تعديل"><i class="las la-pen"></i></a>
                                        {{-- @endcan --}}

                                        <a href="{{ route('institutions.delete', $inistitutions->id) }}" class="btn btn-sm btn-info btn btn-sm btn-danger"
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
