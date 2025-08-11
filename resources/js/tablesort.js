import Tablesort from 'tablesort';
window.Tablesort = Tablesort; // plugin needs global

function initTablesort() {
    document.querySelectorAll('table[data-sortable]').forEach((t) => new Tablesort(t));
}

// Load the number sort plugin after the global is set
import('tablesort/src/sorts/tablesort.number.js')
    .then(() => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initTablesort, { once: true });
        } else {
            initTablesort();
        }
    });
