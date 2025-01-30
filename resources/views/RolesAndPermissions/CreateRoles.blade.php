@extends('layouts.app')

@section('content')

<div class="custom-card">
    <div class="custom-card-header">
        <h2>{{ __('Create New Role') }}</h2>
    </div>
    <div class="custom-card-body">
        <form method="POST" action="{{ URL('add-role') }}" class="custom-form">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Role Name') }}</label>
                <input type="text" required name="name" class="custom-form-control" />
            </div>

            <div class="form-row">
                <div class="form-col">
                    <h3>{{ __('Permissions') }}</h3>
                        <table class="custom-table">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th style="width:20%;">{{ __('Permission') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td class="styled-checkbox">
                                        <input type="checkbox" value="{{ $permission->name }}" name="permission[]"
                                               id="permission_{{ $permission->id }}" />
                                        <label class="checkmark" for="permission_{{ $permission->id }}"></label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>

                <div class="form-col">
                    <h3>{{ __('Users') }}</h3>
                    <div class="form-group">
                    <label for="users">{{ __('Users') }}</label>
                    <div class="select-wrapper">
                    <select class="custom-select" name="users[]" id="users" multiple>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <input type="submit" class="custom-btn custom-btn-success" value="{{ __('Save') }}" />
            </div>

        </form>
    </div>
</div>
@endsection
<style>
   .custom-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 20px;
    }

    .custom-card-header {
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .custom-card-header h2 {
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 0;
    }

    .custom-card-body {
        padding-top: 15px;
    }
    .custom-form {
        display: flex;
        flex-direction: column;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .custom-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }
    .custom-form-control{
        width: 100%;
        padding: 10px 12px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .form-row{
      display: flex;
      flex-wrap: wrap;
       margin-right: -15px;
       margin-left: -15px;
    }
   .form-col {
        flex: 0 0 50%; /* Takes 50% of the available space */
        max-width: 50%; /* Sets a maximum width of 50% */
        padding-right: 15px; /* Add 15px of padding on the right side */
        padding-left: 15px;  /* Add 15px of padding on the left side */
        box-sizing: border-box;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
         margin-bottom: 10px;
    }

    .custom-table th,
    .custom-table td {
        padding: 10px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .custom-table th{
        font-weight: 600;
        border-bottom: 2px solid #ccc;
    }


    .custom-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .styled-checkbox{
        position: relative;
        display: inline-block;
        padding-left: 30px;
    }
    .styled-checkbox input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    .styled-checkbox .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
    }

    .styled-checkbox input[type="checkbox"]:checked + .checkmark {
        background-color: #28a745;
        border: 1px solid #28a745;
    }
    .styled-checkbox .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .styled-checkbox input[type="checkbox"]:checked + .checkmark:after {
        display: block;
    }
    .styled-checkbox .checkmark:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/></svg>") no-repeat right 0.75rem center/1em 1em;
        width: 100%;
        font-size: 1rem;
    }
    .select-wrapper{
        position: relative;
    }

    .custom-select::-ms-expand {
    display: none; /* For IE 11 */
}
.custom-select:focus {
        outline: none;
        border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);

    }
    .custom-btn {
        display: inline-block;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
         margin-bottom: 10px;
    }
    .button-container {
         margin-top: 20px;
    }

    .custom-btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .custom-btn-success:hover {
        background-color: #218838;
    }


</style>



{{-- @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="card">
        <div class="card-header">
            <h1>{{ __('Create New Role') }}</h1>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ URL('add-role') }}">
                @csrf
                <label for="name">{{ __('Role Name') }}</label>
                <input type="text" required name="name" class="form-control" />


                <div class="row">
                    <div class="col-md-6">
                        <h1>{{ __('Permissions') }}</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Permission') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td class="styled-checkbox">
                                            <input type="checkbox" value="{{ $permission->name }}" name="permission[]" id="permission_{{ $permission->id }}" />
                                            <label class="checkmark" for="permission_{{ $permission->id }}"></label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="col-md-6">
                        <h1>{{ __('Users') }}</h1>

                        <label for="users">{{ __('Users') }}</label>
                        <select class="form-control" name="users[]" id="users" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input type="submit" class="btn btn-success" value="{{ __('Save') }}" />
            </form>
        </div>
    </div> --}}
