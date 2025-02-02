@extends('layouts.app', ['title' => 'Manage Curriculum'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-body">
                      <h2>Edit Course</h2>
                      <hr>
                      <form id="form-post" method="POST" action="{{ action('CourseController@update', $course->course_code) }}">
                          @csrf
                          @method('PUT')

                          <div class="row">
                            <div class="col-12 col-lg-3 col-md-6">
                                <label class="form-control-label" for="course_code">Course Code</label>
                                <input id="course_code" name="course_code" class="form-control mb-3" type="text" placeholder="e.g. IT121" value="{{ $course->course_code}}" required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-lg-6 col-md-12">
                              <label class="form-control-label" for="description">Description</label>
                              <input id="description" name="description" class="form-control mb-3" type="text" placeholder="e.g. Web Development" value="{{ $course->description}}" required>
                          </div>
                          </div>

                          <div class="row">
                            <div class="col-12 col-lg-3 col-md-6">
                                <label class="form-control-label" for="units">Units</label>
                                <input id="units" name="units" class="form-control mb-3" type="number" placeholder="e.g. 3" min="1" value="{{ $course->units }}" required>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                              <label class="form-control-label" for="lab_units">Lab Units (optional)</label>
                              <input id="lab_units" name="lab_units" class="form-control mb-3" type="number" min="1" placeholder="e.g. 3" value="{{ $course->units}}">
                              <span class="text-muted text-sm">Note: Leave blank if none</span>
                            </div>
                          </div>

                          <div class="row mt-5">
                              <div class="col-12 col-lg-12">
                                <button type="submit" class="btn btn-outline-info">
                                  <span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span>
                                  <span class="btn-inner--text">Update Course</span>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="javascript:history.back()">Cancel</button>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>

      @include('layouts.footers.auth')
    </div>
@endsection