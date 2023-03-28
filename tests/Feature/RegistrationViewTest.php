<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration_view()
    {
        $client = ClassModel::where('active', 1)->get()->random()->id;
        $event = Event::where('client_id', $client->id)->get()->random()->id;
        $this->get('/api/clients/' . $client->id . '/events/' . $event->id . '-' . $event->event_name . '/'. $event->event_date->id)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'date' => [
                        'id',
                        'name_suffix',
                        'start_date',
                        'end_date',
                        'number_available',
                        'image_on_order_screen_file',
                        'number_still_available',
                        'availability_for_each_price_description' => [
                            [
                                'price_description_id',
                                'min',
                                'max'
                            ]
                        ],
                        'display_promotion_field',
                        'customized_questions',
                        'event_price_descriptions' => [
                            [
                                'id',
                                'name',
                                'price'
                            ]
                        ],
                    ],
                    'has_fees'
                ]
            );
    }
}
