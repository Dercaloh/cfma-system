export default function autocompleteSelect(id, options, initialValue = '') {
    return {
        id,
        search: options[initialValue] || '',
        selected: initialValue,
        allOptions: Object.entries(options),
        filteredOptions: [],
        open: false,
        highlighted: null,
        errorMessage: '',

        get highlightedId() {
            return this.highlighted ? `${this.id}-option-${this.highlighted}` : null;
        },

        init() {
            this.filterOptions();
        },

        filterOptions() {
            const query = this.search.trim().toLowerCase();
            this.filteredOptions = this.allOptions.filter(([key, label]) =>
                label.toLowerCase().includes(query)
            );
            this.highlighted = this.filteredOptions.length ? this.filteredOptions[0][0] : null;
            this.errorMessage = '';
        },

        validateInput() {
            const input = this.search.trim().toLowerCase();

            const match = this.allOptions.find(([key, label]) =>
                label.toLowerCase() === input
            );

            if (match) {
                this.selectOption(match[0]);
            } else {
                this.selected = '';
                this.errorMessage = 'Debe seleccionar un valor válido de la lista.';
            }
        },

        selectOption(key) {
            this.selected = key;
            this.search = options[key];
            this.open = false;
            this.errorMessage = '';
            this.filterOptions();
        },

        highlightNext() {
            const index = this.filteredOptions.findIndex(([key]) => key === this.highlighted);
            const next = this.filteredOptions[index + 1] || this.filteredOptions[0];
            this.highlighted = next?.[0];
        },

        highlightPrev() {
            const index = this.filteredOptions.findIndex(([key]) => key === this.highlighted);
            const prev = this.filteredOptions[index - 1] || this.filteredOptions[this.filteredOptions.length - 1];
            this.highlighted = prev?.[0];
        },

        selectHighlighted() {
            if (this.highlighted) {
                this.selectOption(this.highlighted);
            }
        }
    };
}
