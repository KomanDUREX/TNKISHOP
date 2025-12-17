<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tankist Store - WoT & WoT Blitz')</title>
    <meta name="description" content="@yield('meta', 'Онлайн-магазин акаунтів, золота та срібла для World of Tanks і Blitz')">
    @vite(['resources/css/app.css'])
    <style>
        html {
            background: #0b101a;
        }
        body {
            opacity: 0;
            transition: opacity 0.35s ease;
            background: #0b101a;
        }
        body.is-loaded {
            opacity: 1;
        }
        .page-loader {
            position: fixed;
            inset: 0;
            background: #0b101a;
            display: grid;
            place-items: center;
            z-index: 50;
            opacity: 1;
            transition: opacity 0.25s ease;
        }
        .page-loader.is-hidden {
            opacity: 0;
            pointer-events: none;
        }
        .page-loader__dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent, #fcbf49);
            box-shadow: 0 0 18px rgba(252, 191, 73, 0.6);
            animation: loader-pulse 0.9s ease-in-out infinite;
        }
        @keyframes loader-pulse {
            0%, 100% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.15); opacity: 1; }
        }
    </style>
</head>
<body class="page-shell">
    <div class="page-loader" id="page-loader">
        <div class="page-loader__dot"></div>
    </div>
    <div class="metal-overlay"></div>
    @include('partials.header')

    <main class="page-content">
        @if (session('status'))
            <div class="toast" data-reveal>
                <span class="toast__dot"></span>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <div class="quick-view" data-quickview hidden>
        <div class="quick-view__backdrop" data-quickview-close></div>
        <div class="quick-view__panel">
            <button class="quick-view__close" type="button" data-quickview-close aria-label="Закрити">&times;</button>
            <div class="quick-view__tags">
                <span class="pill pill--type" data-quickview-type></span>
                <span class="pill pill--game" data-quickview-game></span>
                <span class="pill pill--badge" data-quickview-badge hidden></span>
            </div>
            <h3 class="quick-view__title" data-quickview-title></h3>
            <p class="quick-view__desc" data-quickview-desc></p>
            <ul class="quick-view__features" data-quickview-features></ul>
            <form class="quick-view__purchase" data-quickview-form hidden>
                <label>
                    <span>Ваше ім’я</span>
                    <input type="text" name="buyer_name" required>
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="buyer_email" required>
                </label>
                <label>
                    <span>Нік / Telegram</span>
                    <input type="text" name="buyer_contact" placeholder="@nickname" required>
                </label>
                <label>
                    <span>Коментар (опціонально)</span>
                    <textarea name="buyer_note" rows="2" placeholder="Деталі передачі або час онлайн"></textarea>
                </label>
                <button type="submit" class="btn btn--primary quick-view__submit">Підтвердити покупку</button>
            </form>
            <div class="quick-view__footer">
                <div>
                    <p class="price price--xl" data-quickview-price></p>
                    <p class="muted">Миттєва передача та підтримка</p>
                </div>
                <div class="quick-view__actions">
                    <button type="button" class="btn btn--primary" data-quickview-buy>Купити</button>
                    <form method="POST" data-quickview-cart>
                        @csrf
                        <button type="submit" class="btn btn--ghost">В кошик</button>
                    </form>
                    <form method="POST" data-quickview-fav>
                        @csrf
                        <button type="submit" class="btn btn--ghost">В улюблені</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        const finishLoad = () => {
            document.body.classList.add('is-loaded');
            const loader = document.getElementById('page-loader');
            if (loader) loader.classList.add('is-hidden');
        };

        const revealOnLoad = () => {
            if (document.readyState === 'complete') {
                finishLoad();
            } else {
                window.addEventListener('load', finishLoad, { once: true });
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            revealOnLoad();
            const loader = document.getElementById('page-loader');
            window.addEventListener('beforeunload', () => {
                document.body.classList.remove('is-loaded');
                if (loader) loader.classList.remove('is-hidden');
            });
            document.querySelectorAll('a[href]').forEach((link) => {
                link.addEventListener('click', (e) => {
                    const url = link.getAttribute('href') || '';
                    const target = link.getAttribute('target');
                    const isHash = url.startsWith('#');
                    const isExternal = link.host && link.host !== location.host;
                    if (target === '_blank' || isHash || isExternal || e.defaultPrevented) return;
                    document.body.classList.remove('is-loaded');
                    if (loader) loader.classList.remove('is-hidden');
                });
            });
            const toast = document.querySelector('.toast');
            if (toast) {
                setTimeout(() => toast.classList.add('toast--hide'), 2800);
            }

            const toggle = document.querySelector('[data-menu-toggle]');
            const menu = document.querySelector('.site-nav');
            if (toggle && menu) {
                toggle.addEventListener('click', () => {
                    menu.classList.toggle('site-nav--open');
                });
            }

            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const autoRevealSelectors = [
                '.section',
                '.product-card',
                '.feature',
                '.cart-item',
                '.contact-card',
                '.filter-panel',
                '.checkout',
                '.hero__panel',
                '.hero__badge',
                '.empty',
            ];

            autoRevealSelectors.forEach((selector) => {
                document.querySelectorAll(selector).forEach((el) => {
                    if (!el.hasAttribute('data-reveal')) {
                        el.setAttribute('data-reveal', '');
                    }
                });
            });

            const targets = document.querySelectorAll('[data-reveal]');
            if (!prefersReduced && targets.length) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.18 });

                let delay = 0;
                targets.forEach((el) => {
                    el.style.setProperty('--reveal-delay', `${delay}ms`);
                    delay = Math.min(delay + 60, 480);
                    observer.observe(el);
                });
            } else {
                targets.forEach((el) => el.classList.add('is-visible'));
            }

            const quickView = document.querySelector('[data-quickview]');
            if (quickView) {
                const backdrop = quickView.querySelector('.quick-view__backdrop');
                const closeButtons = quickView.querySelectorAll('[data-quickview-close]');
                const titleEl = quickView.querySelector('[data-quickview-title]');
                const descEl = quickView.querySelector('[data-quickview-desc]');
                const priceEl = quickView.querySelector('[data-quickview-price]');
                const typeEl = quickView.querySelector('[data-quickview-type]');
                const gameEl = quickView.querySelector('[data-quickview-game]');
                const badgeEl = quickView.querySelector('[data-quickview-badge]');
                const featuresEl = quickView.querySelector('[data-quickview-features]');
                const cartForm = quickView.querySelector('[data-quickview-cart]');
                const favForm = quickView.querySelector('[data-quickview-fav]');
                const buyBtn = quickView.querySelector('[data-quickview-buy]');
                const purchaseForm = quickView.querySelector('[data-quickview-form]');
                const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
                const showPurchaseToast = (message) => {
                    const t = document.createElement('div');
                    t.className = 'toast toast--purchase';
                    t.innerHTML = '<span class="toast__dot"></span><span>' + message + '</span>';
                    document.body.appendChild(t);
                    setTimeout(() => t.classList.add('toast--hide'), 2400);
                    setTimeout(() => t.remove(), 3000);
                };

                const closeQuickView = () => {
                    quickView.hidden = true;
                    document.body.classList.remove('modal-open');
                };

                const openQuickView = (card) => {
                    if (!card) return;
                    quickView.hidden = false;
                    document.body.classList.add('modal-open');

                    titleEl.textContent = card.dataset.title || '';
                    descEl.textContent = card.dataset.desc || '';
                    priceEl.textContent = card.dataset.price || '';
                    typeEl.textContent = (card.dataset.type || '').toUpperCase();
                    gameEl.textContent = card.dataset.game === 'blitz' ? 'Blitz' : 'WoT';

                    if (card.dataset.badge) {
                        badgeEl.textContent = card.dataset.badge;
                        badgeEl.hidden = false;
                    } else {
                        badgeEl.hidden = true;
                    }

                    typeEl.className = 'pill pill--type ' + (card.dataset.type ? `pill--${card.dataset.type}` : '');

                    featuresEl.innerHTML = '';
                    try {
                        const items = JSON.parse(card.dataset.includes || '[]');
                        items.forEach((item) => {
                            const li = document.createElement('li');
                            li.textContent = item;
                            featuresEl.appendChild(li);
                        });
                    } catch (e) {
                        /* no-op */
                    }

                    cartForm.action = card.dataset.cartAction || '#';
                    favForm.action = card.dataset.favAction || '#';

                    if (purchaseForm) {
                        purchaseForm.reset();
                        purchaseForm.hidden = true;
                    }

                    buyBtn.onclick = () => {
                        if (!purchaseForm) return;
                        purchaseForm.hidden = false;
                        purchaseForm.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    };

                    if (purchaseForm) {
                        purchaseForm.onsubmit = (ev) => {
                            ev.preventDefault();
                            showPurchaseToast('Товар куплений, очікуйте повідомлення на пошту');
                            closeQuickView();
                        };
                    }
                };

                const openFirstCartProduct = () => {
                    const first = document.querySelector('.cart-list [data-product]');
                    if (first) {
                        openQuickView(first);
                    }
                };

                document.addEventListener('click', (e) => {
                    const card = e.target.closest('[data-product]');
                    if (card && !e.target.closest('.btn')) {
                        e.preventDefault();
                        openQuickView(card);
                    }
                    if (e.target.closest('[data-open-cart-quickview]')) {
                        e.preventDefault();
                        openFirstCartProduct();
                    }
                });

                closeButtons.forEach((btn) => btn.addEventListener('click', closeQuickView));
                backdrop?.addEventListener('click', closeQuickView);
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && !quickView.hidden) {
                        closeQuickView();
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
