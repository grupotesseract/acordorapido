<?php

use Illuminate\Database\Seeder;

/**
 * Class EsqueletoSeeder
 */
class EsqueletoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            
            $u = new App\User();
            $u->nome = "Evandro Carreira";
            $u->email = "evandro.carreira@gmail.com";
            $u->senha = bcrypt(env('ADMIN_PWD', '123321'));
            $u->save();

            $e = new App\Empresa();
            $e->nome = "UNIP";
            $e->save();

            $c = new App\Cliente();
            $c->nome = "Evandro Barbosa Carreira";
            $c->user()->associate($u);
            $c->empresa()->associate($e);

            $c->save();

            

            $t = new App\Titulo();
            $t->estado = "azul";
            $t->cliente()->associate($c);
            $t->empresa()->associate($e);
            $t->save();

            $a = new App\Aviso();
            $a->titulo = "Pague o aluguel";
            $a->texto = "Olá! Para manter suas contas em dia, passe no banco na próxima semana";
            $a->user()->associate($u);
            $a->cliente()->associate($c);
            $a->save();


        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}