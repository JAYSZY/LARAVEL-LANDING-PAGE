@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border border-slate-300 px-4 py-2.5 text-sm text-slate-800 shadow-sm transition focus:border-[#0b1530] focus:ring-2 focus:ring-[#0b1530]/20 focus:outline-none']) }}>
