@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  {{-- header --}}
  <div>
    <p class="text-sm text-[#A3A3A3]">{{ strtoupper($evaluation->revolution) }}</p>
    <h1 class="mt-1 text-2xl font-semibold text-white">
      {{ $evaluation->criterion }}
    </h1>
    <p class="mt-2 text-sm text-[#A3A3A3]">
      Update the evaluation value shown in the public view.
    </p>
  </div>

  {{-- errors --}}
  @if($errors->any())
    <div class="bg-red-950 border border-red-800 text-red-200 rounded-xl px-4 py-3">
      <ul class="space-y-1 text-sm">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- form --}}
  <form
    method="POST"
    action="{{ route('admin.evaluation.update', $evaluation) }}"
    class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-5"
  >
    @csrf
    @method('PUT')

    {{-- read only fields --}}
    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-white">Revolution</label>
        <input
          type="text"
          value="{{ strtoupper($evaluation->revolution) }}"
          class="mt-2 w-full rounded-lg border border-[#262626] bg-[#111111] text-[#A3A3A3] px-3 py-2"
          disabled
        >
        <input type="hidden" name="revolution" value="{{ $evaluation->revolution }}">
      </div>

      <div>
        <label class="block text-sm font-medium text-white">Criterion</label>
        <input
          type="text"
          value="{{ $evaluation->criterion }}"
          class="mt-2 w-full rounded-lg border border-[#262626] bg-[#111111] text-[#A3A3A3] px-3 py-2"
          disabled
        >
        <input type="hidden" name="criterion" value="{{ $evaluation->criterion }}">
      </div>
    </div>

    {{-- editable value --}}
    <div>
      <label class="block text-sm font-medium text-white">Value</label>
      <textarea
        name="value"
        rows="8"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >{{ old('value', $evaluation->value) }}</textarea>
    </div>

    {{-- actions --}}
    <div class="flex gap-3">
      <button
        type="submit"
        class="px-4 py-2 rounded-lg bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
      >
        Save
      </button>

      <a
        href="{{ route('admin.evaluation') }}"
        class="px-4 py-2 rounded-lg border border-[#404040] text-sm font-medium text-white hover:bg-[#171717] transition"
      >
        Cancel
      </a>
    </div>
  </form>

</div>
@endsection