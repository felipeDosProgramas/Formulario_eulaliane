/** @type {HTMLFormElement}*/
let form = document.querySelector("form");

/** @type {HTMLInputElement} */
let input_hidden_acao = document.querySelector("input[type='hidden']");

/** @type {{excluir_conta: HTMLButtonElement, alterar_senha: HTMLButtonElement}} */
let btns = {
    alterar_senha: document.querySelector("button#senha"),
    excluir_conta: document.querySelector("button#excluir_conta")
};

btns.alterar_senha.onclick = () => {
    input_hidden_acao.value = "Alterar_senha";
    input_hidden_acao.hidden = false;
    form.submit();
}
btns.excluir_conta.onclick = () => {
    input_hidden_acao.value = "Excluir";
    input_hidden_acao.hidden = true;
    form.submit();
}