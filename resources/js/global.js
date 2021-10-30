const { default: Axios } = require("axios");

$('.btn-delete').on('click', function (e) {
    e.preventDefault();
    $('#confirmationModal .modal-title').html('Confirmação');
    $('#confirmationModal .modal-body p').html('Tem certeza que deseja realizar esta ação?');
    let action = $(this).data('action');
    $('#delete-form').attr('action', action);
    $('#confirmationModal').modal('show');
});
$('.select2').select2({
    allowClear: true,
    placeholder: {
        id: "",
        placeholder: "Escolha..."
    }
});


$('.medium-text-editor').wysihtml5({
    toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": false, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": false, // Button to change color of font
        "blockquote": false
    }
});

const loadingCep = (id) => {
    $(`#street-${id}`).val("...");
    $(`#district-${id}`).val("...");
    $(`#city-${id}`).val("...");
    $(`#uf-${id}`).val("...");
}
$('#cep-place').on('keyup', function () {
    let cep = $(this).val();
    getCep(cep, 'place')
});

const getCep = async (cep, id) => {

    if (cep != "") {
        //Expressão regular para validar o CEP.
        cep = cep.replace(/\D/g, '');
        var validaCep = /^[0-9]{8}$/;
        //Valida o formato do CEP.
        if (validaCep.test(cep)) {
            loadingCep(id);
            const result = await consultCep(cep);
            if (!("erro" in result)) {
                setDataCep(result, id);
            }
        }
        else {
            cleanFormCep(id);
        }
    } else {
        cleanFormCep(id);
    }
}

const setDataCep = (data, id) => {
    $(`#street-${id}`).val(data.logradouro);
    $(`#district-${id}`).val(data.bairro);
    $(`#city-${id}`).val(data.localidade);
    $(`#uf-${id}`).val(data.uf);
}

const consultCep = async (cep) => {
    const response = await axios.get(`https://viacep.com.br/ws/${cep}/json/?callback=?`);
    let result = response.data.replace("(", "");
    result = result.replace(")", "");
    result = result.replace(";", "");
    result = result.replace("?", "");
    return JSON.parse(result);
}
const cleanFormCep = (id) => {
    // Limpa valores do formulário de cep.
    $(`#street-${id}`).val("");
    $(`#district-${id}`).val("");
    $(`#city-${id}`).val("");
    $(`#uf-${id}`).val("");
}

function getFormattedDate(date) {
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;

    return day + '/' + month + '/' + year;
}

function copyClipboard() {
    $('input#link').select();
    var copiar = document.execCommand('copy');
    if (copiar) {
        $('#copyClipboard').popover();
    } else {
        alert('Erro ao copiar, seu navegador pode não ter suporte a essa função.');

    }
}


$('.input-slug').keyup(function () {
    var slug = slugify($(this).val());
    $(this).val(slug);
});

function slugify(string) {
    const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
    const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
    const p = new RegExp(a.split('').join('|'), 'g')
    return string.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with ‘and’
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
    /*
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
    */
}

$('[data-mask]').inputmask();


function floatToReal(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ?
        "-" :
        "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(
        n -
        i).toFixed(c).slice(2) : "");
}

function realToFloat(amount) {
    amount = amount.replace(/\./g, "");
    amount = amount.replace(",", ".");
    amount = parseFloat(amount);
    return amount;
}

function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}


$(document).ready(function () {
    $('.input-phone').each(function () {
        var phone = $(this).val().replace(/\D/g, '');
        if (phone.length > 10) {
            $(this).inputmask({
                "mask": "(99) 99999-9999",
                "placeholder": " "
            });
        } else {
            $(this).inputmask({
                "mask": "(99) 9999-99999",
                "placeholder": " "
            });
        }
    });

    $('.input-cep').inputmask({
        "mask": "99999-999",
        "placeholder": "_"
    });

    $('.input-cnpj').inputmask({
        "mask": "99.999.999/9999-99",
        "placeholder": "_"
    });
    $('.input-hour').inputmask({
        "mask": "99:99",
        "placeholder": "_"
    });

});

$('.input-phone').focusout(function () {
    var phone = $(this).val().replace(/\D/g, '');
    if (phone.length > 10) {
        $(this).inputmask({
            "mask": "(99) 99999-9999",
            "placeholder": " "
        });
    } else {
        $(this).inputmask({
            "mask": "(99) 9999-99999",
            "placeholder": " "
        });
    }
});

$('.alert .close').click(function () {
    $(this).parent().hide();
});

$('.input-date').datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true
});

$(".input-markup").maskMoney({
    thousands: '.',
    decimal: ',',
    allowZero: true,
    precision: 4,
    symbolStay: true
});

$(".input-markup").each(function () {
    if ($(this).val() == '') {
        $(this).val('0,0000');
    }
});
$(".input-money").maskMoney({
    thousands: '.',
    decimal: ',',
    allowZero: true,
    symbolStay: true
});

$(".input-money").each(function () {
    if ($(this).val() == '') {
        $(this).val('0,00');
    }
});

$('.readonly').filter_input({
    regex: '[*]',
    events: 'keypress paste',
});
