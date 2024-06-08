<?php

use App\Models\Company;
use App\Models\User;

use function Pest\Laravel\{actingAs, getJson, postJson, patchJson, deleteJson};
use function Pest\Faker\fake;

test('authorization', function () {
    $company = Company::factory()->create();

    $response = getJson(route('companies.index'));
    $response->assertUnauthorized();
    $response = getJson(route('companies.show', $company));
    $response->assertUnauthorized();
    $response = getJson(route('companies.store', $company));
    $response->assertUnauthorized();
    $response = getJson(route('companies.store', $company));
    $response->assertUnauthorized();
    $response = getJson(route('companies.update', $company));
    $response->assertUnauthorized();
    $response = getJson(route('companies.destroy', $company));
    $response->assertUnauthorized();
})->group('companies');

test('companies index', function () {
    $user = User::factory()->create();
    $companies = Company::factory()->for($user)->times(3)->create();

    $response = actingAs($user)
        ->getJson(route('companies.index'));

    $response
        ->assertOk()
        ->assertJson(['data' => $companies->toArray()]);
})->group('companies');

test('show company', function () {
    $user = User::factory()->create();
    $company = Company::factory()->for($user)->create();

    $response = actingAs($user)->getJson(route('companies.show', $company));

    $response
        ->assertOk()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');

test('store company validation', function () {
    $user = User::factory()->create();
    $company = Company::factory()->for($user)->make();

    $response = actingAs($user)
        ->postJson(route('companies.store', collect($company)->except('name')->toArray()));

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name' => 'required']);
})->group('companies');

test('store company', function () {
    $user = User::factory()->create();
    $company = Company::factory()->for($user)->make();

    $response = actingAs($user)
        ->postJson(route('companies.store', $company->toArray()));

    $response
        ->assertCreated()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');

test('update company', function () {
    $user = User::factory()->create();
    $company = Company::factory()->for($user)->create();
    $company->name = fake()->company;

    $response = actingAs($user)
        ->patchJson(route('companies.update', $company), $company->toArray());

    $response
        ->assertOk()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');

test('delete company', function () {
    $user = User::factory()->create();
    $company = Company::factory()->for($user)->create();

    $response = actingAs($user)
        ->deleteJson(route('companies.destroy', $company));

    $response
        ->assertOk()
        ->assertJson(['success' => true]);
})->group('companies');

test('only owners can update their company', function () {
    $companyOwner = User::factory()->create();
    $maliciousUser = User::factory()->create();
    $company = Company::factory()->for($companyOwner)->create();
    $company->user_id = $maliciousUser->id;

    $response = actingAs($maliciousUser)
        ->patchJson(route('companies.update', $company), $company->toArray());

    $response->assertForbidden();
})->group('companies');
