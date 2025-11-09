@props([
    'product' => null,
])

@if ($product)
<a href="{{ route('products.show', $product) }}"
   class="group flex cursor-pointer flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition-all hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10 dark:border-border-dark dark:bg-surface-dark">
    <div class="flex items-center justify-between">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-primary/15 text-primary">
            <span class="material-symbols-outlined text-2xl">api</span>
        </div>
        <span class="material-symbols-outlined text-slate-400 transition group-hover:text-primary dark:text-white/40">arrow_outward</span>
    </div>
    <h3 class="text-lg font-semibold text-slate-900 transition group-hover:text-primary dark:text-white">{{ $product->name }}</h3>
    <p class="text-sm text-slate-600 dark:text-white/60">{{ $product->short_description }}</p>
</a>
@endif
