@push('scripts')
<script type="text/javascript">
$(document).ready(function(){

    getNotifications = function(){
        // obtenemos primeramente el token csrf y luego realizamos
        // la solicitud de notificaciones
        $.ajax({
            url : '/token/',
            method : 'GET',
            success: function(response){
                try{
                    if(response.status == "success"){
                        // INICIO obtener las notificaciones
                        $.ajax({
                            url : '/contracts/getNotifications/',
                            method : 'GET',
                            data: { _token: response.token },
                            success: function(data){
                                try{
                                    if(data.status == "success"){
                                        notificaciones = '<li style="font-size: 20px;color:red"><h6>Alertas: Fecha Tope Vigencia Contratos</h6></li>';
                                        parent = document.getElementById('alertas-notificaciones');
                                        alertas = 0;

                                        // LISTADO DE VENCIMEINTO EN PDF ESTIRA DE UNA VISTA
                                        // notificaciones += '<p><u style="font-size: 14px;color:red" target="_blank" href="pdf/panel_contracts4">**** REPORTE DE VENCIMIENTOS: ****</u></p>'
                                        notificaciones += '<p><a style="font-size: 14px;color:red" target="_blank" href="pdf/panel_contracts5">REPORTE DE VENCIMIENTOS PDF</a></p>'
                                        notificaciones += '<p><a style="font-size: 14px;color:red" target="_blank" href="/contracts/exportarexcel6">REPORTE DE VENCIMIENTOS EXCEL</a></p>'

                                        // notificaciones pólizas anticipos
                                        if(data.alerta_advance.length > 0){
                                            data.alerta_advance.forEach(element => {
                                                alertas += 1;
                                                var limite = '';
                                                if(element.dias == 0){
                                                    limite = 'Fecha límite hoy.'
                                                }else if(element.dias == 1){
                                                    limite = 'Fecha límite dentro de 1 día.'
                                                }else{
                                                    limite = 'Fecha límite dentro de '+element.dias+' días.'
                                                }
                                                notificaciones += '<li><div class="media"><div class="media-body">'+
                                                    '<p class="notification-msg">POLIZA: ANTICIPOS - IDDNCP: '+element.pac_id+'</p>'+
                                                    // '<p><a style="font-size: 14px;color:red" target="_blank" href="pdf/panel_contracts4">REPORTE DE VENCIMIENTOS</a>&gt;</p>'
                                                    // '<p class="notification-msg">POLIZA: ANTICIPOS</p>'+
                                                    // '<p class="notification-msg">POLIZA: ANTICIPOS - IDDNCP: '+element.pac_id+' - N° CONTRATO: '+element.llamado+'</p>'+
                                                    '<p class="notification-msg">CONTRATISTA: '+element.contratista+'</p>'+
                                                    '<p style="font-size: 14px;color:red" class="notification-msg">ALERTA:'+(element.fecha_ini)+ ' - VCTO.: '+ (element.fecha_fin)+'</p>'+
                                                    // '<p style="font-size: 14px;color:red" class="notification-msg">FECHA VCTO.: '+ (element.fecha_fin)+'</p>'+
                                                    // '<p><a style="font-size: 14px;color:red" target="_blank" href="pdf/panel_contracts4">REPORTE DE VENCIMIENTOS</a>;</p>'
                                                    '</div></div></li>';3
                                            });

                                        }

                                        // notificaciones pólizas fiel cumplimiento
                                        if(data.alerta_fidelity.length > 0){
                                            data.alerta_fidelity.forEach(element => {
                                                alertas += 1;
                                                var limite = '';
                                                if(element.dias == 0){
                                                    limite = 'Fecha límite hoy.'
                                                }else if(element.dias == 1){
                                                    limite = 'Fecha límite dentro de 1 día.'
                                                }else{
                                                    limite = 'Fecha límite dentro de '+element.dias+' días.'
                                                }
                                                notificaciones += '<li><div class="media"><div class="media-body">'+
                                                    // '<p class="notification-msg">POLIZA: FIEL CUMPLIMIENTO - IDDNCP: '+element.pac_id+'</p>'+

                                                    // '<p class="notification-msg">POLIZA: FIEL CUMPLIMIENTO</p>'+
                                                    // '<p class="notification-msg">POLIZA: FIEL CUMPLIMIENTO - IDDNCP: '+element.pac_id+' - N° CONTRATO: '+element.llamado+'</p>'+
                                                    // '<p class="notification-msg">CONTRATISTA: '+element.contratista+'</p>'+
                                                    // '<p style="font-size: 14px;color:red" class="notification-msg">60 DIAS ANTES: '+ ' FECHA:'+(element.fecha_ini)+'</p>'+
                                                    // '<p style="font-size: 14px;color:red" class="notification-msg">FECHA VCTO.: '+ (element.fecha_fin)+'</p>'+
                                                    '</div></div></li>';3
                                            });
                                        }

                                        // notificaciones += '<p><a style="font-size: 14px;color:red" target="_blank" href="pdf/panel_contracts4">REPORTE DE VENCIMIENTOS</a>;</p>'

                                        if(data.alerta_advance.length > 0 || data.alerta_fidelity.length > 0){
                                            $('#numero-notificaciones').text(alertas);
                                            parent.innerHTML = notificaciones;
                                        }
                                    }else{
                                        console.log(data.message);
                                    }
                                }catch(error2){
                                    console.log(error2);
                                }
                            },
                            error: function(error2){
                                console.log(error2);
                            }
                        });
                        // FIN obtener las notificaciones
                    }
                }catch(error){
                    console.log(error);
                }
            }
        });
    }

    getNotifications();

    // intervalo cada 10 minutos
    setInterval(getNotifications, 10*60*1000);
});
</script>
@endpush
