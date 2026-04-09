<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'The Industrial Revolution Explorer' }}</title>

  {{-- assets --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#E5E7EB] text-[#111827]">

  {{-- header --}}
  <header class="sticky top-0 z-50 bg-[#111827] border-b border-[#1F2937]">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">

      {{-- logo --}}
      <a
        href="{{ route('home') }}"
        class="font-semibold tracking-tight {{ request()->routeIs('home') ? 'text-white' : 'text-[#E5E7EB] hover:text-white' }}">
        The IR Explorer
      </a>

      {{-- nav --}}
      <nav class="flex flex-wrap gap-2 text-sm">

        {{-- explore --}}
        <a
          href="{{ route('revolutions.index') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('revolutions.*') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Explore
        </a>

        {{-- compare --}}
        <a
          href="{{ route('analysis.compare') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.compare') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Compare
        </a>

        {{-- criteria --}}
        <a
          href="{{ route('analysis.criteria') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.criteria') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Criteria
        </a>

        {{-- evaluation --}}
        <a
          href="{{ route('analysis.evaluation') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('analysis.evaluation') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Evaluation
        </a>

        {{-- glossary --}}
        <a
          href="{{ route('glossary') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('glossary') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Glossary
        </a>

        {{-- edit --}}
        <a
          href="{{ route('admin.login') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('admin.*') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Edit
        </a>
        

      </nav>
    </div>
  </header>

  {{-- main --}}
  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>

</body>
</html>