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
            $u->name = "Evandro Carreira";
            $u->email = "evandro.carreira@gmail.com";
            $u->password = bcrypt(env('ADMIN_PWD', '123321'));
            $u->save();

            $e = new App\Empresa();
            $e->nome = "UNIP";
            $e->cidade = "Bauru";
            $e->estado = "SP";
            $e->save();

            $c = new App\Cliente();
            $c->nome = "Evandro Barbosa Carreira";
            $c->rg = "46.755.061-2";
            $c->user()->associate($u);

            $c->save();

            $t = new App\Titulo();
            $t->estado = "verde";
            $t->valor = 1380.45;
            $t->titulo = "0834A34002017";
            $t->pago = true;
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
            dd($exception);
                echo 'erro';
        }
    }
}