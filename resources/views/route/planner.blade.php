@extends('layouts.app')

@section('additional_styles')
@endsection

@section('content')
    <div id="route-planner">
        <div class="container py-2">
            <div class="row mt-3">
                <div class="col-12">
                    <h1 class="mb-0">{{ config('app.name') }}</h1>
                    <small class="text-muted">Route Planning</small>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            @include('partials.route-planner')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const setupDropdown = (inputId, dropdownId) => {
            const input = document.getElementById(inputId);
            const dropdown = document.querySelector(`#${inputId} + .dropdown-menu`);
            const hiddenInput = document.getElementById(dropdownId);

            input.addEventListener('input', () => {
                const filter = input.value.toLowerCase();
                const items = dropdown.querySelectorAll('.dropdown-item');
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            dropdown.addEventListener('click', (event) => {
                event.preventDefault();
                const target = event.target;
                if (target.classList.contains('dropdown-item')) {
                    input.value = target.textContent.trim();
                    hiddenInput.value = target.getAttribute('data-value');
                }
            });
        };

        setupDropdown('originInput', 'origin');
        setupDropdown('destinationInput', 'destination');
    });
</script>
@endsection
