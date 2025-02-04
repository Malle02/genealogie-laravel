<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'first_name', 'last_name', 'birth_name',
        'middle_names', 'date_of_birth'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parents()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'parent_id', 'child_id');
    }

    public function getDegreeWith($target_person_id)
    {
        if ($this->id == $target_person_id) {
            return 0;
        }
    
        $relations = DB::table('relationships')->get();
    
        // structure de graphe en mémoire
        $graph = [];
        foreach ($relations as $relation) {
            $graph[$relation->parent_id][] = $relation->child_id;
            $graph[$relation->child_id][] = $relation->parent_id;
        }
    
        $visited = [];
        $queue = [[$this->id, 0]];
    
        while (!empty($queue)) {
            [$current_id, $degree] = array_shift($queue);
    
            if ($degree > 25) {
                return false;
            }
    
            if (!isset($visited[$current_id])) {
                $visited[$current_id] = true;
    
                if (isset($graph[$current_id])) {
                    foreach ($graph[$current_id] as $next_id) {
                        if ($next_id == $target_person_id) {
                            return $degree + 1;
                        }
    
                        $queue[] = [$next_id, $degree + 1];
                    }
                }
            }
        }
    
        return false;
    }
    
}
