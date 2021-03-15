<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_not_view_contact_page_if_not_login()
    {
        $this->get(route('contacts'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function can_view_login_page()
    {
        $user = User::factory()->create();

        $this->be($user);

        $this->get(route('contacts'))
            ->assertSuccessful()
            ->assertSeeLivewire('contacts');
    }

    /** @test */
    public function a_contact_can_be_created()
    {
        $user = User::factory()->create();

        $this->be($user);

        $contact = Contact::factory()->make();

        Livewire::test('contacts')
            ->set('editing', $contact)
            ->call('save');

        $this->assertTrue(Contact::where('email', $contact->email)->exists());
    }
}
