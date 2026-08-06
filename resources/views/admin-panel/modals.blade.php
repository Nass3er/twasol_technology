@section('plugins.sweetalert2', true)

@if (session()->has('add'))
    <script>
        window.onload = function() {

            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: '{{ __("adminlte::adminlte.alert_add") }}'
            });
        }
    </script>
        @php
        \Illuminate\Support\Facades\session::forget('add');
        @endphp
@endif

@if (session()->has('edit'))
    <script>
        window.onload = function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: '{{ __("adminlte::adminlte.alert_edit") }}' 
            });
            
        }
    </script>
        @php
        \Illuminate\Support\Facades\session::forget('edit');
        @endphp
@endif

@if (session()->has('delete'))
    <script>
        window.onload = function() {

            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: '{{ __("adminlte::adminlte.alert_delete") }}'
            });
        }
    </script>
@endif
@if (session()->has('warning'))
<script>
        var warning = "{{ session('warning') }}";
        if (warning != '')
        {window.onload = function() {

            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "warning",
                title: '{{ __("adminlte::adminlte.warning") }}'+'\n'+ warning
            });
        }}
        // @php
        // session(['error' => null]);
        // \Illuminate\Support\Facades\session::forget('error');
        // @endphp
        
    </script>
@endif
@if (session('error'))
<script>
        var error = "{{ session('error') }}";
        if (error != '')
        {window.onload = function() {

            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: error,
            });
        }}        
        console.log('error toast');
        </script>
@endif

@if (session('success'))
<script>
    var success = "{{ session('success') }}";
        if (success != '')
        {window.onload = function() {
            
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: success
            });
        }}        
        console.log('success toast');
        </script>
@endif
