<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    @if (session('icon') && session('message') ) 
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false, 
                timer: 3000,
                timerProgressBar: true,
                title: "{{ session('message')}}",
                icon: "{{ session('icon') }}"
            });
            Toast.fire();
        </script>
    @endif
    {{-- <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false, 
            timer: 3000,
            timerProgressBar: true,
            title: "{{ session('message')}}".
        });
    </script>

    @if (session('icon') === 'success')
        <script>
            Toast.fire({ icon: 'warning' });
        </script>  
    @elseif (session('icon') === 'warning')
        <script>
            Toast.fire({ icon: 'warning' });
        </script>
    @elseif (session('icon') === 'error')
        <script>
            Toast.fire({ icon: 'warning' });
        </script>
    @elseif (session('icon') === 'failed')
        <script>
            Toast.fire({ icon: 'warning' });
        </script>
    @endif --}}
</div>