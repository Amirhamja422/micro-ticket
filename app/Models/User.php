<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Client;
use App\Models\Server;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\Department;
use App\Models\Designation;
use App\Models\TaskHistory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'number', 'department_id', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Client()
    {
        return $this->hasMany(Client::class);
    }

    public function Server()
    {
        return $this->hasMany(Server::class);
    }

    public function taskData()
    {
        return $this->hasMany(Task::class);
    }

    public function TaskHistory()
    {
        return $this->hasMany(TaskHistory::class);
    }

    /**
     * Get department name from user
     *
     * @return void
     */
    public function department_name()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * get designation name from user
     *
     * @return void
     */
    // public function designation_name()
    // {
    //     return $this->belongsTo(Designation::class, 'designation_id', 'id');
    // }

    public function project()
    {
        return $this->morphedByMany(Project::class, 'associatable');
    }

    /**
     * Get all of the posts that are assigned this tag.
     **/
    public function task()
    {
        return $this->morphedByMany(Task::class, 'associatable');
    }

    /**
     * Get all of the posts that are assigned this tag.
     **/
    public function ticket()
    {
        return $this->morphedByMany(Ticket::class, 'associatable');
    }
}
