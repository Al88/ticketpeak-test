<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_class()
    {
        $client = Client::where('active', 1)->get()->random()->id;
        $this->get('/api/clients/' . $client->id . '/classes')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'events',
                    'event_dates' => [
                        'id',
                        'name_suffix',
                        'closed',
                        'virtual',
                        'private',
                        'sold_out',
                        'date_to_show_online',
                        'time_to_show_online',
                        'event' => [
                            'id',
                            'name'
                        ]
                    ]
                ]
            );
    }
}
