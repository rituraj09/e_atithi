<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
@if(session('message') == 'logged in')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        
        Toast.fire({
            icon: 'success',
            title: 'Signed in successfully'
        })
    </script>
@elseif (session('message') == 'room category added')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
        
        Toast.fire({
            icon: 'success',
            title: "{{ session('message')}}"
        })
    </script>
@elseif (session('message') == 'Failed to add room category')
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false, 
        timer: 3000,
        timerProgressBar: true,
    });
    
    Toast.fire({
        icon: 'success',
        title: "{{ session('message')}}"
    })
</script>
@endif

</div>