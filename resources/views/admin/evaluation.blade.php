@extends('layouts.admin')

@section('content')
<div class="space-y-6">

  {{-- header --}}
  <div>
    <h1 class="text-2xl font-semibold text-white">Edit Evaluation</h1>
    <p class="mt-2 text-sm text-[#A3A3A3]">
      Manage IR4.0 and IR5.0 evaluation values.
    </p>
  </div>

  {{-- flash --}}
  @if(session('success'))
    <div class="bg-green-950 border border-green-800 text-green-200 rounded-xl px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- empty state --}}
  @if($evaluations->isEmpty())
    <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6">
      <p class="text-[#D4D4D4] font-medium">No evaluation records found.</p>
    </div>
  @else
    <div class="space-y-4">
      @foreach($evaluations as $item)

        {{-- clickable card --}}
        <a
          href="{{ route('admin.evaluation.edit', $item) }}"
          class="block bg-[#0A0A0A] border border-[#262626] rounded-2xl p-5 transition hover:bg-[#111111] hover:border-[#404040]"
        >
          <div class="flex items-start justify-between gap-4">

            <div class="min-w-0">
              {{-- title --}}
              <h2 class="font-semibold text-white">
                {{ strtoupper($item->revolution) }} — {{ $item->criterion }}
              </h2>

              {{-- value --}}
              <p class="mt-2 text-sm text-[#A3A3A3] whitespace-pre-line">
                {{ $item->value }}
              </p>
            </div>

            {{-- action text --}}
            <span class="shrink-0 text-sm font-medium text-white">
              Edit →
            </span>

          </div>
        </a>

      @endforeach
    </div>
  @endif

</div>
@endsection