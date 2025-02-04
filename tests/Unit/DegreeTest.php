<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class DegreeTest extends TestCase
{
    use RefreshDatabase; 

    /** @test */
    public function it_calcule_correctement_le_degré_de_parenté()
    {
       
        $person1 = Person::factory()->create();
        $person2 = Person::factory()->create();

       
        DB::table('relationships')->insert([
            'created_by' => 1,
            'parent_id' => $person1->id,
            'child_id' => $person2->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        $degree = $person1->getDegreeWith($person2->id);
        $this->assertEquals(1, $degree);
    }
}
