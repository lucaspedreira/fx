export const currencyMask = (value) => {
    // Checa se o valor começa com '-' ou foi removido
    let isNegative = false;

    if (value.startsWith('-')) {
        isNegative = true;
        value = value.substring(1); // Remove o '-' para formatar o número
    }

    // Remove tudo que não for número
    let v = value.replace(/[^\d]/g, '');

    // Caso o usuário tenha removido o valor inteiro
    if (v === '') {
        return isNegative ? '-' : '';
    }

    // Formata o valor para duas casas decimais
    v = (parseFloat(v) / 100).toFixed(2);

    // Substitui o ponto por vírgula
    v = v.replace(".", ",");

    // Adiciona separadores de milhar
    v = v.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

    // Retorna o valor com ou sem o '-' dependendo do que o usuário colocou
    return isNegative ? '-' + v : v;
};
