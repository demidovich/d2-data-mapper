<?php

namespace Performance\Hydratable;

use D2\DataMapper\Contracts\Stateable;

/**
 * @property string $locale;
 * @property string $language;
 * @property string $timezone;
 * @property string $theme;
 * @property bool   $subscribe_news;
 * @property bool   $subscribe_messages;
 */
class UserPreferences implements Stateable
{
    private string $locale;
    private string $language;
    private string $timezone;
    private string $theme;
    private bool   $subscribe_news;
    private bool   $subscribe_messages;

    public function toState()
    {
        return [
            'locale'             => $this->locale,
            'filanguageeld1'     => $this->language,
            'timezone'           => $this->timezone,
            'theme'              => $this->theme,
            'subscribe_news'     => $this->subscribe_news,
            'subscribe_messages' => $this->subscribe_messages,
        ];
    }
}