$('.btn-delete').on('click', function (e) {
    e.preventDefault();
    $('#confirmationModal .modal-title').html('Confirmação');
    $('#confirmationModal .modal-body p').html('Tem certeza que deseja realizar esta ação?');
    let action = $(this).data('action');
    console.log(action);
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

$('.simple-text-editor').wysihtml5({
    toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": false, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": false, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": false, // Button to change color of font
        "blockquote": false
    }
});

$('.medium-text-editor').wysihtml5({
    toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": true, // Button to change color of font
        "blockquote": false
    }
});

const loadingCep = (id) => {
    $(`#street-${id}`).val("...");
    $(`#district-${id}`).val("...");
    $(`#city-${id}`).val("...");
    $(`#uf-${id}`).val("...");
}
$('#cep-place').on('keyup', function(){
    let cep = $(this).val();
    getCep(cep, 'place')
});

const getCep = (cep, id) => {
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validaCep = /^[0-9]{8}$/;
        //Valida o formato do CEP.
        if (validaCep.test(cep)) {
            loadingCep(id);
            const result = consultCep(cep);
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

const consultCep = (cep) => {
    $.getJSON(`https://viacep.com.br/ws/${cep}/json/?callback=?`, function (dados) {
        return dados;
    });
}
const cleanFormCep = (id) => {
    // Limpa valores do formulário de cep.
    $(`#street-${id}`).val("");
    $(`#district-${id}`).val("");
    $(`#city-${id}`).val("");
    $(`#uf-${id}`).val("");
}
