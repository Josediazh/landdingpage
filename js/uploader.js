var formfield;
/* user clicks button on custom field, runs below code that opens new window */
var custom_uploader;
var images = [];
var paginas = [];
var posicion = -1;
var seccion = '';
var tiposubida = '';
jQuery('.onetarek-upload-button').click(function (e) {

    seccion = jQuery(this).data('nameseccion');
    tiposubida = jQuery(this).data('multiple');
    e.preventDefault();
    // obtiene el último div contenedor de las imagenes y respalda su posición

    if (jQuery('.items_' + seccion + ' div:last-of-type').data('position') != undefined) {
        posicion = jQuery('.items_' + seccion + ' div:last-of-type').data('position');
    }

    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
        custom_uploader.open();
        return;
    }
    //Extend the wp.media object
    custom_uploader = wp.media({
        title: 'Agregar imagen',
        button: {
            text: 'Seleciona una imagen'
        },
        multiple: tiposubida
    });

    custom_uploader.on('select', function () {

        attachment = custom_uploader.state().get('selection').toJSON();
        if (jQuery('#image_location_' + seccion).val() != "") {
            //images = JSON.parse( $('#image_location').val() );
            images = JSON.parse(jQuery('#image_location_' + seccion).val());
        }
        jQuery.each(attachment, function (i, val) {
            images.push({
                name: val.name,
                full: val.url,
                id: val.id
            });
            posicion = parseInt(posicion) + parseInt(1);
            jQuery('.items_' + seccion).append('<div class="gal-img" data-position="' + (posicion) + '"><img src="' + val.url + '" ><a data-seccion="' + seccion + '" class="remove_img">Borrar</a></div>');
        });
        jQuery('#image_location_' + seccion).val(JSON.stringify(images));
        console.log(images);
    });
    //Open the uploader dialog
    custom_uploader.open();
});

jQuery('.items_img_after').on('click', '.remove_img', function () {

    var seccioninputgal = jQuery(this).data('seccion');

    if (confirm("¿Esta seguro que desea eliminar esta imagen?")) {
        var arr = JSON.parse(jQuery('#image_location_' + seccioninputgal).val());
        arr.splice(jQuery(this).parent().data('position'), 1);
        jQuery(this).parent().remove();
        jQuery('#image_location_' + seccioninputgal).val(JSON.stringify(arr));
    }
});


window.old_tb_remove = window.tb_remove;
window.tb_remove = function () {
    window.old_tb_remove(); // calls the tb_remove() of the Thickbox plugin
    formfield = null;
};