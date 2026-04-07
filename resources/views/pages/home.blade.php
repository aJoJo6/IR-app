@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- hero --}}
  <div class="bg-white border border-[#D1D5DB] rounded-2xl p-6 text-[#111827]">

    {{-- title --}}
    <h1 class="text-2xl font-semibold">
      Industrial Revolutions (IR1.0–IR5.0)
    </h1>

    {{-- description --}}
    <p class="mt-2 max-w-3xl text-[#374151]">
      Educational tool for exploring and comparing industrial revolutions
      using consistent criteria derived from a systematic literature review.
    </p>

    {{-- actions --}}
    <div class="mt-4 flex flex-wrap gap-3">

      <a
        href="{{ route('revolutions.index') }}"
        class="px-4 py-2 rounded-lg bg-[#111827] text-white text-sm font-medium
               hover:bg-[#1F2937] transition"
      >
        Explore
      </a>

      <a
        href="{{ route('analysis.compare') }}"
        class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-sm font-medium
               hover:border-[#9CA3AF] hover:bg-[#F9FAFB] transition"
      >
        Compare
      </a>

    </div>

  </div>

</div>
@endsection