<table class="table table-busered table-hover mt-3">
    <thead class="thead-dark">
      <h2>ALERTA DE DETALLES DE PÓLIZAS</h2>
{{-- @endif --}}


    {{-- <h2>LLAMADOS</h2> --}}
        <table>
            <tr>
                <th>#</th>                
                <th>IDDNCP</th>
                <th>N°Contrato</th>
                <th>Contratista</th>                
                <th>Tipo Contrato</th>
                <th>Monto total LLAMADO</th>
                <th>Alerta_Anticipo</th>
                <th>Vcto_Anticipo</th>
                <th>Alerta_Fiel Cumpl.</th>
                <th>Vcto_Fiel Cumpl.</th>
                <th>Alerta_Accid.Pers.</th>
                <th>Vcto_Accid.Pers.</th>
                <th>Alerta_Todo Riesgo</th>
                <th>Vcto_Todo Riesgo</th>
                <th>Alerta_Resp.Civil</th>
                <th>Vcto_Resp.Civil</th>                
                {{-- <th>Comentarios</th>                
                <th>Fecha Firma Contr.</th>                
                <th>Estado</th>
                <th>Modalidad</th> --}}
                
            </tr>

            @for ($i = 0; $i < count($contracts); $i++)
            <tr>
                <td>{{ ($i+1) }}</td>
                {{-- <td> {{ $contracts[$i]->llamado }}</td> --}}
                <td> {{ number_format($contracts[$i]->iddncp,'0', ',','.') }} </td>
                <td> {{ $contracts[$i]->number_year }}</td>
                <td> {{ $contracts[$i]->contratista}}</td>
                <td> {{ $contracts[$i]->tipo_contrato}}</td>
                <td> Gs.{{ number_format($contracts[$i]->total_amount,'0', ',','.') }} </td>
                
                @if ($contracts[$i]->fecha_tope_advance <= today())                   
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_advance)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_advance )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_advance)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_advance )) }}</td>
                @endif

                
                <td>{{ is_null($contracts[$i]->vcto_adv)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_adv )) }}</td>
                
                @if ($contracts[$i]->fecha_tope_fidelity <= today())                   
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_fidelity)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_fidelity )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_fidelity)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_fidelity )) }}</td>
                @endif
               
                <td>{{ is_null($contracts[$i]->vcto_fid)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_fid )) }}</td>
                
                @if ($contracts[$i]->fecha_tope_accidents <= today())                   
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_accidents)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_accidents )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_accidents)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_accidents )) }}</td>
                @endif
                
                <td>{{ is_null($contracts[$i]->vcto_acc)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_acc )) }}</td>
                
                @if ($contracts[$i]->fecha_tope_risks <= today())                   
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_risks)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_risks )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_risks)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_risks )) }}</td>
                @endif
                                
                <td>{{ is_null($contracts[$i]->vcto_ris)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_ris )) }}</td>
                
                @if ($contracts[$i]->fecha_tope_civil_resp <= today())
                    <td style="color:#ff0000">{{ is_null($contracts[$i]->fecha_tope_civil_resp)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_civil_resp )) }}</td>
                @else
                    <td>{{ is_null($contracts[$i]->fecha_tope_civil_resp)? "-" : date('d/m/Y', strtotime($contracts[$i]->fecha_tope_civil_resp )) }}</td>
                @endif                
                
                <td>{{ is_null($contracts[$i]->vcto_civ)? "-" : date('d/m/Y', strtotime($contracts[$i]->vcto_civ )) }}</td>
                {{-- <td> {{ date('d/m/Y', strtotime($contracts[$i]->advance_validity_from )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->advance_validity_to )) }}</td> --}}
                {{-- <td>{{ is_null($contract->number)? $contract->description : $contract->modality->description." N° ".$contract->number."/".$contract->year."-".$contract->description }} --}}
                {{-- <td>{{ is_null($orders[$i]->number)? $orders[$i]->description." - ".$orders[$i]->dependency->description : $orders[$i]->modality->code." N° ".$orders[$i]->number."/".$orders[$i]->year." - ".$orders[$i]->description." - ".$orders[$i]->dependency->description }}</td> --}}
                {{-- <td> {{ date('d/m/Y', strtotime($contracts[$i]->fidelity_validity_from )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->fidelity_validity_to )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->accidents_validity_from )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->accidents_validity_to )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->risks_validity_from )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->risks_validity_to )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->civil_resp_validity_from )) }}</td>
                <td> {{ date('d/m/Y', strtotime($contracts[$i]->civil_resp_validity_to )) }}</td> --}}
                {{-- <td> {{ $contracts[$i]->comentarios}}</td> --}}
            </tr>
            @endfor
            {{-- @endforeach --}}
        </table>
    </div>
    </tbody>
  </table>