<?php

namespace Performance\Hydratable;

use D2\DataMapper\Entity;
use D2\DataMapper\Entity\Hydratable;

class UserPreferences extends Entity
{
    use Hydratable;

    private string $locale;
    private string $language;
    private string $timezone;
    private string $theme;
    private bool   $subscribe_news;
    private bool   $subscribe_messages;
}