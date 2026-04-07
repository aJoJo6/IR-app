@extends('layouts.app')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">
      What Defines an Industrial Revolution?
    </h1>
    <p class="mt-2 text-[#374151] max-w-3xl">
      This page explains the framework used to interpret whether a period represents an industrial revolution rather than incremental technological change.
    </p>
  </div>

  {{-- grid --}}
  <div class="grid md:grid-cols-2 gap-6">

    @foreach(config('criteria.blocks') as $index => $block)

      {{-- accordion card --}}
      <div class="bg-white border border-[#D1D5DB] rounded-2xl overflow-hidden">

        {{-- header --}}
        <button
          onclick="toggleAccordion({{ $index }})"
          class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-[#111827] hover:bg-[#F9FAFB] focus:outline-none"
        >
          {{ $block['title'] }}

          {{-- icon --}}
          <span id="icon-{{ $index }}" class="text-lg transition-transform">
            +
          </span>
        </button>

        {{-- content --}}
        <div
          id="content-{{ $index }}"
          class="hidden px-5 pb-5 text-sm text-[#374151] space-y-3"
        >
          <p>{{ $block['body'] }}</p>

          {{-- bullets --}}
          <ul class="list-disc pl-5 space-y-1">
            @foreach($block['bullets'] as $bullet)
              <li>{{ $bullet }}</li>
            @endforeach
          </ul>
        </div>

      </div>

    @endforeach

  </div>
</div>

{{-- accordion script --}}
<script>
let openIndex = 0; // default open

function toggleAccordion(index) {
  const content = document.getElementById(`content-${index}`); // selected content
  const icon = document.getElementById(`icon-${index}`); // selected icon

  const isOpen = !content.classList.contains('hidden'); // check state

  // close all
  document.querySelectorAll('[id^="content-"]').forEach(el => el.classList.add('hidden'));
  document.querySelectorAll('[id^="icon-"]').forEach(el => el.innerText = '+');

  // open selected
  if (!isOpen) {
    content.classList.remove('hidden');
    icon.innerText = '−';
  }
}

// init
document.addEventListener('DOMContentLoaded', () => {
  toggleAccordion(0); // open first
});
</script>

@endsection