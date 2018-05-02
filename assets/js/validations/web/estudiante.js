$(document).ready(function() {

	$("#start_loading_registro").css('display', 'none');
	$("#showContentRegistro").css('display', 'block');

	$("#start_loading_lista_estudiante").css('display', 'none');
	$("#content_lista_estudiante").css('display', 'block');

	//mayusculas
	$('input[type=text]').keyup(function() {
		$(this).val($(this).val().toUpperCase());
	});
    inicalizarDataTable("example");
    
});

function cancelarRegistro() {
    $("#form_crear_estudiante")[0].reset();
}
function cancelarEditRegistro() {
    $("#form_edit_estudiante")[0].reset();
}
function saveEstudent(){
	$("#form_crear_estudiante").validate({

        rules: {
            codigo: { required: true},
            nombre: { required: true, maxlength: 60 },
            ape_pate: { required: true },
            ape_mate: { required: true },
            curp: { required: true },
            year_fecha: { required: true },
            mes_fecha: { required: true },
            lugar_nacimiento: { required: true },
            lugar_recidencia: { required: true },
        },
        messages: {
            codigo: "Codigo es Necesarias",
            nombre: "Nombre es Necesario",
            ape_pate: "Apellido Paterno es Necesarias",
            ape_mate: "Apellido Materno es Necesario",
            curp: "CURP es Necesarias",
            year_fecha: "*",
            mes_fecha: "*",
            lugar_nacimiento: "Lugar Nacimiento es Necesario",
            lugar_recidencia: "Regicidencia Nacimiento es Necesario",
           
        },
        submitHandler: function(){

            var formData = new FormData($(".form_create_estudiante")[0]);

            var l = $("#btn_guardar_estudiante").ladda();
            l.ladda('start');
            $.ajax({
                type: "POST",
                url:baseURL + "web/Estudiantes_ctrl/guardar_estudiante",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta) {
                  var obj = JSON.parse(respuesta);
                    if (obj.resultado === true) {
                       //Limpiar formulario
                       $("#form_crear_estudiante")[0].reset(); 
                       //Mensaje de operación realizada con éxito
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                            };
                        
                        toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');                        
                    }, 1300);
                    }else{
                      sweetAlert("EL TIPO DE ARCHIVO ES INVALIDO","INTENTE CON  OTRO","error");
                    }
                } 
            });
            l.ladda('stop');
        }
    });
}
function validarYear(year){

    anyo=parseInt(year);

    if ((((anyo%100)!=0)&&((anyo%4)==0))||((anyo%400)==0)){

      var HTML = "";
      var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      var num_fila = 1;
          
          HTML += "<option class='' style='width: 10%'' value='' selected disabled hidden>Mes</option>";
          for (l in meses) {

              if (num_fila < 10 ) {
                  HTML += "<option value='0"+num_fila+"'> " + meses[l] +"  </option>";
              }else{
                HTML += "<option value='"+num_fila+"'> " + meses[l] +"  </option>";
              }
            num_fila ++; 
          }
      
      $("#mes_fecha_nacimientoEdit")[0].setAttribute("onchange", "MesBisiesto(value)");
      $("#mes_fecha_nacimientoEdit").html(HTML);
      
    }else{

       var HTML = "";
       var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
          var num_fila = 1;
            
          HTML += "<option class='' style='width: 10%'' value='' selected disabled hidden>Mes</option>";
          for (l in meses) {

              if (num_fila < 10 ) {
                  HTML += "<option value='0"+num_fila+"'> " + meses[l] +"  </option>";
              }else{
                HTML += "<option value='"+num_fila+"'> " + meses[l] +"  </option>";
              }
            num_fila ++; 
          }

       $("#mes_fecha_nacimientoEdit")[0].setAttribute("onchange", "MesNoBisiesto(value)");
       $("#mes_fecha_nacimientoEdit").html(HTML);

     }
}
function MesBisiesto(mes){
   
  var febreroDisiesto =   ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29"];
  var generico31 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
  var generico30 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"];
  
  if (mes == 01) {
       this.generico_31(generico31);
  }
  if (mes == 02) {
    var HTML = "";
    var num_fila = 1;
    for (l in febreroDisiesto) {
            HTML += "<option value='"+febreroDisiesto[l]+"'> " + febreroDisiesto[l] +"  </option>";
        num_fila ++; 
    }
    $("#dia_fecha_nacimientoEdit").html(HTML);

  }
  if (mes == 03) {
    this.generico_31(generico31);
  }
  if (mes == 04) {
      this.generico_30(generico30);
  }
  if (mes == 05) {
     this.generico_31(generico31);
  }
  if (mes == 06) {
      this.generico_30(generico30);
  }
  if (mes == 07) {
      this.generico_31(generico31);
  }
  if (mes == 08) {
      this.generico_31(generico31);
  }
  if (mes == 09) {
      this.generico_30(generico30);
  }
  if (mes == 10) {
      this.generico_31(generico31);
  }
  if (mes == 11) {
      this.generico_30(generico30);
  }
  if (mes == 12) {
      this.generico_31(generico31);
  }
}
function MesNoBisiesto(noB){

  var generico31 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
  var generico30 = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"];
  var febrero =    ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28"];
  
  var HTML = "";
  if (noB == 01) {
       this.generico_31(generico31);
  }
  if (noB == 02) {
      var num_fila = 1;
      for (l in febrero) {
              HTML += "<option value='"+febrero[l]+"'> " + febrero[l] +"  </option>";
          num_fila ++; 
      }
      $("#dia_fecha_nacimientoEdit").html(HTML);  
  }
  if (noB == 03) {
    this.generico_31(generico31);
  }
  if (noB == 04) {
      this.generico_30(generico30);
  }
  if (noB == 05) {
     this.generico_31(generico31);
  }
  if (noB == 06) {
      this.generico_30(generico30);
  }
  if (noB == 07) {
      this.generico_31(generico31);
  }
  if (noB == 08) {
      this.generico_31(generico31);
  }
  if (noB == 09) {
      this.generico_30(generico30);
  }
  if (noB == 10) {
      this.generico_31(generico31);
  }
  if (noB == 11) {
      this.generico_30(generico30);
  }
  if (noB == 12) {
      this.generico_31(generico31);
  }
}
function generico_30(generico30){
   var HTML = "";
   var num_fila = 1;
      for (l in generico30) {
              HTML += "<option value='"+generico30[l]+"'> " + generico30[l] +"  </option>";
          num_fila ++; 
      }
      $("#dia_fecha_nacimientoEdit").html(HTML);  
}
function generico_31(generico31){
   var HTML = "";
   var num_fila = 1;
      for (l in generico31) {
              HTML += "<option value='"+generico31[l]+"'> " + generico31[l] +"  </option>";
          num_fila ++; 
      }
      $("#dia_fecha_nacimientoEdit").html(HTML);  
}
function validarCJ(codigoJ){
  
  
   $.ajax({
      type: "POST",
      url: baseURL + "web/Estudiantes_ctrl/buscar_codigojoven",
      data: {codigoJ: codigoJ}, 
      
       success: function(respuesta){
         var obj = JSON.parse(respuesta);

         if (obj.resultado == true) {
              sweetAlert("YA EXISTE CODIGO JOVEN","INTENTE CON  OTRO","error");

          }else{
              $("#btn_guardar_edit_estudiante").attr("disabled", false);
          }  
      }
    });

}
function validarCurp(input) {
    var curp = input.value.toUpperCase(),        
        valido = "No válido";
        
    if (procesaCurp(curp)) { // ⬅️ Acá se comprueba
        valido = "Válido";
         $("#btn_guardar_estudiante").attr("disabled", false); 

    } else {        
        sweetAlert("CURP NO VALIDO","VULVA A INTENTAR","error");   
        $("#btn_guardar_estudiante").attr("disabled", true); 
        return false;
    }           
}
function procesaCurp(curp){

    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);
    
    if (!validado)  //Coincide con el formato general?
        return false;
    
    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }
      
    if (validado[2] != digitoVerificador(validado[1])) 
        return false;
            
        return true; //Validado
}

/* MODULO DE EDITAR ESTUDIANTES */
function validarCJEditar(codigoJ){
  
  
   $.ajax({
      type: "POST",
      url: baseURL + "web/Estudiantes_ctrl/buscar_codigojoven",
      data: {codigoJ: codigoJ}, 
      
       success: function(respuesta){
         var obj = JSON.parse(respuesta);

         if (obj.resultado == true) {
              sweetAlert("YA EXISTE CODIGO JOVEN","INTENTE CON  OTRO","error");
              $("#btn_guardar_edit_estudiante").attr("disabled", false);
          }else{
              $("#btn_guardar_edit_estudiante").attr("disabled", false);
          }  
      }
    });

}
function validarCurpEditar(input) {
    var curp = input.value.toUpperCase(),        
        valido = "No válido";
        
    if (procesaCurpEditar(curp)) { // ⬅️ Acá se comprueba
        valido = "Válido";
         $("#btn_guardar_edit_estudiante").attr("disabled", false); 

    } else {
        sweetAlert("CURP NO VALIDO","VULVA A INTENTAR","error");   
        $("#btn_guardar_edit_estudiante").attr("disabled", true); 
        return false;
    }
}
function procesaCurpEditar(curp){

    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);
    
    if (!validado)  //Coincide con el formato general?
        return false;
    
    //Validar que coincida el dígito verificador
    function digitoVerificadorEditar(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }
      
    if (validado[2] != digitoVerificadorEditar(validado[1])) 
        return false;
            
        return true; //Validado
}

function editEstudiante(id, codigo_joven,nombre,paterno, materno, curp, nacimiento, lugarNacimiento, lugarRecidencia) {

    document.getElementById("idEditar").innerHTML=id+"";
    document.getElementById("idEditar").value=id;
    document.getElementById("codigoEdit").value=codigo_joven;
    document.getElementById("nombreEdit").value=nombre;
    document.getElementById("paternoEdit").value=paterno;
    document.getElementById("maternoEdit").value=materno;
    document.getElementById("curpEdit").value=curp;

    // var fecha = nacimiento.split("-");

    document.getElementById("fecha_nacimientoEdit").value=nacimiento;
    // document.getElementById("mes_fecha_nacimientoEdit").value=fecha[1];
    // document.getElementById("dia_fecha_nacimientoEdit").value=fecha[2];

    document.getElementById("lugar_nacimientoEdit").value=lugarNacimiento;
    document.getElementById("lugar_recidenciaEdit").value=lugarRecidencia;

}
function deshabilitarEstudiante(id, nombre, paterno, materno) {

    var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
    var text = "<h3>¿SEGURO DE DESHABILITAR ESTUDIANTE?</h3>";
    swal({
        title: text+name,
        type: "warning",
        showCancelButton: true,
        html:true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI, DESHABILITAR AHORA!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: baseURL + "web/Estudiantes_ctrl/deshabilitar_Estudiante",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function () {
                swal("Hecho!", "EMPLEADO CORRECTAMENTE DESHABILITADO!", "success");
                setTimeout(function() {
                    window.location.href = baseURL+"lista-estudiantes";
                }, 2000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });
}
function habilitarEstudiante(id, nombre, paterno, materno) {

    var name = "<p><strong>"+nombre+' '+paterno+ ' '+ materno+"</strong><p>";
    var text = "<h3>¿SEGURO DE HABILITAR EMPLEADO?</h3>";
    swal({
        title: text+name,
        type: "warning",
        html:true,
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI, HABILITAR AHORA!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: baseURL + "web/Estudiantes_ctrl/habilitar_Estudiante",
            type: "POST",
            data: {id: id},
            dataType: "html",
            success: function () {
                swal("Hecho!", "ESTUDIANTE HABILITADO CORRECTAMENTE!", "success");
                setTimeout(function() {
                    window.location.href = baseURL+"lista-estudiantes";
                }, 2000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    });
}

function saveEditEstudiante(){

    $("#form_edit_estudiante").validate({

        rules: {
            codigo: { required: true},
            nombre: { required: true, maxlength: 60 },
            ape_pate: { required: true },
            ape_mate: { required: true },
            curp: { required: true },
            fecha_nacimiento: {required: true},
            lugar_nacimiento: { required: true },
            lugar_recidencia: { required: true }
        },
        messages: {
            codigo: "Codigo es Necesarias",
            nombre: "Nombre es Necesario",
            ape_pate: "Apellido Paterno es Necesarias",
            ape_mate: "Apellido Materno es Necesario",
            curp: "CURP es Necesarias",
            fecha_nacimiento: "Fecha Nacimiento requirido",
            lugar_nacimiento: "Lugar Nacimiento es Necesario",
            lugar_recidencia: "Regicidencia Nacimiento es Necesario"

        },
        submitHandler: function(){

            var dataString = $("#form_edit_estudiante").serialize();
            alert(dataString);
            var l = $("#btn_guardar_edit_estudiante").ladda();
            l.ladda('start');
            $.ajax({
                type: "POST",
                url:baseURL + "web/Estudiantes_ctrl/guardar_estudiante_edit",
                data: dataString,
                success: function(respuesta) {
                    var obj = JSON.parse(respuesta);

                    if (obj.resultado === true) {
                        //Limpiar formulario
                        l.ladda('stop');
                        $("#form_edit_estudiante")[0].reset();
                        $("#form_edit_estudiante").modal('hide');
                        //Mensaje de operación realizada con éxito
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 1500
                            };
                            toastr.success('Los datos se guardaron correctamente', 'GUARDARON DATOS');
                            setTimeout(function() {
                                window.location.href = baseURL + "lista-estudiantes";
                            }, 1300);
                        }, 1300);
                    }
                }
            });
        }
    });

}
