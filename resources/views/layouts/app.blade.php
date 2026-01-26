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
    <a href="{{ route('home') }}"
       class="font-semibold tracking-tight text-[#E5E7EB] hover:text-white">
      The IR Explorer
    </a>

    <nav class="flex flex-wrap gap-2 text-sm">
      <a class="px-3 py-2 rounded text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white transition"
         href="{{ route('explore') }}">Explore</a>

      <a class="px-3 py-2 rounded text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white transition"
         href="{{ route('compare') }}">Compare</a>

      <a class="px-3 py-2 rounded text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white transition"
         href="{{ route('criteria') }}">Criteria</a>

      <a class="px-3 py-2 rounded text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white transition"
         href="{{ route('evaluation') }}">Evaluation</a>

      <a class="px-3 py-2 rounded text-[#E5E7EB] hover:bg-[#1F2937] hover:text-white transition"
         href="{{ route('glossary') }}">Glossary</a>
    </nav>
  </div>
</header>

  <main class="max-w-6xl mx-auto px-4 py-8">
    @yield('content')
  </main>
</body>
</html>
