@include('admin.header',["title"=>$title])
<link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

@include('admin.menu')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Agent Forms</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.agents')}}">Agents</a></li>
                                <li class="breadcrumb-item active">Agent Forms</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$name->name}} Forms</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link mb-2 active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-medicare" role="tab" aria-controls="v-pills-home" aria-selected="true">Medicare Forms</a>
                                        <a class="nav-link mb-2" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-fe" role="tab" aria-controls="v-pills-profile" aria-selected="false">Final Expense Forms</a>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-medicare" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                            <div class="card-body">
                                                <div class="accordion" id="accordionExample">
                                                    <?php $i=1;$j=1; ?>
                                                    @forelse ($medicare_forms as $form)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{$i}}">
                                                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                                                                {{date("M d,Y",strtotime($form->created_at))}}  at {{date("h:i a",strtotime($form->created_at))}}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading{{$i}}" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td></td>
                                                                            <td>{{$form->first_name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td></td>
                                                                            <td>{{$form->last_name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <td></td>
                                                                            <td>{{$form->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Zip Code</th>
                                                                            <td></td>
                                                                            <td>{{$form->zip_code}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Phone</th>
                                                                            <td></td>
                                                                            <td>{{$form->phone}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jornaya Lead ID</th>
                                                                            <td></td>
                                                                            <td>{{$form->jornaya_lead_id}}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $i++ ?>
                                                    @empty
                                                        No Forms Submitted Yet!
                                                    @endforelse
                                                </div><!-- end accordion -->
                                            </div><!-- end card-body -->
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-fe" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                            <div class="card-body">
                                                <div class="accordion" id="accordionExample">
                                                    @forelse ($fe_forms as $form)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading{{$j}}">
                                                            <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$j}}" aria-expanded="true" aria-controls="collapse{{$j}}">
                                                                {{date("M d,Y",strtotime($form->created_at))}}  at {{date("h:i a",strtotime($form->created_at))}}
                                                            </button>
                                                        </h2>
                                                        <div id="collapse{{$j}}" class="accordion-collapse collapse" aria-labelledby="heading{{$j}}" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>First Name</th>
                                                                            <td></td>
                                                                            <td>{{$form->first_name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Last Name</th>
                                                                            <td></td>
                                                                            <td>{{$form->last_name}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Email</th>
                                                                            <td></td>
                                                                            <td>{{$form->email}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Zip Code</th>
                                                                            <td></td>
                                                                            <td>{{$form->zip_code}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Phone</th>
                                                                            <td></td>
                                                                            <td>{{$form->phone}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Jornaya Lead ID</th>
                                                                            <td></td>
                                                                            <td>{{$form->jornaya_lead_id}}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $j++ ?>
                                                    @empty
                                                        No Forms Submitted Yet!
                                                    @endforelse
                                                </div><!-- end accordion -->
                                            </div><!-- end card-body -->
                                        </div>
                                        
                                    </div>
                                </div><!--  end col -->
                            </div><!-- end row -->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
@include('admin.footer')