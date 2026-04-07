@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Compare Revolutions</h1>
    <p class="mt-2 max-w-3xl text-[#374151]">
      Compare industrial revolutions using consistent analytical criteria.
    </p>
  </div>

  {{-- current selection --}}
  <div class="bg-[#F9FAFB] border border-[#D1D5DB] rounded-xl px-4 py-3 text-sm text-[#374151]">
    Comparing:
    <span class="font-semibold text-[#111827]">{{ $left['title'] }}</span>
    and
    <span class="font-semibold text-[#111827]">{{ $right['title'] }}</span>
  </div>

  {{-- selector --}}
  <form id="compareForm" method="GET" action="{{ route('analysis.compare') }}"
        class="bg-white border border-[#D1D5DB] rounded-2xl p-4 flex flex-wrap items-center gap-4">

    {{-- left --}}
    <div class="flex items-center gap-2">
      <span class="text-sm font-medium text-[#374151]">Left</span>
      <select id="leftSelect" name="left" class="rounded-lg border-gray-300">
        @foreach($revolutions as $key => $rev)
          <option value="{{ $key }}" @selected($left['id'] === $rev['id'])>
            {{ $rev['label'] }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- right --}}
    <div class="flex items-center gap-2">
      <span class="text-sm font-medium text-[#374151]">Right</span>
      <select id="rightSelect" name="right" class="rounded-lg border-gray-300">
        @foreach($revolutions as $key => $rev)
          <option value="{{ $key }}" @selected($right['id'] === $rev['id'])>
            {{ $rev['label'] }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- warning --}}
    <div id="compareWarning" class="hidden text-sm text-red-600">
      Please select two different revolutions.
    </div>

    {{-- button --}}
    <button id="compareBtn" type="submit"
      class="ml-auto px-4 py-2 rounded-lg bg-[#111827] text-white text-sm font-medium disabled:opacity-60 disabled:cursor-not-allowed">
      Compare
    </button>
  </form>

  {{-- summary cards --}}
  <div class="grid lg:grid-cols-2 gap-4">

    {{-- left card --}}
    <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
      <h2 class="font-semibold text-[#111827] text-lg">
        {{ $left['label'] }}
      </h2>
      <p class="mt-2 text-sm text-[#374151]">{{ $left['summary'] }}</p>
      <p class="mt-1 text-xs text-[#6B7280]">{{ $left['years'] }}</p>
    </div>

    {{-- right card --}}
    <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
      <h2 class="font-semibold text-[#111827] text-lg">
        {{ $right['label'] }}
      </h2>
      <p class="mt-2 text-sm text-[#374151]">{{ $right['summary'] }}</p>
      <p class="mt-1 text-xs text-[#6B7280]">{{ $right['years'] }}</p>
    </div>

  </div>

  {{-- levelled comparison --}}
  <div class="space-y-4">

    @foreach($categories as $catKey => $catLabel)
      <div class="grid lg:grid-cols-2 gap-4 items-stretch">

        {{-- left section --}}
        <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5 flex flex-col">
          <h3 class="font-semibold text-[#111827] border-b border-[#E5E7EB] pb-2 mb-3">
            {{ $catLabel }}
          </h3>

          <div class="text-sm text-[#374151] leading-relaxed whitespace-pre-line flex-grow">
            {{ $left['content'][$catKey] ?? 'No information available.' }}
          </div>
        </div>

        {{-- right section --}}
        <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5 flex flex-col">
          <h3 class="font-semibold text-[#111827] border-b border-[#E5E7EB] pb-2 mb-3">
            {{ $catLabel }}
          </h3>

          <div class="text-sm text-[#374151] leading-relaxed whitespace-pre-line flex-grow">
            {{ $right['content'][$catKey] ?? 'No information available.' }}
          </div>
        </div>

      </div>
    @endforeach

  </div>
</div>

{{-- compare script --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

  const leftSelect = document.getElementById('leftSelect'); // left dropdown
  const rightSelect = document.getElementById('rightSelect'); // right dropdown
  const warning = document.getElementById('compareWarning'); // duplicate warning
  const button = document.getElementById('compareBtn'); // submit button

  const validate = () => {
    const same = leftSelect.value === rightSelect.value; // same selection
    warning.classList.toggle('hidden', !same); // show or hide warning
    button.disabled = same; // block invalid compare
  };

  document.getElementById('compareForm').addEventListener('submit', (e) => {
    if (leftSelect.value === rightSelect.value) {
      e.preventDefault(); // stop invalid submit
      warning.classList.remove('hidden'); // show warning
      return;
    }

    button.disabled = true; // prevent double click
    button.innerText = 'Loading...'; // loading feedback
  });

  leftSelect.addEventListener('change', validate); // check left change
  rightSelect.addEventListener('change', validate); // check right change

  validate(); // initial check
});
</script>

@endsection