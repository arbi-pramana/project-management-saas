@extends('users.layouts.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active"><a href="#">Help?</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Cara Menggunakan Platform : </h3>
                        <br>
                        <h4>Step 1 - Add Data Master:</h4>
                        <ul>
                            <li>1.1 - Klik menu Data Master</li>
                            <li>1.2 - Klik menu Department, dan tambahkan data department</li>
                            <li>1.3 - Klik menu Employee Type, dan tambahkan data tipe karyawan. ex : permanent, fulltime, part time, contract, dll</li>
                            <li>1.4 - Klik menu Employee, dan tambahkan data karyawan</li>
                        </ul>
                        <br>
                        <h4>Step 2 - Add Data Client:</h4>
                        <ul>
                            <li>2.1 - Klik menu Client, dan tambahkan data client</li>
                        </ul>
                        <br>
                        <h4>Step 3 - Add Project:</h4>
                        <ul>
                            <li>3.1 - Klik menu Project, dan tambahkan data project</li>
                            <li>3.2 - Klik nama project yang baru ditambahkan </li>
                            <ul style="margin-left:20px">
                                <li>3.2.1 - Klik icon Milestone, tambahkan milestone pada project yang dipilih</li>
                                <li>3.2.2 - Klik icon Task, tambahkan untuk menambahkan task pada project yang dipilih</li>
                                <li>3.2.3 - Klik icon Income, tambahkan income yang masuk saat project berjalan</li>
                                <li>3.2.4 - Klik icon Expense, tambahkan expense yang keluar saat project berjalan</li>
                            </ul>
                        </ul>
                        <br>
                        <h4>Step 4 - Dashboard:</h4>
                        <ul>
                            <li>Setelah Anda melakukan step 1 - 3, Anda bisa melihat reportnya secara <b>Realtime</b> <br>
                                Seperti : <b>Executive Dashboard, Resources Dashboard,</b> dan <b>Project Detail Dashboard</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop