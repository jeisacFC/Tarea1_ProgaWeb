@props([
    'label' => '',
    'value' => '',
    'icon' => null,
])

<div class="flex items-start gap-3">
    @if ($icon)
        <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
            <flux:icon :icon="$icon" class="size-4" />
        </div>
    @endif
    <div class="flex-1 min-w-0">
        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
            {{ $label }}
        </flux:text>
        <flux:text class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100">
            {{ $value }}
        </flux:text>
    </div>
</div>
