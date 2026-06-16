export function initKontrakTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    if (!tabButtons.length) return;

    window.showTab = function (tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        tabButtons.forEach(button => {
            button.classList.remove('border-yellow-400', 'text-black', 'bg-yellow-200');
            button.classList.add('border-transparent', 'text-gray-500');
        });

        const content = document.getElementById('content-' + tabName);
        if (content) content.classList.remove('hidden');

        const activeTab = document.getElementById('tab-' + tabName);
        if (activeTab) {
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            activeTab.classList.add('border-yellow-400', 'text-black', 'bg-yellow-200');
        }

        const url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        window.history.pushState({}, '', url);
    };

    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab') || 'pending';
    window.showTab(tab);
}
