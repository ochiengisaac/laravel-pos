<?php if (auth()->user()->role === "merchant") : ?>
@include('layouts.partials.merchant_sidebar')
<?php elseif (auth()->user()->role === 'supplier') : ?>
@include('layouts.partials.supplier_sidebar')
<?php else : ?>
@include('layouts.partials.default_sidebar')
<?php endif; ?>