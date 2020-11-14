<?php

namespace Tests\Stubs\User;

use D2\DataMapper\Contracts\Stateable;
use D2\DataMapper\Traits\Jsonable;
use Performance\Hardcode\Entity;

/**
 * @property bool   $subsribe_news
 * @property bool   $subsribe_notifications
 * @property string $locale
 * @property int    $page_size
 * 
 * @method static self fromState($state)
 */
class UserPreferencesJsonable implements Stateable
{
    use Jsonable;

    protected  bool   $subsribe_news = true;
    protected  bool   $subsribe_notifications = true;
    protected  string $locale = 'ru_RU';
    protected  int    $page_size = 25;

    public function subscribeNews(bool $value): void
    {
        $this->subsribe_news = $value;
    }
}