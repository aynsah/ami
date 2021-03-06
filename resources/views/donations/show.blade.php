@extends('layouts.app')

@push('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('css/donation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alms.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials-theme-flat.css') }}" />
@endpush

@section('content')

<div class="mobile-filter-button">
  <div type="button" class="filter-btn btn-orange text-light mid-content" data-toggle="modal" data-target="#exampleModalLong" onclick="call_donation_list()">
    <i class="fa fa-database"></i>
  </div>
</div>


<div class="text-primary mt-4 mb-4 ml-4">
  <a href="{{ route('index') }}" class="text-primary hovering-link">Home </a> >
  <a href="{{ route('campaigns.front') }}" class="text-primary hovering-link">Campaign </a> >
  <a href="{{ url('/campaign/$campaign->id') }}" class="text-primary hovering-link"> {{ $campaign->title }} </a>
</div>

<section class="campaign-detail">
  <div class="container bg-light">
    <div class="full-width mobile-align-center">
      <input type="hidden" value="{{ $campaign->id }}" id="cid">
      <input type="hidden" value="1" id="uid">
      <div>
        <div class="campaign-info-box">
          <div class="content-box">
            <div class="campaign-info-image">
              <img class="campaign-full-image" src="{{ asset($campaign->image_cover) }}">
            </div>
            <div class="campaign-info-desc mt-4" align="center">
              <h3 style="margin-bottom: 2px"> {{ $campaign->title }}</h3>
              <a href="#" class="text-primary hovering-link"> {{ $campaign->user->name }} </a>
              <div class="content-box no-padd" style="margin-top: 16px;">
                <p class="content-desc">
                    {!! $campaign->short_desc !!}
                </p>
                <span class="content-desc"> Dibuat Tanggal &nbsp; : </span><span class="text-primary"> {{ $campaign->created_at }} </span><br>
                <span class="content-desc"> Sisa Waktu &nbsp; : </span><span class="text-primary"> {{ $campaign->getCampaignDeadline($campaign->deadline) }} </span><br>

                <div class="btn main-btn single-btn btn-orange text-light form" style="margin-top: 16px" data-toggle="modal" data-target="#exampleModalLong" onclick="call_donation_list()">
                  <i class="fa fa-database"></i> &nbsp; Berikan Donasi
                </div>
                <div class="btn main-btn single-btn btn-success-outline text-success form" style="margin-top: 16px;" id="add-wishlist">
                  <i class="fa fa-bookmark"></i> Simpan Campaign
                </div>
              </div>
            </div>
            <div class="campaign-info-setting">
              <div class="content-box no-padd">
                <ul class="menu-list mobile-menu-list text-primary">
                  <li class="show-body" style="border-bottom: 1px solid royalblue">Detail</li>
                  <li class="show-updates" style=""> Update({{ count($updates) }})</li>
                </ul>
              </div>
            </div>
            <div class="campaign-info-detail" align="left">
              <div class="campaign-body">
              {!! $campaign->body !!}
              </div>
              <div class="campaign-updates" style="display:none">
                @if(count($updates) == 0)
                  <div style="width:100%" align=center>
                    <p> Belum ada Pemberitahuan Campaign </p>
                  </div>
                @endif
                @if(Auth::check())
                  @if(Auth::id() == $campaign->user_id)
                    <div class="mobile-full-width mb-3" align="center">
                      <a href="{{ url('campaign/update/'.$campaign->id) }}">
                        <div class="btn main-btn single-btn btn-orange-outline"> Tambahkan Pembaharuan </div>
                      </a>
                    </div>
                  @endif
                @endif
                @if(count($updates) != 0)
                  @foreach($updates as $update)
                    <h5 class="content-title"> {{ $update->title }} </h5>
                    <p class="content-desc"> 
                      <span class="basic-body-{{$update->id}}">
                      {!! substr($update->body, 0, 5) !!} <span onclick="read_more('{{ $update->id }}')" class="text-primary more-{{ $update->id }}"> Lebih banyak </span>
                      </span>
                      <span class="detail-body-{{$update->id}}" style="display:none">
                      {!! substr($update->body, 5, strlen($update->body)) !!} <span onclick="read_more('{{ $update->id }}')" class="text-primary less-{{ $update->id }}"> Sembunyikan </span>
                      </span>
                    </p>
                    <p class="text-primary"> {{ $update->created_at }} </p>
                    <hr>
                  @endforeach
                @endif
              </div>
            </div>

            <div class="campaign-info-footer">
              <p class="text-danger"> Campaign terlihat mencurigakan? </p>
              <a href="{{ url('/campaign/report/'.$campaign->id) }}"><div class="form btn main-btn single-btn btn-success-outline text-success" style="width: 100%">Laporkan Campaign ini</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="mb-3">
  <div class="container">
    <div class="campaign-info-box bg-light">
      <div class="additional-info">
        <div class="campaign-info-share">
          <div class="content-box">
            <div>
              <h5>Bagikan Campaign ini</h5>
              <div id="share"></div>
            </div>
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
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('js/jssocials.min.js') }} "></script>

<script>
  function call_donation_list(){
    $('#modal-include').html(`@include('donations.donation-list')`)
  }

  $("#share").jsSocials({
      shares: ["twitter", "facebook", "whatsapp"]
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function read_more(id){
    element = $('.detail-body-' + id)
    if(element.css('display') == 'none'){
      element.css('display','initial')
      $('.more-' + id).css('display','none')
      $()
    }else{
      element.css('display','none')
      $('.more-' + id).css('display','initial')
    }
  }

  $('.show-body').click(function(){
    $('.show-updates').css('border-bottom','none')
    $('.campaign-updates').hide()
    $(this).css('border-bottom', '1px solid royalblue')
    $('.campaign-body').show()
  })

  $('.show-updates').click(function(){
    $('.show-body').css('border-bottom', 'none')
    $('.campaign-body').hide()
    $(this).css('border-bottom', '1px solid royalblue')
    $('.campaign-updates').show()
  })


  $('#add-wishlist').click(function(){
    $.ajax({
      type:'POST',
      url:'/campaign/save',
      data: {
        'campaign_id' : $('#cid').val(),
        'user_id' : $('#cid').val()
      },
      success:function(data, xhr) {
        alert(data.message)
      }
    })
  })
</script>
@endpush

