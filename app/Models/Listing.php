<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //protected $fillable = ['title', 'company', 'location', 'website', 'tags', 'email', 'description'];

    public function scopeFilter($query, array $filters){
        //handle if filter['tag'] doesn't null
        if($filters['tag'] ?? false){
            //add where condition for query
            $query->where('tags', 'like', '%'.request('tag').'%');
        }

        //handle if filter['search'] doesn't null
        if($filters['search'] ?? false){
            //add where condition for query
            $query  ->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('description', 'like', '%'.request('search').'%')
                    ->orWhere('tags', 'like', '%'.request('search').'%');
        }
    }
}
