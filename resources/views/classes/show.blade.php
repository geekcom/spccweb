@extends('layouts.app', ['title' => 'Class Scheduling'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

      <div class="row mt-5">
        <div class="col-12 col-lg-5 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-body row align-items-center">
              <div class="col">
                <h2 class="mb-0">
                  {{ $sclass->getCourse() }}
                </h2>
                <p class="text-muted text-sm">{{ $degree }}</p>

                <hr class="my-4" />

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
                      <a href="/faculties/{{ $sclass->instructor->user->id }}">
                        {{ $sclass->instructor->user->getNameWithTitle() }}
                      </a>
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

                <hr class="my-4" />

                <div class="row">
                  <div class="col">
                    <a href="/classes" class="btn btn-outline-secondary btn-sm">
                      Return
                    </a>
                    @role('admin')
                    <a href="/classes/{{ $sclass->class_id }}/edit" class="btn btn-outline-info btn-sm">
                      Edit Class
                    </a>

                    <form action="{{ action('SClassController@destroy', $sclass->class_id) }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirm('Are you sure you want to dissolve the {{ $sclass->getCourse() }} class?') ? this.parentElement.submit() : ''">
                            Dissolve Class
                        </button>
                    </form>
                    @endrole
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-7 mb-5 mb-xl-0">
          <div class="card shadow">
          @if(count($grades) > 0)
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Students Enrolled</h3>
                    </div>
                    @role('admin')
                    <div class="col text-right">
                      <a href="/classes/enroll_students/{{ $sclass->class_id}}" class="btn btn-sm btn-primary">
                          Enroll Student
                        </a>
                    </div>
                    @endrole
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="text-center">Student No.</th>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Credited Curriculum</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($grades as $grade)
                        <tr>
                            <td class="text-left" scope="row">

                              <form action="{{ action('GradeController@destroy', $grade->grade_id) }}" method="post" style="display:inline">
                                  @csrf
                                  @method('DELETE')

                              <button type="button" class="btn btn-outline-warning btn-sm" onclick="confirm('Are you sure you want to drop {{ $grade->student->user->getName() }} in {{ $sclass->course_code }} class?') ? this.parentElement.submit() : ''">
                                      Drop
                                  </button>
                              </form>
                            </td>
                            <td class="text-center">
                              <a href="/students/{{ $grade->student->user->id }}">
                                {{ $grade->student->student_no }}
                              </a>
                            </td>
                            <td>{{ $grade->student->user->getName() }}</td>
                            <td class="text-center">
                              <a href="/curriculums/{{ $grade->curriculumDetails->curriculum_id }}">
                                {{ $grade->curriculumDetails->curriculum_id }} {{ $grade->curriculumDetails->course->course_code}}
                              </a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $grades->links() }}
            </div>
          @else
            <div class="row mt-3 mb-5">
                <div class="col text-center">
                    <p class="lead">No Enrolled Students</p>
                    <br>
                    @role('admin')
                    <div class="col">
                      <a href="/classes/enroll_students/{{ $sclass->class_id}}" class="btn btn-lg btn-primary">
                          Enroll Student
                        </a>
                    </div>
                    @endrole
                </div>
            </div>
          @endif
          </div>
        </div>
      </div>

      @include('layouts.footers.auth')
    </div>
@endsection