<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Article extends Model implements Sortable
{
    use SortableTrait;
    use SearchableTrait;

    protected $table = 'articles';

    protected $searchable = [
        'columns' => [
            'articles.title' => 10,
            'articles.content' => 2,
        ]
    ];


    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'cid');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
