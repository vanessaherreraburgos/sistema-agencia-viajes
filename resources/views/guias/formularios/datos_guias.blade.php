
                                <h1>{{trans('copies.form_general.personales')}}</h1>
                                <fieldset>
                                    <!-- <h2>{{trans('copies.form_general.datos_personales')}}</h2> -->
                                    <div class='clearfix'></div>
                                    <div style="height: 45px;"></div>

                                    <!-- Documento y tipo de documento -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('cod_tipo_documento', trans('copies.form_general.tipo_documento').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::select('cod_tipo_documento', $tipos_documento, null, ['id'=>'cod_tipo_documento', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.form_general.selecc_tipo_doc') ]) }}
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('documento', trans('copies.form_general.documento').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('documento', '', ['id'=>'documento', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>
                                    <!-- Nombre y apellido -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('nombres', trans('copies.form_general.nombres').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('nombres', '', ['id'=>'nombres', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>

                                            <div class="col-md-1">
                                                {{ Form::label('apellido1', trans('copies.form_general.primer_apellido').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-2">
                                                {{ Form::text('apellido1', '', ['id'=>'apellido1', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>

                                            <div class="col-md-1">
                                                {{ Form::label('apellido2', trans('copies.form_general.segundo_apellido'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-2">
                                                {{ Form::text('apellido2', '', ['id'=>'apellido2', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>
                                    <!-- Foto y Nacionalidad -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('foto_guia', trans('copies.form_general.foto'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::file('foto_guia', ['id'=>'foto_guia', 'class' => 'form-control-file', 'multiple'=>'true', 'aria-describedby'=>'fileHelp']) }}
                                                <small id="fileHelp" class="form-text text-muted">
                                                    {{trans('copies.form_general.text-foto')}}
                                                </small>
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('cod_pais_nacionalidad', trans('copies.form_general.nacionalidad').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::select('cod_pais_nacionalidad', $nacionalidades, null, ['id'=>'cod_pais_nacionalidad', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.form_general.selecc_nacionalidad') ]) }}
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>
                                <h1>{{trans('copies.form_general.ubicacion')}}</h1>
                                <fieldset>
                                    <!-- <h2>{{trans('copies.form_general.datos_ubicacion')}}</h2> -->
                                    <!--País - Estado - Ciudad-->
                                    <!--Lugar de nacimiento-->

                                    <div class="form-group">
                                        <div class='clearfix'></div>
                                        <div style="height: 45px;"></div>
                                        <div class="col-md-3">
                                            {{ Form::label('lugar_residencia', trans('copies.form_general.lugar_residencia').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                        </div>

                                        <div class="col-md-3">

                                          {{ Form::select('cod_pais_res', [], null, ['id'=>'cod_pais_res', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_pais') ]) }}
                                        </div>

                                        <div class="col-md-3">
                                            {{ Form::select('cod_estado_res', [], null, ['id'=>'cod_estado_res', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_estado') ]) }}
                                        </div>
                                        <div class="col-md-3">

                                            {{ Form::select('cod_ciudad_res', [], null, ['id'=>'cod_ciudad_res', 'class' => 'form-control select2 required', 'placeholder' => trans('copies.generales.select_ciudad') ]) }}

                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>

                                    <!-- Dirección e email -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('direccion_res', trans('copies.form_general.direccion').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('direccion_res', '', ['id'=>'direccion_res', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('email', trans('copies.form_general.email').trans('copies.generales.obligatorio'), ['id'=>'email_guia', 'class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::email('email', '', ['id'=>'email', 'class' => 'form-control required email', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>

                                    <!-- celular y teléfono -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('telefono_celular', trans('copies.form_general.celular').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('telefono_celular', '', ['id'=>'telefono_celular', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('telefono_local', trans('copies.form_general.tel_fijo'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('telefono_local', '', ['id'=>'telefono_local', 'class' => 'form-control', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>

                                </fieldset>

                                <h1>{{trans('copies.form_general.laborales')}}</h1>
                                <fieldset>
                                    <!-- <h2>{{trans('copies.form_general.datos_laborales')}}</h2> -->
                                    <div class='clearfix'></div>
                                    <div style="height: 45px;"></div>


                                    <!-- adjuntos certificado médico y credencial de turismo -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('adjunto_certificado_medico', trans('copies.form_general.adjunto_cert_med').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label ']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::file('adjunto_certificado_medico', ['id'=>'adjunto_certificado_medico', 'class' => 'form-control-file', 'placeholder' => trans('copies.form_general.escriba'), 'aria-describedby'=>'fileHelp']) }}
                                                <small id="fileHelp" class="form-text text-muted">
                                                    {{trans('copies.form_general.text-cert-med')}}
                                                </small>
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('adjunto_credencial', trans('copies.form_general.adjunto_turismo').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::file('adjunto_credencial', ['id'=>'adjunto_credencial', 'class' => 'form-control-file', 'placeholder' => trans('copies.form_general.escriba'), 'aria-describedby'=>'fileHelp']) }}
                                                    <small id="fileHelp" class="form-text text-muted">
                                                        {{trans('copies.form_general.text-cre-tur')}}
                                                    </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>

                                    <!-- Vigencia de cert medico y numero de credencial de turismo -->
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                {{ Form::label('fecha_vigencia_cert_medico', trans('copies.form_general.fecha_vig_cert_med').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::date('fecha_vigencia_cert_medico', '',['id'=>'fecha_vigencia_cert_medico', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>

                                            <div class="col-md-2">
                                                {{ Form::label('credencial_turismo', trans('copies.form_general.creden_turismo').trans('copies.generales.obligatorio'), ['class' => 'col-sm-12 control-label']) }}
                                            </div>
                                            <div class="col-md-4">
                                                {{ Form::text('credencial_turismo_num', '', ['id'=>'credencial_turismo_num', 'class' => 'form-control required', 'placeholder' => trans('copies.form_general.escriba') ]) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='clearfix'></div>
                                    <div style="height: 15px;"></div>
                                </fieldset>


                                

