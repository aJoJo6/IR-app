@extends('layouts.app')

@section('content')
<div class="space-y-6">
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">What Defines an Industrial Revolution?</h1>
    <p class="mt-2 max-w-3xl text-[#374151]">
      This page explains the framework used to interpret whether a period represents an industrial revolution
      rather than incremental technological change.
    </p>
  </div>

  <div class="grid lg:grid-cols-2 gap-4">
    @foreach($criteriaBlocks as $block)
      <section class="bg-white border border-[#D1D5DB] rounded-2xl p-5">
        <h2 class="font-semibold text-[#111827]">{{ $block['title'] }}</h2>

        <p class="mt-2 text-sm text-[#374151] leading-relaxed whitespace-pre-line">
          {{ $block['body'] }}
        </p>

        @if(!empty($block['bullets']))
          <ul class="mt-3 text-sm text-[#374151] list-disc pl-5 space-y-1">
            @foreach($block['bullets'] as $b)
              <li>{{ $b }}</li>
            @endforeach
          </ul>
        @endif
      </section>
    @endforeach
  </div>
</div>
@endsection
