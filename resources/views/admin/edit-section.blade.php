@extends('layouts.admin')

@section('content')
<div class="max-w-4xl space-y-6">

    <div>
        <p class="text-sm text-[#A3A3A3]">{{ $section->revolution->label }}</p>
        <h1 class="mt-1 text-2xl font-semibold text-white">Edit Section</h1>
        <p class="mt-2 text-sm text-[#A3A3A3]">
            Update section content and manage gallery images.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-950 border border-green-800 text-green-200 rounded-xl px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

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
        action="{{ route('admin.sections.update', $section) }}"
        class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-5"
    >
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-white">Section Title</label>
            <input
                type="text"
                name="section_title"
                value="{{ old('section_title', $section->section_title) }}"
                class="mt-2 w-full rounded-xl border border-[#404040] bg-[#111111] text-white px-4 py-3"
            >
        </div>

        <div>
            <label class="block text-sm font-medium text-white">Body</label>
            <textarea
                name="body"
                rows="10"
                class="mt-2 w-full rounded-xl border border-[#404040] bg-[#111111] text-white px-4 py-3"
            >{{ old('body', $section->body) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button
                type="submit"
                class="px-4 py-2 rounded-xl bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
            >
                Save Changes
            </button>

            <a
                href="{{ route('admin.index') }}"
                class="px-4 py-2 rounded-xl border border-[#404040] text-sm text-white hover:bg-[#171717] transition"
            >
                Cancel
            </a>
        </div>
    </form>

    <div class="bg-[#0A0A0A] border border-[#262626] rounded-2xl p-6 space-y-5">
        <div>
            <h2 class="text-lg font-semibold text-white">Gallery Images</h2>
            <p class="mt-1 text-sm text-[#A3A3A3]">Upload multiple images and delete any you do not want.</p>
        </div>

        <form
            method="POST"
            action="{{ route('admin.sections.images.store', $section) }}"
            enctype="multipart/form-data"
            class="space-y-4"
        >
            @csrf

            <div>
                <label class="block text-sm font-medium text-white">Images</label>
                <input
                    type="file"
                    name="images[]"
                    multiple
                    accept="image/*"
                    class="mt-2 block w-full text-sm text-white"
                >
            </div>

            <button
                type="submit"
                class="px-4 py-2 rounded-xl bg-white text-black text-sm font-medium hover:bg-[#E5E5E5] transition"
            >
                Upload Images
            </button>
        </form>

        @if($section->images->isEmpty())
            <p class="text-sm text-[#A3A3A3]">No gallery images uploaded yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($section->images as $image)
                    <div class="rounded-2xl border border-[#262626] bg-[#111111] p-3 space-y-3">
                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            alt="Section image"
                            class="h-36 w-full rounded-xl object-cover"
                        >

                        <form
                            method="POST"
                            action="{{ route('admin.sections.images.destroy', $image) }}"
                            onsubmit="return confirm('Delete this image?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="w-full rounded-xl border border-red-900 bg-red-950 px-3 py-2 text-sm font-medium text-red-300 hover:bg-red-900/40 transition"
                            >
                                Delete Image
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection