<?php

namespace Tests\Stubs;

use D2\DataMapper\JsonEntity;

/**
 * @property bool   $subsribe_news
 * @property bool   $subsribe_notifications
 * @property string $locale
 * @property int    $page_size
 * 
 * @method static self fromState($state)
 */
class UserPreferencesJson extends JsonEntity
{
    protected  bool   $subsribe_news = true;
    protected  bool   $subsribe_notifications = true;
    protected  string $locale = 'ru_RU';
    protected  int    $page_size = 25;

    public function subscribeNews(bool $value): void
    {
        $this->subsribe_news = $value;
    }
}