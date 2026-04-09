@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

  <div>
    <h1 class="text-2xl font-semibold text-[#111827]">Edit Criterion</h1>
  </div>

  @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3">
      <ul class="space-y-1 text-sm">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form
    method="POST"
    action="{{ route('admin.criteria.update', $criterion) }}"
    class="bg-white border border-[#D1D5DB] rounded-2xl p-6 space-y-4"
  >
    @csrf
    @method('PUT')

    <div>
      <label class="block text-sm font-medium text-[#111827]">Title</label>
      <input type="text" name="title" value="{{ old('title', $criterion->title) }}"
        class="mt-2 w-full rounded-lg border-[#9CA3AF]">
    </div>

    <div>
      <label class="block text-sm font-medium text-[#111827]">Description</label>
      <textarea name="description" rows="8"
        class="mt-2 w-full rounded-lg border-[#9CA3AF]">{{ old('description', $criterion->description) }}</textarea>
    </div>

    <div class="flex gap-3">
      <button type="submit"
        class="px-4 py-2 rounded-lg bg-[#111827] text-white text-sm font-medium hover:bg-[#1F2937] transition">
        Save
      </button>

      <a href="{{ route('admin.criteria') }}"
        class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-sm font-medium hover:border-[#9CA3AF] hover:bg-[#F9FAFB] transition">
        Cancel
      </a>
    </div>
  </form>

</div>
@endsection