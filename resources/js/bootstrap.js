import Swal from 'sweetalert2';
import 'bootstrap';
import './fontawesome';

window.Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    animation: false,
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
