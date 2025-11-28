<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_pagina_clientes_sem_autenticacao(): void
    {
        $response = $this->get('/clientes');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_pagina_clientes_com_autenticacao(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/clientes');
        $response->assertStatus(status: 200);
    }
    public function test_inserir_clientes_sem_autenticacao(): void
    {

        $response = $this->post('/clientes', Cliente::factory()->make()->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
    public function test_inserir_clientes_com_autenticacao(): void
    {
        $data = Cliente::factory()->make()->toArray();
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/clientes');
        $this->assertDatabaseHas('clientes', $data);
    }

    public function test_inserir_clientes_com_autenticacao_sem_nome(): void
    {
        $data = Cliente::factory()->make()->toArray();
        unset($data['nome']);
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(status: 302);
        $response->assertSessionHasErrors(['nome']); // Verifica se há erro de validação
        $this->assertDatabaseMissing('clientes', $data); // Verifica que os dados originais não foram inseridos
    }

    public function test_inserir_clientes_com_autenticacao_sem_email(): void
    {
        $data = Cliente::factory()->make()->toArray();
        unset($data['email']);
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(status: 302);
       $this->assertDatabaseHas('clientes', $data);
    }
    public function test_inserir_clientes_com_autenticacao_com_email_invalido(): void
    {
        $data = Cliente::factory()->make()->toArray();
        $originalData = $data; // Salva os dados originais
        $data['email'] = 'emailinvalido';
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(status: 302);
        $response->assertSessionHasErrors(['email']); // Verifica se há erro de validação
        $this->assertDatabaseMissing('clientes', $originalData); // Verifica que os dados originais não foram inseridos
    }
    public function test_inserir_clientes_com_autenticacao_com_telefone_invalido(): void
    {
        $data = Cliente::factory()->make()->toArray();
        $originalData = $data; // Salva os dados originais
        $data['telefone'] = 'telefoneinvalido#@!fakjfdklajf';
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(status: 302);
        $response->assertSessionHasErrors(['telefone']); // Verifica se há erro de validação
        $this->assertDatabaseMissing('clientes', $originalData); // Verifica que os dados originais não foram inseridos
    }
    public function test_inserir_clientes_com_autenticacao_sem_contato(): void
    {
        $data = Cliente::factory()->make()->toArray();
        $originalData = $data; // Salva os dados originais
        unset($data['telefone']);
        unset($data['email']);
        $response = $this->actingAs(User::factory()->create())->post('/clientes', $data);
        $response->assertStatus(status: 302);
        $response->assertSessionHasErrors(['telefone','email']); // Verifica se há erro de validação
        $this->assertDatabaseMissing('clientes', $originalData); // Verifica que os dados originais não foram inseridos
    }

}
