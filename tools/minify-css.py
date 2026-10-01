#!/usr/bin/env python3
"""Maakt veryo/assets/css/main.min.css uit main.css: commentaar en overbodige witruimte eruit."""
import re, sys, pathlib
src = pathlib.Path(__file__).resolve().parent.parent / 'veryo/assets/css/main.css'
css = src.read_text(encoding='utf-8')
css = re.sub(r'/\*.*?\*/', '', css, flags=re.S)
css = re.sub(r'\s+', ' ', css)
css = re.sub(r'\s*([{};,>])\s*', r'\1', css)
css = re.sub(r':\s+', ':', css)
css = css.replace(';}', '}')
# Spaties rond + en - binnen calc() blijven staan; die zijn nodig.
out = src.with_name('main.min.css')
out.write_text(css.strip() + '\n', encoding='utf-8')
print(f'{out.name}: {len(css.encode())} bytes (bron {len(src.read_bytes())})')
