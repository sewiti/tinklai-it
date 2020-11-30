@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Visi darbai</div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <table class="table">
            <thead>
              <tr>
                <th style="width: 20%;" class="text-nowrap">Data ir laikas</th>
                <th style="width: 20%;">Darbuotojas</th>
                <th style="width: 20%;">Problema</th>
                <th style="width: 20%;">Statusas</th>
                <th style="width: 20%;">Peržiūra</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($problems as $problem)
              <tr class="{{
                  $problem->status=='finished' ? 'table-default' :
                  ($problem->status=='in_progress' ? 'table-info' :
                  (strtotime("now") - strtotime($problem->created_at) >= 7200 ? 'table-danger' : 'table-warning'))
                }}">

                <td style="width: 20%;" class="align-middle">
                  {{ $problem->created_at->format('Y-m-d H:i') }}
                </td>

                <td style="width: 20%;" class="align-middle">
                  @include('helpers.user', ['user' => $problem, 'noType' => true])
                </td>

                <td style="width: 20%;" class="align-middle">{{ $problem->title }}</td>

                <td style="width: 20%;" class="align-middle">

                  @include('helpers.status', ['status' => $problem->status])
                </td>

                <td style="width: 20%;" class="align-middle">
                  <a class="btn btn-outline-dark" href="{{ route('admin.show', ['problemId' => $problem->id]) }}" role="button">
                    Peržiūrėti
                  </a>
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="4" style="width: 100%;" class="align-middle text-center alert alert-light">
                  Darbų nėra.
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>

          {{ $problems->links() }}
        </div>
      </div>


    </div>
  </div>
</div>
@endsection
