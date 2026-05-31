<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'Unimus Life & Culinary Hub')</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
    --primary: #1e40af; --primary-dark: #1e3a8a;
    --primary-soft: #dbeafe; --accent: #f59e0b;
    --success: #10b981; --destructive: #ef4444;
    --bg: #f8fafc; --card: #ffffff;
    --border: #e2e8f0; --muted: #94a3b8;
    --text: #0f172a; --text-light: #64748b;
    --font: 'Plus Jakarta Sans', sans-serif;
    --shadow-card: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
    --shadow-float: 0 8px 24px rgba(0,0,0,.10);
    --radius: 16px;
}
body { font-family: var(--font); background: var(--bg); color: var(--text); min-height: 100vh; -webkit-font-smoothing: antialiased; }
a { text-decoration: none; color: inherit; }
button { font-family: var(--font); cursor: pointer; }
input, select, textarea { font-family: var(--font); }

/* HEADER */
.app-header { position: sticky; top: 0; z-index: 30; background: linear-gradient(160deg,var(--primary),var(--primary-dark)); color: #fff; }
.header-inner { max-width: 440px; margin: 0 auto; padding: 16px 16px 0; }
.header-brand { display: flex; align-items: center; gap: 10px; }
.brand-icon { width: 38px; height: 38px; border-radius: 12px; background: rgba(255,255,255,.18); display: grid; place-items: center; font-size: 20px; }
.brand-label small { font-size: 10px; opacity: .75; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; display: block; }
.brand-label strong { font-size: 15px; font-weight: 800; }
.header-subtitle { font-size: 13px; opacity: .88; margin: 10px 0 0; }
.search-wrap { background: linear-gradient(160deg,var(--primary),var(--primary-dark)); }
.search-inner { max-width: 440px; margin: 0 auto; padding: 12px 16px 18px; }
.search-box { position: relative; }
.search-box input { width: 100%; height: 44px; padding: 0 40px 0 38px; border-radius: 14px; border: none; outline: none; background: #fff; font-size: 14px; box-shadow: 0 2px 8px rgba(0,0,0,.12); }
.search-icon { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--muted); }
.search-btn { position: absolute; right: 6px; top: 50%; transform: translateY(-50%); background: var(--primary); color: #fff; border: none; border-radius: 10px; padding: 6px 12px; font-size: 12px; font-weight: 700; }

/* MAIN */
.main { max-width: 440px; margin: 0 auto; padding: 16px 16px 90px; }
.section-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin: 14px 0 8px; }

/* CHIPS */
.chip-row { display: flex; gap: 8px; overflow-x: auto; margin: 0 -16px; padding: 0 16px 4px; scrollbar-width: none; }
.chip-row::-webkit-scrollbar { display: none; }
.chip { flex-shrink: 0; height: 36px; padding: 0 14px; border-radius: 999px; border: 1.5px solid var(--border); background: var(--card); color: var(--text); font-size: 12px; font-weight: 600; transition: all .15s; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px; }
.chip:hover, .chip.active { background: var(--primary); color: #fff; border-color: var(--primary); }

/* PRICE FILTER */
.price-row { display: flex; flex-wrap: wrap; gap: 8px; }
.price-btn { height: 32px; padding: 0 12px; border-radius: 10px; border: 1.5px solid var(--border); background: var(--card); color: var(--text-light); font-size: 12px; font-weight: 600; transition: all .15s; }
.price-btn:hover, .price-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }

/* RESULTS */
.results-header { display: flex; align-items: center; justify-content: space-between; margin: 18px 0 12px; }
.results-title { font-size: 16px; font-weight: 800; }
.results-count { font-size: 12px; color: var(--muted); }
.grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.empty { text-align: center; padding: 56px 16px; color: var(--muted); font-size: 14px; }

/* CARD */
.card { background: var(--card); border-radius: var(--radius); border: 1.5px solid var(--border); overflow: hidden; box-shadow: var(--shadow-card); display: block; transition: transform .15s; }
.card:active { transform: scale(.97); }
.card-img { position: relative; aspect-ratio: 4/3; overflow: hidden; background: var(--border); }
.card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.card:hover .card-img img { transform: scale(1.05); }
.cat-badge { position: absolute; top: 8px; left: 8px; padding: 3px 8px; border-radius: 999px; font-size: 10px; font-weight: 700; backdrop-filter: blur(6px); }
.cat-Culinary { background: rgba(245,158,11,.22); color: #92400e; }
.cat-Kost { background: rgba(16,185,129,.18); color: #065f46; }
.cat-BRT { background: rgba(30,64,175,.18); color: #1e3a8a; }
.card-body { padding: 10px 12px 12px; }
.card-name { font-weight: 700; font-size: 13px; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.card-desc { font-size: 11px; color: var(--text-light); margin: 3px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.card-price { font-size: 13px; font-weight: 800; color: var(--primary); margin-top: 6px; }
.card-price span { font-size: 10px; font-weight: 500; color: var(--muted); }

/* BOTTOM NAV */
.bottom-nav { position: fixed; bottom: 0; left: 0; right: 0; z-index: 20; background: var(--card); border-top: 1.5px solid var(--border); display: flex; }
.nav-btn { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 3px; padding: 10px 0; background: none; border: none; color: var(--muted); font-size: 10px; font-weight: 600; transition: color .15s; }
.nav-btn:hover, .nav-btn.active { color: var(--primary); }

/* DETAIL */
.detail-hero { position: relative; aspect-ratio: 4/3; background: var(--border); }
@media(min-width:480px){ .detail-hero { aspect-ratio: 16/9; } }
.detail-hero img { width: 100%; height: 100%; object-fit: cover; }
.detail-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom,rgba(0,0,0,.4) 0%,transparent 60%); }
.back-btn { position: absolute; top: 14px; left: 14px; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,.9); border: none; display: grid; place-items: center; box-shadow: 0 2px 8px rgba(0,0,0,.15); color: var(--text); font-size: 18px; }
.hero-badge { position: absolute; top: 14px; right: 14px; padding: 5px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; background: var(--primary); color: #fff; }
.detail-card { max-width: 440px; margin: -24px auto 0; position: relative; background: var(--card); border-radius: 20px; padding: 16px; box-shadow: var(--shadow-float); border: 1.5px solid var(--border); }
.detail-name { font-size: 20px; font-weight: 800; line-height: 1.2; }
.detail-shortdesc { font-size: 13px; color: var(--muted); margin-top: 4px; }
.detail-price { font-size: 26px; font-weight: 900; color: var(--primary); margin-top: 10px; }
.detail-price span { font-size: 13px; font-weight: 500; color: var(--muted); }
.detail-main { max-width: 440px; margin: 0 auto; padding: 0 16px 60px; }
.detail-section { margin-top: 20px; }
.detail-section-title { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin-bottom: 10px; }
.detail-desc { font-size: 13px; line-height: 1.7; }
.facilities { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.facility { display: flex; align-items: center; gap: 8px; background: var(--primary-soft); color: var(--primary); border-radius: 10px; padding: 8px 10px; font-size: 12px; font-weight: 600; }
.brt-stops { border-left: 2px solid rgba(30,64,175,.25); padding-left: 16px; margin-left: 6px; }
.brt-stop { position: relative; font-size: 13px; padding: 4px 0; }
.brt-stop::before { content: ''; position: absolute; left: -21px; top: 8px; width: 10px; height: 10px; border-radius: 50%; background: var(--primary); border: 2px solid var(--bg); }
.info-row { display: flex; align-items: flex-start; gap: 12px; background: var(--card); border: 1.5px solid var(--border); border-radius: 14px; padding: 12px; }
.info-row + .info-row { margin-top: 8px; }
.info-icon { width: 36px; height: 36px; border-radius: 10px; background: var(--primary-soft); color: var(--primary); display: grid; place-items: center; flex-shrink: 0; font-size: 16px; }
.info-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); }
.info-value { font-size: 13px; color: var(--text); margin-top: 1px; word-break: break-word; }
.map-preview { border-radius: 16px; overflow: hidden; border: 1.5px solid var(--border); background: var(--border); position: relative; }
.map-preview img { width: 100%; height: 176px; object-fit: cover; display: block; }
.map-coords { position: absolute; bottom: 8px; left: 8px; background: rgba(255,255,255,.9); border-radius: 6px; padding: 3px 8px; font-size: 10px; color: var(--muted); }
.btn-primary { width: 100%; height: 46px; border-radius: 14px; background: var(--primary); color: #fff; border: none; font-size: 14px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 12px; transition: opacity .15s; }
.btn-primary:hover { opacity: .9; }
.social-row { display: flex; gap: 8px; }
.btn-social { flex: 1; height: 44px; border-radius: 14px; border: 1.5px solid var(--border); background: var(--card); display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; font-weight: 600; transition: background .15s; }
.btn-social:hover { background: var(--primary-soft); color: var(--primary); }

/* ALERTS */
.alert { padding: 12px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 16px; }
.alert-success { background: #d1fae5; color: #065f46; border: 1.5px solid #a7f3d0; }
.alert-error { background: #fee2e2; color: #991b1b; border: 1.5px solid #fecaca; }
</style>
@stack('styles')
</head>
<body>
@yield('content')
@stack('scripts')
</body>
</html>