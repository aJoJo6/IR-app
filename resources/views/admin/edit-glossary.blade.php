@extends('layouts.admin')

@section('content')
<div class="max-w-3xl space-y-6">

    {{-- Header --}}
    <div>
        <p class="text-sm text-[#A3A3A3]">Glossary</p>
        <h1 class="mt-1 text-2xl font-semibold text-white">
            Edit Term
        </h1>
        <p class="mt-2 text-sm text-[#A3A3A3]">
            Update the glossary term and its definition.
        </p>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="bg-red-950 border border-red-800 text-red-200 rounded-xl px-4 py-3">
            <ul class="space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form
        method="POST"
        action="{{ route('admin.glossary.update', $term) }}"
        class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-white">Term</label>
            <input
                type="text"
                name="term"
                value="{{ old('term', $term->term) }}"
                class="mt-2 w-full rounded-xl border border-[#404040] bg-[#111111] text-white px-4 py-3 outline-none"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-white">Definition</label>
            <textarea
                name="definition"
                rows="8"
                class="mt-2 w-full rounded-xl border border-[#404040] bg-[#111111] text-white px-4 py-3 outline-none"
            >{{ old('definition', $term->definition) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button
                type="submit"
                class="px-4 py-2 rounded-xl bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
            >
                Save
            </button>

            <a
                href="{{ route('admin.glossary') }}"
                class="px-4 py-2 rounded-xl border border-[#404040] text-sm font-medium text-white hover:bg-[#171717] transition"
            >
                Cancel
            </a>
        </div>
    </form>

</div>
@endsection