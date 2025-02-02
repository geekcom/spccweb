@extends('layouts.app', ['title' => 'Grade Report'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

      <div class="row mt-5">
        <div class="col-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-body row align-items-center">
              <div class="col">
                <h2 class="mb-0">
                  {{ $sclass->getCourse() }}
                </h2>
                <p class="text-muted text-sm">{{ $degree }}</p>

                @if(count($grades) > 0)
                <div class="row">
                  <div class="col">
                    <a href="/grades" class="btn btn-outline-secondary btn-sm">
                      Return
                    </a>
                  </div>
                </div>
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          @if(count($grades) > 0)
            <div class="nav-wrapper">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-class-info-tab" data-toggle="tab" href="#tabs-class-info" role="tab" aria-controls="tabs-class-info" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>Class Information</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-grades-tab" data-toggle="tab" href="#tabs-grades" role="tab" aria-controls="tabs-grades" aria-selected="true"><i class="ni ni-bell-55 mr-2"></i>Students' Grades</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link mb-sm-3 mb-md-0" id="tabs-som-tab" data-toggle="tab" href="#tabs-som" role="tab" aria-controls="tabs-som" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Summary of Grades</a>
                  </li>
              </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="gradesTab">

                        <!-- Class Information Tab -->
                        <div class="tab-pane fade" id="tabs-class-info" role="tabpanel" aria-labelledby="tabs-class-info-tab">
                          <dl class="row text-sm">
                            <dt class="col-sm-5">
                                Academic Term:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->acadTerm->getAcadTerm() }}
                            </dd>
                            <dt class="col-sm-5">
                                Instructor:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->instructor->user->getNameWithTitle() }}
                            </dd>
                            <dt class="col-sm-5">
                                Credits:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->course->getCredits() }}
                            </dd>
                            <dt class="col-sm-5">
                                Schedule (Lec):
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->getLecSchedule() }}
                            </dd>
                            @if($sclass->course->lab_units > 0)
                            <dt class="col-sm-5">
                                Schedule (Lab):
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->getLabSchedule() }}
                            </dd>
                            @endif
                            @if($sclass->room != null)
                            <dt class="col-sm-5">
                                Room:
                            </dt>
                            <dd class="col-sm-7">
                                {{ $sclass->room }}
                            </dd>
                            @endif
                          </dl>
                          @role('admin')

                          <hr class="my-4" />

                          <h3>Alteration of Grades</h3>
                          <p class="description">
                            Alteration of grades should only be done in case of emergency where the faculty is unable to alter the submitted grades. In these cases, the OIC or Admin may alter it.
                          </p>

                          <a href="/grades/{{ $sclass->class_id }}/edit" class="btn btn-outline-warning btn-md">
                              Alter Grades
                          </a>

                          <hr class="my-4" />

                          <h3>Locking of Grades</h3>
                          <p class="description">
                            Locking of grades should be done upon the approval of the OIC in which he/she can unlock the grades temporarily for the faculty. By default, the succeeding period's grades are locked unless the current period's grades has been encoded. In short, if the prelims grades haven't been encoded yet, grades for midterms and finals are temporarily locked.
                          </p>

                          <div class="row mt-3">
                            <div class="col-3 col-md-2">
                              <div class="form-control-label mb-3">
                                  All Grades
                              </div>
                              <label class="custom-toggle">
                                <input type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                            </div>

                            <div class="col-3 col-md-2">
                              <div class="form-control-label mb-3">
                                  Prelims Grade
                              </div>
                              <label class="custom-toggle">
                                <input type="checkbox">
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                            </div>

                            <div class="col-3 col-md-2">
                              <div class="form-control-label mb-3">
                                  Midterms Grade
                              </div>
                              <label class="custom-toggle">
                                <input type="checkbox" checked disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                            </div>

                            <div class="col-3 col-md-2">
                              <div class="form-control-label mb-3">
                                  Finals Grade
                              </div>
                              <label class="custom-toggle">
                                <input type="checkbox" checked disabled>
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                            </div>
                          </div>

                          <div class="row mt-2">
                              <div class="col-12 col-lg-12">
                                <button type="submit" class="btn btn-outline-warning">
                                  <span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span>
                                  <span class="btn-inner--text">Save Changes</span>
                                </button>
                              </div>
                          </div>
                          @endrole

                        </div>
                        <!-- end Class Information Tab -->

                        <!-- Students' Grades Tab -->
                        <div class="tab-pane fade show active" id="tabs-grades" role="tabpanel" aria-labelledby="tabs-grades-tab">
                          <div class="table-responsive row">
                              <table class="table align-items-center table-flush">
                                  <thead class="thead-light">
                                      <tr>
                                          <th scope="col" class="text-center">Student No.</th>
                                          <th scope="col" class="text-center">Name</th>
                                          <th scope="col" class="text-center">Prelims</th>
                                          <th scope="col" class="text-center">Midterms</th>
                                          <th scope="col" class="text-center">Finals</th>
                                          <th scope="col" class="text-center">Average</th>
                                          <th scope="col" class="text-center">Grade</th>
                                          <th scope="col" class="text-center">Completion</th>
                                          <th scope="col" class="text-center">Remarks</th>
                                          <th scope="col" class="text-center">Note</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($grades as $grade)
                                      <tr>
                                          <td class="text-center" scope="row">
                                            {{ $grade->student->getStudentNo() }}
                                          </td>
                                          <td>{{ $grade->student->user->getName() }}</td>
                                          <td class="text-center">{{ $grade->prelims }}</td>
                                          <td class="text-center">{{ $grade->midterms }}</td>
                                          <td class="text-center">{{ $grade->finals }}</td>
                                          <td class="text-center">{{ $grade->getAverage() }}</td>
                                          <td class="text-center">{{ $grade->getGrade() }}</td>
                                          <td class="text-center">{{ $grade->getCompletion() }}</td>
                                          <td class="text-center">
                                            @if($grade->getRemarks() == 'PASSED')
                                              <span class="badge badge-dot mr-4">
                                                <i class="bg-success"></i> {{ $grade->getRemarks() }}
                                              </span>
                                            @elseif($grade->getRemarks() == 'INCOMPLETE')
                                              <span class="badge badge-dot mr-4">
                                                <i class="bg-warning"></i> {{ $grade->getRemarks() }}
                                              </span>
                                            @elseif($grade->getRemarks() == 'FAILED')
                                              <span class="badge badge-dot mr-4">
                                                <i class="bg-danger"></i> {{ $grade->getRemarks() }}
                                              </span>
                                            @endif
                                          </td>
                                          <td class="text-center">
                                            {{ $grade->note }}
                                          </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                              </table>
                          </div>

                          <div class="row mt-4">
                            <div class="col-12">
                                {{ $grades->links() }}
                            </div>
                          </div>
                        </div>
                        <!-- end Students' Grades Tab -->

                        <!-- Summary of Grades Tab -->
                        <div class="tab-pane fade" id="tabs-som" role="tabpanel" aria-labelledby="tabs-som-tab">
                            <dl class="row text-sm">
                              <dt class="col-4 col-lg-2">
                                  Prelims Grades
                              </dt>
                              <dd class="col-8 col-lg-10">
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/prelims" class="btn btn-outline-secondary btn-sm">
                                  Upload
                                </a>
                                @endrole
                                @if($sclass->sog_prelims != null)
                                <a href="/summary_grades/{{ $sclass->class_id }}/prelims/download" class="btn btn-outline-primary btn-sm">
                                  Download
                                </a>
                                <a href="/summary_grades/{{ $sclass->class_id }}/prelims/view" class="btn btn-outline-info btn-sm">
                                  View & Print
                                </a>
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/prelims/remove" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this file?')">
                                  Remove
                                </a>
                                @endrole
                                <span>{{ $sclass->getSOGPrelims() }}</span>
                                @else
                                  <span>N/A</span>
                                @endif
                              </dd>

                              <dt class="col-4 col-lg-2 mt-2">
                                  Midterms Grades
                              </dt>
                              <dd class="col-8 col-lg-10 mt-2">
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/midterms" class="btn btn-outline-secondary btn-sm">
                                  Upload
                                </a>
                                @endrole
                                @if($sclass->sog_midterms != null)
                                <a href="/summary_grades/{{ $sclass->class_id }}/midterms/download" class="btn btn-outline-primary btn-sm">
                                  Download
                                </a>
                                <a href="/summary_grades/{{ $sclass->class_id }}/midterms/view" class="btn btn-outline-info btn-sm">
                                  View & Print
                                </a>
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/midterms/remove" class="btn btn-outline-danger btn-sm">
                                  Remove
                                </a>
                                @endrole
                                <span>{{ $sclass->getSOGMidterms() }}</span>
                                @else
                                  <span>N/A</span>
                                @endif
                              </dd>

                              <dt class="col-4 col-lg-2 mt-2">
                                  Finals Grades
                              </dt>
                              <dd class="col-8 col-lg-10 mt-2">
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/finals" class="btn btn-outline-secondary btn-sm">
                                  Upload
                                </a>
                                @endrole
                                @if($sclass->sog_finals != null)
                                <a href="/summary_grades/{{ $sclass->class_id }}/finals/download" class="btn btn-outline-primary btn-sm">
                                  Download
                                </a>
                                <a href="/summary_grades/{{ $sclass->class_id }}/finals/view" class="btn btn-outline-info btn-sm">
                                  View & Print
                                </a>
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/finals/remove" class="btn btn-outline-danger btn-sm">
                                  Remove
                                </a>
                                @endrole
                                <span>{{ $sclass->getSOGFinals() }}</span>
                                @else
                                  <span>N/A</span>
                                @endif
                              </dd>

                              <dt class="col-4 col-lg-2 mt-2">
                                  Average Grades
                              </dt>
                              <dd class="col-8 col-lg-10 mt-2">
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/average" class="btn btn-outline-secondary btn-sm">
                                  Upload
                                </a>
                                @endrole
                                @if($sclass->sog_average != null)
                                <a href="/summary_grades/{{ $sclass->class_id }}/average/download" class="btn btn-outline-primary btn-sm">
                                  Download
                                </a>
                                <a href="/summary_grades/{{ $sclass->class_id }}/average/view" class="btn btn-outline-info btn-sm">
                                  View & Print
                                </a>
                                @role('admin')
                                <a href="/summary_grades/{{ $sclass->class_id }}/average/remove" class="btn btn-outline-danger btn-sm">
                                  Remove
                                </a>
                                @endrole
                                <span>{{$sclass->getSOGAverage()}}</span>
                                @else
                                  <span>N/A</span>
                                @endif
                              </dd>
                            </dl>
                        </div>
                        <!-- end Summary of Grades Tab -->
                    </div>
                </div>
            </div>
          @else
            <div class="row mt-2">
              <div class="col-xl-12 mb-5 mb-xl-0">
                  <div class="card shadow">
                    <div class="card-body row mt-3 mb-5">
                        <div class="col text-center">
                            <p class="lead">No Students Enrolled</p>
                            <br>
                            <a href="/grades" class="btn btn-primary btn-lg">Return</a>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
          @endif
        </div>
      </div>

      @include('layouts.footers.auth')
    </div>
@endsection