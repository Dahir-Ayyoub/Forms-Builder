@extends('layouts.app')
@section('content')

<div class="custom-card">
    <div class="custom-card-header">
        <h2>{{ 'Roles And Permissions' }}</h2>
    </div>
    <div class="custom-card-body">
        <div class="button-container">
        <a href="{{ URL('create-roles') }}" class="custom-btn custom-btn-primary">{{ __('Create Roles') }}</a>
        </div>

        <table class="custom-table">
            <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th style="width:20%;" >{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ URL('edit-role') }}/{{ $role->id }}" class="custom-btn custom-btn-secondary">{{ __('Edit') }}</a>
                            <a href="{{ URL('delete-role') }}/{{ $role->id }}" class="custom-btn custom-btn-danger">{{ __('Delete') }}</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

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
        margin-bottom: 20px;
    }

    .custom-btn-primary {
        background-color: #28a745;
        color: #fff;
    }

    .custom-btn-primary:hover {
        background-color: #218838;
    }

    .custom-btn-secondary {
        background-color: #17a2b8;
        color: #fff;
    }

    .custom-btn-secondary:hover {
        background-color: #138496;
    }


     .custom-btn-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .custom-btn-danger:hover {
        background-color: #c82333;
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
    .action-buttons{
        display: flex;
        gap: 5px;
    }

</style>
@endsection
