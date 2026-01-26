@extends('layouts.app')

@section('content')

<div class="space-y-6">
  {{-- Page header --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Compare Revolutions</h1>
    <p class="mt-2 text-[#374151] max-w-3xl">
      Choose two industrial revolutions and compare them using consistent analytical criteria.
    </p>
  </div>

  {{-- Controls --}}
  <form
    class="bg-white border border-[#D1D5DB] rounded-2xl p-5 flex flex-wrap items-end gap-4"
    method="GET"
    action="{{ route('compare') }}"
  >
    <div>
      <label class="text-sm font-medium text-[#111827]">Left</label>
      <select
        name="left"
        class="mt-1 w-64 rounded-lg border-[#9CA3AF] text-[#111827]"
      >
        @foreach($revolutions as $id => $r)
          <option value="{{ $id }}" @selected($left['id'] === $id)>
            {{ $r['label'] }} — {{ $r['title'] }}
          </option>
        @endforeach
      </select>
    </div>

    <div>
      <label class="text-sm font-medium text-[#111827]">Right</label>
      <select
        name="right"
        class="mt-1 w-64 rounded-lg border-[#9CA3AF] text-[#111827]"
      >
        @foreach($revolutions as $id => $r)
          <option value="{{ $id }}" @selected($right['id'] === $id)>
            {{ $r['label'] }} — {{ $r['title'] }}
          </option>
        @endforeach
      </select>
    </div>

    <label class="flex items-center gap-2 text-sm text-[#111827]">
      <input
        type="checkbox"
        id="highlightToggle"
        class="rounded border-[#9CA3AF]"
        checked
      >
      Highlight differences
    </label>

    <button
      class="px-4 py-2 rounded-lg bg-[#111827] text-white hover:bg-[#1F2937] text-sm transition"
    >
      Compare
    </button>
  </form>

  {{-- Comparison results --}}
  <div class="space-y-4">
    @foreach($categories as $key => $label)
      @php
        $a = $left['content'][$key] ?? '—';
        $b = $right['content'][$key] ?? '—';
        $diff = trim($a) !== trim($b);
      @endphp

      <section class="grid lg:grid-cols-2 gap-4">
        <div
          class="bg-white border border-[#D1D5DB] rounded-2xl p-5 compare-cell {{ $diff ? 'is-diff' : '' }}"
        >
          <h3 class="font-semibold text-[#111827]">{{ $label }}</h3>
          <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
            {{ $a }}
          </p>
        </div>

        <div
          class="bg-white border border-[#D1D5DB] rounded-2xl p-5 compare-cell {{ $diff ? 'is-diff' : '' }}"
        >
          <h3 class="font-semibold text-[#111827]">{{ $label }}</h3>
          <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
            {{ $b }}
          </p>
        </div>
      </section>
    @endforeach
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('highlightToggle');
  const cells = document.querySelectorAll('.compare-cell.is-diff');

  const apply = () => {
    cells.forEach(c => {
      c.classList.toggle('ring-2', toggle.checked);
      c.classList.toggle('ring-[#111827]', toggle.checked);
    });
  };

  toggle.addEventListener('change', apply);
  apply();
});
</script>

@endsection
