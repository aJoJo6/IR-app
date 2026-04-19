@extends('layouts.admin')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center">
  <div class="w-full max-w-lg bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-4">

    {{-- page title --}}
    <div>
      <h1 class="text-2xl font-semibold text-white">Admin Login</h1>
    </div>

    {{-- error message --}}
    @if(session('error'))
      <div class="bg-red-950 border border-red-800 text-red-200 rounded-lg px-4 py-3 text-sm">
        {{ session('error') }}
      </div>
    @endif

    {{-- login form --}}
    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
      @csrf

      {{-- password input --}}
      <div>
        <label for="password" class="block text-sm font-medium text-white">Password</label>
        <input
          id="password"
          type="password"
          name="password"
          placeholder="Enter password"
          class="mt-2 w-full border border-[#404040] rounded-lg px-3 py-2 text-white placeholder:text-[#737373] bg-[#111111]"
          required
        >
      </div>

      {{-- submit button --}}
      <button
        type="submit"
        class="w-full px-4 py-2 rounded-lg bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
      >
        Login
      </button>
    </form>

  </div>
</div>
@endsection