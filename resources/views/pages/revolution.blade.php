@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

  {{-- page header --}}
  <div class="flex items-start justify-between gap-6 flex-wrap">

    {{-- intro section --}}
    <div>
      {{-- breadcrumb navigation --}}
      <nav class="text-sm text-[#6B7280]">
        <a href="{{ route('home') }}" class="hover:text-[#111827]">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('revolutions.index') }}" class="hover:text-[#111827]">Explore</a>
        <span class="mx-1">/</span>
        <span>{{ $revolution['label'] }}</span>
      </nav>

      {{-- revolution meta --}}
      <div class="mt-2 text-sm text-[#6B7280]">
        {{ $revolution['label'] }} · {{ $revolution['years'] }}
      </div>

      {{-- revolution title --}}
      <h1 class="mt-1 text-2xl font-semibold text-[#111827]">
        {{ $revolution['title'] }}
      </h1>

      {{-- revolution summary --}}
      <p class="mt-2 max-w-3xl text-[#374151]">
        {{ $revolution['summary'] }}
      </p>
    </div>

    {{-- compare button --}}
    <a
      href="{{ route('analysis.compare', ['left' => $revolution['id'], 'right' => 'ir4']) }}"
      class="px-4 py-2 rounded-lg border border-[#9CA3AF] text-[#111827] bg-white text-sm hover:bg-[#E5E7EB] hover:border-[#6B7280] transition"
    >
      Compare this
    </a>
  </div>

  {{-- hero image --}}
  @if(!empty($revolution['hero_image']))
    <div class="w-full max-w-4xl mx-auto">
      <div class="aspect-video overflow-hidden rounded-2xl border border-[#D1D5DB]">
        <img
          src="{{ asset('storage/' . $revolution['hero_image']) }}"
          alt="{{ $revolution['title'] }}"
          class="w-full h-full object-cover"
        >
      </div>
    </div>
  @endif

  {{-- section cards --}}
  <div class="grid lg:grid-cols-2 gap-4 items-stretch">
    @foreach($categories as $key => $label)
      <a
        href="{{ route('revolutions.section', ['id' => $revolution['id'], 'section' => $key]) }}"
        class="block h-full bg-white border border-[#D1D5DB] rounded-2xl p-5 transition transform hover:shadow-sm hover:border-[#9CA3AF] hover:-translate-y-px"
      >
        <div class="flex flex-col h-full">
          {{-- section title --}}
          <h2 class="font-semibold text-[#111827]">
            {{ $label }}
          </h2>

          {{-- section preview --}}
          <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
            {{ \Illuminate\Support\Str::limit($revolution['content'][$key] ?? 'No information available for this category.', 220) }}
          </p>

          {{-- read more link text --}}
          <p class="mt-auto pt-4 text-sm font-medium text-[#111827]">
            Read more →
          </p>
        </div>
      </a>
    @endforeach
  </div>

</div>
@endsection