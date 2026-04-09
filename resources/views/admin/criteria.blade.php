@extends('layouts.admin')

@section('content')
<div class="space-y-6">

  {{-- header --}}
  <div class="flex items-start justify-between gap-4 flex-wrap">
    <div>
      <h1 class="text-2xl font-semibold text-white">Edit Criteria</h1>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Manage the criteria used to evaluate industrial revolutions.
      </p>
    </div>

    <a
      href="{{ route('admin.criteria.create') }}"
      class="px-4 py-2 rounded-lg border border-[#404040] text-sm text-white hover:bg-[#171717] transition">
      Add criterion
    </a>
  </div>

  {{-- flash --}}
  @if(session('success'))
    <div class="bg-green-950 border border-green-800 text-green-200 rounded-xl px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- empty state --}}
  @if($criteria->isEmpty())
    <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6">
      <p class="text-[#D4D4D4] font-medium">No criteria found.</p>
      <p class="text-sm text-[#A3A3A3] mt-1">Add your first criterion to begin.</p>
    </div>
  @else
    <div class="space-y-4">
      @foreach($criteria as $item)
        <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-5 flex items-start justify-between gap-4">
          <div>
            <h2 class="font-semibold text-white">{{ $item->title }}</h2>
            <p class="mt-2 text-sm text-[#A3A3A3] whitespace-pre-line">{{ $item->description }}</p>
          </div>

          <a
            href="{{ route('admin.criteria.edit', $item) }}"
            class="text-sm font-medium text-white hover:underline whitespace-nowrap">
            Edit
          </a>
        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection