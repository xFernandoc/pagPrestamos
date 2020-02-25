(function() {
    /**
     * Ajuste decimal de un número.
     *
     * @param {String}  tipo  El tipo de ajuste.
     * @param {Number}  valor El numero.
     * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
     * @returns {Number} El valor ajustado.
     */
    function decimalAdjust(type, value, exp) {
      // Si el exp no está definido o es cero...
      if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
      }
      value = +value;
      exp = +exp;
      // Si el valor no es un número o el exp no es un entero...
      if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
      }
      // Shift
      value = value.toString().split('e');
      value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
      // Shift back
      value = value.toString().split('e');
      return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }
  
    // Decimal round
    if (!Math.round10) {
      Math.round10 = function(value, exp) {
        return decimalAdjust('round', value, exp);
      };
    }
    // Decimal floor
    if (!Math.floor10) {
      Math.floor10 = function(value, exp) {
        return decimalAdjust('floor', value, exp);
      };
    }
    // Decimal ceil
    if (!Math.ceil10) {
      Math.ceil10 = function(value, exp) {
        return decimalAdjust('ceil', value, exp);
      };
    }
  })();
$(document).ready(function () {
    var SERVERURL = "http://" + location.hostname + "/prestamos/";
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(".nav-link").toggleClass('p-0');
        $('.icomas').toggleClass('mr-3');
    });
    var ancho = $(window).width();
    var alto = $(window).height();
    if (ancho <= 768) {
        $("#perfilcc").toggleClass("nav-link");
    };
    $("#min").on("click", function () {
        $("#pnlgrand").toggleClass("d-none");
        $("#pnlpeq").toggleClass("d-none");
    });
    $("#min_peq").on("click", function () {
        $("#pnlgrand").toggleClass("d-none");
        $("#pnlpeq").toggleClass("d-none");
    });

    //Fecha socio
    let f_soc = moment().format("YYYY") - 18;
    f_soc = f_soc + "-" + moment().format("MM") + "-" + moment().format("DD");
    $("#fecha_nac_soc").attr("max", f_soc);

    //Validacion de campos vacios
    $("#txtcant").blur(function () {
        validar("#txtcant", "#error1");
    });
    $("#txtcuota").blur(function () {
        validar("#txtcuota", "#error2");
    });
    $("#txtinte").blur(function () {
        validar("#txtinte", "#error3");
    });

    function validar(id = null, error = null) {
        if ($(id).val() == "") {
            $(id).addClass("vacio");
            $(error).removeClass("d-none");
            $(id).addClass("shake");
        } else {
            $(id).removeClass("vacio");
            $(error).addClass("d-none");
            $(id).removeClass("shake");
        }
        return $(id).val() == "";
    }
    var altura = $("#frmprestamo").height() * 0.75;

    //Definir alto de tabla de simualcion de prestamo
    $("#conttabla").attr("style", "height : " + altura + "px !important");

    //calcular simulacion de prestamo
    $("#btncalpres").on("click", function () {
        if ($("#txtcant").val() != "" && $("#txtcuota").val() != "" && $("#txtinte").val() != "") {
            $("#tbcontenido").empty();
            var cadena = '<thead>' +
                '<tr>' +
                '<th class="text-center border-right font-weight-bold u-regular">#</th>' +
                '<th class="text-center border-right font-weight-bold u-regular">Fecha</th>' +
                '<th class="text-center border-right font-weight-bold u-regular">Saldo</th>' +
                '<th class="text-center border-right font-weight-bold u-regular">Amortiz.</th>' +
                '<th class="text-center border-right font-weight-bold u-regular">Interes</th>' +
                '<th class="text-center font-weight-bold u-regular">Cuota</th>' +
                '</tr>' +
                '</thead>';
            $("#tbcontenido").append(cadena);
            var cantcuo = $("#txtcuota").val();
            var interes = $("#txtinte").val();
            interes = interes / 100;
            var cant = $("#txtcant").val();
            var resultado = ((Math.pow((1 + interes), cantcuo) * interes) / (Math.pow((1 + interes), cantcuo) - 1)) * cant;
            $("#resultado").removeClass("d-none");
            $("#lblcuota").text("S/ " + new Intl.NumberFormat("es-PE").format(Math.round(resultado)));
            llenartb(cantcuo, resultado, cant, interes);
            $("#tbcontenido caption button").addClass("btn ml-1");
            $("#tbcontenido caption button").removeClass("button-default");
            $("#btnsexport").removeClass("d-none");
        } else {
            validar("#txtcant", "#error1");
            validar("#txtcuota", "#error2");
            validar("#txtinte", "#error3");
        }
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    //Llenar tabla para simualcion de prestamos
    function llenartb(cantcuot, monto, total, tem) {
        var fecha = new Date();
        var mes = fecha.getMonth() + 1;
        var dia = fecha.getDate();
        var cadena = "<tbody><tr>" +
            "<td class='text-center'>0</td>" +
            "<td class='text-center'>---</td>" +
            "<td class='text-center'>" + total + "</td>" +
            "<td class='text-center'>---</td>" +
            "<td class='text-center'>---</td>" +
            "<td class='text-center'>---</td>" +
            "</tr>";
        $("#tbcontenido").append(cadena);
        var amorttotal = 0;
        var intertotal = 0;
        for (let index = 0; index < cantcuot; index++) {
            mes = mes + 1;
            var salida = (dia < 10 ? '0' : '') + dia + '/' +
                (mes < 10 ? '0' : '') + mes + '/' + fecha.getFullYear() + '';
            var interes = total * tem;
            var amort = monto - interes;
            total = total - amort;
            amorttotal = amorttotal + amort;
            intertotal = intertotal + interes;
            cadena = "<tr>" +
                "<td class='text-center'>" + (index + 1) + "</td>" +
                "<td class='text-center'>" + salida + "</td>" +
                "<td class='text-center'>" + "S/ " + new Intl.NumberFormat("es-PE").format(Math.round10(total,-2)) + "</td>" +
                "<td class='text-center'>" + "S/ " + new Intl.NumberFormat("es-PE").format(Math.round10(amort,-2)) + "</td>" +
                "<td class='text-center'>" + "S/ " + new Intl.NumberFormat("es-PE").format(Math.round10(interes,-2)) + "</td>" +
                "<td class='text-center'>" + "S/ " + new Intl.NumberFormat("es-PE").format(Math.round10(monto,-2)) + "</td>" +
                "</tr>";
            $("#tbcontenido").append(cadena);
            $("#conttabla").addClass("shadow border");
            $("#listado").val(obtdatos());
        }
        $("#tbcontenido").append("</tbody>");
        var cadena2 = "<tfoot><tr>" +
            "<th class='text-center '></td>" +
            "<th class='text-center'></td>" +
            "<th class='text-center'></td>" +
            "<th class='text-center font-weight-bold u-regular'>" + "S/ " + new Intl.NumberFormat("es-PE").format(amorttotal.toString().substring(0,7)) + "</td>" +
            "<th class='text-center font-weight-bold u-regular'>" + "S/ " + new Intl.NumberFormat("es-PE").format(Math.round10(intertotal,-1)) + "</td>" +
            "<th class='text-center'></td>" +
            "</tr></tfoot>";
        $("#tbcontenido").append(cadena2);
    };
    function obtdatos() {
        var filas = [];
        $("#tbcontenido tbody tr").each(function () {
            var filatemp = [];
            $(this).children("td").each(function () {
                var pos  = $(this).text().includes("S/ ");
                if (pos) {
                    filatemp.push($(this).text().substring(3,$(this).text().length));
                }else{
                    filatemp.push($(this).text());
                }
            });
            filas.push(filatemp);
        });
        return filas;
    }

    //Establecer alto de tabla de socios 
    $("#frmtbsocios").attr("style", "height : " + Math.round(alto * 0.3824) + "px");

    //Busqueda dinamica por dni en socios afiliados

    $("#txtbuscar").keyup(function () {
        var texto = $("#txtbuscar").val();
        $("#tbsocios").empty();
        $.ajax({
            type: "post",
            url: SERVERURL + "functions/formajax/tbsocios.php",
            dataType: "html",
            data: {
                "busq": texto
            },
            success: function (datos) {
                $("#tbsocios").append(datos);
            }
        });
    });
    //Validadcion del dni, si ya existe , si esta vacio o si esta incompleto
    $("#busqdni").on("click", function () {
        var documento = $("#txtbuscar").val();
        $("#icoerror").removeClass();
        $("#icoerror").addClass("fas mr-1 d-none");
        if (documento != "" && documento.length == 8) {
            $.ajax({
                type: "post",
                url: SERVERURL + "functions/formajax/validardni.php",
                dataType: "html",
                data: {
                    busq: documento
                },
                success: function (datos) {
                    if (datos == "1") {
                        $("#icoerror").toggleClass("d-none");
                        $("#icoerror").toggleClass("fa-spinner");
                        $("#icoerror").toggleClass("fa-spin");
                        $("#errorsoc").text("Buscando...");
                        $("#txtnomb").val("");
                        $("#txtape").val("");
                        $("#icoerror").toggleClass("fa-spinner");
                        $("#icoerror").toggleClass("fa-spin");
                        $("#icoerror").toggleClass("fa-exclamation-circle");
                        $("#errorsoc").text("D.N.I ya registrado");
                    } else {
                        $("#icoerror").toggleClass("d-none");
                        $("#errorsoc").text("Buscando...");
                        $("#icoerror").toggleClass("fa-spinner");
                        $("#icoerror").toggleClass("fa-spin");
                        consultarxdni(documento);
                    }
                }
            });
        } else {
            $("#txtnomb").val("");
            $("#txtape").val("");
            $("#icoerror").toggleClass("d-none");
            $("#icoerror").toggleClass("fa-exclamation-circle");
            $("#errorsoc").text("D.N.I incompleto");
        }

    });
    //Consultar dni x ajax con libreria dom html
    function consultarxdni(doc) {
        axios.post(SERVERURL + "functions/formajax/consultardni.php", {
            dni: doc
        }).then(function (res) {
            if (res.data.length > 0) {
                $("#icoerror").toggleClass("d-none");
                $("#icoerror").toggleClass("fa-spinner");
                $("#icoerror").toggleClass("fa-spin");
                $("#errorsoc").text("");
                $("#txtnomb").val(res.data[0]);
                $("#txtape").val(res.data[1] + " " + res.data[2]);
                $("#txtnomb").val() != "" ? $(".cjnomb span").addClass("opac-0") : $(".cjnomb span").removeClass("opac-0");
                $("#txtape").val() != "" ? $(".cjape span").addClass("opac-0") : $(".cjape span").removeClass("opac-0");
            } else {
                $("#txtnomb").val("");
                $("#txtape").val("");
                $("#icoerror").toggleClass("fa-spinner");
                $("#icoerror").toggleClass("fa-spin");
                $("#icoerror").toggleClass("fa-exclamation-circle");
                $("#errorsoc").text("D.N.I no encontrado");
            }
        }).catch(function (error) {
            $("#errorsoc").text("D.N.I no encontrado");
            console.log(error);
        });
    }

    //Inicialmente inicia con los primeros dep/prov/dist
    leerjson("departamentos");
    leerjson("provincias", "#opprov", "01", null);
    leerjson("distritos", "#opdist", "01", "0101");

    //Cambio de distrito
    $("#opdep").on("change", function () {
        var valor = this.value;
        $("#opdist").empty();
        leerjson("provincias", "#opprov", valor, null);
        leerjson("distritos", "#opdist", valor, valor + "01");
        $("#txtdep").val($("#opdep").find("option:selected").text());
    });
    //Cambio de provincia
    $("#opprov").on("change", function () {
        var valorprov = this.value;
        var valordep = $("#opdep").val();
        leerjson("distritos", "#opdist", valordep, valorprov);
    });

    $("#opdist").on("change", function () {
        $("#txtdist").val($("#opdist").find("option:selected").text());
    });
    //leer y llenar lista de departamentos, provincias y distristos
    function leerjson(json, id = null, valordep = null, valorprov = null) {
        $.getJSON(SERVERURL + "json/" + json + ".json", function (datos) {
            $(id).empty();
            $.each(datos, function (index, cont) {
                switch (json) {
                    case "departamentos":
                        $("#opdep").append(new Option(cont["name"], cont["id"]));
                        break;
                    case "provincias":
                        if (cont["department_id"] == valordep) {
                            $("#opprov").append(new Option(cont["name"], cont["id"]));
                        }
                        break;
                    case "distritos":
                        if (cont["department_id"] == valordep && cont["province_id"] == valorprov) {
                            $("#opdist").append(new Option(cont["name"], cont["id"]));
                        }
                        break;
                }
            });
        }).then(function (e) {
            $("#txtprov").val($("#opprov").find("option:selected").text());
            $("#txtdist").val($("#opdist").find("option:selected").text());
        });
    };

    $("#txtdomic").blur(function () {
        $(this).val() == "" ? $(".cjdomc span").removeClass("opac-0") : $(".cjdomc span").addClass("opac-0");
    });

    $("#fecha_nac_soc").blur(function () {
        $(this).val() == "" ? $(".cjcump span").removeClass("opac-0") : $(".cjcump span").addClass("opac-0");
    });
    $("#txtdep").val("AMAZONAS");
    $("#txtprov").val("CHACHAPOYAS");
    $("#txtdist").val("CHACHAPOYAS");
    //Ingresar socio
    $("#btningsoc").on("click", function (e) {
        e.preventDefault();
        if ($("#txtnomb").val() != "" && $("#txtape").val() != "" && $("#fecha_nac_soc").val() != "" && $("#txtdomic").val() != "" && $("#txtcelular").val() != "") {
            $("#infoadd").addClass("d-none");
            $("#loadingsocio").toggleClass("d-none");
            var datos = $("#frmaddsocio").serialize();
            $.ajax({
                type: "post",
                url: SERVERURL + "functions/formajax/ingresarsoc.php",
                dataType: "html",
                data: datos,
                success: function (result) {
                    console.log(result);
                    if (result == "Exito") {
                        $("#loadingsocio").toggleClass("d-none");
                        $.confirm({
                            title: "<div class='u-regular font-weight-bold text-dark'>Exito !</div>",
                            content: "<div class='text-dark'>Socio ingresado correctamente</div>",
                            type: "green",
                            typeAnimated: true,
                            buttons: {
                                Continuar: {
                                    text: "Continuar",
                                    btnClass: 'btn-green',
                                    action: function () {
                                        window.open(SERVERURL + "socioslist", '_parent')
                                    }
                                }
                            }
                        });
                    }
                }
            });
        } else {
            $("#infoadd").removeClass("d-none");
            $("#txtnomb").val() == "" ? $(".cjnomb span").removeClass("opac-0") : $(".cjnomb span").addClass("opac-0");
            $("#txtape").val() == "" ? $(".cjape span").removeClass("opac-0") : $(".cjape span").addClass("opac-0");
            $("#fecha_nac_soc").val() == "" ? $(".cjcump span").removeClass("opac-0") : $(".cjcump span").addClass("opac-0");
            $("#txtdomic").val() == "" ? $(".cjdomc span").removeClass("opac-0") : $(".cjdomc span").addClass("opac-0");
            $("#txtcelular").val() == "" ? $(".cjcelu span").removeClass("opac-0") : $(".cjcelu span").addClass("opac-0");
            if ($("#txtbuscar").val() == "") {
                $("#icoerror").removeClass();
                $("#icoerror").addClass("fas mr-1 d-none");
                $("#errorsoc").text("");
                $("#icoerror").toggleClass("d-none fa-exclamation-circle");
            }
        }
    });
    $(".cjprestamos").attr("style", "height : " + alto * 0.4 + "px");

    if (window.location.pathname.indexOf("account_pres") > 0) {
        var dni = window.location.pathname;
        dni = dni.substring(dni.indexOf("pres/") + 5, dni.length);
        var tipo = "PENDIENTE";
        $.ajax({
            type: "post",
            url: SERVERURL + "functions/formajax/obtpres_pag.php",
            dataType: "html",
            data: {
                "dni": dni,
                "estado": tipo
            },
            success: function (data) {
                if (data != "vacio") {
                    $("#tbpressoc").empty();
                    $("#tbpressoc").append(data);
                } else {
                    $(".cont").addClass("d-none");
                    $(".detalle").removeClass("d-none");
                    $(".detalle div").text("Ningun prestamo pendiente");
                }
            }
        });
        $.ajax({
            type: "post",
            url: SERVERURL + "functions/formajax/obtdeudo.php",
            dataType: "json",
            data: {
                "dni": dni,
            },
            success: function (respuesta) {
                if (eval(respuesta)[0] > 0) {
                    $(".btnsemaforo button").removeClass("btn-success");
                    $(".btnsemaforo button").removeClass("text-white");
                    $(".btnsemaforo button i").removeClass("fa-check-circle");
                    $(".btnsemaforo button span").text("Deudo");
                    $(".btnsemaforo button").addClass("btn-warning");
                    $(".btnsemaforo button").addClass("text-dark");
                    $(".btnsemaforo button i").addClass("fa-exclamation-circle");
                } else if (eval(respuesta)[0] == 0) {
                    $(".btnsemaforo button").removeClass("btn-warning");
                    $(".btnsemaforo button").removeClass("text-dark");
                    $(".btnsemaforo button i").removeClass("fa-exclamation-circle");
                    $(".btnsemaforo button span").text("Limpio");
                    $(".btnsemaforo button").addClass("btn-success");
                    $(".btnsemaforo button").addClass("text-white");
                    $(".btnsemaforo button i").addClass("fa-check-circle");
                }
            }
        })
    }

    $("input:radio[name=estado]").click(function () {
        var tipo = $(this).val();
        var dni = window.location.pathname;
        dni = dni.substring(dni.indexOf("pres/") + 5, dni.length);
        $.ajax({
            type: "post",
            url: SERVERURL + "functions/formajax/obtpres_pag.php",
            dataType: "html",
            data: {
                "dni": dni,
                "estado": tipo
            },
            success: function (data) {
                if (data != "vacio") {
                    $(".cont").removeClass("d-none");
                    $(".detalle").addClass("d-none");
                    $("#tbpressoc").empty();
                    $("#tbpressoc").append(data);
                } else {
                    $(".cont").addClass("d-none");
                    $(".detalle").removeClass("d-none");
                    $(".detalle div").text(tipo == "PENDIENTE" ? "Ningun prestamo pendiente" : "Ninguno prestamo pagado");
                }
            }
        });
    });
    /*
    (function (a) {
        (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
    })(navigator.userAgent || navigator.vendor || window.opera);

    alert(jQuery.browser.mobile);*/
});