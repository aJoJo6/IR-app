@extends('layouts.app')

@section('content')
<div class="space-y-6">

  {{-- Header --}}
  <div class="flex items-start justify-between gap-6 flex-wrap">
    <div>
      <div class="text-sm text-[#6B7280]">
        {{ $revolution['label'] }} · {{ $revolution['years'] }}
      </div>

      <h1 class="mt-1 text-2xl font-semibold text-[#111827]">
        {{ $revolution['title'] }}
      </h1>

      <p class="mt-2 max-w-3xl text-[#374151]">
        {{ $revolution['summary'] }}
      </p>
    </div>

    <a
      href="{{ route('compare', ['left' => $revolution['id'], 'right' => 'ir4']) }}"
      class="px-4 py-2 rounded-lg
             border border-[#9CA3AF]
             text-[#111827] bg-white
             hover:bg-[#E5E7EB] transition
             text-sm"
    >
      Compare this
    </a>
  </div>

  {{-- Content sections --}}
  <div class="grid lg:grid-cols-2 gap-4">
    @foreach($categories as $key => $label)
      <section class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
        <h2 class="font-semibold text-[#111827]">
          {{ $label }}
        </h2>

        <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
          {{ $revolution['content'][$key] ?? '—' }}
        </p>
      </section>
    @endforeach
  </div>

</div>
@endsection
