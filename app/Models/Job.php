<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  use HasFactory;

  // use this to prevent mass assignment rule error
  // all properties that will be push to the db 
  // need to be in this array  
  // or use unguard, see more in AppServiceProvider file
  protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags', 'logo', 'user_id'];

  public function scopeFilter($query, array $filters)
  {
    if ($filters['tag'] ?? false) {
      $query->where('tags', 'like', '%' . request('tag') . '%');
      // search the tags column 
      // if it like (sql mysql) the query
      // SELECT * FROM 'jobs' WHERE 'tags' like '%tagValue%'  
    }

    if ($filters['search'] ?? false) {
      $query->where('title', 'like', '%' . request('search') . '%')
        ->orWhere('description', 'like', '%' . request('search') . '%')
        ->orWhere('tags', 'like', '%' . request('search') . '%');
    }
  }

  /* Relationship to user 
  mean this specific job belonging to a user 
  use tinker to test this
  php artisan tinker
  \App\Models\Job::find(job id here)->user
  list the info of the user that post this job
  */
  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }
}
