@extends('formbuilder::layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            {{ $pageTitle ?? '' }}
                            <div class="btn-toolbar float-md-right" role="toolbar">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('forms.index') }}" class="btn btn-sm btn-primary float-md-right">
                                        <i class="fa fa-arrow-left"></i> Back To My Forms
                                    </a>
                                    <button class="btn btn-primary btn-sm clipboard"
                                            data-clipboard-text="{{ route('form.render', $form->identifier) }}"
                                            data-message="Link Copied" data-original="Copy Form Link"
                                            title="Copy form URL to clipboard">
                                        <i class="fa fa-clipboard"></i> Copy Form Link
                                    </button>
                                </div>
                            </div>
                        </h5>
                    </div>
                    <form action="{{ route('forms.update', $form) }}" method="POST" id="createFormForm"
                          data-form-method="PUT">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Form Name</label>
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name') ?? $form->name }}" required autofocus
                                               placeholder="Enter Form Name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="form_type" class="col-form-label">Form Type</label>

                                        <select disabled name="form_type" id="form_type" class="form-control"
                                                required="required">
                                            <option value="">Choose Form Type</option>
                                            @foreach(App\Models\Form::$formTypes as $key => $type)
                                                <option value="{{ $key }}"
                                                        @if($form->form_type == $key) selected @endif>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('form_type'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('form_type') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 return_div form_url_edit" style="display: none;">
                                    <div class="form-group">
                                        <label for="form_url_edit" class="col-form-label">Form Url</label>

                                        <input id="form_url_edit" type="text"
                                               class="form-control{{ $errors->has('form_url_edit') ? ' is-invalid' : '' }}"
                                               name="form_url_edit"
                                               value="{{ old('form_url_edit') ?? $form->form_url }}" required autofocus
                                               placeholder="Enter Form Url">

                                        @if ($errors->has('form_url_edit'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('form_url_edit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 return_div2 form_action_edit" style="display: none;">
                                    <div class="form-group">
                                        <label for="form_action_edit" class="col-form-label">Action button name</label>

                                        <input id="form_action_edit" type="text"
                                               class="form-control{{ $errors->has('form_action_edit') ? ' is-invalid' : '' }}"
                                               name="form_action_edit"
                                               value="{{ old('form_action_edit') ?? $form->form_action }}" required
                                               autofocus placeholder="Enter Form Url">

                                        @if ($errors->has('form_action_edit'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('form_action_edit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 return_div2 form_action_edit" style="display: none;">
                                    <div class="form-group">
                                        <label for="form_email_edit" class="col-form-label">Specify email addresses by
                                            separated commas</label>

                                        <input id="form_email_edit" type="text"
                                               class="form-control{{ $errors->has('form_email_edit') ? ' is-invalid' : '' }}"
                                               name="form_email_edit"
                                               value="{{ old('form_email_edit') ?? $form->form_email }}" required
                                               autofocus
                                               placeholder="Enter Specify email addresses by separated commas">

                                        @if ($errors->has('form_email_edit'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('form_email_edit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="visibility" class="col-form-label">Form Visibility</label>

                                        <select name="visibility" id="visibility" class="form-control"
                                                required="required">
                                            <option value="" selected disabled>Select Form Visibility</option>
                                            @foreach(App\Models\Form::$visibility_options as $option)
                                                <option value="{{ $option['id'] }}"
                                                        @if($form->visibility == $option['id']) selected @endif>
                                                    {{ $option['name'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('visibility'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('visibility') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4" style="display: none;" id="allows_edit_DIV">
                                    <div class="form-group">
                                        <label for="allows_edit" class="col-form-label">
                                            Allow Submission Edit
                                        </label>

                                        <select name="allows_edit" id="allows_edit" class="form-control"
                                                required="required">
                                            <option value="0" @if($form->allows_edit == 0) selected @endif>
                                                NO (submissions are final)
                                            </option>
                                            <option value="1" @if($form->allows_edit == 1) selected @endif>
                                                YES (allow users to edit their submissions)
                                            </option>
                                        </select>

                                        @if ($errors->has('allows_edit'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('allows_edit') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 return_div2" style="display: none;">
                                    <div class="alert alert-info" role="alert">
                                        <i class="fa fa-info-circle"></i>
                                        Click on or Drag and drop components onto the main panel to build your form
                                        content.
                                    </div>

                                    <div id="fb-editor" class="fb-editor"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card-footer" id="fb-editor-footer" style="display: none;">
                        <button type="button" class="btn btn-primary fb-clear-btn return_div2" style="display: none;">
                            <i class="fa fa-remove"></i> Clear Form
                        </button>
                        <button type="button" class="btn btn-primary fb-save-btn">
                            <i class="fa fa-save"></i> Submit &amp; Save Form
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
<script type="text/javascript">
    window.FormBuilder = window.FormBuilder || {}
    window.FormBuilder.form_roles = @json($form_roles);

    window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
</script>
<script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}"
        defer></script>
@endpush
