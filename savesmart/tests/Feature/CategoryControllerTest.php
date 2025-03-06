<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), [
            'name' => 'Updated Category Name',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Category Name',
        ]);
        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Catégorie mise à jour avec succès!');
    }

    public function test_can_delete_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category));

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Catégorie supprimée avec succès!');
    }
}
