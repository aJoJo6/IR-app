@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-white">Edit Section</h1>
    <p class="mt-2 text-[#A3A3A3]">
      {{ $section->revolution->label }} — {{ $section->section_title }}
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
    action="{{ route('admin.sections.update', $section) }}"
    enctype="multipart/form-data"
    class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-4"
  >
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-white">Section title</label>
      <input
        type="text"
        name="section_title"
        value="{{ old('section_title', $section->section_title) }}"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Body</label>
      <textarea
        name="body"
        rows="14"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >{{ old('body', $section->body) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Section image</label>
      <input
        type="file"
        name="image_path"
        class="mt-2 w-full text-sm text-[#A3A3A3]"
      >

      @if($section->image_path)
        <img
          src="{{ asset('storage/' . $section->image_path) }}"
          alt="{{ $section->section_title }}"
          class="mt-4 w-full rounded-xl border border-[#262626]"
        >
      @endif
    </div>

    <div class="flex gap-3">
      <button
        type="submit"
        class="px-4 py-2 rounded-lg bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
      >
        Save
      </button>

      <a
        href="{{ route('admin.index') }}"
        class="px-4 py-2 rounded-lg border border-[#404040] text-sm font-medium text-white hover:bg-[#171717] transition"
      >
        Cancel
      </a>
    </div>
  </form>

</div>
@endsection