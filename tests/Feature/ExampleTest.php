use App\Models\User;

it('returns a successful response for authenticated users', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertStatus(200);
});

it('redirects guests from home to login', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
    $response->assertRedirect('/login');
});