<?php

namespace App\Models\Concerns;

use Spatie\Activitylog\Models\Activity;

trait LogsContext
{
    abstract protected function activityContext(): array;

    // Spatie v5 hook
    public function beforeActivityLogged(Activity $activity, string $eventName): void
    {
        $this->applyContext($activity);
    }

    // Spatie v4 hook (ignored on v5)
    // public function tapActivity(Activity $activity, string $eventName): void
    // {
    //     $this->applyContext($activity);
    // }

    private function applyContext(Activity $activity): void
    {
        $context = $this->activityContext();

        $prefixed = [];
        foreach ($context as $key => $value) {
            $prefixed["ctx.$key"] = is_array($value) ? json_encode($value) : $value;
        }

        // Clean copy for your own queries
        $activity->properties = collect($activity->properties)->merge(['context' => $context]);

        // v5: diff lives in attribute_changes
        $changes = $activity->attribute_changes?->toArray();

        if (! empty($changes)) {
            foreach (['old', 'attributes'] as $key) {
                if (isset($changes[$key])) {
                    $changes[$key] = array_merge($prefixed, $changes[$key]);
                }
            }
            $activity->attribute_changes = collect($changes);

            return;
        }

        // v4: diff lives in properties
        // $props = collect($activity->properties);
        // foreach (['old', 'attributes'] as $key) {
        //     if ($props->has($key)) {
        //         $props[$key] = array_merge($prefixed, $props[$key]);
        //     }
        // }
        // $activity->properties = $props;
    }
}