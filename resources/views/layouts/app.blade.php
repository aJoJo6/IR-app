<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'The Industrial Revolution Explorer' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#E5E7EB] text-[#111827]">
  <header class="sticky top-0 z-50 bg-[#111827] border-b border-[#1F2937]">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a
        href="{{ route('home') }}"
        class="font-semibold tracking-tight {{ request()->routeIs('home') ? 'text-white' : 'text-[#E5E7EB] hover:text-white' }}">
        The IR Explorer
      </a>

      <nav class="flex flex-wrap gap-2 text-sm">
        <a
          href="{{ route('explore') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('explore') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Explore
        </a>

        <a
          href="{{ route('compare') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('compare') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Compare
        </a>

        <a
          href="{{ route('criteria') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('criteria') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Criteria
        </a>

        <a
          href="{{ route('evaluation') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('evaluation') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Evaluation
        </a>

        <a
          href="{{ route('glossary') }}"
          class="px-3 py-2 rounded transition {{ request()->routeIs('glossary') ? 'bg-[#1F2937] text-white' : 'text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white' }}">
          Glossary
        </a>
      </nav>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>
</body>
</html>