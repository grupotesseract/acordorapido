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
            

            // Criando usuário para aluno, escola e admin
            $userAluno = new App\User();
            $userAluno->name = "Evandro Carreira";
            $userAluno->email = "evandro.carreira@gmail.com";
            $userAluno->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userAluno->save();

            $userEscola = new App\User();
            $userEscola->name = "ITE";
            $userEscola->email = "toledo@ite.edu.br";
            $userEscola->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userEscola->save();

            $userAdmin = new App\User();
            $userAdmin->name = "Edilson Britto";
            $userAdmin->email = "edilson.bauru@gmail.com";
            $userAdmin->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userAdmin->save();

            // Criando entidades de aluno e escola e associando o user
            $c = new App\Cliente();
            $c->nome = "Evandro Barbosa Carreira";
            $c->rg = "46.755.061-2";
            $c->user()->associate($userAluno);
            $c->save();

            $e = new App\Empresa();
            $e->nome = "ITE";
            $e->cidade = "Bauru";
            $e->estado = "SP";
            $c->user()->associate($userEscola);
            $e->save();

            $e = new App\Empresa();
            $e->nome = "PREVE";
            $e->cidade = "Bauru";
            $e->estado = "SP";
            $e->save();

            $e = new App\Empresa();
            $e->nome = "COEDUP";
            $e->cidade = "Bauru";
            $e->estado = "SP";
            $e->save();


            /*$u = new App\User();
            $u->name = "Evandro Carreira";
            $u->email = "evandro.carreira@gmail.com";
            $u->password = bcrypt(env('ADMIN_PWD', '123321'));
            $u->save();

            

            $c = new App\Cliente();
            $c->nome = "Evandro Barbosa Carreira";
            $c->rg = "46.755.061-2";
            $c->user()->associate($u);
=======
            // Criando funções dentro do sistema
            $escola = new App\Role();
            $escola->name         = 'escola';
            $escola->display_name = 'Instituição de ensino'; 
            $escola->description  = 'Usuário autorizado a visualizar os dados referentes à sua escola'; 
            $escola->save();
>>>>>>> 983e743feed8cfe86f76186c10e44ecca4072b10

            $admin = new App\Role();
            $admin->name         = 'admin';
            $admin->display_name = 'Admin do sistema';
            $admin->description  = 'Usuário autorizado a excluir, editar e incluir alunos, escolas e novos usuários'; 
            $admin->save();

            $aluno = new App\Role();
            $aluno->name         = 'aluno';
            $aluno->display_name = 'Usuário Aluno'; 
            $aluno->description  = 'Usuário autorizado a visualizar somente seus títulos e infos pessoais'; 
            $aluno->save();

<<<<<<< HEAD
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
            $a->save();*/
            // associando as funções aos usuários
            $userAluno->attachRole($aluno);
            $userEscola->attachRole($escola);
            $userAdmin->attachRole($admin);
            
        } catch (\Illuminate\Database\QueryException $exception) {
            dd($exception);
                echo 'erro';
        }
    }
}