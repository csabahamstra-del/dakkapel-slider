"""Crawlt alle pagina's uit de sitemap en controleert status, H1, JSON-LD, externe bronnen en canonical."""
import json, re, sys, urllib.request
from html.parser import HTMLParser

BASE = sys.argv[1] if len(sys.argv) > 1 else 'http://localhost:8080'

def get(url):
    try:
        with urllib.request.urlopen(url) as r:
            return r.status, r.read().decode('utf-8'), dict(r.headers)
    except urllib.error.HTTPError as e:
        return e.code, e.read().decode('utf-8'), dict(e.headers)

class P(HTMLParser):
    def __init__(s):
        super().__init__(); s.h1 = 0; s.ld = []; s.inld = False; s.ext = []; s.robots = ''; s.canon = ''; s.title = ''; s.intitle = False; s.desc = ''
    def handle_starttag(s, t, a):
        a = dict(a)
        if t == 'h1': s.h1 += 1
        if t == 'script' and a.get('type') == 'application/ld+json': s.inld = True; s.ld.append('')
        if t == 'title': s.intitle = True
        if t == 'meta' and a.get('name') == 'robots': s.robots = a.get('content', '')
        if t == 'meta' and a.get('name') == 'description': s.desc = a.get('content', '')
        if t == 'link' and a.get('rel') == 'canonical': s.canon = a.get('href', '')
        for attr in ('src', 'srcset'):
            if a.get(attr, '').startswith('http') and not a[attr].startswith(BASE): s.ext.append(a[attr])
        if t == 'link' and a.get('href', '').startswith('http') and not a['href'].startswith(BASE) and a.get('rel') in ('stylesheet', 'preload', 'preconnect', 'dns-prefetch', 'icon', 'apple-touch-icon'):
            s.ext.append(a['href'])
    def handle_endtag(s, t):
        if t == 'script': s.inld = False
        if t == 'title': s.intitle = False
    def handle_data(s, d):
        if s.inld: s.ld[-1] += d
        if s.intitle: s.title += d

_, sm, _ = get(BASE + '/wp-sitemap.xml')
urls = []
for sub in re.findall(r'<loc>(.*?)</loc>', sm):
    _, x, _ = get(sub)
    urls += re.findall(r'<loc>(.*?)</loc>', x)
print('sitemap-URLs:', len(urls))
for bad in ('/rapport/', '/bedankt/', '/cookieverklaring/', '/algemene-voorwaarden/', 'veryo_lead', '/wp-sitemap-users'):
    print('  niet in sitemap', bad, ':', 'OK' if not any(bad in u for u in urls) and bad not in sm else 'FOUT')
extra = [BASE + p for p in ('/rapport/', '/bedankt/', '/cookieverklaring/', '/algemene-voorwaarden/', '/bestaat-niet/')]
problems = 0; types = {}
for u in urls + extra:
    st, html, h = get(u)
    p = P(); p.feed(html)
    msgs = []
    if st != 200 and 'bestaat-niet' not in u: msgs.append('status %d' % st)
    if p.h1 != 1: msgs.append('%d x H1' % p.h1)
    if p.ext: msgs.append('extern: ' + ', '.join(p.ext))
    for block in p.ld:
        try:
            d = json.loads(block)
            for n in d.get('@graph', []):
                t = n['@type'] if isinstance(n['@type'], str) else '+'.join(n['@type'])
                types[t] = types.get(t, 0) + 1
        except Exception as e:
            msgs.append('JSON-LD ongeldig: %s' % e)
    if re.search(r'(Warning|Notice|Deprecated|Fatal error)</b>:', html): msgs.append('PHP-melding in HTML')
    if '[VUL IN' in html or '[FOTO' in html: msgs.append('placeholder zichtbaar voor bezoekers')
    if msgs: problems += 1
    print(('FOUT ' if msgs else 'ok   ') + u.replace(BASE, '') + '  [' + p.robots + '] ' + p.title.strip()[:60] + ('  ' + '; '.join(msgs) if msgs else ''))
print('schema-types:', types)
st, txt, h = get(BASE + '/robots.txt'); print('--- robots.txt', st); print(txt)
st, txt, h = get(BASE + '/llms.txt'); print('--- llms.txt', st, h.get('Content-Type')); print(txt[:900])
print('problemen:', problems)

# FAQ-schema moet exact overeenkomen met de zichtbare tekst.
import html as H
mism = 0; checked = 0
for u in urls:
    st, page, _ = get(u)
    p = P(); p.feed(page)
    visible = {}
    for q, a in re.findall(r'<details class="wp-block-details[^"]*"><summary>(.*?)</summary>(.*?)</details>', page, re.S):
        norm = lambda t: re.sub(r'\s+', ' ', H.unescape(re.sub('<[^>]+>', '', t))).strip()
        visible[norm(q)] = norm(a)
    for block in p.ld:
        for n in json.loads(block).get('@graph', []):
            if n['@type'] == 'FAQPage':
                for q in n['mainEntity']:
                    checked += 1
                    if visible.get(q['name']) != q['acceptedAnswer']['text']:
                        mism += 1; print('FAQ verschil op', u, q['name'])
print('FAQ-vragen gecontroleerd:', checked, 'verschillen:', mism)
