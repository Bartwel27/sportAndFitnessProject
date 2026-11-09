<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bartwel Sports & Fitness | Gear up in Zambia</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--ink:#14181f;--chalk:#f7f8fa;--green:#0e7a4f;--yellow:#f2c230;--red:#d6342c;--line:#dfe3e8;--muted:#5b6470}
*{box-sizing:border-box;margin:0}
body{font-family:Barlow,system-ui,sans-serif;color:var(--ink);background:var(--chalk);line-height:1.55}
h1,h2,h3,.logo{font-family:"Barlow Condensed",Impact,sans-serif;line-height:1}
a{color:inherit;text-decoration:none}
:focus-visible{outline:3px solid var(--yellow);outline-offset:2px}
.wrap{max-width:1120px;margin:auto;padding:0 20px}
header{background:var(--ink);color:#fff;position:sticky;top:0;z-index:5}
header .wrap{display:flex;align-items:center;justify-content:space-between;height:64px;gap:16px}
.logo{font-size:26px;font-weight:800;letter-spacing:.5px}.logo span{color:var(--yellow)}
nav{display:flex;gap:22px;align-items:center;font-weight:500}
nav a:hover{color:var(--yellow)}
.cart{background:var(--yellow);color:var(--ink);padding:8px 14px;border-radius:6px;font-weight:600}
.btn{display:inline-block;padding:14px 26px;border-radius:6px;font-weight:600;border:0;cursor:pointer;font-size:16px;font-family:inherit}
.btn.main{background:var(--yellow);color:var(--ink)}
.btn.ghost{border:2px solid #fff;color:#fff}
.hero{background:var(--green);color:#fff;position:relative;overflow:hidden;padding:88px 0 96px}
.hero::before{content:"";position:absolute;inset:0;background:repeating-linear-gradient(90deg,transparent 0 118px,rgba(255,255,255,.14) 118px 122px)}
.hero .wrap{position:relative}
.hero h1{font-size:clamp(52px,9vw,112px);font-weight:800;max-width:11ch;text-transform:uppercase}
.hero p{font-size:20px;max-width:46ch;margin:22px 0 32px}
.hero .btns{display:flex;gap:14px;flex-wrap:wrap}
section{padding:72px 0}
h2{font-size:44px;font-weight:800;margin-bottom:28px;text-transform:uppercase}
.cats{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
.cat{background:var(--ink);color:#fff;padding:28px 22px;min-height:140px;display:flex;flex-direction:column;justify-content:flex-end;border-left:8px solid var(--yellow)}
.cat:nth-child(2){border-color:var(--red)}.cat:nth-child(3){border-color:var(--green)}.cat:nth-child(4){border-color:#fff}
.cat h3{font-size:30px}.cat span{color:#b8c0cc;font-size:15px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px}
.card{background:#fff;border:1px solid var(--line);border-radius:8px;overflow:hidden;display:flex;flex-direction:column}
.thumb{height:170px;display:grid;place-items:center;font-family:"Barlow Condensed";font-size:64px;font-weight:800;color:rgba(255,255,255,.9)}
.card .body{padding:16px;display:flex;flex-direction:column;gap:6px;flex:1}
.card h3{font-size:24px}.card small{color:var(--muted)}
.price{font-weight:600;font-size:18px;margin-top:auto}
.card .btn{width:100%;margin-top:10px;background:var(--ink);color:#fff;padding:11px}
.card .btn:hover{background:var(--green)}
.why{background:#fff;border-block:1px solid var(--line)}
.why ul{list-style:none;padding:0;display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:28px}
.why h3{font-size:26px;margin-bottom:8px}.why p{color:var(--muted)}
.join{background:var(--ink);color:#fff;text-align:center}
.join p{margin:0 auto 26px;max-width:48ch;color:#b8c0cc}
footer{background:#0b0e13;color:#98a1ae;padding:30px 0;font-size:15px}
footer .wrap{display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px}
#toast{position:fixed;bottom:20px;left:50%;transform:translate(-50%,80px);background:var(--ink);color:#fff;padding:12px 20px;border-radius:6px;transition:transform .25s}
#toast.on{transform:translate(-50%,0)}
@media(max-width:700px){nav a.hide{display:none}section{padding:52px 0}h2{font-size:36px}}
@media(prefers-reduced-motion:reduce){#toast{transition:none}}
</style>
</head>
<body>
<header>
  <div class="wrap">
    <a href="/" class="logo">BARTWEL<span>.</span>SPORTS</a>
    <nav>
      <a class="hide" href="#shop">Shop</a>
      <a class="hide" href="#featured">Featured</a>
      @auth<a class="hide" href="/dashboard">My account</a>@else<a class="hide" href="/login">Login</a>@endauth
      <a class="cart" href="/cart">Cart ({{ collect(session('cart', []))->sum('quantity') }})</a>
    </nav>
  </div>
</header>
@if(session('success'))<div style="background:#0e7a4f;color:#fff;padding:10px;text-align:center">{{ session('success') }}</div>@endif

<main>
<div class="hero">
  <div class="wrap">
    <h1>Train hard. Play harder.</h1>
    <p>Football boots, gym equipment, running gear and supplements, all in one store in Zambia.</p>
    <div class="btns">
      <a class="btn main" href="#featured">Shop now</a>
      <a class="btn ghost" href="/register">Create account</a>
    </div>
  </div>
</div>

<section id="shop">
  <div class="wrap">
    <h2>Shop by sport</h2>
    <div class="cats" data-live-block="categories">
      @forelse($categories as $c)
        <a class="cat" href="/products?category={{ $c->slug }}"><h3>{{ $c->name }}</h3><span>{{ $c->products_count }} {{ \Illuminate\Support\Str::plural('product', $c->products_count) }}</span></a>
      @empty
        <p>No categories yet.</p>
      @endforelse
    </div>
  </div>
</section>

<section id="featured" style="padding-top:0">
  <div class="wrap">
    <h2>Featured products</h2>
    <div class="grid" data-live-block="featured">
      @forelse($latest->take(4) as $p)
      <article class="card">
        <a href="/products/{{ $p->id }}">
        @if($p->image)<img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->name }}" style="height:170px;width:100%;object-fit:cover;display:block">
        @else<div class="thumb" style="background:{{ ['#0e7a4f','#d6342c','#2c5fb3','#8a5a14'][$p->category_id % 4] }}">{{ strtoupper(substr($p->name, 0, 2)) }}</div>@endif
        </a>
        <div class="body">
          <h3><a href="/products/{{ $p->id }}">{{ $p->name }}</a></h3>
          <small>{{ $p->category->name }}@if($p->stock < 1) &middot; Out of stock @elseif($p->stock <= 5) &middot; Only {{ $p->stock }} left @endif</small>
          <div class="price">K{{ number_format($p->price, 2) }}</div>
          <form method="POST" action="/cart/add/{{ $p->id }}">@csrf<button class="btn" @disabled($p->stock < 1)>Add to cart</button></form>
        </div>
      </article>
      @empty
      <p>No products yet. Check back soon.</p>
      @endforelse
    </div>
  </div>
</section>

<section class="why">
  <div class="wrap">
    <ul>
      <li><h3>Genuine gear</h3><p>Every item is checked before it reaches you.</p></li>
      <li><h3>Fast delivery</h3><p>Order online and get it delivered across Lusaka.</p></li>
      <li><h3>Pay your way</h3><p>Mobile money or cash on delivery.</p></li>
    </ul>
  </div>
</section>

<section class="join">
  <div class="wrap">
    <h2>Track your orders</h2>
    <p>Create a free account to save your cart, follow your orders and reorder in one tap.</p>
    <a class="btn main" href="/register">Create account</a>
  </div>
</section>
</main>

<footer>
  <div class="wrap">
    <span>&copy; 2026 Bartwel Sports &amp; Fitness. All rights reserved.</span>
    <span>Lusaka, Zambia</span>
  </div>
</footer>

<script src="{{ asset('js/live.js') }}"></script>
</body>
</html>
