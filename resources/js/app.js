import Swal from 'sweetalert2';
import { DataTable } from 'simple-datatables';
import 'bootstrap';
import './fontawesome';

document.addEventListener('DOMContentLoaded', () => {
    const toggleDarkMode = () => {
        document.body.classList.toggle('dark-mode');

        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('dark-mode', isDarkMode);

        document.querySelectorAll('font').forEach((font) => {
            font.size = 'initial';
            font.color = isDarkMode ? 'white' : 'black';
        });
    };

    const darkModePreference = localStorage.getItem('dark-mode');
    if (darkModePreference === 'true') {
        document.body.classList.add('dark-mode');
        document.querySelector('#toggle-dark-mode').checked = true;
    }

    document.querySelector('#toggle-dark-mode').addEventListener('click', toggleDarkMode);
});

window.dataTable = (selector, options = { searchable: false }) => {
    const elem = document.querySelector(selector);
    new DataTable(elem, options);
}
