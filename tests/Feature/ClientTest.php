<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\Client;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_client()
    {
        $client = Client::where('active', 1)->get()->random()->id;
        $this->get('/api/clients/' . $client->url)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'client' => [
                        'id',
                        'name',
                        'url',
                        'website',
                        'merchant',
                        'support_phone',
                        'currency',
                        'date_format',
                        'text_above_events',
                        'text_above_classes',
                        'text_above_merchandises',
                        'text_above_auditions',
                        'events_grouped',
                        'events_in_calendar',
                        'closed_events_text',
                        'classes_menu_text',
                        "classes_button_text",
                        "text_above_seating_plan",
                        "text_above_general_admission",
                        "text_above_gift_certificates",
                        "show_tickets_sold_and_remaining",
                        "show_tickets_sold_and_remaining_threshold",
                        "display_field_address",
                        "require_field_address",
                        "display_field_address_2",
                        "require_field_address_2",
                        "display_field_city",
                        "require_field_city",
                        "display_field_state",
                        "require_field_state",
                        "display_field_province",
                        "require_field_province",
                        "display_field_county",
                        "require_field_county",
                        "display_field_country",
                        "require_field_country",
                        "display_field_zip",
                        "require_field_zip",
                        "display_field_postal",
                        "require_field_postal",
                        "display_field_phone",
                        "require_field_phone",
                        "display_field_how_referred",
                        "require_field_how_referred",
                        "display_field_comments",
                        "require_field_comments",
                        "display_field_country_code",
                        "require_field_country_code",
                        "customized_questions_events_instructions",
                        "customized_questions_classes_instructions",
                        "customized_questions_auditions_instructions",
                        "customized_questions_donation_instructions",
                        "text_at_the_bottom_of_the_cart",
                        "show_donation_button",
                        "text_next_to_donation_button",
                        "allow_different_name_on_each_ticket",
                        "allow_will_call",
                        "enable_gift_certificates",
                        "enable_gift_certificates_online",
                        "gift_certificate_options",
                        "gift_certificates_expiration",
                        "show_link_back_to_company_website",
                        "text_after_paying_events",
                        "text_after_paying_classes",
                        "text_after_paying_auditions",
                        "text_after_paying_donations",
                        "text_after_paying_general",
                        "display_social_network_buttons",
                        "display_home_button",
                        "show_order_link_on_success_page",
                        "invite_to_email_list",
                        "color_background",
                        "color_font",
                        "color_button_background",
                        "color_button_font",
                        "logo_file",
                        "logo_mime_type",
                        "classes_customized_questions_instructions",
                        "auditions_customized_questions_instructions",
                        "text_above_subscriptions_flex_passes",
                        "merchandise_display_field_address",
                        "merchandise_require_field_address",
                        "merchandise_display_field_address_2",
                        "merchandise_require_field_address_2",
                        "merchandise_display_field_city",
                        "merchandise_require_field_city",
                        "merchandise_display_field_state",
                        "merchandise_require_field_state",
                        "merchandise_display_field_province",
                        "merchandise_require_field_province",
                        "merchandise_display_field_country",
                        "merchandise_require_field_country",
                        "merchandise_display_field_zip",
                        "merchandise_require_field_zip",
                        "merchandise_display_field_postal",
                        "merchandise_require_field_postal",
                        "merchandise_display_field_phone",
                        "merchandise_require_field_phone",
                        "merchandise_display_field_how_referred",
                        "merchandise_require_field_how_referred",
                        "merchandise_display_field_comments",
                        "merchandise_require_field_comments",
                        "merchandise_display_field_shipping_address",
                        "merchandise_require_field_shipping_address",
                        "merchandise_display_field_shipping_address_2",
                        "merchandise_require_field_shipping_address_2",
                        "merchandise_display_field_shipping_city",
                        "merchandise_require_field_shipping_city",
                        "merchandise_display_field_shipping_state",
                        "merchandise_require_field_shipping_state",
                        "merchandise_display_field_shipping_province",
                        "merchandise_require_field_shipping_province",
                        "merchandise_display_field_shipping_country",
                        "merchandise_require_field_shipping_country",
                        "merchandise_display_field_shipping_zip",
                        "merchandise_require_field_shipping_zip",
                        "merchandise_display_field_shipping_postal",
                        "merchandise_require_field_shipping_postal",
                        "merchandise_display_field_shipping_phone",
                        "merchandise_require_field_shipping_phone",
                        "gift_certificate_image_file",
                        "gift_certificate_image_mime_type",
                        "authorize_net_public_client_key",
                        "paypal_server_side",
                        "customized_questions",
                    ],
                    "support_phone_extension",
                    "events_count",
                    "classes_count",
                    "auditions_count",
                    "donations_count",
                    "subscriptions_count",
                    "flex_passes_count",
                    "memberships_count",
                    "merchandises_count",
                    "short_timezone",
                    "order_code",
                    "order_count",
                    "order_expiration",
                    "onlyAuditions"
                ]
            );
    }


    public function test_checkout_view()
    {
        $order = Order::where('active', 1)->get()->random()->id;
        $this->get('/orders/'. $order->id .'-'. $order->code)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'order' => [
                        'id',
                        'status',
                        "donation",
                        "paid_amount",
                        "expiration",
                        "will_call",
                        "count",
                        "service_fees",
                        "applied_promo_codes_message",
                        "total_order_promotion_name",
                        'consumer_name',
                        'tickets' => [
                            [
                                "id",
                                "first_name",
                                "last_name",
                                "name",
                                "flex_pass_id",
                                "membership_id",
                                "price",
                                "service_fees",
                                "promotions",
                                "total_order_promotions",
                                "paid_amount",
                                "paid_amount_with_gift_certificates",
                                "ticket_section",
                                "ticket_row",
                                "ticket_column",
                                "ticket_table",
                                "ticket_seat",
                                "service_fee_values",
                                "promotion_values",
                                "available_prices",
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
