$(document).ready(function() {
    console.log("hola mudno");

  // mostrarDatos("",1,7);

  // $("input[name=busqueda]").keyup(function(){
  //   textobuscar = $(this).val();
  //   valoroption = $("#cantidad").val();
  //   mostrarDatos(textobuscar,1,valoroption);
  // });

  // $("body").on("click",".paginacion li a",function(e){
  //   e.preventDefault();
  //   valorhref = $(this).attr("href");
  //   valorBuscar = $("input[name=busqueda]").val();
  //   valoroption = $("#cantidad").val();
  //   mostrarDatos(valorBuscar,valorhref,valoroption);
  // });

  // $("#cantidad").change(function(){
  //   valoroption = $(this).val();
  //   valorBuscar = $("input[name=busqueda]").val();
  //   mostrarDatos(valorBuscar,1,valoroption);
  // });

});

// $(document).on("ready", main);

function buscaEstudiante(){

	valorBuscarNombre = $("input[name=nombre]").val();
	valorBuscarPerterno = $("input[name=ap_pat]").val();
	valorBuscarMaterno = $("input[name=ap_mat]").val();

	valoroption = $("#cantidad").val();

	mostrarDatos(valorBuscarNombre ,valorBuscarPerterno, valorBuscarMaterno ,1,valoroption);

}

function mostrarDatos(valorBuscarNombre ,valorBuscarPerterno, valorBuscarMaterno,pagina,cantidad){

    $.ajax({    
       url: baseURL + "web/saldo_ctrl/mostrar",
       type: "POST",
       data: {nombre:valorBuscarNombre, paterno: valorBuscarPerterno, materno: valorBuscarMaterno ,nropagina:pagina,cantidad:cantidad},
       dataType:"json",
       success:function(response){
      		console.log(response);
       filas = "";
       $.each(response.estudiante,function(key,item){

	        filas += "<tr> ";
	          filas += "<td style='text-align: left;'>";
	            filas += "<label id='codigo_joven"+item.id_usuario+"'>"+item.codigo_joven+"</label>";
	          filas += "</td> +";
	          filas += "<td style='text-align: left;'>";
	            filas += "<label id='nombre"+item.id_usuario+"'>"+item.nombre+"</label>";
	          filas += "</td>";
	          filas += "<td style='text-align: left;'>";
	            filas += "<label id='paterno"+item.id_usuario+"'>"+item.ap_pat+"</label>";
	          filas += "</td>";
	          filas += "<td>";
	            filas += "<label id='materno"+item.id_usuario+"'>"+item.ap_mat+"</label>";
	          filas += "</td>"; 
	          filas += "<td>";
	            filas += "<label id='curp"+item.id_usuario+"'>"+item.curp+"</label>";
	          filas += "</td>";
             filas += "<td>"; 
              filas += "<label id='saldo"+item.id_usuario+"'>"+item.saldo+"</label>";
            filas += "</td>";
	          filas += "<td>"; 
	            filas += "<label id='fecha_nacimiento"+item.id_usuario+"'>"+item.fecha_nacimiento+"</label>";
	          filas += "</td>";
	          filas += "<td>";
	            filas += "<button type='button' onclick='ajaxConsultas("+item.id_usuario+")' class='col-gl-9 btn btn-primary text-center'>Recargar</button>";
	          filas += "</td>";
	        filas += "</tr>";  
    	});

       $("#tbclientes tbody").html(filas);
       linkseleccionado = Number(pagina);
       //total registros
       totalregistros = response.totalregistros;
       //cantidad de registros por pagina
       cantidadregistros = response.cantidad;

       numerolinks = Math.ceil(totalregistros/cantidadregistros);
       paginador = "<ul class='pagination'>";
       if(linkseleccionado>1){
          paginador+="<li><a href='1'>&laquo;</a></li>";
          paginador+="<li><a href='"+(linkseleccionado-1)+"' '>&lsaquo;</a></li>";
       }
       else{
        paginador+="<li class='disabled'><a href='#'>&laquo;</a></li>";
        paginador+="<li class='disabled'><a href='#'>&lsaquo;</a></li>";
       }
       //muestro de los enlaces 
       //cantidad de link hacia atras y adelante
       cant = 2;
       //inicio de donde se va a mostrar los links
       pagInicio = (linkseleccionado > cant) ? (linkseleccionado - cant) : 1;
       //condicion en la cual establecemos el fin de los links
       if (numerolinks > cant)
       {
        //conocer los links que hay entre el seleccionado y el final
        pagRestantes = numerolinks - linkseleccionado;
        //defino el fin de los links
        pagFin = (pagRestantes > cant) ? (linkseleccionado + cant) :numerolinks;
       }
       else 
       {
        pagFin = numerolinks;
       }

       for (var i = pagInicio; i <= pagFin; i++) {
        if (i == linkseleccionado)
          paginador +="<li class='active'><a href='javascript:void(0)'>"+i+"</a></li>";
        else
          paginador +="<li><a href='"+i+"'>"+i+"</a></li>";
       }
      //condicion para mostrar el boton sigueinte y ultimo
      if(linkseleccionado<numerolinks)
      {
        paginador+="<li><a href='"+(linkseleccionado+1)+"' >&rsaquo;</a></li>";
        paginador+="<li><a href='"+numerolinks+"'>&raquo;</a></li>";

      }
      else
      {
        paginador+="<li class='disabled'><a href='#'>&rsaquo;</a></li>";
        paginador+="<li class='disabled'><a href='#'>&raquo;</a></li>";
      }
      
      paginador +="</ul>";
      $(".paginacion").html(paginador);

    }
  });
}