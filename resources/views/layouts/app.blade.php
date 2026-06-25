<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>@yield('title', 'Unimus Life & Culinary Hub')</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
<style>
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
* { font-family: var(--font) !important; }
body { 
    background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%); 
    color: var(--text); 
    min-height: 100vh; 
    -webkit-font-smoothing: antialiased; 
    font-family: var(--font);
}
a { text-decoration: none; color: inherit; }
button { font-family: var(--font); cursor: pointer; }
input, select, textarea { font-family: var(--font); }

/* HEADER */
.app-header { position: sticky; top: 0; z-index: 30; background: linear-gradient(135deg,#0052cc 0%,#1e40af 100%); color: #fff; padding: 6px 0; }
.header-inner { max-width: 440px; margin: 0 auto; padding: 24px 16px 32px; display: flex; align-items: center; justify-content: space-between; }
.header-brand { display: flex; align-items: center; gap: 10px; }
.brand-icon { width: 44px; height: 44px; border-radius: 14px; background: rgba(255,255,255,.2); display: grid; place-items: center; font-size: 24px; }
.brand-label small { font-size: 11px; opacity: .75; font-weight: 600; text-transform: uppercase; letter-spacing: .08em; display: block; }
.brand-label strong { font-size: 16px; font-weight: 800; }
.header-subtitle { font-size: 13px; opacity: .88; margin: 10px 0 0; }
.header-admin-btn { font-size: 20px; background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25); color: #fff; width: 44px; height: 44px; border-radius: 12px; display: grid; place-items: center; cursor: pointer; transition: all .15s; text-decoration: none; }
.header-admin-btn:hover { background: rgba(255,255,255,.25); }
.search-inner { max-width: 440px; margin: 0 auto; padding: 0 16px 32px; }
.search-hero { margin-bottom: 6px; }
.search-hero h1 { font-size: 20px; font-weight: 800; line-height: 1.15; color: #fff; margin-bottom: 4px; }
.search-hero p { font-size: 12px; line-height: 1.4; opacity: .95; color: #fff; margin: 0; }
.search-box { position: relative; margin-top: 18px; }
.search-box input { width: 100%; height: 44px; padding: 0 40px 0 38px; border-radius: 12px; border: none; outline: none; background: #fff; font-size: 14px; box-shadow: 0 6px 18px rgba(14,54,134,0.12); }
.search-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 18px; }
.search-btn { position: absolute; right: 6px; top: 50%; transform: translateY(-50%); background: linear-gradient(90deg,#007bff,#1e40af); color: #fff; border: none; border-radius: 12px; padding: 8px 14px; font-size: 13px; font-weight: 700; cursor: pointer; box-shadow: 0 6px 16px rgba(30,64,175,.18); }

/* Creative search layout */
.search-form .input-group { max-width: 860px; margin: 6px auto 0; border-radius: 12px; overflow: hidden; }
.search-form .input-group .input-group-text { background: #fff; border: none; }
.search-form .form-control { border: none; }

.hero-search-row { display: flex; gap: 0; align-items: center; max-width: 620px; margin: 14px auto 0; }
.hero-search-input { display: flex; align-items: center; gap: 14px; background: #fff; padding: 12px 16px; border-radius: 18px 0 0 18px; box-shadow: 0 20px 40px rgba(14,54,134,0.14); flex: 1; min-height: 56px; }
.hero-search-input .hero-search-icon { font-size: 18px; color: var(--muted); }
.hero-search-input input { border: none; outline: none; font-size: 14px; padding: 0; width: 100%; color: var(--text); }
.hero-search-submit { flex: 0 0 auto; padding: 14px 26px; min-height: 56px; border-radius: 0 18px 18px 0; background: linear-gradient(135deg,#10b981,#059669); color: #fff; border: none; box-shadow: 0 18px 36px rgba(16,185,129,0.18); font-weight: 700; transition: transform .2s, opacity .2s; }
.hero-search-submit:hover { opacity: .95; transform: translateY(-1px); }
.hero-intro-text { max-width: 720px; margin: 16px auto 0; color: rgba(255,255,255,.88); font-size: 14px; line-height: 1.6; text-align: center; }
.hero-feature-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; max-width: 860px; margin: 24px auto 0; }
.feature-card { display: flex; align-items: flex-start; gap: 14px; background: rgba(255,255,255,.16); border: 1px solid rgba(255,255,255,.18); border-radius: 18px; padding: 18px; backdrop-filter: blur(10px); min-height: 108px; }
.feature-card-icon { width: 44px; height: 44px; display: grid; place-items: center; border-radius: 14px; background: rgba(255,255,255,.22); font-size: 20px; }
.feature-card-title { font-size: 15px; font-weight: 700; margin-bottom: 4px; color: #fff; }
.feature-card-text { font-size: 13px; color: rgba(255,255,255,.82); line-height: 1.5; }

.search-section { position: relative; overflow: hidden; padding-bottom: 32px; }
.main { max-width: 1100px; margin: 0 auto; padding: 16px 16px 90px; }
.admin-main { max-width: 960px; margin: 0 auto; padding: 24px 24px 90px; }
.section-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); margin: 14px 0 8px; }

/* CHIPS */
.chip-row { display: flex; gap: 10px; overflow-x: auto; margin: 24px -16px 0; padding: 0 16px 8px; scrollbar-width: none; }
.chip-row::-webkit-scrollbar { display: none; }
.chip { flex-shrink: 0; height: 40px; padding: 0 16px; border-radius: 999px; border: 2px solid #e0e0e0; background: #fff; color: var(--text); font-size: 13px; font-weight: 600; transition: all .15s; white-space: nowrap; display: inline-flex; align-items: center; gap: 7px; cursor: pointer; }
.chip:hover { border-color: var(--primary); color: var(--primary); }
.chip.active { background: var(--primary); color: #fff; border-color: var(--primary); }

/* PRICE FILTER */
.section-label-price { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--muted); margin: 20px 0 10px; }
.price-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
.price-btn { height: 36px; padding: 0 14px; border-radius: 12px; border: 1.5px solid var(--border); background: #fff; color: var(--text-light); font-size: 12px; font-weight: 600; transition: all .15s; cursor: pointer; }
.price-btn:hover { background: var(--primary-soft); border-color: rgba(30,64,175,.3); color: var(--primary); }
.price-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }

/* RESULTS */
.results-header { display: flex; align-items: center; justify-content: space-between; margin: 8px 0 18px; }
.results-title { font-size: 18px; font-weight: 800; }
.results-count { font-size: 13px; color: var(--muted); }
.grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.empty { text-align: center; padding: 56px 16px; color: var(--muted); font-size: 14px; }

/* CARD */
.card { background: var(--card); border-radius: var(--radius); border: 1.5px solid var(--border); overflow: hidden; box-shadow: var(--shadow-card); display: block; transition: transform .15s; }
.card:active { transform: scale(.97); }
.card-img { position: relative; aspect-ratio: 1/1; overflow: hidden; background: var(--border); }
.card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
.card:hover .card-img img { transform: scale(1.08); }
.cat-badge { position: absolute; top: 8px; left: 8px; padding: 3px 8px; border-radius: 999px; font-size: 10px; font-weight: 700; backdrop-filter: blur(6px); }
.cat-Culinary { background: rgba(245,158,11,.22); color: #92400e; }
.cat-Kost { background: rgba(16,185,129,.18); color: #065f46; }
.cat-BRT { background: rgba(30,64,175,.18); color: #1e3a8a; }
.card-body { padding: 12px 12px 14px; }
.card-name { font-weight: 700; font-size: 14px; line-height: 1.3; margin-bottom: 6px; }
.card-desc { font-size: 12px; color: var(--text-light); margin: 4px 0 8px; display: flex; align-items: center; gap: 4px; }
.card-desc::before { content: '📍'; }
.card-price { font-size: 15px; font-weight: 800; color: var(--primary); }
.card-price span { font-size: 11px; font-weight: 500; color: var(--muted); margin-left: 4px; }

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
.btn-primary.btn-sm { width: auto; min-width: 120px; padding: 0 18px; }
.btn-primary:hover { opacity: .9; }
.btn-secondary { width: 100%; height: 46px; border-radius: 14px; background: #fff; color: var(--text); border: 1.5px solid var(--border); font-size: 14px; font-weight: 700; transition: all .15s; }
.btn-secondary:hover { background: var(--primary-soft); border-color: rgba(30,64,175,.35); color: var(--primary); }
.btn-logout { width: auto; min-width: 100px; padding: 0 18px; height: 36px; border-radius: 14px; background: #fff; color: var(--destructive); border: 1.5px solid #fecaca; font-size: 13px; font-weight: 700; transition: all .15s; display: inline-flex; align-items: center; gap: 6px; }
.btn-logout:hover { background: #fee2e2; border-color: var(--destructive); }
.admin-panel { background: var(--card); border: 1.5px solid var(--border); border-radius: 24px; box-shadow: var(--shadow-card); padding: 24px; margin-top: 24px; }
.admin-panel-hero { display: flex; gap: 18px; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; }
.admin-panel-hero h1 { font-size: 28px; margin-bottom: 6px; }
.admin-panel-hero p { color: var(--text-light); max-width: 680px; }
.admin-summary { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; margin-top: 18px; }
@media(max-width:880px) { .admin-summary { grid-template-columns: 1fr 1fr; } }
.admin-summary-card { background: var(--primary-soft); border-radius: 20px; padding: 18px; border: 1px solid rgba(30,64,175,.12); }
.admin-summary-card strong { display: block; font-size: 22px; color: var(--primary); margin-bottom: 4px; }
.admin-summary-card span { font-size: 12px; color: var(--text-light); }
.admin-grid-list { display: grid; grid-template-columns: 1fr; gap: 16px; margin-top: 24px; }
@media(min-width:720px) { .admin-grid-list { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
.admin-card { display: flex; flex-direction: column; background: var(--card); border-radius: 22px; overflow: hidden; border: 1.5px solid var(--border); box-shadow: var(--shadow-card); transition: transform .16s; }
.admin-card:hover { transform: translateY(-2px); }
.admin-card-thumb { position: relative; min-height: 170px; background: var(--border); overflow: hidden; }
.admin-card-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
.admin-card-badge { position: absolute; top: 14px; left: 14px; padding: 7px 12px; border-radius: 999px; background: rgba(30,64,175,.92); color: #fff; font-size: 11px; font-weight: 700; }
.admin-card-body { padding: 20px; display: flex; flex-direction: column; gap: 12px; flex: 1; }
.admin-card-title { margin: 0; font-size: 18px; font-weight: 800; line-height: 1.2; }
.admin-card-meta { color: var(--text-light); font-size: 13px; line-height: 1.6; }
.admin-card-desc { color: var(--text-light); font-size: 13px; line-height: 1.7; min-height: 48px; }
.admin-card-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: auto; }
.form-card { background: var(--card); border: 1.5px solid var(--border); border-radius: 24px; box-shadow: var(--shadow-card); padding: 28px; }
.form-grid { display: grid; grid-template-columns: 1fr; gap: 18px; }
@media(min-width:720px) { .form-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
.span-2 { grid-column: 1 / -1; }
.field-group { display: flex; flex-direction: column; gap: 10px; }
.field-label { font-size: 14px; font-weight: 700; color: var(--text); }
.field-input { width: 100%; padding: 14px 16px; border-radius: 16px; border: 1.5px solid var(--border); background: #fff; color: var(--text); outline: none; font-size: 14px; }
.field-input textarea { min-height: 130px; resize: vertical; }
.form-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 10px; }
.form-actions .btn-secondary { width: auto; }
.social-row { display: flex; gap: 8px; }
.btn-social { flex: 1; height: 44px; border-radius: 14px; border: 1.5px solid var(--border); background: var(--card); display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 13px; font-weight: 600; transition: background .15s; }
.btn-social:hover { background: var(--primary-soft); color: var(--primary); }

/* ALERTS */
.alert { padding: 12px 16px; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 16px; }
.alert-success { background: #d1fae5; color: #065f46; border: 1.5px solid #a7f3d0; }
.alert-error { background: #fee2e2; color: #991b1b; border: 1.5px solid #fecaca; }

/* HEADER IMPROVEMENTS */
.app-header { 
    background: linear-gradient(135deg, #0052cc 0%, #1e40af 100%); 
    color: white; 
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    border-bottom: 1px solid rgba(255,255,255,0.1);
}
.header-nav { display: flex; align-items: center; justify-content: space-between; }
.brand { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 18px; }
.brand-icon { width: 44px; height: 44px; border-radius: 14px; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 24px; }
.nav-links { display: flex; gap: 16px; align-items: center; }
.nav-link { color: rgba(255,255,255,.9); font-size: 14px; font-weight: 600; transition: all 0.3s ease; }
.nav-link:hover { color: white; opacity: 1; }

/* SMOOTH ANIMATIONS */
.fade-in { animation: fadeIn 0.5s ease-in-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

/* IMPROVED CARDS */
.item-card { 
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
    border: none; 
    border-radius: 16px;
    overflow: hidden;
}
.item-card:hover { 
    transform: translateY(-8px); 
    box-shadow: 0 16px 32px rgba(0,0,0,0.12);
}
.item-card img { transition: transform 0.5s ease; }
.item-card:hover img { transform: scale(1.06); }

/* RESPONSIVE CONTAINER */
@media(max-width: 576px) {
    .main { padding-bottom: 100px; }
    .grid { grid-template-columns: 1fr; }
}
@media(min-width: 768px) {
    .grid { grid-template-columns: repeat(2, 1fr); }
    .admin-summary { grid-template-columns: repeat(4, 1fr); }
}
@media(min-width: 992px) {
    .grid { grid-template-columns: repeat(3, 1fr); }
}

@media(min-width: 768px) {
    .filters-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 24px; }
}

.filters-grid { display: grid; grid-template-columns: 1fr; gap: 20px; justify-content: center; width: 100%; max-width: 900px; margin: 0 auto; }
.filter-section { background: white; border-radius: 12px; padding: 12px; margin-bottom: 0; box-shadow: var(--shadow-card); width: 100%; }
.filter-title { font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 10px; }
.filter-chips { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
.filter-btn { 
    padding: 8px 12px; 
    border-radius: 18px; 
    border: 2px solid var(--border); 
    background: white; 
    color: var(--text); 
    font-size: 13px; 
    font-weight: 600;
    transition: all 0.2s;
    cursor: pointer;
}

.filter-header { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
.toggle-btn { background: transparent; border: 1px solid var(--border); padding: 6px 10px; border-radius: 10px; font-size: 13px; color: var(--primary); cursor: pointer; }
.toggle-btn:hover { background: var(--primary-soft); }
.collapsed { display: none !important; }
.filter-btn:hover { border-color: var(--primary); color: var(--primary); }
.filter-btn.active { background: var(--primary); color: white; border-color: var(--primary); }

/* EMPTY STATE */
.empty-state { 
    text-align: center; 
    padding: 60px 20px; 
    color: var(--muted);
}
.empty-state-icon { font-size: 64px; margin-bottom: 16px; }

/* BREADCRUMB */
.breadcrumb-custom { background: transparent; padding: 0; margin-bottom: 16px; }
.breadcrumb-item { color: var(--text-light); font-size: 13px; }
.breadcrumb-item a { color: var(--primary); }
</style>
@stack('styles')
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('content')
@stack('scripts')
<script>
document.addEventListener('click', function(e){
    if(e.target && e.target.matches('.toggle-btn')){
        var btn = e.target;
        var sel = btn.getAttribute('data-target');
        var target = document.querySelector(sel);
        if(!target) return;
        var isCollapsed = target.classList.toggle('collapsed');
        if(isCollapsed){
            btn.textContent = 'Tampilkan';
            btn.setAttribute('aria-expanded','false');
        } else {
            btn.textContent = 'Sembunyikan';
            btn.setAttribute('aria-expanded','true');
        }
    }
});
</script>
</body>
</html>