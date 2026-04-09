@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  <div>
    <h1 class="text-2xl font-semibold text-white">Add Criterion</h1>
  </div>

  @if($errors->any())
    <div class="bg-red-950 border border-red-800 text-red-200 rounded-xl px-4 py-3">
      <ul class="space-y-1 text-sm">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form
    method="POST"
    action="{{ route('admin.criteria.store') }}"
    class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-4"
  >
    @csrf

    <div>
      <label class="block text-sm font-medium text-white">Title</label>
      <input
        type="text"
        name="title"
        value="{{ old('title') }}"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Description</label>
      <textarea
        name="description"
        rows="8"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2">{{ old('description') }}</textarea>
    </div>

    <div class="flex gap-3">
      <button
        type="submit"
        class="px-4 py-2 rounded-lg bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition">
        Save
      </button>

      <a
        href="{{ route('admin.criteria') }}"
        class="px-4 py-2 rounded-lg border border-[#404040] text-sm text-white hover:bg-[#171717] transition">
        Cancel
      </a>
    </div>
  </form>

</div>
@endsection