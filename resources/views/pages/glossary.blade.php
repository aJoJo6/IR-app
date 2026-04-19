@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Glossary</h1>
    <p class="mt-2 max-w-3xl text-[#374151]">
      Definitions of key terms.
    </p>
  </div>

  {{-- search --}}
  <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
    <label class="text-sm font-medium text-[#111827]">Search terms</label>

    <input
      id="glossarySearch"
      type="text"
      placeholder="Type to filter…"
      class="mt-2 w-full rounded-lg border-[#9CA3AF] text-[#111827] placeholder:text-[#6B7280]"
      autocomplete="off"
    >

    {{-- result count --}}
    <p id="resultCount" class="text-xs text-[#6B7280] mt-2">
      Showing {{ count($terms) }} terms
    </p>
  </div>

  {{-- glossary list --}}
  <div id="glossaryList" class="grid lg:grid-cols-2 gap-4">
    @foreach($terms as $t)

      {{-- item --}}
      <section class="bg-white border border-[#D1D5DB] rounded-2xl p-5 glossary-item
                      transition transform
                      hover:shadow-sm hover:border-[#9CA3AF] hover:-translate-y-px">

        {{-- term --}}
        <h2 class="font-semibold text-[#111827] glossary-term">
          {{ $t['term'] }}
        </h2>

        {{-- definition --}}
        <p class="mt-2 text-sm text-[#374151] leading-relaxed glossary-def">
          {{ $t['definition'] }}
        </p>

      </section>

    @endforeach
  </div>

  {{-- no results --}}
  <div id="noResults" class="hidden bg-white border border-[#D1D5DB] rounded-2xl p-6">
    <p class="text-[#374151] font-medium">No results found.</p>
    <p class="text-sm text-[#6B7280] mt-1">Try a different keyword or a shorter term.</p>
  </div>

</div>

{{-- search script --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

  const input = document.getElementById('glossarySearch'); // input field
  const items = Array.from(document.querySelectorAll('.glossary-item')); // all items
  const noResults = document.getElementById('noResults'); // empty state
  const resultCount = document.getElementById('resultCount'); // counter

  const normalize = (s) => (s || '').toLowerCase(); // normalize text

  const apply = () => {
    const q = normalize(input.value); // query
    let shown = 0;

    items.forEach(item => {
      const term = normalize(item.querySelector('.glossary-term')?.textContent);
      const def  = normalize(item.querySelector('.glossary-def')?.textContent);

      const match = !q || term.includes(q) || def.includes(q); // match logic

      item.classList.toggle('hidden', !match); // show/hide

      if (match) shown++;
    });

    resultCount.textContent = `Showing ${shown} term${shown === 1 ? '' : 's'}`; // update count
    noResults.classList.toggle('hidden', shown !== 0); // toggle empty state
  };

  input.addEventListener('input', apply); // live filter
  apply(); // initial state

});
</script>
@endsection