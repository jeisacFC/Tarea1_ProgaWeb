@props(['title', 'value', 'icon', 'trend', 'trendUp'])

<flux:card>
    <div class="flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <flux:text variant="subtle">{{ $title }}</flux:text>
            <flux:icon :icon="$icon" variant="outline" class="text-zinc-400 size-5" />
        </div>

        <div class="flex items-end justify-between gap-4">
            <flux:heading size="3xl" level="3">{{ $value }}</flux:heading>
            
            <div @class([
                'flex items-center gap-1 text-sm font-medium px-2 py-1 rounded-full',
                'bg-green-50 text-green-700 dark:bg-green-400/10 dark:text-green-400' => $trendUp,
                'bg-red-50 text-red-700 dark:bg-red-400/10 dark:text-red-400' => !$trendUp,
            ])>
                <flux:icon :icon="$trendUp ? 'arrow-trending-up' : 'arrow-trending-down'" class="size-3" />
                <span>{{ $trend }}</span>
            </div>
        </div>
    </div>
</flux:card>
