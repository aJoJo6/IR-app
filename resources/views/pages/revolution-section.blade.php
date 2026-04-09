@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- header --}}
  <div>

    {{-- breadcrumb --}}
    <nav class="text-sm text-[#6B7280]">
      <a href="{{ route('home') }}" class="hover:text-[#111827]">Home</a>
      <span class="mx-1">/</span>
      <a href="{{ route('revolutions.index') }}" class="hover:text-[#111827]">Explore</a>
      <span class="mx-1">/</span>
      <a href="{{ route('revolutions.show', $revolution['id']) }}" class="hover:text-[#111827]">
        {{ $revolution['label'] }}
      </a>
      <span class="mx-1">/</span>
      <span>{{ $sectionTitle }}</span>
    </nav>

    {{-- meta --}}
    <div class="mt-2 text-sm text-[#6B7280]">
      {{ $revolution['label'] }} · {{ $revolution['years'] }}
    </div>

    {{-- title --}}
    <h1 class="mt-1 text-2xl font-semibold text-[#111827]">
      {{ $sectionTitle }}
    </h1>

    {{-- subtitle --}}
    <p class="mt-2 max-w-3xl text-[#374151]">
      {{ $revolution['title'] }}
    </p>
  </div>

  {{-- section image with caption --}}
  @if(!empty($sectionImage))
    <figure class="space-y-2">
      <img
        src="{{ asset('storage/' . $sectionImage) }}"
        alt="{{ $sectionTitle }}"
        class="w-full rounded-2xl border border-[#D1D5DB] shadow-sm"
      >

      <figcaption class="text-xs text-[#6B7280]">
        Figure: {{ $sectionTitle }} — {{ $revolution['label'] }}
      </figcaption>
    </figure>
  @endif

  {{-- content --}}
  <section class="bg-white border border-[#D1D5DB] rounded-2xl p-6">
    <p class="text-sm text-[#374151] leading-relaxed whitespace-pre-line">
      {{ $sectionContent }}
    </p>
  </section>

  {{-- section nav --}}
  <div class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
    <h2 class="font-semibold text-[#111827]">Other sections</h2>

    <div class="mt-3 flex flex-wrap gap-2">
      @foreach($categories as $key => $label)
        <a
          href="{{ route('revolutions.section', ['id' => $revolution['id'], 'section' => $key]) }}"
          class="px-3 py-2 rounded-lg text-sm border transition
                 {{ $sectionKey === $key
                    ? 'bg-[#111827] text-white border-[#111827]'
                    : 'bg-white text-[#111827] border-[#D1D5DB] hover:border-[#9CA3AF] hover:bg-[#F9FAFB]' }}"
        >
          {{ $label }}
        </a>
      @endforeach
    </div>
  </div>

  {{-- actions --}}
  <div class="flex flex-wrap gap-3">
    <a
      href="{{ route('revolutions.show', $revolution['id']) }}"
      class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-sm font-medium
             hover:border-[#9CA3AF] hover:bg-[#F9FAFB] transition"
    >
      Back to {{ $revolution['label'] }}
    </a>

    <a
      href="{{ route('analysis.compare', ['left' => $revolution['id'], 'right' => 'ir4']) }}"
      class="px-4 py-2 rounded-lg bg-[#111827] text-white text-sm font-medium
             hover:bg-[#1F2937] transition"
    >
      Compare this
    </a>
  </div>

</div>
@endsection