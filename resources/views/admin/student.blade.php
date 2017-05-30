@extends('admin.layouts.app')
@section('title')学生管理@endsection
@section('js')
    <script>

    </script>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Page Header
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <table id="table_server" class="table table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>student_num</th>
                <th>name</th>
                <th>id_card_num</th>
                <th>department_class_id</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>id</th>
                <th>student_num</th>
                <th>name</th>
                <th>id_card_num</th>
                <th>department_class_id</th>
            </tr>
            </tfoot>
        </table>
    </section>
    <!-- /.content -->
@endsection