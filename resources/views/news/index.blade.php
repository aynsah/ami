@extends('layouts.app')

@push('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/donation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alms.css') }}">

<style type="text/css">
  body{
    background-color: #fff;
  }
</style>
@endpush

@section('content')
<div class="mobile-filter-button">
  <div type="button" class="filter-btn btn-success text-light mid-content" data-toggle="modal" data-target="#exampleModalLong" onclick="call_filter_form()">
    <i class="fa fa-search"></i>
  </div>
</div>

<section class="fundraising">
  <div class="row campaign-row">

    <div class="col-12">
      <!-- <div class="content-box invitation">
        <div class="content-box bg-success text-white">
          <div class="row">
            <div class="col-12">
              <h4 class="content-title">Mari Berdonasi</h4>
              <p class="text-justify"> Donasi yang diberikan akan diberikan sesuai dengan Campaign yang dipilih melalui pihak Amal Madani Indonesia
                  dan setiap donasi akan dikelola dengan sebaik-baiknya  </p>
            </div>
            <div class="col-12 mid-content mt-2">
              <div class="btn main-btn bg-light text-success">
                <b>Tentang Donasi</b>
              </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="content-box search-on-desktop">
        <form>
          <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend2"><i class="fa fa-search"></i></span>
            </div>
              <input type="text" id="searchFilter" name="search-filter" class="form-control" placeholder="Cari Artikel">
            </div>
          </div>
        </form>
      </div>

      <div class="content-box discover-campaign-box" style="padding-right:0">
        <div class="discover-campaign">
          <div class="row full-width">
          @foreach($news as $news)
            <div class="col-12 mid-content">
                <a href="{{ url('/berita/'.$news->id) }}">
                    <div class="campaign-box row">
                        <div class="campaign-image-box col-6">
                        <img class="campaign-image" src="{{ asset($news->image_cover) }}">
                        </div>
                        <div class="campaign-info col-6">
                        <b class="campaign-title text-success">{{ $news->title }}</b><br>
                        <p class="campaign-category"> {!! substr($news->body,0,120).'...' !!}</p>
                        <div>
                            <span class="campaign-progress" style="float: left;"> <span class="content-desc"> Dibuat Tanggal </span><br> {{ $news->created_at }}</span>
                        </div>
                        </div>
                        <br>
                    </div>
                </a>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
<script src="{{ asset('js/mdb.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/donation.js') }}"></script>
<script type="text/javascript">

  function call_filter_form(){
    $('#modal-include').html(`@include('layouts.modal.filter.filter-news')`)
  }

  function filter_click(name = null, created_at = null){
    urlParams = new URL(window.location.href).searchParams

    name     = name != null ? name : urlParams.get('search-filter')
    created_at = created_at != null ? created_at : urlParams.get('created_at')

    window.location = "/news?search-filter=" + name + "&created_at=" + created_at 
  }
</script>
@endpush
