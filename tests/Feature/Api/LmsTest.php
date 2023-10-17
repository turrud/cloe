<?php

namespace Tests\Feature\Api;

use App\Models\Lms;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LmsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_all_lms_list(): void
    {
        $allLms = Lms::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-lms.index'));

        $response->assertOk()->assertSee($allLms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_lms(): void
    {
        $data = Lms::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-lms.store'), $data);

        $this->assertDatabaseHas('lms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_lms(): void
    {
        $lms = Lms::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'text' => $this->faker->text(),
        ];

        $response = $this->putJson(route('api.all-lms.update', $lms), $data);

        $data['id'] = $lms->id;

        $this->assertDatabaseHas('lms', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_lms(): void
    {
        $lms = Lms::factory()->create();

        $response = $this->deleteJson(route('api.all-lms.destroy', $lms));

        $this->assertModelMissing($lms);

        $response->assertNoContent();
    }
}
