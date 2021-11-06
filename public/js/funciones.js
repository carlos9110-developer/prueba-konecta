const IdiomaDataTable = {
    "decimal": "",
    "emptyTable": "No hay datos",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
    "infoFiltered": "(Filtro de _MAX_ total registros)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ registros",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "No se encontraron coincidencias",
    "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar orden de columna ascendente",
        "sortDescending": ": Activar orden de columna desendente"
    }
};

var responsiveFunciones;

const formatNumber = {
    separador: ".", // separador para los miles
    sepDecimal: ',', // separador para los decimales
    formatear: function(num) {
        num += '';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
        while (regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }
        return this.simbol + splitLeft + splitRight;
    },
    new: function(num, simbol) {
        this.simbol = simbol || '';
        return this.formatear(num);
    }
}

var Funciones = (function() {
    return {
        retornarIdiomaDatatable: function() {
            return IdiomaDataTable;
        },
        esconderAlertBootstrap: function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                });
            }, 4500);
        },
        isNumberKey: function(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        },
        formatearNumero: function(numero) {
            return formatNumber.new(numero)
        },
        determinarResponsive: function(parametro) {
            if (screen.width <= parametro) {
                return true;
            }
            return false;
        }
    }
})();