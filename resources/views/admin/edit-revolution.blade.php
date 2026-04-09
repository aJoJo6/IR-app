@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  {{-- title --}}
  <div>
    <h1 class="text-2xl font-semibold text-white">Edit Revolution</h1>
    <p class="mt-2 text-[#A3A3A3]">
      Update revolution details and image.
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
    action="{{ route('admin.revolutions.update', $revolution) }}"
    enctype="multipart/form-data"
    class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-4"
  >
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-white">Label</label>
      <input
        type="text"
        name="label"
        value="{{ old('label', $revolution->label) }}"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Title</label>
      <input
        type="text"
        name="title"
        value="{{ old('title', $revolution->title) }}"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Years</label>
      <input
        type="text"
        name="years"
        value="{{ old('years', $revolution->years) }}"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Summary</label>
      <textarea
        name="summary"
        rows="5"
        class="mt-2 w-full rounded-lg border border-[#404040] bg-[#111111] text-white px-3 py-2"
      >{{ old('summary', $revolution->summary) }}</textarea>
    </div>

    <div>
      <label class="block text-sm font-medium text-white">Hero image</label>
      <input
        type="file"
        name="hero_image"
        class="mt-2 w-full text-sm text-[#A3A3A3]"
      >

      @if($revolution->hero_image)
        <img
          src="{{ asset('storage/' . $revolution->hero_image) }}"
          alt="{{ $revolution->title }}"
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