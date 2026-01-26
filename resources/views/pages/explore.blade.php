@extends('layouts.app')

@section('content')
<div class="space-y-6">
  {{-- Page header --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Explore Revolutions</h1>
    <p class="mt-2 text-[#374151]">
      Select an industrial revolution.
    </p>
  </div>

  {{-- Cards --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($revolutions as $id => $r)
      <a
        href="{{ route('revolutions.show', $id) }}"
        class="block bg-white border border-[#D1D5DB] rounded-2xl p-5
               hover:shadow-sm transition"
      >
        <div class="flex items-baseline justify-between">
          <span class="text-sm font-semibold text-[#111827]">
            {{ $r['label'] }}
          </span>
          <span class="text-xs text-[#6B7280]">
            {{ $r['years'] }}
          </span>
        </div>

        <h2 class="mt-2 font-semibold text-[#111827]">
          {{ $r['title'] }}
        </h2>

        <p class="mt-2 text-sm text-[#374151]">
          {{ $r['summary'] }}
        </p>
      </a>
    @endforeach
  </div>
</div>
@endsection
