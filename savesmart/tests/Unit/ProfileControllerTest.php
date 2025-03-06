<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileControllerTest extends TestCase
{
    public function test_user_can_create_profile()
    {
        $user = User::factory()->create();  
        $this->actingAs($user); 

        $data = [
            'name' => 'Test Profile',
            'password' => 'password123',
        ];

        $response = $this->post(route('profiles.store'), $data);

        $response->assertRedirect(route('profiles.index'));

        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'name' => 'Test Profile',
        ]);

        $response->assertSessionHas('success', 'Profil créé avec succès !');
    }
}
