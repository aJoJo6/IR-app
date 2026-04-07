@extends('layouts.app')

@php
  // badge colours
  function badgeClasses($value) {
      $value = strtolower(trim($value));

      return match ($value) {
          'yes', 'strong', 'high', 'full' => 'bg-green-100 text-green-800 border-green-200',
          'partial', 'medium', 'emerging', 'mixed' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
          'no', 'weak', 'low', 'none' => 'bg-red-100 text-red-800 border-red-200',
          default => 'bg-[#F9FAFB] text-[#111827] border-[#D1D5DB]',
      };
  }
@endphp

@section('content')
<div class="space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">
      Evaluation: IR4.0 and IR5.0
    </h1>
    <p class="mt-2 max-w-3xl text-[#374151]">
      This is a proof-of-concept evaluation summary showing how IR4.0 and IR5.0 align
      with the criteria derived from IR1.0–IR3.0.
    </p>
  </div>

  {{-- evaluation table --}}
  <div class="bg-white border border-[#D1D5DB] rounded-2xl p-6 overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="text-left text-[#6B7280]">
        <tr>
          <th class="py-2 pr-4">Criterion</th>
          <th class="py-2 pr-4">IR4.0</th>
          <th class="py-2 pr-4">IR5.0</th>
        </tr>
      </thead>

      <tbody class="align-top">
        @foreach($criteria as $i => $c)
          <tr class="border-t border-[#E5E7EB]">

            {{-- criterion --}}
            <td class="py-3 pr-4 font-medium text-[#111827]">
              {{ $c }}
            </td>

            {{-- ir4 result --}}
            <td class="py-3 pr-4">
              <span class="inline-flex px-2 py-1 rounded-lg border {{ badgeClasses($ir4[$i] ?? '—') }}">
                {{ $ir4[$i] ?? '—' }}
              </span>
            </td>

            {{-- ir5 result --}}
            <td class="py-3 pr-4">
              <span class="inline-flex px-2 py-1 rounded-lg border {{ badgeClasses($ir5[$i] ?? '—') }}">
                {{ $ir5[$i] ?? '—' }}
              </span>
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- legend --}}
  <div class="grid lg:grid-cols-2 gap-4">
    <div class="bg-white border border-[#D1D5DB] rounded-2xl p-6">
      <h2 class="font-semibold text-[#111827]">Legend</h2>

      <ul class="mt-3 text-sm text-[#374151] space-y-2">
        @foreach($legend as $k => $v)
          <li>
            <span class="font-semibold text-[#111827]">{{ $k }}</span>:
            {{ $v }}
          </li>
        @endforeach
      </ul>
    </div>
  </div>

</div>
@endsection