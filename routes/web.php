<?php

use App\Http\Controllers\PainelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitacaoOrcamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\ProcedimentosController;
use App\Http\Controllers\OrcamentoController;


// Rotas da página Inicial

Route::get('/', function() {
    return view('inicio/inicio');
});

Route::get('/inicio', function() {
    return view('inicio/inicio');
});

Route::get('/medico', function() {
    return view('inicio/formularioMedico');
});

Route::get('/paciente', function() {
    return view('inicio/formularioPaciente');
});

Route::post('/processarFormulario', [SolicitacaoOrcamentoController::class, 'store']);

Route::get('/confirmacao', function() {
    return view('inicio/confirmacao');
})->name('confirmacao');





// Rotas da página de Login, Logout

Route::get('/admin/login', function() {
    return view('admin/login');
});

Route::get('/login', function () {
    return view('admin/login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');







// Rotas do Painel

Route::get('/dashboard', [PainelController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/painel', [PainelController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/dashboard/filter', [PainelController::class, 'filtrar'])->name('dashboard.filter')->middleware('auth');

Route::get('/dashboard/order', [PainelController::class, 'ordenar'])->name('dashboard.order')->middleware('auth');

Route::post('/favoritar/{codigoSolicitacao}', [SolicitacaoOrcamentoController::class, 'toggleFavorite'])->middleware('auth');





// Rotas da página de Usuários

Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.usuarios');

Route::get('/usuarios/novo', [UsuariosController::class, 'mostrarRegistro'])->name('usuarios.registrar');
Route::post('/usuarios/novo', [UsuariosController::class, 'registrar'])->name('usuarios.store');

Route::get('/usuarios/editar/{id}', [UsuariosController::class, 'editar'])->name('usuarios.editar');
Route::post('/usuarios/editar/{id}', [UsuariosController::class, 'atualizar'])->name('usuarios.update');

Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');





// Rotas de Procedimentos
Route::get('/procedimentos', [ProcedimentosController::class, 'index'])->name('procedimentos.index');

Route::get('/procedimentos/novo', [ProcedimentosController::class, 'criar'])->name('procedimentos.criar');
Route::post('/procedimentos/novo', [ProcedimentosController::class, 'salvar'])->name('procedimentos.store');

Route::get('/procedimentos/editar/{id}', [ProcedimentosController::class, 'editar'])->name('procedimentos.editar');
Route::put('/procedimentos/editar/{id}', [ProcedimentosController::class, 'atualizar'])->name('procedimentos.update');

Route::delete('/procedimentos/{id}', [ProcedimentosController::class, 'destroy'])->name('procedimentos.destroy');





// Rotas da página de Tabelas de Preços

Route::get('/precos', function() {
    return view('precos/precos');
});











// Rotas de Solicitações de Orçamento

Route::get('/atribuirOrcamento/{codigo_solicitacao}',[SolicitacaoOrcamentoController::class, 'atribuirOrcamento'])->name('orcamento.atribuir');

Route::post('/atualizar_orcamento', [SolicitacaoOrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.atualizar');

Route::get('/orcamento/designar/{id}', [OrcamentoController::class, 'atribuirUsuarios'])->name('orcamento.designar');
Route::post('/orcamento/salvar', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.salvar');

Route::get('/orcamento/cirurgiao/{id}', [OrcamentoController::class, 'cirurgiao'])->name('orcamento.cirurgiao');
Route::post('/orcamento/cirurgiaoSalvar', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.cirurgiaoSalvar');

Route::get('/orcamento/anestesia/{id}', [OrcamentoController::class, 'anestesia'])->name('orcamento.anestesia');
Route::post('/orcamento/anestesistaSalvar', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.anestesistaSalvar');

Route::get('/orcamento/criar/{id}', [OrcamentoController::class, 'criacaoOrcamento'])->name('orcamento.criar');
Route::post('/orcamento/criarSalvar', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.criarSalvar');

Route::get('/orcamento/liberacao/{id}', [OrcamentoController::class, 'liberacao'])->name('orcamento.liberacao');
Route::post('/orcamento/liberar', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.liberar');

Route::get('/orcamento/negociacao/{id}', [OrcamentoController::class, 'negociacao'])->name('orcamento.negociacao');
Route::post('/orcamento/concluir', [OrcamentoController::class, 'atualizarOrcamento'])->name('orcamento.concluir');





// Rotas de Convênios

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
