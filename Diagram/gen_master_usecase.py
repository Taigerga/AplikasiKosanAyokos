#!/usr/bin/env python3
"""Generate master use case diagram combining all actors with ~21 essential use cases."""

import os

DIAGRAM_DIR = r"D:\laragon\www\AplikasiKosanAyokos\Diagram"

def esc(s):
    return s.replace('&', '&amp;').replace('<', '&lt;').replace('>', '&gt;')

UC = [
    # (id, label, x, y, fill, stroke, actor_ids)
    # Row 1 - Autentikasi (y=105)
    ('uc01', 'UC-01\nLogin', 240, 105, '#dae8fc', '#6c8ebf', ['pengunjung']),
    ('uc02', 'UC-02\nRegister', 420, 105, '#dae8fc', '#6c8ebf', ['pengunjung']),
    ('uc03', 'UC-03\nReset Password', 600, 105, '#dae8fc', '#6c8ebf', ['pengunjung']),
    # Row 2 - Kos (y=180)
    ('uc04', 'UC-04\nCari Kos', 240, 180, '#dae8fc', '#6c8ebf', ['pengunjung']),
    ('uc05', 'UC-05\nDetail Kos', 420, 180, '#dae8fc', '#6c8ebf', ['pengunjung']),
    ('uc06', 'UC-06\nKelola Kos', 600, 180, '#ffe6cc', '#d79b00', ['pemilik']),
    # Row 3 - Kontrak (y=260)
    ('uc07', 'UC-07\nAjukan Kontrak', 240, 260, '#d5e8d4', '#82b366', ['penghuni']),
    ('uc08', 'UC-08\nSetujui/Tolak Kontrak', 420, 260, '#ffe6cc', '#d79b00', ['pemilik']),
    ('uc09', 'UC-09\nSelesaikan Kontrak', 600, 260, '#ffe6cc', '#d79b00', ['pemilik']),
    # Row 4 - Pembayaran (y=340)
    ('uc10', 'UC-10\nLakukan Pembayaran', 240, 340, '#d5e8d4', '#82b366', ['penghuni']),
    ('uc11', 'UC-11\nSetujui Pembayaran', 420, 340, '#ffe6cc', '#d79b00', ['pemilik']),
    ('uc12', 'UC-12\nRiwayat Pembayaran', 600, 340, '#d5e8d4', '#82b366', ['penghuni']),
    # Row 5 - Aduan & Review (y=420)
    ('uc13', 'UC-13\nBuat/Muat Review', 240, 420, '#d5e8d4', '#82b366', ['penghuni']),
    ('uc14', 'UC-14\nAjukan Aduan', 420, 420, '#d5e8d4', '#82b366', ['penghuni', 'pemilik']),
    ('uc15', 'UC-15\nKelola Aduan', 600, 420, '#e1d5e7', '#9673a6', ['admin']),
    # Row 6 - Admin (y=500)
    ('uc16', 'UC-16\nDashboard Platform', 240, 500, '#e1d5e7', '#9673a6', ['admin']),
    ('uc17', 'UC-17\nKelola Pengguna', 420, 500, '#e1d5e7', '#9673a6', ['admin']),
    ('uc18', 'UC-18\nLihat Laporan', 600, 500, '#e1d5e7', '#9673a6', ['admin']),
    # Row 7 - Sistem (y=580)
    ('uc19', 'UC-19\nKirim Notifikasi', 240, 580, '#f5f5f5', '#999999', []),
    ('uc20', 'UC-20\nCallback Payment', 420, 580, '#f5f5f5', '#999999', []),
    ('uc21', 'UC-21\nScheduled Tenggat', 600, 580, '#f5f5f5', '#999999', []),
]

SECTIONS = [
    (90, 'Autentikasi', '#dae8fc', '#6c8ebf'),
    (165, 'Manajemen Kos', '#ffe6cc', '#d79b00'),
    (245, 'Kontrak Sewa', '#d5e8d4', '#82b366'),
    (325, 'Pembayaran', '#d5e8d4', '#82b366'),
    (405, 'Aduan & Review', '#fff2cc', '#d6b656'),
    (485, 'Admin', '#e1d5e7', '#9673a6'),
    (565, 'Sistem (Internal)', '#f5f5f5', '#999999'),
]

ACTORS = [
    ('pengunjung', 'Pengunjung', 60, 80, '#dae8fc', '#6c8ebf'),
    ('penghuni', 'Penghuni', 60, 190, '#d5e8d4', '#82b366'),
    ('pemilik', 'Pemilik', 60, 400, '#ffe6cc', '#d79b00'),
    ('admin', 'Admin', 60, 550, '#e1d5e7', '#9673a6'),
]

INCLUDES = [
    ('uc02', 'uc01'),  # Register include Login
    ('uc07', 'uc04'),  # Ajukan Kontrak include Cari Kos
]

def gen():
    lines = []
    a = lines.append
    
    a('<?xml version="1.0" encoding="UTF-8"?>')
    a('<mxfile host="drawio" version="24.7.17">')
    a('  <diagram name="Use Case - Master">')
    a('    <mxGraphModel>')
    a('      <root>')
    a('        <mxCell id="0"/>')
    a('        <mxCell id="1" parent="0"/>')
    
    # System boundary
    a('        <mxCell id="sys" value="Sistem AyoKos" style="shape=umlFrame;whiteSpace=wrap;html=1;fillColor=none;strokeColor=#333333;fontStyle=1;fontSize=14;" vertex="1" parent="1">')
    a('          <mxGeometry x="200" y="40" width="620" height="650" as="geometry"/>')
    a('        </mxCell>')
    
    # Section labels
    for sidx, (sy, label, sc, ss) in enumerate(SECTIONS):
        lid = f"sec{sidx}"
        a(f'        <mxCell id="{lid}" value="{esc(label)}" style="text;html=1;align=center;verticalAlign=middle;fontStyle=1;fontSize=10;fillColor={sc};strokeColor={ss};rounded=1;" vertex="1" parent="1">')
        a(f'          <mxGeometry x="220" y="{sy}" width="120" height="18" as="geometry"/>')
        a(f'        </mxCell>')
    
    # Actors
    for aid, alabel, ax, ay, af, as_ in ACTORS:
        a(f'        <mxCell id="{aid}" value="{alabel}" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;fillColor={af};strokeColor={as_};fontSize=11;" vertex="1" parent="1">')
        a(f'          <mxGeometry x="{ax}" y="{ay}" width="30" height="60" as="geometry"/>')
        a(f'        </mxCell>')
    
    # Generalization: Penghuni -> Pengunjung
    a('        <mxCell id="gen1" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;endArrow=block;endFill=0;" edge="1" parent="1" source="penghuni" target="pengunjung">')
    a('          <mxGeometry relative="1" as="geometry"/>')
    a('        </mxCell>')
    
    # Use cases
    for uid, ulabel, ux, uy, uf, us_, _ in UC:
        a(f'        <mxCell id="{uid}" value="{esc(ulabel)}" style="ellipse;whiteSpace=wrap;html=1;fillColor={uf};strokeColor={us_};fontSize=9;" vertex="1" parent="1">')
        a(f'          <mxGeometry x="{ux}" y="{uy}" width="120" height="36" as="geometry"/>')
        a(f'        </mxCell>')
    
    # Association edges
    eid = 100
    for uid, _, _, _, _, _, actor_ids in UC:
        for aid in actor_ids:
            if not aid:
                continue
            aid_map = {'pengunjung': 'pengunjung', 'penghuni': 'penghuni', 'pemilik': 'pemilik', 'admin': 'admin'}
            a(f'        <mxCell id="e{eid}" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;" edge="1" parent="1" source="{aid_map[aid]}" target="{uid}">')
            a(f'          <mxGeometry relative="1" as="geometry"/>')
            a(f'        </mxCell>')
            eid += 1
    
    # Include/Extend edges
    for src, tgt in INCLUDES:
        a(f'        <mxCell id="e{eid}" value="&lt;&lt;include&gt;&gt;" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;endArrow=open;dashed=1;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="{src}" target="{tgt}">')
        a(f'          <mxGeometry relative="1" as="geometry"/>')
        a(f'        </mxCell>')
        eid += 1
    
    # Legend
    a('        <mxCell id="legend" value="Legend" style="rounded=0;whiteSpace=wrap;html=1;fillColor=none;strokeColor=#666666;verticalAlign=top;fontStyle=1;fontSize=10;" vertex="1" parent="1">')
    a('          <mxGeometry x="630" y="700" width="180" height="110" as="geometry"/>')
    a('        </mxCell>')
    legend_items = [
        ('#dae8fc', '#6c8ebf', 'Pengunjung'),
        ('#d5e8d4', '#82b366', 'Penghuni'),
        ('#ffe6cc', '#d79b00', 'Pemilik'),
        ('#e1d5e7', '#9673a6', 'Admin'),
        ('#f5f5f5', '#999999', 'Sistem (Internal)'),
    ]
    li_y = 28
    for lf, ls, ll in legend_items:
        a(f'        <mxCell id="lbox{li_y}" value="" style="rounded=0;html=1;fillColor={lf};strokeColor={ls};" vertex="1" parent="legend">')
        a(f'          <mxGeometry x="10" y="{li_y}" width="16" height="12" as="geometry"/>')
        a(f'        </mxCell>')
        a(f'        <mxCell id="ltxt{li_y}" value="{esc(ll)}" style="text;html=1;align=left;verticalAlign=middle;fontSize=8;" vertex="1" parent="legend">')
        a(f'          <mxGeometry x="32" y="{li_y-2}" width="140" height="16" as="geometry"/>')
        a(f'        </mxCell>')
        li_y += 18
    
    a(f'        <mxCell id="linclude" value="&lt;html&gt;&lt;span style=&quot;border-bottom:1px dashed #333;&quot;&gt;dashed&lt;/span&gt; = &amp;lt;&amp;lt;include&amp;gt;&amp;gt;" style="text;html=1;align=left;verticalAlign=middle;fontSize=8;" vertex="1" parent="legend">')
    a(f'          <mxGeometry x="10" y="{li_y+2}" width="160" height="16" as="geometry"/>')
    a(f'        </mxCell>')
    
    a('      </root>')
    a('    </mxGraphModel>')
    a('  </diagram>')
    a('</mxfile>')
    
    return '\n'.join(lines)

def main():
    xml = gen()
    fpath = os.path.join(DIAGRAM_DIR, 'use-case-master.drawio')
    with open(fpath, 'w', encoding='utf-8') as f:
        f.write(xml)
    print(f"Generated: use-case-master.drawio")

if __name__ == '__main__':
    main()
