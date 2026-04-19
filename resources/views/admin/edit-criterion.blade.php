@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-8">

    {{-- page header --}}
    <div>
        <p class="text-sm font-medium uppercase tracking-wide text-zinc-500">Criterion</p>
        <h1 class="mt-2 text-4xl font-semibold tracking-tight text-white">Edit Criterion</h1>
        <p class="mt-3 text-base text-zinc-400">
            Update the criterion title and description used across the evaluation views.
        </p>
    </div>

    {{-- validation errors --}}
    @if($errors->any())
        <div class="rounded-2xl border border-red-800 bg-red-950 px-5 py-4 text-red-200">
            <ul class="space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- edit form --}}
    <form
        method="POST"
        action="{{ route('admin.criteria.update', $criterion) }}"
        class="space-y-6 rounded-3xl border border-zinc-800 bg-zinc-950 p-8"
    >
        @csrf
        @method('PUT')

        {{-- title input --}}
        <div>
            <label for="title" class="block text-sm font-medium text-zinc-200">
                Title
            </label>
            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $criterion->title) }}"
                class="mt-3 w-full rounded-2xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white placeholder-zinc-500 outline-none transition focus:border-zinc-500"
            >
        </div>

        {{-- description input --}}
        <div>
            <label for="description" class="block text-sm font-medium text-zinc-200">
                Description
            </label>
            <textarea
                id="description"
                name="description"
                rows="8"
                class="mt-3 w-full rounded-2xl border border-zinc-700 bg-zinc-900 px-4 py-3 text-white placeholder-zinc-500 outline-none transition focus:border-zinc-500"
            >{{ old('description', $criterion->description) }}</textarea>
        </div>

        {{-- form actions --}}
        <div class="flex flex-wrap gap-3">
            <button
                type="submit"
                class="inline-flex items-center rounded-2xl bg-white px-5 py-3 text-sm font-medium text-black transition hover:bg-zinc-200"
            >
                Save Changes
            </button>

            <a
                href="{{ route('admin.criteria') }}"
                class="inline-flex items-center rounded-2xl border border-zinc-700 px-5 py-3 text-sm font-medium text-zinc-200 transition hover:bg-zinc-900"
            >
                Cancel
            </a>
        </div>
    </form>

</div>
@endsection