<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-md bg-amber-400 px-4 py-2 text-sm font-semibold text-[#0b1530] transition hover:bg-amber-300 focus:outline-none focus:ring-2 focus:ring-amber-400/40 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
