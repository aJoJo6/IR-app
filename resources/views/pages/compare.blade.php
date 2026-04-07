@extends('layouts.app')

@section('content')
<div class="space-y-6">

  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Compare Revolutions</h1>
    <p class="mt-2 max-w-3xl text-[#374151]">
      Choose two industrial revolutions and compare them using consistent analytical criteria.
    </p>
  </div>

  <div class="bg-[#F9FAFB] border border-[#D1D5DB] rounded-xl px-4 py-3 text-sm text-[#374151]">
    Currently comparing:
    <span class="font-semibold text-[#111827]">{{ $left['title'] }}</span>
    and
    <span class="font-semibold text-[#111827]">{{ $right['title'] }}</span>
  </div>

  @if(count($summary))
    <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
      <h2 class="font-semibold text-[#111827]">Comparison Summary</h2>
      <p class="mt-2 text-sm text-[#374151]">
        The following categories differ between the selected revolutions.
      </p>

      <ul class="mt-3 space-y-2 text-sm text-[#374151]">
        @foreach($summary as $item)
          <li class="border border-[#E5E7EB] rounded-lg px-3 py-2 bg-[#F9FAFB]">
            <span class="font-semibold text-[#111827]">{{ $item['label'] }}</span>
            shows a distinction between
            <span class="font-medium">{{ $item['left'] }}</span>
            and
            <span class="font-medium">{{ $item['right'] }}</span>.
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="compareForm" method="GET" action="{{ url('/compare') }}"
        class="bg-white border border-[#D1D5DB] rounded-2xl p-4 flex flex-wrap items-center gap-4">

    <div class="flex items-center gap-2">
      <span class="text-sm text-[#374151] font-medium">Left</span>
      <select id="leftSelect" name="left" class="rounded-lg border-gray-300">
        @foreach($revolutions as $key => $rev)
          <option value="{{ $key }}" @selected($left['id'] === $rev['id'])>
            {{ $rev['title'] }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="flex items-center gap-2">
      <span class="text-sm text-[#374151] font-medium">Right</span>
      <select id="rightSelect" name="right" class="rounded-lg border-gray-300">
        @foreach($revolutions as $key => $rev)
          <option value="{{ $key }}" @selected($right['id'] === $rev['id'])>
            {{ $rev['title'] }}
          </option>
        @endforeach
      </select>
    </div>

    <label class="flex items-center gap-2 text-sm text-[#374151]">
      <input type="checkbox" name="diff" value="1" class="rounded border-gray-300" @checked($diff)>
      Highlight differences
    </label>

    <div id="compareWarning" class="hidden text-sm text-red-600">
      Please choose two different industrial revolutions.
    </div>

    <button id="compareBtn" type="submit"
      class="ml-auto px-4 py-2 rounded-lg bg-[#111827] text-white text-sm font-medium disabled:opacity-60 disabled:cursor-not-allowed">
      Compare
    </button>
  </form>

  <div class="grid lg:grid-cols-2 gap-4">

    <div class="space-y-4">
      <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
        <h2 class="font-semibold text-[#111827]">
          {{ $left['title'] }}
          <span class="text-sm text-[#6B7280]">({{ $left['label'] }})</span>
        </h2>
        <p class="mt-2 text-sm text-[#374151]">{{ $left['summary'] }}</p>
        <p class="mt-1 text-xs text-[#6B7280]">{{ $left['years'] }}</p>
      </div>

      @foreach($categories as $catKey => $catLabel)
        @php
          $leftText = $left['content'][$catKey] ?? 'No information available for this category.';
          $rightText = $right['content'][$catKey] ?? 'No information available for this category.';
          $isDifferent = trim($leftText) !== trim($rightText);
          $sectionClass = ($diff && $isDifferent)
            ? 'bg-yellow-50 border-yellow-300'
            : 'bg-white border-[#D1D5DB]';
        @endphp

        <section class="border rounded-2xl p-5 {{ $sectionClass }}">
          <div class="flex items-center justify-between gap-3">
            <h3 class="font-semibold text-[#111827]">{{ $catLabel }}</h3>

            @if($diff && $isDifferent)
              <span class="text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                Different
              </span>
            @endif
          </div>

          <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
            {{ $leftText }}
          </p>
        </section>
      @endforeach
    </div>

    <div class="space-y-4">
      <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
        <h2 class="font-semibold text-[#111827]">
          {{ $right['title'] }}
          <span class="text-sm text-[#6B7280]">({{ $right['label'] }})</span>
        </h2>
        <p class="mt-2 text-sm text-[#374151]">{{ $right['summary'] }}</p>
        <p class="mt-1 text-xs text-[#6B7280]">{{ $right['years'] }}</p>
      </div>

      @foreach($categories as $catKey => $catLabel)
        @php
          $leftText = $left['content'][$catKey] ?? 'No information available for this category.';
          $rightText = $right['content'][$catKey] ?? 'No information available for this category.';
          $isDifferent = trim($leftText) !== trim($rightText);
          $sectionClass = ($diff && $isDifferent)
            ? 'bg-yellow-50 border-yellow-300'
            : 'bg-white border-[#D1D5DB]';
        @endphp

        <section class="border rounded-2xl p-5 {{ $sectionClass }}">
          <div class="flex items-center justify-between gap-3">
            <h3 class="font-semibold text-[#111827]">{{ $catLabel }}</h3>

            @if($diff && $isDifferent)
              <span class="text-xs font-medium px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                Different
              </span>
            @endif
          </div>

          <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
            {{ $rightText }}
          </p>
        </section>
      @endforeach
    </div>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('compareForm');
  const leftSelect = document.getElementById('leftSelect');
  const rightSelect = document.getElementById('rightSelect');
  const warning = document.getElementById('compareWarning');
  const button = document.getElementById('compareBtn');

  const validateSelections = () => {
    const same = leftSelect.value === rightSelect.value;
    warning.classList.toggle('hidden', !same);
    button.disabled = same;
  };

  form.addEventListener('submit', (e) => {
    if (leftSelect.value === rightSelect.value) {
      e.preventDefault();
      warning.classList.remove('hidden');
      return;
    }

    button.disabled = true;
    button.innerText = 'Loading...';
  });

  leftSelect.addEventListener('change', validateSelections);
  rightSelect.addEventListener('change', validateSelections);

  validateSelections();
});
</script>
@endsection