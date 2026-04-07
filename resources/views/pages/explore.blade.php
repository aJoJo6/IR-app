@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Explore Revolutions</h1>
    <p class="mt-2 text-[#374151]">
      Select an industrial revolution.
    </p>
  </div>

  {{-- cards --}}
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($revolutions as $id => $r)

      {{-- card --}}
      <a
        href="{{ route('revolutions.show', $id) }}"
        class="block bg-white border border-[#D1D5DB] rounded-2xl p-5
               transition transform
               hover:shadow-sm hover:border-[#9CA3AF] hover:-translate-y-[1px]"
      >

        {{-- header --}}
        <div class="flex items-baseline justify-between">
          <span class="text-sm font-semibold text-[#111827]">
            {{ $r['label'] }}
          </span>
          <span class="text-xs text-[#6B7280]">
            {{ $r['years'] }}
          </span>
        </div>

        {{-- title --}}
        <h2 class="mt-2 font-semibold text-[#111827]">
          {{ $r['title'] }}
        </h2>

        {{-- summary --}}
        <p class="mt-2 text-sm text-[#374151]">
          {{ $r['summary'] }}
        </p>

      </a>
    @endforeach
  </div>

</div>
@endsection