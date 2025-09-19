@extends('adminlte::page')

{{-- Extend and customize the browser title --}}

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')

    <div class="text-center">
        <p class="mb-0">
            &copy; {{ date('Y') }} {{ config('app.company_name', 'WalterMotos') }}
            - Todos los derechos reservados - Version 1.0.0
        </p>
       {{--  <div class="mt-1">
            <a href="https://facebook.com" target="_blank" class="text-white me-3">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://instagram.com" target="_blank" class="text-white me-3">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="mailto:info@waltermotos.com" class="text-white">
                <i class="fas fa-envelope"></i>
            </a>
        </div> --}}
    </div>


@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
    <script>
        $(document).ready(function() {
            // Add your common script logic here...
        });
    </script>
@endpush

{{-- Add common CSS customizations --}}

@push('css')
    <style type="text/css">
        {{-- You can add AdminLTE customizations here --}}
        /*
            .card-header {
                border-bottom: none;
            }
            .card-title {
                font-weight: 600;
            }
            */
    </style>
@endpush
