// Live updates on every page.
// 1. Every 5 seconds ask the server for a fingerprint of the data (products, categories, orders, users).
// 2. If it changed, download the current page in the background and swap each [data-live-block] in place.
// No page refresh. A block is skipped while someone is typing in it, so nothing gets lost.
(function () {
  if (window.__liveStarted) { return; }            // safe if this file is included twice
  window.__liveStarted = true;
  if (!document.querySelector('[data-live-block]')) { return; }
  var version = null;
  var busy = false;

  // Has the visitor changed this field from what the server rendered?
  function fieldDirty(i) {
    if (i.type === 'hidden' || i.type === 'submit' || i.type === 'button') { return false; }
    if (i.type === 'file') { return !!(i.files && i.files.length > 0); }
    if (i.type === 'checkbox' || i.type === 'radio') { return i.checked !== i.defaultChecked; }
    if (i.tagName === 'SELECT') {
      var def = 0;                                  // with no "selected" attribute the browser picks the first option
      for (var k = 0; k < i.options.length; k++) { if (i.options[k].defaultSelected) { def = k; break; } }
      return i.selectedIndex !== def;
    }
    return i.value !== i.defaultValue;
  }
  function isDirty(el) {
    return Array.prototype.some.call(el.querySelectorAll('input, textarea, select'), fieldDirty);
  }

  function refresh(el, doc, state) {
    var fresh = doc.querySelector('[data-live-block="' + el.dataset.liveBlock + '"]');
    if (!fresh || fresh.innerHTML === el.innerHTML) { return; }
    if (el.contains(document.activeElement) || isDirty(el)) {
      state.skipped = true;                         // someone is busy in here: leave it, but still update inner blocks
      el.querySelectorAll('[data-live-block]').forEach(function (inner) {
        if (inner.parentElement.closest('[data-live-block]') === el) { refresh(inner, doc, state); }
      });
      return;
    }
    var tab = el.querySelector('.nav-tabs .nav-link.active');
    var target = tab ? tab.getAttribute('data-bs-target') : null;
    el.innerHTML = fresh.innerHTML;
    state.changed = true;
    if (target && window.bootstrap) {
      var t = el.querySelector('[data-bs-target="' + target + '"]');
      if (t) { window.bootstrap.Tab.getOrCreateInstance(t).show(); }
    }
  }

  async function check() {
    if (document.hidden || busy) { return; }
    busy = true;
    try {
      var r = await fetch('/live/version', { headers: { 'Accept': 'application/json' }, cache: 'no-store' });
      if (!r.ok) { return; }
      var d = await r.json();
      if (version === null) { version = d.v; return; }
      if (d.v === version) { return; }

      var page = await fetch(location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-store' });
      if (!page.ok) { return; }
      var doc = new DOMParser().parseFromString(await page.text(), 'text/html');

      var state = { skipped: false, changed: false };
      document.querySelectorAll('[data-live-block]').forEach(function (el) {
        if (el.parentElement && el.parentElement.closest('[data-live-block]')) { return; }   // outermost blocks only
        refresh(el, doc, state);
      });
      if (!state.skipped) { version = d.v; }        // if something was skipped, try again on the next tick
      if (state.changed) { window.dispatchEvent(new Event('live:updated')); }
    } catch (e) { /* network hiccup: try again next tick */ }
    finally { busy = false; }
  }

  check();
  setInterval(check, 5000);
  document.addEventListener('visibilitychange', check);
})();
