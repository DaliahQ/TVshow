import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('search-input');
    const resultsList = document.getElementById('search-results');

    let timeout = null;

    input.addEventListener('input', function () {
        clearTimeout(timeout);

        const query = this.value.trim();

        if (query.length < 2) {
            resultsList.style.display = 'none';
            resultsList.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {
            fetch(`/search-suggestions?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultsList.innerHTML = '';

                    if (data.episodes.length === 0 && data.shows.length === 0) {
                        resultsList.style.display = 'none';
                        return;
                    }

                    if (data.episodes.length) {
                        const epHeader = document.createElement('li');
                        epHeader.className = 'list-group-item active';
                        epHeader.textContent = 'Episodes';
                        resultsList.appendChild(epHeader);

                        data.episodes.forEach(ep => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.innerHTML = `<a href="/episodes/${ep.id}" class="text-decoration-none">${ep.title}</a>`;
                            resultsList.appendChild(li);
                        });
                    }

                    if (data.shows.length) {
                        const showHeader = document.createElement('li');
                        showHeader.className = 'list-group-item active';
                        showHeader.textContent = 'Shows';
                        resultsList.appendChild(showHeader);

                        data.shows.forEach(show => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.innerHTML = `<a href="/tvshows/${show.id}" class="text-decoration-none">${show.title}</a>`;
                            resultsList.appendChild(li);
                        });
                    }

                    resultsList.style.display = 'block';
                });
        }, 300);
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!resultsList.contains(e.target) && e.target !== input) {
            resultsList.style.display = 'none';
        }
    });
});


