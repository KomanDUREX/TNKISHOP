<footer class="site-footer">
    <div class="container footer__grid">
        <div>
            <p class="footer__title">Tankist Store</p>
            <p class="footer__text">Магазин акаунтів та валюти для World of Tanks і WoT Blitz. Гарантуємо чесність, швидкість і підтримку 24/7.</p>
        </div>
        <div>
            <p class="footer__title">Навігація</p>
            <div class="footer__links">
                <a href="{{ route('products') }}">Товари</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                <a href="{{ route('favorites') }}">Улюблені</a>
                <a href="{{ route('cart') }}">Кошик</a>
                <a href="{{ route('about') }}">Про нас</a>
                <a href="{{ route('contacts') }}">Контакти</a>
            </div>
        </div>
        <div>
            <p class="footer__title">Контакти</p>
            <p class="footer__text">Email: support@tankist.store<br>Telegram: @tankist_support<br>Discord: tankist.store#7777</p>
        </div>
    </div>
    <div class="container footer__bottom">
        <span>© {{ date('Y') }} Tankist Store. Усі права захищені.</span>
        <span>WoT & WoT Blitz fan-made shop</span>
    </div>
</footer>
