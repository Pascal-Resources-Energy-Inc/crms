@extends('layouts.app')

@section('content')
<div class="mb-3">
<a href="#"  target='_blank'>
    <img
      src="{{asset('images.png')}}"
      class="light-logo"
      alt="Logo-Dark"
      style='width:178px;height:40px;'
    />
   
  </a>
</div>
<h2 class="mb-6 fs-8 fw-bolder">Welcome</h2>
{{-- <p class="text-dark fs-4 mb-7">Your Admin Dashboard</p> --}}

<form method="POST" action="{{ route('login') }}">
    @csrf
  <div class="mb-7">
    <label
      for="email"
      class="form-label text-dark fw-bold"
      >Email</label
    >
    <input
      type="email"
      class="control form-control{{ $errors->has('email') ? ' is-invalid' : '' }} py-6" name="email" value="{{ old('email') }}" required autofocus"
      id="email"
      aria-describedby="Email"
    />

   
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div>
  <div class="mb-9">
    <label
      for="exampleInputPassword1"
      class="form-label text-dark fw-bold"
      >Password</label
    >
    <input
      type="password" name='password'
      class="form-control py-6"
      id="exampleInputPassword1" required
    />
    @if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
@endif
  </div>
  <div
    class="d-flex align-items-center justify-content-between mb-7 pb-1"
  >

    <a
      class="text-primary fw-medium fs-3 fw-bold"
    href="{{ route('password.request') }}"
      >Forgot Password ?</a
    >
  </div>
  <button
    type='submit'
    class="btn btn-primary w-100 mb-7 rounded-pill"
    >Sign In</button>

</form>
@endsection
