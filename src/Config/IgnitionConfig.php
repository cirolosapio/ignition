<?php

namespace Spatie\Ignition\Config;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class IgnitionConfig implements Arrayable
{
    protected array $options = [];

    public static function loadFromConfigFile(): self
    {
        $defaultConfigValues = (new DefaultConfigFinder)->getSettingsFromConfig();

        return new static($defaultConfigValues);
    }

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function mergeWithDefaults(array $newDefaults): self
    {
        $this->options = array_merge($newDefaults, $this->options);

        return $this;
    }

    public function setOption(string $name, string $value): self
    {
        $this->options[$name] = $value;

        return $this;
    }

    public function editor(): ?string
    {
        return $this->options['editor'] ?? null;
    }

    public function remoteSitesPath(): ?string
    {
        return $this->options['remote_sites_path'] ?? null;
    }

    public function localSitesPath(): ?string
    {
        return $this->options['local_sites_path'] ?? null;
    }

    public function theme(): ?string
    {
        return $this->options['theme'] ?? null;
    }

    public function shareButtonEnabled(): bool
    {
        return $this->options['enable_share_button'] ?? false;
    }

    public function runnableSolutionsEnabled(): bool
    {
        return $this->options['enable_share_button'] ?? false;;
    }

    public function toArray(): array
    {
        return [
            'editor' => $this->editor(),
            'remoteSitesPath' => $this->remoteSitesPath(),
            'localSitesPath' => $this->localSitesPath(),
            'theme' => $this->theme(),
            'enableShareButton' => $this->shareButtonEnabled(),
            'enableRunnableSolutions' => $this->runnableSolutionsEnabled(),
            'directorySeparator' => DIRECTORY_SEPARATOR,
        ];
    }
}