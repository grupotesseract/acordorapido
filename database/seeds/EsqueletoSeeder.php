<?php

use Illuminate\Database\Seeder;

/**
 * Class EsqueletoSeeder.
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
            $userAluno->name = 'Evandro Carreira';
            $userAluno->email = 'evandro.carreira@gmail.com';
            $userAluno->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userAluno->save();
            $userEscola = new App\User();
            $userEscola->name = 'Escola Teste';
            $userEscola->email = 'toledo@ite.edu.br';
            $userEscola->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userEscola->save();
            $userAdmin = new App\User();
            $userAdmin->name = 'Edilson Alexandre Britto';
            $userAdmin->email = 'edilson.bauru@gmail.com';
            $userAdmin->password = bcrypt(env('ADMIN_PWD', '123321'));
            $userAdmin->save();

            // Criando entidades de aluno e escola e associando o user
            $c = new App\Cliente();
            $c->nome = 'Evandro Barbosa Carreira';
            $c->rg = '46.755.061-2';
            $c->user()->associate($userAluno);
            $c->save();

            $e = new App\Empresa();
            $e->nome = 'EscolaTeste';
            $e->cidade = 'Bauru';
            $e->estado = 'SP';
            $e->user()->associate($userEscola);
            $e->save();

            // Criando funções dentro do sistema
            $escola = new App\Role();
            $escola->name = 'escola';
            $escola->display_name = 'Instituição de ensino';
            $escola->description = 'Usuário autorizado a visualizar os dados referentes à sua escola';
            $escola->save();

            $admin = new App\Role();
            $admin->name = 'admin';
            $admin->display_name = 'Admin do sistema';
            $admin->description = 'Usuário autorizado a excluir, editar e incluir alunos, escolas e novos usuários';
            $admin->save();
            
            $aluno = new App\Role();
            $aluno->name = 'aluno';
            $aluno->display_name = 'Usuário Aluno';
            $aluno->description = 'Usuário autorizado a visualizar somente seus títulos e infos pessoais';
            $aluno->save();

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
