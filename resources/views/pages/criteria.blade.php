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

  {{-- empty state --}}
  @if($criteriaBlocks->isEmpty())
    <div class="bg-white border border-[#D1D5DB] rounded-2xl p-6">
      <p class="text-[#374151] font-medium">No criteria available yet.</p>
    </div>
  @else

    {{-- grid --}}
    <div class="grid md:grid-cols-2 gap-6">
      @foreach($criteriaBlocks as $index => $block)

        {{-- accordion card --}}
        <div class="bg-white border border-[#D1D5DB] rounded-2xl overflow-hidden">

          {{-- header --}}
          <button
            onclick="toggleAccordion({{ $index }})"
            class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-[#111827] hover:bg-[#F9FAFB] focus:outline-none"
          >
            {{ $block->title }}

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
            <p class="whitespace-pre-line">{{ $block->description }}</p>
          </div>

        </div>

      @endforeach
    </div>

  @endif
</div>

{{-- accordion script --}}
<script>
function toggleAccordion(index) { // toggle accordion by index
  const content = document.getElementById(`content-${index}`); // get content element
  const icon = document.getElementById(`icon-${index}`); // get icon element
  const isOpen = !content.classList.contains('hidden'); // check if open

  document.querySelectorAll('[id^="content-"]').forEach(el => el.classList.add('hidden')); // hide all content
  document.querySelectorAll('[id^="icon-"]').forEach(el => el.innerText = '+'); // reset all icons

  if (!isOpen) { // if not already open
    content.classList.remove('hidden'); // show selected content
    icon.innerText = '−'; // set icon to minus
  }
}

document.addEventListener('DOMContentLoaded', () => { // run when page loads
  @if($criteriaBlocks->isNotEmpty()) // check if data exists
    toggleAccordion(0); // open first item
  @endif
});
</script>

@endsection