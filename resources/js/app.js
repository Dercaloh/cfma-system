import './bootstrap';

import Alpine from 'alpinejs'
import autocompleteSelect from './components/autocomplete-select.js'

Alpine.data('autocompleteSelect', autocompleteSelect)

window.Alpine = Alpine
Alpine.start()
