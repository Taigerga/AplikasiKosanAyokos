export function initSearchableSelects() {
    document.querySelectorAll('select[data-searchable]').forEach(select => {
        if (select.dataset.searchableInitialized) return;
        select.dataset.searchableInitialized = '1';
        new SearchableSelect(select);
    });
}

class SearchableSelect {
    constructor(select) {
        this.select = select;
        this.pageSize = 10;
        this.currentPage = 1;
        this.filterText = '';

        this.select.style.display = 'none';
        this.wrapper = document.createElement('div');
        this.wrapper.className = 'relative';
        this.select.parentNode.insertBefore(this.wrapper, this.select);
        this.wrapper.appendChild(this.select);

        this.build();
    }

    build() {
        const icon = this.wrapper.closest('.relative')?.querySelector('i')?.cloneNode() || null;
        const placeholder = this.select.options[0]?.disabled
            ? this.select.options[0].text
            : 'Pilih...';

        this.trigger = document.createElement('button');
        this.trigger.type = 'button';
        this.trigger.className =
            'w-full flex items-center justify-between px-4 py-3 border-2 border-black bg-white text-black font-black placeholder-gray-500 focus:shadow-[3px_3px_0px_#000] outline-none transition';
        this.trigger.innerHTML = `
            <span class="flex items-center gap-2">
                <span class="selected-text">${this.escapeHtml(this.getSelectedText())}</span>
            </span>
            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
        `;

        this.dropdown = document.createElement('div');
        this.dropdown.className =
            'absolute top-full left-0 right-0 z-50 mt-1 border-2 border-black bg-white shadow-[4px_4px_0px_#000] hidden';

        this.searchInput = document.createElement('input');
        this.searchInput.type = 'text';
        this.searchInput.placeholder = 'Cari...';
        this.searchInput.className =
            'w-full px-4 py-2.5 border-b-2 border-black font-black text-black placeholder-gray-500 outline-none';
        this.searchInput.addEventListener('input', () => {
            this.filterText = this.searchInput.value;
            this.currentPage = 1;
            this.renderOptions();
        });

        this.optionsContainer = document.createElement('div');
        this.optionsContainer.className = 'max-h-[280px] overflow-y-auto';

        this.loadMoreBtn = document.createElement('button');
        this.loadMoreBtn.type = 'button';
        this.loadMoreBtn.className =
            'w-full px-4 py-2 bg-yellow-400 hover:bg-yellow-500 font-black text-black border-t-2 border-black transition hidden';
        this.loadMoreBtn.innerHTML = '<i class="fas fa-chevron-down mr-2"></i> Tampilkan lebih banyak';
        this.loadMoreBtn.addEventListener('click', () => {
            this.currentPage++;
            this.renderOptions();
        });

        this.dropdown.appendChild(this.searchInput);
        this.dropdown.appendChild(this.optionsContainer);
        this.dropdown.appendChild(this.loadMoreBtn);
        this.wrapper.appendChild(this.trigger);
        this.wrapper.appendChild(this.dropdown);

        this.trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggle();
        });

        document.addEventListener('click', (e) => {
            if (!this.wrapper.contains(e.target)) this.close();
        });

        this.select.addEventListener('change', () => this.updateTriggerText());
    }

    escapeHtml(text) {
        const d = document.createElement('div');
        d.textContent = text;
        return d.innerHTML;
    }

    getSelectedText() {
        const idx = this.select.selectedIndex;
        if (idx >= 0 && this.select.options[idx]) {
            return this.select.options[idx].text;
        }
        return 'Pilih...';
    }

    getFilteredOptions() {
        return Array.from(this.select.options).filter((opt, i) => {
            if (i === 0 && opt.disabled) return false;
            if (!this.filterText) return true;
            return opt.text.toLowerCase().includes(this.filterText.toLowerCase());
        });
    }

    renderOptions() {
        const all = this.getFilteredOptions();
        const total = all.length;
        const end = this.currentPage * this.pageSize;
        const page = all.slice(0, end);

        this.optionsContainer.innerHTML = '';

        if (page.length === 0) {
            const empty = document.createElement('div');
            empty.className = 'px-4 py-6 text-center text-gray-500 font-black';
            empty.textContent = 'Tidak ada hasil';
            this.optionsContainer.appendChild(empty);
            this.loadMoreBtn.classList.add('hidden');
            return;
        }

        page.forEach((opt) => {
            const div = document.createElement('div');
            div.className =
                'px-4 py-2.5 font-black text-black hover:bg-yellow-100 border-b border-gray-100 flex items-center gap-2 cursor-pointer transition';
            if (opt.value === this.select.value) {
                div.classList.add('bg-yellow-400', 'hover:bg-yellow-400');
            }
            div.dataset.value = opt.value;
            div.textContent = opt.text;

            div.addEventListener('click', () => this.selectOption(opt.value));
            this.optionsContainer.appendChild(div);
        });

        if (end < total) {
            this.loadMoreBtn.classList.remove('hidden');
            this.loadMoreBtn.textContent = `Tampilkan ${Math.min(this.pageSize, total - end)} lagi (${total - end} tersisa)`;
        } else {
            this.loadMoreBtn.classList.add('hidden');
        }
    }

    toggle() {
        if (this.dropdown.classList.contains('hidden')) {
            this.open();
        } else {
            this.close();
        }
    }

    open() {
        this.dropdown.classList.remove('hidden');
        this.trigger.querySelector('.fa-chevron-down').classList.add('rotate-180');
        this.searchInput.value = this.filterText;
        this.currentPage = 1;
        this.renderOptions();
        this.searchInput.focus();
    }

    close() {
        this.dropdown.classList.add('hidden');
        this.trigger.querySelector('.fa-chevron-down').classList.remove('rotate-180');
    }

    selectOption(value) {
        this.select.value = value;
        this.select.dispatchEvent(new Event('change', { bubbles: true }));
        this.select.dispatchEvent(new Event('input', { bubbles: true }));
        this.updateTriggerText();
        this.close();
    }

    updateTriggerText() {
        this.trigger.querySelector('.selected-text').textContent = this.getSelectedText();
    }
}
