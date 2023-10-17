<?php

namespace Tests\Feature\Controllers;

use App\Models\Lms;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LmsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_lms(): void
    {
        $allLms = Lms::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-lms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_lms.index')
            ->assertViewHas('allLms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_lms(): void
    {
        $response = $this->get(route('all-lms.create'));

        $response->assertOk()->assertViewIs('app.all_lms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_lms(): void
    {
        $data = Lms::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-lms.store'), $data);

        $this->assertDatabaseHas('lms', $data);

        $lms = Lms::latest('id')->first();

        $response->assertRedirect(route('all-lms.edit', $lms));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_lms(): void
    {
        $lms = Lms::factory()->create();

        $response = $this->get(route('all-lms.show', $lms));

        $response
            ->assertOk()
            ->assertViewIs('app.all_lms.show')
            ->assertViewHas('lms');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_lms(): void
    {
        $lms = Lms::factory()->create();

        $response = $this->get(route('all-lms.edit', $lms));

        $response
            ->assertOk()
            ->assertViewIs('app.all_lms.edit')
            ->assertViewHas('lms');
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

        $response = $this->put(route('all-lms.update', $lms), $data);

        $data['id'] = $lms->id;

        $this->assertDatabaseHas('lms', $data);

        $response->assertRedirect(route('all-lms.edit', $lms));
    }

    /**
     * @test
     */
    public function it_deletes_the_lms(): void
    {
        $lms = Lms::factory()->create();

        $response = $this->delete(route('all-lms.destroy', $lms));

        $response->assertRedirect(route('all-lms.index'));

        $this->assertModelMissing($lms);
    }
}
