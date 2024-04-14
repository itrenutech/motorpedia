<script>
    @if(Session::has('flash_message_success'))
    Command: toastr["success"]("{{Session::get('flash_message_success')}}")
    @endif
    @if(Session::has('flash_message_error'))
    Command: toastr["error"]("{{Session::get('flash_message_error')}}")
    @endif
    @if(Session::has('flash_message_warning'))
    Command: toastr["warning"]("{{Session::get('flash_message_warning')}}")
    @endif
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>