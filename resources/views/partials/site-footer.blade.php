{{-- ============================================================
     FOOTER
     Two parts:
     1) a contact info bar (location / phone / email / visiting
        hours) copied from the official BJMP Virac website.
     2) a slim credit line matching the sign-in screen's footer.
============================================================= --}}
<footer class="site-footer">

    {{-- Contact info bar --}}
    <div class="site-footer__grid">

        @php
            $contact = [
                ['icon' => 'map-pin', 'text' => 'Brgy. Calatagan, Virac,<br>Catanduanes, Philippines'],
                ['icon' => 'phone', 'text' => '09971578500'],
                ['icon' => 'envelope', 'text' => 'viracjail@bjmp.gov.ph<br>&#64;BJMPViracOfficial'],
                ['icon' => 'clock', 'text' => 'Mon &ndash; Sun: 8:00 AM &ndash; 4:00 PM'],
            ];
        @endphp

        @foreach ($contact as $item)
            <div class="footer-item">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="icon-amber-sm" />
                <p class="footer-item__text">{!! $item['text'] !!}</p>
            </div>
        @endforeach

    </div>
</footer>
