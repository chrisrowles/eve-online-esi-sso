import Swal from 'sweetalert2';
import { DataTable } from 'simple-datatables';
import 'bootstrap';
import './fontawesome';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#toggle-dark-mode').addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        
        document.querySelectorAll('font').forEach((font) => {
            font.size = 'initial';
            font.color = document.body.classList.contains('dark-mode')
                ? 'white'
                : 'black';
        });
    })
});

window.dataTable = (selector, options = { searchable: false }) => {
    const elem = document.querySelector(selector);
    new DataTable(elem, options);
}
