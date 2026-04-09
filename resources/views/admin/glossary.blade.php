@extends('layouts.admin')

@section('content')
<div class="space-y-6">

  {{-- header --}}
  <div class="flex items-start justify-between gap-4 flex-wrap">
    <div>
      <h1 class="text-2xl font-semibold text-white">Edit Glossary</h1>
      <p class="mt-2 text-sm text-[#A3A3A3]">
        Manage glossary terms and definitions.
      </p>
    </div>

    <a
      href="{{ route('admin.glossary.create') }}"
      class="px-4 py-2 rounded-lg border border-[#404040] text-sm text-white hover:bg-[#171717] transition">
      Add definition
    </a>
  </div>

  {{-- flash --}}
  @if(session('success'))
    <div class="bg-green-950 border border-green-800 text-green-200 rounded-xl px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- empty state --}}
  @if($terms->isEmpty())
    <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6">
      <p class="text-[#D4D4D4] font-medium">No glossary terms found.</p>
      <p class="text-sm text-[#A3A3A3] mt-1">Add your first definition to begin.</p>
    </div>
  @else
    <div class="space-y-4">
      @foreach($terms as $term)
        <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-5 flex items-start justify-between gap-4">
          <div>
            <h2 class="font-semibold text-white">{{ $term->term }}</h2>
            <p class="mt-2 text-sm text-[#A3A3A3] whitespace-pre-line">{{ $term->definition }}</p>
          </div>

          <a
            href="{{ route('admin.glossary.edit', $term) }}"
            class="text-sm font-medium text-white hover:underline whitespace-nowrap">
            Edit
          </a>
        </div>
      @endforeach
    </div>
  @endif

</div>
@endsection