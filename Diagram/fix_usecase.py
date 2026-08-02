#!/usr/bin/env python3
"""Fix use case diagrams: add missing association lines, fix extend/gen arrows."""

import re
import os

DIAGRAM_DIR = r"D:\laragon\www\AplikasiKosanAyokos\Diagram"

def add_edges_before_root(xml, edges):
    """Add edge cells before </root>."""
    insert = "\n" + "\n".join(edges) + "\n"
    return xml.replace("</root>", insert + "      </root>")

def fix_guest_penghuni(xml):
    # Fix generalization: hollow triangle (endFill=1 -> endFill=0)
    xml = xml.replace(
        'endArrow=block;endFill=1;exitX=0.5;exitY=0;exitDx=0;exitDy=0;entryX=0.5;entryY=1;entryDx=0;entryDy=0;',
        'endArrow=block;endFill=0;exitX=0.5;exitY=0;exitDx=0;exitDy=0;entryX=0.5;entryY=1;entryDx=0;entryDy=0;'
    )
    # Fix extend arrow direction: UC-13--extend-->UC-14 should be UC-14-->UC-13
    # Current: source="28" target="29"
    # Fix: source="29" target="28"  
    xml = xml.replace(
        '<mxCell id="31" value="&lt;&lt;extend&gt;&gt;" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;endArrow=open;dashed=1;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="28" target="29">',
        '<mxCell id="31" value="&lt;&lt;extend&gt;&gt;" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;endArrow=open;dashed=1;fontSize=9;labelBackgroundColor=#ffffff;" edge="1" parent="1" source="29" target="28">'
    )

    # Add missing association edges: Pengunjung (5) -> UC
    pengunjung_ucs = [
        ('50', '5', '14'),  # UC-04 Melihat Peta Kos
        ('51', '5', '15'),  # UC-05 Lihat Info
        ('52', '5', '16'),  # UC-06 Mendaftar Akun
        ('53', '5', '17'),  # UC-07 Login
        ('54', '5', '18'),  # UC-08 Reset Password
        ('55', '5', '19'),  # UC-09 Review Publik
    ]
    # Add missing association edges: Penghuni (6) -> UC
    penghuni_ucs = [
        ('56', '6', '28'),  # UC-13 Daftar Kontrak
        ('57', '6', '29'),  # UC-14 Detail Kontrak
        ('58', '6', '30'),  # UC-15 Pembayaran
        ('59', '6', '33'),  # UC-16 Riwayat
        ('60', '6', '34'),  # UC-17 Review
        ('61', '6', '35'),  # UC-18 Edit Review
        ('62', '6', '37'),  # UC-19 Hapus Review
        ('63', '6', '38'),  # UC-20 Analisis
        ('64', '6', '39'),  # UC-21 Aduan
        ('65', '6', '40'),  # UC-22 Komentar
        ('66', '6', '41'),  # UC-23 Profil
        ('67', '6', '42'),  # UC-24 Notifikasi
        ('68', '6', '43'),  # UC-25 Logout
    ]
    all_edges = []
    for eid, src, tgt in pengunjung_ucs + penghuni_ucs:
        all_edges.append(
            f'        <mxCell id="{eid}" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;" edge="1" parent="1" source="{src}" target="{tgt}">\n'
            f'          <mxGeometry relative="1" as="geometry"/>\n'
            f'        </mxCell>'
        )
    return add_edges_before_root(xml, all_edges)

def fix_pemilik(xml):
    pemilik_ucs = [
        ('40', '4', '11'),  # UC-29 Fasilitas
        ('41', '4', '12'),  # UC-30 Pengaturan
        ('42', '4', '13'),  # UC-31 Kamar
        ('43', '4', '14'),  # UC-32 Daftar Kontrak
        ('44', '4', '15'),  # UC-33 Setujui Kontrak
        ('45', '4', '16'),  # UC-34 Tolak Kontrak
        ('46', '4', '17'),  # UC-35 Selesaikan
        ('47', '4', '18'),  # UC-36 Hapus Kontrak
        ('48', '4', '19'),  # UC-37 Lihat Pembayaran
        ('49', '4', '20'),  # UC-38 Setujui Pembayaran
        ('50', '4', '21'),  # UC-39 Tolak Pembayaran
        ('51', '4', '22'),  # UC-40 Review
        ('52', '4', '23'),  # UC-41 Analisis
        ('53', '4', '24'),  # UC-42 Aduan
        ('54', '4', '25'),  # UC-43 Komentar
        ('55', '4', '26'),  # UC-44 Profil
        ('56', '4', '27'),  # UC-45 Notifikasi
        ('57', '4', '28'),  # UC-46 Logout
        ('58', '4', '29'),  # UC-47 Export PDF
    ]
    all_edges = []
    for eid, src, tgt in pemilik_ucs:
        all_edges.append(
            f'        <mxCell id="{eid}" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;" edge="1" parent="1" source="{src}" target="{tgt}">\n'
            f'          <mxGeometry relative="1" as="geometry"/>\n'
            f'        </mxCell>'
        )
    return add_edges_before_root(xml, all_edges)

def fix_admin_sistem(xml):
    # Remove "Sistem" as stick figure actor inside boundary
    # Replace it with a rectangle actor OUTSIDE the boundary (move to left, below Admin)
    # Actually, better approach: remove the "Sistem" stick figure and make these use cases
    # have no actor (system internal functions)
    
    admin_ucs = [
        ('35', '5', '9'),   # UC-49 Manage Admin
        ('36', '5', '10'),  # UC-50 Lihat Pemilik
        ('37', '5', '11'),  # UC-51 Update Status Pemilik
        ('38', '5', '12'),  # UC-52 Lihat Penghuni
        ('39', '5', '13'),  # UC-53 Update Status Penghuni
        ('40', '5', '14'),  # UC-54 Lihat Kos
        ('41', '5', '15'),  # UC-55 Moderasi Review
        ('42', '5', '16'),  # UC-56 Kelola Aduan
        ('43', '5', '17'),  # UC-57 Analisis
        ('44', '5', '18'),  # UC-58 Laporan
        ('45', '5', '19'),  # UC-59 Keuangan
        ('46', '5', '20'),  # UC-60 Logout
    ]
    # For system UC, no actor needed (internal system functions)
    
    all_edges = []
    for eid, src, tgt in admin_ucs:
        all_edges.append(
            f'        <mxCell id="{eid}" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;" edge="1" parent="1" source="{src}" target="{tgt}">\n'
            f'          <mxGeometry relative="1" as="geometry"/>\n'
            f'        </mxCell>'
        )
    xml = add_edges_before_root(xml, all_edges)
    
    # Remove "Sistem" actor and its associations
    # Remove the stick figure cell
    xml = xml.replace(
        '<mxCell id="6" value="Sistem" style="shape=umlActor;verticalLabelPosition=bottom;verticalAlign=top;html=1;fillColor=#f5f5f5;strokeColor=#666666;fontSize=11;" vertex="1" parent="1">\n'
        '          <mxGeometry x="70" y="440" width="30" height="60" as="geometry"/>\n'
        '        </mxCell>',
        ''
    )
    # Remove associations from Sistem
    xml = xml.replace(
        '<mxCell id="22" value="" style="edgeStyle=orthogonalEdgeStyle;rounded=1;orthogonalLoop=1;jettySize=auto;html=1;exitX=1;exitY=0.5;" edge="1" parent="1" source="6" target="21">\n'
        '          <mxGeometry relative="1" as="geometry"/>\n'
        '        </mxCell>',
        ''
    )
    return xml

def main():
    files = {
        'use-case-guest-penghuni.drawio': fix_guest_penghuni,
        'use-case-pemilik.drawio': fix_pemilik,
        'use-case-admin-sistem.drawio': fix_admin_sistem,
    }
    for fname, fixer in files.items():
        fpath = os.path.join(DIAGRAM_DIR, fname)
        with open(fpath, 'r', encoding='utf-8') as f:
            xml = f.read()
        xml = fixer(xml)
        with open(fpath, 'w', encoding='utf-8') as f:
            f.write(xml)
        print(f"Fixed: {fname}")

if __name__ == '__main__':
    main()
