@extends('layouts.app', ['title' => 'Grade Report'])

@push('js')
<script>
$(document).on('keydown', 'input[pattern]', function(e){
  var input = $(this);
  var oldVal = input.val();
  var regex = new RegExp(input.attr('pattern'), 'g');

  setTimeout(function(){
    var newVal = input.val();
    if(!regex.test(newVal)){
      input.val(oldVal);
    }
  }, 0);
});
</script>
@endpush

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                      <div class="row align-items-center">
                          <div class="col">
                              <h2>Alteration of Grades</h2>
                              <p class="text-muted text-sm">
                                  {{ $sclass->getCourse() }}
                              </p>
                          </div>
                          <div class="col text-right">
                              <a href="/grades/{{ $sclass->class_id }}" class="btn btn-sm btn-secondary">Return</a>
                          </div>
                      </div>
                    </div>

                    <form id="form-post" method="POST" action="{{ action('GradeController@update', $sclass->class_id) }}">
                    @csrf
                    @method('PUT')

                    <input name="class_id" type="text" value="{{ $sclass->class_id }}" style="display:none">

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">Student No.</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center" style="min-width:125px">Prelims</th>
                                    <th scope="col" class="text-center" style="min-width:125px">Midterms</th>
                                    <th scope="col" class="text-center" style="min-width:125px">Finals</th>
                                    <th scope="col" class="text-center">Is INC?</th>
                                    <th scope="col" class="text-center" style="min-width:200px">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $id = 0; ?>
                              @foreach ($grades as $grade)
                                <input name="grade_id[]" type="text" value="{{ $grade->grade_id }}" style="display:none">
                                <tr>
                                    <td class="text-center" scope="row">
                                      {{ $grade->student->getStudentNo() }}
                                      <input name="id[]" type="text" value="{{ $id }}" style="display:none;">
                                    </td>
                                    <td>{{ $grade->student->user->getName() }}</td>
                                    <td class="text-center">
                                      <input name="prelims[]" class="form-control mb-3" type="text" placeholder="e.g. 85.00" pattern="^\d{0,2}(\.\d{0,2})?$" value="{{ $grade->prelims }}">
                                    </td>
                                    <td class="text-center">
                                      <input name="midterms[]" class="form-control mb-3" type="text" placeholder="e.g. 85.00" pattern="^\d{0,2}(\.\d{0,2})?$" value="{{ $grade->midterms }}">
                                    </td>
                                    <td class="text-center">
                                      <input name="finals[]" class="form-control mb-3" type="text" placeholder="e.g. 85.00" pattern="^\d{0,2}(\.\d{0,2})?$" value="{{ $grade->finals }}">
                                    </td>
                                    <td class="text-center">
                                      <label class="custom-toggle">
                                        <input name="is_inc[{{$id}}]" type="checkbox" {{ $grade->is_inc ? 'checked' : '' }}>
                                        <span class="custom-toggle-slider rounded-circle"></span>
                                      </label>
                                    </td>
                                    <td>
                                      @if($grade->is_inc)
                                        <input name="note[]" class="form-control mb-3" type="text" placeholder="Enter note" value="{{ $grade->note }}" required>
                                      @else
                                        <input name="note[]" type="text" style="display:none">
                                      @endif
                                    </td>
                                </tr>
                                <?php $id++ ?>
                              @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-info">
                          <span class="btn-inner--icon"><i class="ni ni-single-copy-04"></i></span>
                          <span class="btn-inner--text">Save Changes</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="javascript:history.back()">Cancel</button>
                    </div>

                    </form>

                </div>
            </div>
        </div>

      @include('layouts.footers.auth')
    </div>
@endsection