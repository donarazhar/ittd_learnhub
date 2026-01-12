<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity as SpatieLogsActivity;

trait LogsActivity
{
    use SpatieLogsActivity;

    /**
     * Get the options for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->getLogAttributes())
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => $this->getActivityDescription($eventName));
    }

    /**
     * Get attributes to log.
     */
    protected function getLogAttributes(): array
    {
        // Default attributes, bisa di-override di masing-masing model
        return ['*'];
    }

    /**
     * Get activity description based on event.
     */
    protected function getActivityDescription(string $eventName): string
    {
        $modelName = class_basename($this);
        $userName = auth()->user()?->name ?? 'System';

        return match ($eventName) {
            'created' => "{$userName} membuat {$modelName} baru: {$this->getActivityIdentifier()}",
            'updated' => "{$userName} mengupdate {$modelName}: {$this->getActivityIdentifier()}",
            'deleted' => "{$userName} menghapus {$modelName}: {$this->getActivityIdentifier()}",
            default => "{$userName} melakukan {$eventName} pada {$modelName}: {$this->getActivityIdentifier()}",
        };
    }

    /**
     * Get identifier for activity description.
     */
    protected function getActivityIdentifier(): string
    {
        // Prioritas: title > name > id
        if (isset($this->title)) {
            return $this->title;
        }

        if (isset($this->name)) {
            return $this->name;
        }

        return "ID {$this->id}";
    }
}
