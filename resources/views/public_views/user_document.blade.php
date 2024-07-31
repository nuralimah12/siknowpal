@extends('layouts.base')

@section('title', $user->name.'Document')

@section('custom_css_link', asset('Css/User-Document_style/main.css'))

@section('breadcrumbs')
<div class="breadcrumbs-box mt-1 py-2">
  <div class="page-title mb-1">{{$user->name}} Document</div>
  <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item align-items-center">
        <a href="{{route('home')}}" class="text-decoration-none">Home</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{$user->name}} Document
      </li>
    </ol>
  </nav>
</div>
@endsection

@section('main-content')
<div class="user-document-content">
  <div class="identity-wrapper d-flex mt-3 gap-4 align-items-center">
    <div class="col-md-2 col-3">
      <img src="{{asset('storage/Profile/'.($user->profile_picture ? $user->profile_picture : 'default.png'))}}"
        class="img-avatar img-fluid" />
    </div>
    <div class="identity-box">
      <p class="author fw-semibold ls-b mb-1">{{$user->name}}</p>
      <div class="departement-identity">
        <p class="prody mb-0 ls-s">{{$user->departemen->name}}</p>
        <p class="departement ls-s">{{$user->departemen->divisi->name}}</p>
      </div>
    </div>
  </div>
  <div class="list-thesis-wrapper mt-4">
    <div class="action-wrapper d-lg-flex justify-content-end align-items-baseline">
      <div class="wrappper mt-2 mt-lg-0">
        <form action="{{route('user.document', $user->id)}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control py-2 px-3 search-input border-0" placeholder="Search"
              aria-label="Recipient's username" list="titleListOption" aria-describedby="basic-addon2" name="title" />
            <datalist id="titleListOption" class="titleListOption"> </datalist>
            <button type="submit" class="input-group-text btn btn-primary d-flex align-items-center fs-5 px-3"
              id="basic-addon2">
              <i class="ri-search-line"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="thesis-list-box">
      <div class="pagination-nav mt-3 mb-1">
        <span class="fw-light">Showing page {{$document->currentPage() }} of about {{$document->lastPage()}}
          pages</span>
      </div>
      <div class="thesis-box mt-2 d-flex flex-column gap-2">
        @forelse ($document as $item)
        <div class="thesis-item">
          <a href="{{route('detail.document', $item->id)}}" class="thesis-title text-decoration-none mb-1 fw-semibold">
            {{$item->title}}
          </a>
          <a href="{{route('user.document', $item->id_user)}}" class="d-block text-decoration-none thesis-author mb-1">
            {{$user->username}} - {{$user->departemen->name}}
          </a>
          <p class="thesis-abstract mb-1">
            {{$item->deskripsi}}
          </p>
        </div>
        @empty
        <p class="text-center">Document Not Found</p>
        @endforelse
      </div>
      <div class="pagination-box d-flex mt-2 justify-content-end">
        {{$document->links('pagination::bootstrap-4')}}
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
  let debounce = function (func, wait, immediate) {
     let timeout;
     return function() {
         let context = this, args = arguments;
         let later = function() {
                 timeout = null;
                 if (!immediate) func.apply(context, args);
         };
         let callNow = immediate && !timeout;
         clearTimeout(timeout);
         timeout = setTimeout(later, wait);
         if (callNow) func.apply(context, args);
     };
};

  $('.search-input').on('input', debounce(function (e) {
    let searchInput = e.target.value;

    $.get("{{route('user.document.getSuggestionTitle', $user->id)}}", {
      title : searchInput
    },
      function (data, textStatus, jqXHR) {
        if (data.length !== 0) {
          $('#titleListOption').empty();
        }
        data.forEach(e => {
          $('#titleListOption').append($('<option>', {
            value: e.title
          }));
        }); 4
      },
    );
  }, 500));
</script>
@endpush