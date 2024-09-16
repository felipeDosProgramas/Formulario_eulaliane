/** @type {[HTMLInputElement, HTMLInputElement]} */
let inputs_senha = [
    document.querySelector("input[name='senha']"),
    document.querySelector("input[name='senha-conf']")
];
/** @type {HTMLButtonElement} */
let btn_submit = document.querySelector("button[type='submit']");
/** @type {undefined|number} */
let testar_igualdade = undefined;

/**
 * @param {number} oposto
 * @returns {(function(Event): void)}
 */
let evTestarIgualdade = (oposto) => (ev) => {
    clearTimeout(testar_igualdade);
    testar_igualdade = setTimeout(
        () => btn_submit.disabled = ev.target.value !== inputs_senha[oposto].value,
        250
    );
};

inputs_senha[0].oninput = evTestarIgualdade(1);
inputs_senha[1].oninput =  evTestarIgualdade(0);