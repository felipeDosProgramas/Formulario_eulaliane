<?php
    require_once "php/logout_user.php";
    if (!isset($_COOKIE['login']))
        header('location: ./index.php');
    $estados = require_once "php/enderecos.php";
    $imprimeCampo = require_once "php/resumo_formulario.php";
    require_once "php/valor_salvo_no_cookie_ou_sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Inscrição</title>
    <link rel="stylesheet" href="css/formulario.css">
    <script src="js/apiMunicipios.js" defer></script>
</head>
<body>
<div class="header">
    <img src="https://lh5.googleusercontent.com/proxy/TrpYbMJJub8TjnWFTFsK5l00n1II-4f9jupBMM70BB2ErY3ehQ1Y-323ZwYkI4Nf_15sniAuI1VTJS5kVkBvm8oragPu4s163QPUcBa7HpwZoCE" alt="Logo da Instituição">
    <h2>Inscrição</h2>
    <h3>Curso Superior em Desenvolvimento de Software Multiplataforma</h3>
    <form action="#" method="post" style="width: 30vw; height: 5vh; position: absolute; top: 0;right: 0">
        <span> <?= valor_salvo_no_cookie_ou_session("email") ?> </span>
        <button type="submit" name="logout" style="width: 7.5vw">Sair</button>
    </form>
</div>
<div class="container">
    <div class="form-container">
        <div>
            <h5>Dados Pessoais</h5>
            <form id="registration-form" method="post" action="#">
                <div class="name-fields">
                    <div class="field-group">
                        <label for="primeiro-nome">Primeiro Nome</label>
                        <input type="text" id="primeiro-nome" name="primeiro-nome" required>
                    </div>
                    <div class="field-group">
                        <label for="segundo-nome">Segundo Nome</label>
                        <input type="text" id="segundo-nome" name="segundo-nome" required>
                    </div>
                </div>
                <div class="field-group">
                    <label for="usuario">Nome de Usuário</label>
                    <div class="input-with-icon">
                        <div class="icon">@</div>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                </div>
                <div class="field-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="field-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="address-fields">
                    <div class="field-group">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" name="cidade" required>
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="estado">Estado</label>
                        <select id="estado" name="estado" required onchange="getMunicipiosDoEstado(parseInt(this.value.trim()))">
                            <option hidden disabled selected>escolha um estado</option>
                            <?= popular_select_de_estados($estados) ?>
                        </select>
                    </div>
                    <div class="field-group">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" required>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="field-group">
                    <label class="unidade-label">UNIDADE</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <label><input type="radio" name="unidade" value="sede" required>Sede</label>
                        </div>
                        <div class="radio-option">
                            <label><input type="radio" name="unidade" value="extensao">Extensão</label>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="field-group">
                    <label class="periodo-label">PERÍODO</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <label><input type="radio" name="periodo" value="vespertino" required>Vespertino</label>
                        </div>
                        <div class="radio-option">
                            <label><input type="radio" name="periodo" value="noturno">Noturno</label>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </div>
    <div class="data-preview-container">
        <h2>Resumo</h2>
        <div class="field">
            <label for="preview-nome">Nome</label>
            <div id="preview-nome">
                <?= $imprimeCampo("primeiro-nome")." ".$imprimeCampo("segundo-nome", "") ?>
            </div>
        </div>
        <div class="field">
            <label for="preview-usuario">Usuário</label>
            <div id="preview-usuario">
                <?= $imprimeCampo("usuario") ?>
            </div>
        </div>
        <div class="field">
            <label for="preview-email">E-mail</label>
            <div id="preview-email">
                <?= $imprimeCampo("email") ?>
            </div>
        </div>
        <div class="field">
            <label for="preview-endereco">Endereço</label>
            <div id="preview-endereco">
                <?= $imprimeCampo("endereco", "-", ", ").
                    $imprimeCampo("cidade", "",  ", ").
                    get_nome_estado_pelo_codigo().
                    $imprimeCampo("cep", "") ?>
            </div>
        </div>
        <div class="field">
            <label for="preview-unidade">Unidade</label>
            <div id="preview-unidade">
                <?= $imprimeCampo("unidade") ?>
            </div>
        </div>
        <div class="field">
            <label for="preview-periodo">Período</label>
            <div id="preview-periodo">
                <?= $imprimeCampo("periodo") ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
