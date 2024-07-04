import Swal from 'sweetalert2';
import { DataTable } from 'simple-datatables';
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

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#toggle-dark-mode').addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    })
});

window.dataTable = (selector, options = { searchable: false }) => {
    const elem = document.querySelector(selector);
    new DataTable(elem, options);
}
