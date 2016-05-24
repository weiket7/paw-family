<?php use App\Models\Enums\SubscribeStat; ?>

@extends('template')

@section('content')
  <div class="page_content_offset">
    <div class="container">
      <div class="row clearfix">
        <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
          <h2 class="tt_uppercase color_dark m_bottom_20">Register</h2>

          <form method="post" action="{{url("register")}}">
            {{csrf_field()}}

            @include('register-form')
          </form>
        </section>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("#name").focus();
    });
  </script>
@endsection