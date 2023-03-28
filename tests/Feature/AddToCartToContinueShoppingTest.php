<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddToCartToContinueShoppingTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_tickets()
    {
        $order = Order::get()->random()->id;
        $this->get('/api/orders/' . $order->id . '/add_tickets')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'order_code',
                    'order_count',
                    'order_expiration',
                    'success_array',
                    'warning_array',
                    'error_array',
                ]
            );
    }


    public function test_get_classes()
    {
        $class = ClassModel::where('active', 1)->get()->random()->id;
        $this->get('/api/clients/' . $class->id . '/classes')
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
